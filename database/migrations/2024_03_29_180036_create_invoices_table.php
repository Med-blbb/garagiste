<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->decimal('additional_charges', 8, 2);
            $table->decimal('amount', 8, 2);
            $table->decimal('total_amount', 8, 2);
            $table->foreignId('repair_id')->constrained();
            $table->foreignId('client_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
