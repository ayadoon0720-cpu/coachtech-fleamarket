<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryItemTable extends Migration
{
    public function up()
    {
        Schema::create('category_item', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('item_id')
            ->constrained()
            ->onDelete('cascade');

            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();

            $table->unique(['category_id', 'item_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_item');
    }
}
