<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('groep_user_koppel', function (Blueprint $table) {
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('Users');
            $table->unsignedBigInteger('groepId');
            $table->foreign('groepId')->references('id')->on('groep');
        });

        Schema::table('les_user_koppel', function (Blueprint $table) {
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('Users');
            $table->unsignedBigInteger('lesId');
            $table->foreign('lesId')->references('id')->on('les');
        });
        
        Schema::table('vragen', function (Blueprint $table) {
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('Users');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unique('password_code');
        });
    }

    public function down()
    {
        Schema::table('vragen', function (Blueprint $table) {
            $table->dropForeign(['userId']);
            $table->dropColumn('userId');
        });
    }
};