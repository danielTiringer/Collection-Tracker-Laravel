<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->id();
            $table->string('source');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('collection_element_source', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_element_id')
                ->unique()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('source_id')
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_element_source');
        Schema::dropIfExists('sources');
    }
};
