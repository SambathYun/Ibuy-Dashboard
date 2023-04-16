<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_products')) {
            Schema::create('tbl_products', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('admin_id');
                $table->foreign('admin_id')->references('id')->on('tbl_admins');
                $table->string('title', '100');
                $table->decimal('price', 8, 2);
                $table->char('description');
                $table->string('image');
                $table->decimal('discount', 8, 2);
                $table->integer('type');
                $table->integer('status');
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
        Schema::drop('tbl_products');
        Schema::disableForeignKeyConstraints();
    }
}
