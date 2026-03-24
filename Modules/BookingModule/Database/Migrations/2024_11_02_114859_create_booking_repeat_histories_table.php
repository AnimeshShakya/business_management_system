<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingRepeatHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_repeat_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('booking_id')->nullable();
            $table->foreignUuid('booking_repeat_id')->nullable();
            $table->foreignUuid('booking_repeat_details_id')->nullable();
            $table->string('readable_id')->nullable();
            $table->integer('old_quantity')->nullable();
            $table->integer('new_quantity')->nullable();
            $table->tinyInteger('is_multiple')->default(0);
            $table->decimal('total_booking_amount', 24,3)->default(0);
            $table->decimal('total_tax_amount', 24,3)->default(0);
            $table->decimal('total_discount_amount', 24,3)->default(0);
            $table->decimal('extra_fee', 24,3)->default(0);
            $table->decimal('total_referral_discount_amount', 24,3)->default(0);
            $table->json('log_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_repeat_histories');
    }
}
