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
        // on initialise le temps total à 0
        $estimate->total_time = 0;

        foreach ($fields as $field) {
            if ($field->slug == "nom-du-projet") {
                $estimate->name = $form["nom-du-projet"];
            }

            // on initialise le time et le % supplémentaire à 0
            $time = 0;
            $percentage = 0;

            if ($field->type == "select" && isset($form[$field->slug])) {
                // var_dump($form[$field->slug]);
                $value = $form[$field->slug];
                $preset = $field->values()->where("value", $value)->get();
                // $time = $preset[0]['startup_time'] ? $preset[0]['startup_time'] : $preset[0]['total_percentage'];


                if ($form[$field->slug] === 'laravel') {
                    // si nous avons un projet laravel nous transformons le temps prévu de minutes en heures
                    $time = $preset[0]['startup_time'] / 60;
                } elseif ($form[$field->slug] === 'laravel-et-vuejs') {
                    // si c'est un projet laravel et vue nous transformons le temps prévu de minutes en heures et récupérons le % à ajouter à la fin
                    $time = $preset[0]['startup_time'] / 60;
                    $percentage = $preset[0]['total_percentage'];
                } else {
                    // sinon nous n'avons qu'un % supplémentaire à récupérer
                    $percentage = $preset[0]['total_percentage'];
                }

                // traitement pour afficher el etxte dans le tableau de la page /details
                if ($form[$field->slug] === 'laravel' || $form[$field->slug] === 'laravel-et-vuejs') {
                    $label = "Type de projet : " . $preset[0]["label"];
                } else {
                    $label = "Type de design : " . $preset[0]["label"];
                }

                // informationsde la ligne à créer
                $lines[] = ["label" => $label, "type" => "specific", "time" => $time];

                // on ajoute au temps total les temps simples sans %
                $estimate->total_time += $time;
                $percentage += $percentage;
            }

            if ($field->type == "checkbox"  && isset($form[$field->slug])) {

                foreach ($form[$field->slug] as $formField) {
                    $value = $formField;
                    $preset = $field->values()->where("value", $value)->get();

                    // on modifie le temps de minutes en heures
                    $time = $preset[0]["time"] / 60;

                    $lines[] = ["label" => $preset[0]["label"], "type" => "general", "time" => $time];

                    // on ajoute au temps total les temps simples 
                    $estimate->total_time += $time;
                }
            }

            if ($field->type == "custom" && isset($form[$field->slug])) {

                foreach ($form[$field->slug] as $formField) {
                    $lines[] = ["label" => $formField["name"], "type" => "general", "time" => $formField["time"]];

                    $estimate->total_time += $formField["time"];
                }
            }
        }

        $estimate->total_time +=  $estimate->total_time * $percentage / 100;

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
