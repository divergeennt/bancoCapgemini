<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conta_corrente', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('banco_id');
            $table->integer('cliente_id');
            $table->string('agencia', 20);
            $table->string('conta', 20);
            $table->double('saldo', 10,2);
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conta_corrente');
    }
}
