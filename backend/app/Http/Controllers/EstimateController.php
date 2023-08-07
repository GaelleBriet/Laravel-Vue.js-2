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
        $estimates = Estimate::all();
        return response()->json($estimates);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        //$estimate = Estimate::create($request->all());

        $estimate = new Estimate();
        $estimate->name = $request->name;
        $estimate->total_time = $request->total_time;
        $estimate->save();
        return response()->json($estimate, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $estimate = Estimate::with('lines')->findOrFail($id);
        return response()->json($estimate);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $estimate = Estimate::find($id);
        $estimate->name = $request->name;
        $estimate->total_time = $request->total_time;
        $estimate->save();
        return response()->json($estimate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $estimate = Estimate::find($id);
        $estimate->delete();
        return response()->json($estimate);
    }
}
