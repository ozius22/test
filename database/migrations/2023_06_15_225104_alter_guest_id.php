<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterGuestID extends Migration
{
    public function up()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('guest_id')->change();
        });
    }

    public function down()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            // Revert the changes if needed
            $table->number('guest_id')->change();
        });
    }
}
