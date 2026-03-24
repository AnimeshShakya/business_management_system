<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteSearchHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_search_histories', function (Blueprint $table) {
            $table->uuid('id')->index()->primary();
            $table->uuid('user_id');
            $table->string('user_type');
            $table->string('route_name');
            $table->string('route_uri');
            $table->string('route_full_url');
            $table->string('keyword')->nullable();
            $table->json('response')->nullable();
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
        Schema::dropIfExists('route_search_histories');
    }
}
