<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('route_search_histories') && !Schema::hasColumn('route_search_histories', 'response')) {
            Schema::table('route_search_histories', function (Blueprint $table) {
                $table->json('response')->nullable()->after('keyword');
            });

            DB::table('route_search_histories')->truncate();
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('route_search_histories') && Schema::hasColumn('route_search_histories', 'response')) {
            Schema::table('route_search_histories', function (Blueprint $table) {
                $table->dropColumn('response');
            });
        }
    }
};
