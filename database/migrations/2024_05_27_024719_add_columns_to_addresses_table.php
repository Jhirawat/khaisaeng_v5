<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->unsignedBigInteger('subdistrict_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('province_id');
            $table->string('postcode');
            $table->enum('address_type', ['บ้าน', 'สำนักงาน']);

            $table->foreign('subdistrict_id')->references('id')->on('subdistricts');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('province_id')->references('id')->on('provinces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('subdistrict_id');
            $table->dropColumn('district_id');
            $table->dropColumn('province_id');
            $table->dropColumn('postcode');
            $table->dropColumn('address_type');
        });
    }
};
