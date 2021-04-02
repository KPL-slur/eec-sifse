<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ===== hasil rancangan erd =====
        Schema::create('recommendations', function (Blueprint $table) {
            $table->bigIncrements('rec_id');
            // id of the head of current report. ex: if the id is 5 it means this report has the head reports of 5
            $table->foreignId('head_id')->constrained('head_reports', 'head_id')->onDelete('cascade');
            $table->string('name');
            $table->string('jumlah_unit_needed');
            $table->integer('year');
            $table->timestamps();
            $table->softDeletes();
        });
        // ===== hasil rancangan erd =====
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recommendations');
    }
}
