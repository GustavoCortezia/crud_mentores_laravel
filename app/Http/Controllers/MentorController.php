<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            // $limit = $request->query('limit');
            // $page = $request->query('page');

            // $mentores = Mentor::all()->paginate($limit, ['*'], 'page', $page);
            $mentores = Mentor::all();

            return response()->json(['mentores' => $mentores], Response::HTTP_OK);

        } catch (QueryException $e) {
            return response()->json(['message' => 'Ocorreu um erro ao recuperar os dados. Por favor, tente novamente.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate(
                [
                    'name' => 'required|string',
                    'email' => 'required|email',
                    'cpf' => 'required|string'

                ],
                [
                    'required' => 'Campo :attribute é obrigatório!',
                    'string' => 'Campo :attribute precisa ser string!',
                    'email' => 'Campo :attribute precisa ser válido!',
                ]
            );

            $mentor = Mentor::create($request->all());

            return response()->json(['success' => true, 'msg' => "Mentor cadastrado com sucesso.", "data" => $mentor], Response::HTTP_CREATED);
        } catch (ValidationException $th) {
            return response()->json(['success' => false,'message' => $th->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Throwable $error) {
            return response()->json(['success' => false,'message' => 'Erro interno, tente novamente!'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $mentor = Mentor::findOrFail($id);

            return response()->json(['success' => true, 'msg' => "Listado carro.", 'data' => $mentor]);
        } catch (ModelNotFoundException $error) {
            return response()->json(['success' => false, 'msg' => $error->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $request->validate(
                [
                    'name' => 'required|string',
                    'email' => 'required|email',
                    'cpf' => 'required|string'
                ],
                [
                    'required' => 'Campo :attribute é obrigatório!',
                    'string' => 'Campo :attribute precisa ser string!',
                    'email' => 'Campo :attribute precisa ser válido!',
                ]
            );

            $mentor = Mentor::findOrFail($id);

            // $carro->marca = $request->marca;
            // $carro->modelo = $request->modelo;

            $mentor->fill([
                'name' => $request->name,
                'cpf' => $request->cpf,
                'email' => $request->email
            ]);

            $mentor->save();

            return response()->json(['success' => true, 'msg' => "Mentor editado com sucesso!", 'data' => $mentor]);
        } catch (\Exception $error) {
            return response()->json(['success' => false, 'msg' => $error->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $mentor = Mentor::findOrFail($id);

            $mentor->delete();

            return response()->json(['success' => true, 'msg' => "Mentor excluido com sucesso!"]);
        } catch (\Exception $error) {
            return response()->json(['success' => false, 'msg' => $error->getMessage()], 400);
        }
    }
}
