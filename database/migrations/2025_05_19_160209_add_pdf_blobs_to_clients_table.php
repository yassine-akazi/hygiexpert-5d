<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('pdf_path')->nullable();
            $table->string('plan_path')->nullable();
            $table->string('rapport_diagnostic_path')->nullable();
            $table->string('fiche_intervention_path')->nullable();
            $table->string('attestation_traitement_path')->nullable();
            $table->string('evaluation_trimestrielle_path')->nullable();
            $table->string('analyse_tendance_annuelle_path')->nullable();
            $table->string('attestation_mygiexpert5d_path')->nullable();
            $table->string('autre1_path')->nullable();
            $table->string('autre2_path')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'pdf_path', 'plan_path', 'rapport_diagnostic_path', 'fiche_intervention_path',
                'attestation_traitement_path', 'evaluation_trimestrielle_path', 'analyse_tendance_annuelle_path',
                'attestation_mygiexpert5d_path', 'autre1_path', 'autre2_path'
            ]);
        });
    }
};