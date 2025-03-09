<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        // Crear la tabla de likes
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');  // Relación con el Post
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Relación con el User
            $table->timestamps();
            $table->unique(['post_id', 'user_id']);  // Asegura que un usuario solo pueda dar un like por post
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
