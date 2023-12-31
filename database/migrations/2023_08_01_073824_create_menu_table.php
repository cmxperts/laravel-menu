<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable(config('menu.table_prefix') . config('menu.table_name_menus'))) {
            Schema::create(config('menu.table_prefix') . config('menu.table_name_menus'), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->boolean('admin')->nullable();
                $table->string('name');
                $table->string('class')->nullable();
                $table->string('alias', 50)->nullable();
                $table->integer('ordering')->nullable();
                $table->timestamps();
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
        Schema::dropIfExists(config('menu.table_prefix') . config('menu.table_name_menus'));
    }
}
