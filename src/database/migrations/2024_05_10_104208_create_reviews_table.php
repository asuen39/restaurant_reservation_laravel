<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            /*カラム名:user_id, 型:bigint unsigned, NOT NULL:〇, FOREIGN KEY:userd(id) */
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('users');
            /*カラム名:reservation_id, 型:bigint unsigned, NOT NULL:〇, FOREIGN KEY:reservations(id) */
            $table->unsignedBigInteger('reservation_id')->nullable(false);
            $table->unsignedBigInteger('rating')->nullable(false);
            $table->text('comment')->nullable(false);
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
