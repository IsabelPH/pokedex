<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotosPerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos_perfil', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('usuario_id');    
            $table->foreign('usuario_id')
                ->references('id') 
                ->on('usuarios') //cual tabla es la padre?
                ->onUpdate('cascade') //que pasa si se actualiza el id del padre?
                ->onDelete('cascade'); //que pasa si se elimina el padre
                
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
        Schema::dropIfExists('fotos_perfil');
    }
}
