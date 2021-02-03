<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('plag_type', [0, 1]);
            $table->text('sections');
            $table->integer('subsentence_length');
            $table->integer('overlay_length');
            $table->text('report_paths')->nullable();
            $table->text('results')->nullable();
            $table->float('copy_percent')->nullable();
            $table->enum('status', [0, 1, 2, 3])->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposals');
    }
}
