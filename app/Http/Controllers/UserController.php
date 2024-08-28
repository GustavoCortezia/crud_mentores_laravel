<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public function store(Request $request)
    {
        try {

            $request->validate(
                [
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|string'

                ],
                [
                    'required' => 'Campo :attribute é obrigatório!',
                    'string' => 'Campo :attribute precisa ser string!',
                    'email' => 'Campo :attribute precisa ser válido!',
                    'unique' => 'Campo :attribute já está em uso!'
                ]
            );

            $data = $request->all();

            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);

            return response()->json(['success' => true, 'msg' => "Usuário cadastrado com sucesso.", "data" => $user], Response::HTTP_CREATED);
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
}
