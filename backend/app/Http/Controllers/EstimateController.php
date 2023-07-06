<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(["name" => "GET /api/estimates : Liste des estimations."]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        return response()->json(["name" => "POST /api/estimates : Création d'une estimation."]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(["name" => "GET /api/estimates/{estimate} : Affichage d'une estimation."]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return response()->json(["name" => "PUT|PATCH /api/estimates/{estimate} : Mise à jour d'une estimation."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json(["name" => "DELETE /api/estimates/{estimate} : Suppression d'une estimation."]);
    }
}
