<?php

namespace Database\Seeders;

use App\Models\EstimateField;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        EstimateField::factory()->create([
            "name" => "Nom du projet",
            "slug" => Str::slug("Nom du projet"),
            "type" => "text"
        ]);

        EstimateField::factory()->create([
            "name" => "Technologies",
            "slug" => Str::slug("Technologies"),
            "type" => "select"
        ])
            ->values()->createMany([
                [
                    "label" => "Laravel",
                    "value" => "laravel",
                    "startup_time" => 4 * 60,
                    "total_percentage" => 0
                ],
                [
                    "label" => "Laravel et Vue.js",
                    "value" => Str::slug("Laravel et Vue.js"),
                    "startup_time" => 6 * 60,
                    "total_percentage" => 25
                ]
            ]);

        EstimateField::factory()->create([
            "name" => "Développements génériques",
            "slug" => Str::slug("Développements génériques"),
            "type" => "checkbox"
        ])
            ->values()->createMany([
                [
                    "label" => "Page d'accueil",
                    "value" => Str::slug("Page d'accueil"),
                    "time" => 7 * 60,
                ],
                [
                    "label" => "Événement",
                    "value" => Str::slug("Événement"),
                    "time" => 14 * 60,
                ],
                [
                    "label" => "Page de type éditoriale",
                    "value" => Str::slug("Page de type éditoriale"),
                    "time" => 5 * 60,
                ],
                [
                    "label" => "Offres d'emplois",
                    "value" => Str::slug("Offres d'emplois"),
                    "time" => 16 * 60,
                ],
                [
                    "label" => "Blog",
                    "value" => Str::slug("Blog"),
                    "time" => 10 * 60,
                ],
            ]);

        EstimateField::factory()->create([
            "name" => "Développements supplémentaires",
            "slug" => Str::slug("Développements supplémentaires"),
            "type" => "custom"
        ]);

        EstimateField::factory()->create([
            "name" => "Type de design",
            "slug" => Str::slug("Type de design"),
            "type" => "select"
        ])
            ->values()->createMany([
                [
                    "label" => "Simple",
                    "value" => Str::slug("Simple"),
                    "total_percentage" => 0,
                ],
                [
                    "label" => "Complexe",
                    "value" => Str::slug("Complexe"),
                    "total_percentage" => 15,
                ],
                [
                    "label" => "Complexe avec animations",
                    "value" => Str::slug("Complexe avec animations"),
                    "total_percentage" => 20,
                ]
            ]);
    }
}
