<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable(config('menu.table_prefix') . config('menu.table_name_items'))) {
            Schema::create(config('menu.table_prefix') . config('menu.table_name_items'), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('role_id')->default(0);
                $table->string('label');
                $table->string('link');
                $table->string('icon')->nullable();
                $table->unsignedBigInteger('parent_id')->default(0);
                $table->integer('ordering')->default(0);
                $table->string('class')->nullable();
                $table->enum('target', ['_self', '_blank'])->default('_self');
                $table->unsignedBigInteger('menu_id')->index('cmx_menu_items_menu_id_foreign');
                $table->integer('depth')->default(0);
                $table->timestamps();

                $table->foreign(['menu_id'])->references(['id'])->on(config('menu.table_prefix') . config('menu.table_name_menus'))
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('menu.table_prefix') . config('menu.table_name_items'), function (Blueprint $table) {
            $table->dropForeign('cmx_menu_items_menu_id_foreign');
        });

        Schema::dropIfExists(config('menu.table_prefix') . config('menu.table_name_items'));
    }
}
