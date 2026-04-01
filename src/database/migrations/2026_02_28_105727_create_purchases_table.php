<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('item_id')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('address_id')
            ->constrained('addresses')
            ->onDelete('cascade');

            $table->string('payment_method');
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();

            $table->unique('item_id'); // 1商品1購入を想定する場合
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
