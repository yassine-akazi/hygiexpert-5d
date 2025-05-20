<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('type');  // ex: 'pdf_path', 'plan_path', etc.
            $table->string('path');  // chemin du fichier stocké
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }

};
