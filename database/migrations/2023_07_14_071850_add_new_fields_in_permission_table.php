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
        Schema::table('permissions', function (Blueprint $table) {
            $table->longText('protected_routes')->nullable()->after('permision_module_id');
            $table->string('redirect_route')->nullable()->after('protected_routes');
            $table->string('permission_slug')->nullable()->after('protected_routes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn(['protected_routes', 'redirect_route', 'permission_slug']);
        });
    }
};
