<?php
/**
 * Contains the CreateLaracrumbsTable class.
 *
 * @package Laracrumbs\Database\Migrations
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Handles migrations for creating or destroying the Laracrumbs table in the database.
 *
 * Commands:
 *    php artisan migrate --path=vendor/blackdrago/laracrumbs/src/database/migrations/
 *    php artisan migrate:rollback --path=vendor/blackdrago/laracrumbs/src/database/migrations/
 */
class CreateLaracrumbsTable extends Migration
{
    /** @var string $tableName         The name of the Laracrumbs table. */
    protected $tableName = 'laracrumbs';

    /**
     * Run Laracrumbs Migrations.
     */
    public function up()
    {
        if (Schema::hasTable($this->tableName)) {
            // do nothing, the table already exists
            return;
        }
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('link')->nullable();
            $table->string('title')->nullable();
            $table->string('route')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
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
