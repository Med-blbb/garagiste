<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpairPartsTable extends Migration
{
    public function up()
    {
        Schema::create('spair_parts', function (Blueprint $table) {
            $table->id();
            $table->string('part_name');
            $table->string('part_reference')->unique();
            $table->string('supplier');
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->foreignId('repair_id')->nullable()->constrained('repairs');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('spair_parts');
    }
}
