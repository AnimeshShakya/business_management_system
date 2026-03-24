<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\ServiceManagement\Entities\Service;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
        });

        Service::whereNull('slug')
            ->orWhere('slug', '')
            ->chunkById(100, function ($services) {
                foreach ($services as $service) {
                    $service->slug = Service::generateUniqueSlug($service->name, $service->id);
                    $service->save();
                }
            });

        Schema::table('services', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
