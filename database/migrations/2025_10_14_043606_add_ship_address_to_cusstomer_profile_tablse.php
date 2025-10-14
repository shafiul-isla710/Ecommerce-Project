<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customer_profiles', function (Blueprint $table) {
            $table->string('cus_fax',50)->nullable();
            $table->dropColumn('name');
            $table->dropColumn('email');

            $table->string('ship_name',50)->nullable();
            $table->string('ship_add',50)->nullable();
            $table->string('ship_city',50)->nullable();
            $table->string('ship_state',50)->nullable();
            $table->string('ship_postcode',50)->nullable();
            $table->string('ship_country',50)->nullable();
            $table->string('ship_phone',50)->nullable();
            $table->string('ship_fax',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_profiles', function (Blueprint $table) {
            $table->dropColumn('cus_fax');
            $table->dropColumn('ship_name');
            $table->dropColumn('ship_add');
            $table->dropColumn('ship_city');
            $table->dropColumn('ship_state');
            $table->dropColumn('ship_postcode');
            $table->dropColumn('ship_country');
            $table->dropColumn('ship_phone');
            $table->dropColumn('ship_fax');

            $table->string('name',50);
            $table->string('email',50)->nullable();
        });
    }
};
