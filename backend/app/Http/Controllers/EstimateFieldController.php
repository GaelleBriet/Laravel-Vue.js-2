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
        $estimatesFields = EstimateField::all();
        return response()->json($estimatesFields);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $estimateField = EstimateField::create($request->all());
        // return response()->json($estimateField, 201);

        $estimateField = new EstimateField();
        $estimateField->name = $request->name;
        $estimateField->slug = $request->slug;
        $estimateField->type = $request->type;
        $estimateField->save();
        return response()->json($estimateField, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $estimateField = EstimateField::findOrFail($id);
        return response()->json($estimateField);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $estimateField = EstimateField::find($id);
        $estimateField->name = $request->name;
        $estimateField->slug = $request->slug;
        $estimateField->type = $request->type;
        $estimateField->save();
        return response()->json($estimateField);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $estimateField = EstimateField::findOrFail($id);
        $estimateField->delete();
        return response()->json($estimateField);
    }
}
