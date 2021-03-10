<?php


namespace App\Services;


use App\Repositories\AuthenticationRepository;
use Firebase\JWT\JWT;
use Illuminate\Database\Eloquent\Model;

class AuthenticationService extends AbstractService
{
    public $repository;

    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->repository = new AuthenticationRepository($model);
    }

    public function login($user)
    {
        $data = $this->repository->getUser($user['email']);

        if (!is_null($data)) {
            return $this->checkPasswordLogin($data,$user['password'] );
        }

        return response()->json(['error' => 'Usuario não encontrado'], 401);
    }

    public function register($data)
    {
        $data['password'] = md5($data['password']);

        return response(['user' => $this->repository->store($data), 'message' => 'Usuário cadastrado com sucesso']);
    }

    /**
     * Convert data in JWT
     *
     * @return string
     */
    protected function createToken($data)
    {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'data' => $data, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + (200 * 24 * 60 * 60)// Expiration time
        ];
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    protected function checkPasswordLogin($user,$password)
    {
        if ($user->password != md5($password)) {
            return response()->json([
                'error' => 'Senha incorreta.'
            ], 401);
        } else {
            return response()->json([
                'token' => $this->createToken($user)
            ]);
        }
    }
}
