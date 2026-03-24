<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingRepeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_repeats', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->string('readable_id')->nullable();
            $table->foreignUuid('booking_id')->nullable();
            $table->foreignUuid('booking_details_id')->nullable();
            $table->foreignUuid('provider_id')->nullable();
            $table->foreignUuid('serviceman_id')->nullable();
            $table->string('booking_type')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('booking_status')->default('pending');
            $table->dateTime('service_schedule')->nullable();
            $table->boolean('is_paid')->default(0);
            $table->string('payment_method')->default('cash');
            $table->decimal('total_booking_amount',24,3)->default(0);
            $table->decimal('total_tax_amount',24,3)->default(0);
            $table->decimal('total_discount_amount',24,3)->default(0);
            $table->decimal('total_campaign_discount_amount',24,3)->default(0);
            $table->decimal('total_coupon_discount_amount',24,3)->default(0);
            $table->decimal('removed_coupon_amount',24,3)->default(0);
            $table->decimal('additional_charge',24,3)->default(0);
            $table->decimal('additional_tax_amount',24,3)->default(0);
            $table->decimal('additional_discount_amount',24,3)->default(0);
            $table->decimal('additional_campaign_discount_amount',24,3)->default(0);
            $table->decimal('extra_fee',24,3)->default(0);
            $table->decimal('total_referral_discount_amount',24,3)->default(0);
            $table->string('coupon_code')->nullable();
            $table->tinyInteger('is_verified')->default(0);
            $table->tinyInteger('is_reassign')->default(0);
            $table->longText('evidence_photos',24,3)->nullable();
            $table->string('booking_otp',255)->nullable();
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
        Schema::dropIfExists('booking_repeats');
    }
}
