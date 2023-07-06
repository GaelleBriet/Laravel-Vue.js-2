<?php

namespace App\Http\Controllers;

use App\Models\EstimateField;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EstimateFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(["name" => "GET /api/fields : Liste des champs pour l'estimation."]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        return response()->json(["name" => "POST /api/fields : Création d'un champ pour l'estimation."]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(["name" => "GET /api/fields/{field} : Affichage d'un champ pour l'estimation."]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return response()->json(["name" => "PUT|PATCH /api/fields/{field} : Mise à jour d'un champ pour l'estimation."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json(["name" => "DELETE /api/fields/{field} : Suppression d'un champ pour l'estimation."]);
    }
}
