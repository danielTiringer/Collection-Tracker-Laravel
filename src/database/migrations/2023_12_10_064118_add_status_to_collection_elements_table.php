<?php

use App\Enums\CollectionElementStatus;
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
        Schema::table('collection_elements', function (Blueprint $table) {
            $table->tinyInteger('status')
                ->default(CollectionElementStatus::PLANNED)
                ->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('collection_elements', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
