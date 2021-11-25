<?php

namespace App\Repositories\Repository;

use App\Models\User;
use App\Repositories\Contracts\UserInterface;
use App\Repositories\Repository\AbstractRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserRepository extends AbstractRepository implements UserInterface
{
    private $model = User::class;
    private $message;
    private $relationships = [];
    private $dependents = [];



    public function __construct()
    {
        $this->model = app($this->model);
        parent::__construct($this->model, $this->message, $this->relationships, $this->dependents);
    }

    public function login(Request $request)
    {
        try {
            $model = User::where('email', $request->email)->first();
            if ($model !== null && Hash::check($request->password, $model->password) === true) {
                $this->setMessage('Login efetuado com sucesso', 200);
                return $model->createToken($model->email)->plainTextToken;
            } else {
                $this->setMessage('Credenciais incorretas', 401);
                return null;
            }
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e, 500);
            return null;
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            $this->setMessage('Logout bem-sucedido', 200);
            return null;
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e, 500);
            return null;
        }
    }

    public function me(Request $request)
    {
        try {
            $this->setMessage('Dados encontrados', 200);
            return $request->user();
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e, 500);
            return null;
        }
    }
}
