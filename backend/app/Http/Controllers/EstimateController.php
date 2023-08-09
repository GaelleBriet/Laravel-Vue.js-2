<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\Models\EstimateField;
use App\Models\EstimateLine;
use App\Models\EstimateFieldValue;
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
        $form = $request->all();

        $fields = EstimateField::all();

        $lines = [];
        $estimate = new Estimate();

        $totalPureTime = 0;
        $percentageProjectType = 0;
        $percentageDesignType= 0;

        $projectLine = [];
        $DesignLine = [];

        foreach ($fields as $field) {
            if ($field->slug == "nom-du-projet") {
                $estimate->name = $form["nom-du-projet"];
            }

            if ($field->type == "checkbox"  && isset($form[$field->slug])) {

                foreach ($form[$field->slug] as $formField) {
                    $value = $formField;
                    $preset = $field->values()->where("value", $value)->get();

                    $time = $preset[0]["time"];

                    // adding that time to totalTime (without %)
                    $totalPureTime += $time;

                    $lines[] = ["label" => $preset[0]["label"], "type" => "general", "time" => $time];
                }

            }

            if ($field->type == "custom" && isset($form[$field->slug])) {

                foreach ($form[$field->slug] as $formField) {
        
                    // adding that time to totalTime (without %) hours -> minutes
                    $time = $formField["time"]*60;
                    $totalPureTime += $time;

                    $lines[] = ["label" => $formField["name"], "type" => "general", "time" => $time];
                }

            }

            if ($field->type == "select" && isset($form[$field->slug])) {

                $value = $form[$field->slug];
                $preset = $field->values()->where("value", $value)->get();

                if ($form[$field->slug] === 'laravel' || $form[$field->slug] === 'laravel-et-vuejs') {

                    $percentageProjectType = $preset[0]['total_percentage'];

                    $time = $preset[0]['startup_time'];
                    $totalPureTime += $time;

                    $lines[] = ["label" => "Mise en place du projet", "type" => "general", "time" => $time];

                }

                if ($form[$field->slug] === 'simple' || $form[$field->slug] === 'complexe' || $form[$field->slug] === 	"complexe-avec-animations") {

                    // Design
                    $percentageDesignType = $preset[0]['total_percentage'];

                }

                // traitement pour afficher le texte dans le tableau de la page /details
                if ($form[$field->slug] === 'laravel' || $form[$field->slug] === 'laravel-et-vuejs') {
                    $projectLine["label"] = "Type de projet : " . $preset[0]["label"];
                    $projectLine["type"] = "specific";
                } else {
                    $DesignLine["label"] = "Type de design : " . $preset[0]["label"];
                    $DesignLine["type"] = "specific";
                }

            }

        }

        $projectLine["time"] = $totalPureTime * ($percentageProjectType/100);
        $DesignLine["time"] = $totalPureTime * ($percentageDesignType/100);

        $lines[] = $projectLine;
        $lines[] = $DesignLine;

        $estimate->total_time = $totalPureTime + $projectLine["time"] + $DesignLine["time"];

        $estimate->save();
        $estimate->lines()->createMany($lines);
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
