<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite', function (Blueprint $table) {
            $table->bigIncrements('id');
            /*カラム名:user_id, 型:bigint unsigned, NOT NULL:〇, FOREIGN KEY:userd(id) */
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('users');
            /*カラム名:shop_id, 型:bigint unsigned, NOT NULL:〇, FOREIGN KEY:shop(id) */
            $table->unsignedBigInteger('shop_id')->nullable(false);
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });

        Schema::table('favorite', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->default(0)->change(); // デフォルト値を設定します
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite');
    }
}
