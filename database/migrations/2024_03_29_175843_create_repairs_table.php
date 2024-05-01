<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairsTable extends Migration
{
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->enum('status', ['Pending', 'In_progress', 'Completed'])->default('Pending');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->text('mechanic_notes')->nullable();
            $table->text('client_notes')->nullable();
            $table->foreignId('mechanic_id')->constrained('users');
            $table->foreignId('vehicle_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('repairs');
    }
}
