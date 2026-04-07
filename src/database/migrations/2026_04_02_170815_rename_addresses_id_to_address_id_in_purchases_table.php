<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAddressesIdToAddressIdInPurchasesTable extends Migration
{
    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->renameColumn('addresses_id', 'address_id');
        });
    }

    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->renameColumn('address_id', 'addresses_id');
        });
    }
}
