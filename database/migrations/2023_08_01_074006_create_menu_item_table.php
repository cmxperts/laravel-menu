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
                $table->unsignedBigInteger('menu_id')->nullable()->index('cmx_menu_items_menu_id_foreign');
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->string('type', 50)->default('menu');
                $table->string('label', 100)->nullable();
                $table->string('class', 100)->nullable();
                $table->string('alias', 100)->nullable();
                $table->text('description')->nullable();
                $table->integer('depth')->nullable();
                $table->string('icon', 30)->nullable();
                $table->string('link', 100)->nullable();
                $table->string('target', 100)->nullable();
                $table->string('heading_position', 3)->nullable();
                $table->string('image')->nullable();
                $table->string('sub_line', 30)->nullable();
                $table->string('sub_menu_class', 30)->nullable();
                $table->unsignedBigInteger('ordering')->nullable();
                $table->text('conditions')->nullable();
                $table->text('active_class')->nullable();
                $table->text('is_active')->nullable();
                $table->timestamps();
                $table->softDeletes();

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
