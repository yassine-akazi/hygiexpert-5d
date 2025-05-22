<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Document;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DocumentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $clients = Client::all();

        $types = [
            'Factures', 'Plan', 'rapport_diagnostic', 'fiche_intervention',
            'attestation_traitement', 'evaluation_trimestrielle', 'analyse_tendance_annuelle',
            'attestation_hygiexpert5d', 'Dossier_technique_des_produits', "Rapport_d'intervention"
        ];

        foreach ($clients as $client) {
            $count = rand(5, 15);
            for ($i = 0; $i < $count; $i++) {
                $type = $types[array_rand($types)];
                $year = rand(2018, 2025);
                $month = rand(1, 12);
                $day = rand(1, 28);
                $randomDate = Carbon::create($year, $month, $day);

                $filename = strtolower(str_replace(' ', '_', $type)) . "_{$day}_{$month}_{$year}.pdf";

                Document::create([
                    'client_id' => $client->id,
                    'type' => $type,
                    'path' => "fake/path/{$filename}",
                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ]);
            }
        }
    }
}