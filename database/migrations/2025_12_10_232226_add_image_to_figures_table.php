<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToFiguresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('figures', function (Blueprint $table) {
            $table->string('image')->nullable(); // добавляем колонку image
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('figures', function (Blueprint $table) {
            $table->dropColumn('image'); // удаляем колонку при откате
        });
    }
}
