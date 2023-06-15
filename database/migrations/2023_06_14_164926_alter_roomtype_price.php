<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRoomTypePrice extends Migration
{
    public function up()
    {
        Schema::table('room_types', function (Blueprint $table) {
            $table->float('price', 8, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('room_types', function (Blueprint $table) {
            // Revert the changes if needed
            $table->number('price')->change();
        });
    }
}
