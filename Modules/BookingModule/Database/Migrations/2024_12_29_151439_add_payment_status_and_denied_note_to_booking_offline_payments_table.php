<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentStatusAndDeniedNoteToBookingOfflinePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_offline_payments', function (Blueprint $table) {
            $table->foreignUuid('offline_payment_id')->nullable()->after('booking_id');
            $table->enum('payment_status', ['pending', 'denied', 'approved'])->default('approved')->after('customer_information');
            $table->text('denied_note')->nullable()->after('payment_status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_offline_payments', function (Blueprint $table) {
            $table->dropColumn('offline_payment_id');
            $table->dropColumn('payment_status');
            $table->dropColumn('denied_note');
        });
    }
}
