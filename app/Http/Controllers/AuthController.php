<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        try {

            $request->validate(
                [
                    'email' => 'required|email',
                    'password' => 'required|string'

                ],
                [
                    'required' => 'Campo :attribute é obrigatório!',
                    'string' => 'Campo :attribute precisa ser string!',
                    'email' => 'Campo :attribute precisa ser válido!',
                ]
            );

            $user = User::where('email', $request->email)->first();

            if(!$user || !Hash::check($request->password, $user->password)){
                return response()->json(['success' => false, 'message' => 'E-mail e/ou senha inválida'], Response::HTTP_UNAUTHORIZED);
            };

            $token = $user->createToken($user->email)->plainTextToken;



            return response()->json(['success' => true, 'msg' => "Login efetuado com sucesso.", "data" => $user, "token" => $token], Response::HTTP_OK);

            } catch (ValidationException $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Throwable $error) {
            return response()->json([
                'success' => false,
                'message' => 'Erro interno, tente novamente!'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json(['success' => false, 'msg' => 'Usuário não autenticado'], 401);
            }

            $user->tokens()->delete();

            return response()->json(['success' => true, 'msg' => "Logout feito com sucesso"], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()], 400);
        }
    }


}
