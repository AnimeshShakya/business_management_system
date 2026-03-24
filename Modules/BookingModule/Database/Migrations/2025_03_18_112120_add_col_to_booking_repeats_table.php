<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColToBookingRepeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_repeats', function (Blueprint $table) {
            $table->string('service_location')->default('customer')->comment('customer,provider')->after('booking_otp');
            $table->text('service_address_location')->nullable()->after('booking_otp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_repeats', function (Blueprint $table) {
            $table->dropColumn('service_location');
            $table->dropColumn('service_address_location');
        });
    }
}
