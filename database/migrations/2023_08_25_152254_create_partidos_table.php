<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipo_local_id');
            $table->unsignedBigInteger('equipo_visitante_id');
            $table->unsignedBigInteger('liga_id');
            // Otros campos para los partidos como 'fecha', 'resultado', etc.
            $table->timestamps();
            
            // Definir las relaciones
            $table->foreign('equipo_local_id')->references('id')->on('teams');
            $table->foreign('equipo_visitante_id')->references('id')->on('teams');
            $table->foreign('liga_id')->references('id')->on('leagues');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partidos');
    }
}
