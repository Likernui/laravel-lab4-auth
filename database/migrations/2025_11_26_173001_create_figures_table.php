<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiguresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('figures', function (Blueprint $table) {
        $table->id();

        // Основные поля фигурки
        $table->string('name');                       // Имя фигурки, например: "Исаги Йоичи"
        $table->string('type')->nullable();           // Тип издания, например: "Эксклюзив"
        $table->string('image_path')->nullable();     // Путь к картинке в storage
        $table->unsignedInteger('height_cm')->nullable(); // Высота в см
        $table->string('material')->nullable();       // Материал
        $table->text('short_description')->nullable(); // Краткое описание (для карточки)
        $table->text('full_description')->nullable();  // Полное описание (для модалки)

        // Дата выхода фигурки (для мутаторов)
        $table->date('release_date')->nullable();

        // Служебные поля
        $table->timestamps();   // created_at и updated_at
        $table->softDeletes();  // поле deleted_at для "мягкого" удаления
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('figures');
    }
}
