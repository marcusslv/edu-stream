<?php

namespace App\Http\Controllers\User;

use App\Domains\User\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(
        protected UserService $userService
    )
    {

    }
    public function register(Request $request)
    {
        Storage::put('exemplo.txt', 'Conteúdo do arquivo de exemplo');
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $this->userService->save([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->ok([
            'message' => 'Usuário registrado com sucesso!',
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = $this->userService->findOneWhere(['email' => $request->email]);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->error([
                'message' => 'Credenciais inválidas!',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('admin_token')->plainTextToken;

        return $this->ok([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => config('sanctum.expiration'),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->ok([
            'message' => 'Usuário deslogado com sucesso!',
        ]);
    }

    public function me()
    {
        $user = $this->userService->findOneWhere(['id' => auth()->id()]);

        return $this->ok([
            'user' => $user,
        ]);
    }
}
