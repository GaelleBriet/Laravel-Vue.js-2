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
        // $estimate = new Estimate();
        // $estimate->name = $request->name;
        // $estimate->total_time = $request->total_time;
        // $estimate->save();
        // return response()->json($estimate, 201);

        $form = $request->all();

        // dd($form);

        // dd($form);

        $fields = EstimateField::all();

        $lines = [];
        $estimate = new Estimate();

        foreach ($fields as $field) {
            if ($field->slug == "nom-du-projet") {
                $estimate->name = $form["nom-du-projet"];
            }
            if ($field->type == "select") {
                // var_dump($form[$field->slug]);
                $value = $form[$field->slug];
                $preset = $field->values()->where("value", $value)->get();
                $time = $preset[0]['startup_time'] ? $preset[0]['startup_time'] : $preset[0]['total_percentage'];

                if ($form[$field->slug] === 'laravel' || $form[$field->slug] === 'laravel-et-vuejs') {
                    $label = "Type de projet : " . $preset[0]["label"];
                } else {
                    $label = "Type de design : " . $preset[0]["label"];
                }

                $lines[] = ["label" => $label, "type" => "specific", "time" => $time];
            }
            if ($field->type == "checkbox") {

                foreach ($form[$field->slug] as $formField) {
                    $value = $formField;
                    $preset = $field->values()->where("value", $value)->get();
                    $time = $preset[0]["time"];
                    $lines[] = ["label" => $preset[0]["label"], "type" => "general", "time" => $time];
                }
            }
            if ($field->type == "custom") {

                foreach ($form[$field->slug] as $formField) {
                    $lines[] = ["label" => $formField["name"], "type" => "general", "time" => $formField["time"]];
                }
            }
        }


        $estimate->total_time = 120;

        $estimate->save();

        $estimate->lines()->createMany($lines);

        // dd($lines);
        $estimate->save();

        // dd($estimate);



        // $value = $form[$field->slug];
        // $preset = $field->values()->where("value", $value)->get();
        // $time = $preset->time ?? $preset->startup_time;
        // $lines[] = ["label" => $field->name, "type" => "general", "time" => $time];




        // $estimateLinesData = $request->input('estimate_lines', []);
        // foreach ($estimateLinesData as $lineData) {
        //     $estimateLine = new EstimateLine();
        //     $estimateLine->label = $lineData['label'];
        //     $estimateLine->time = $lineData['time'];
        //     $estimateLine->type = $lineData['type'];
        //     if (
        //         $lineData['label'] === "page-daccueil" ||
        //         $lineData['label'] === "evenement" ||
        //         $lineData['label'] === "page-de-type-editoriale" ||
        //         $lineData['label'] === "offres-demplois" ||
        //         $lineData['label'] === "blog"
        //     ) {
        //         $estimateFieldValue = EstimateFieldValue::where('value',  $lineData['label'])->first();
        //         $estimateLine->time = $estimateFieldValue->time;
        //     }
        //     $estimate->lines()->save($estimateLine);
        // }

        /*
        $fields = EstimateField:all();
        $lines = []
        foreach ($fields as $field) {
            if ($field->slug == "nom-du-projet") {
                $name = $form["nom-du-projet"];
            }
            if ($field->type == "select") {
                $value = $form[$field->slug];
                $preset = $field->values()->where("value", "=", $value)->get();
                $time = $preset->time ?? $preset->startup_time;
                $lines[] = ["label" => $field->name, $type => "general", "time" => $time]
            }
        }
        */


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
