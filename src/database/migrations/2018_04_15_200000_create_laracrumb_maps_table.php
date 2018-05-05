<?php
/**
 * Contains the CreateLaracrumbMapsTable class.
 *
 * @package Laracrumbs\Database\Migrations
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Handles migrations for creating or destroying the Laracrumb Maps table in the database.
 *
 * Commands:
 *    php artisan migrate --path=vendor/blackdrago/laracrumbs/src/database/migrations/
 *    php artisan migrate:rollback --path=vendor/blackdrago/laracrumbs/src/database/migrations/
 */
class CreateLaracrumbMapsTable extends Migration
{
    /** @var string $tableName         The name of the Laracrumbs Map table. */
    protected $tableName = 'laracrumb_maps';

    /**
     * Run Laracrumbs Map Migrations.
     */
    public function up()
    {
        if (Schema::hasTable($this->tableName)) {
            // do nothing, the table already exists
            return;
        }
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->string('route_name')->unique();
            $table->string('function_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
