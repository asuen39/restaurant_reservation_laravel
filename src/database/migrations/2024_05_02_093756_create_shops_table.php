<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            /*カラム名:id, 型:bigint unsigned, PRIMARY KEY:〇 */
            $table->bigIncrements('id');
            $table->string('shops_name', 255)->nullable(false);
            $table->string('image_path', 255)->nullable(false);
            /*カラム名:country_id, 型:bigint unsigned, NOT NULL:〇, FOREIGN KEY:countries(id) */
            $table->unsignedBigInteger('country_id')->nullable(false);
            $table->foreign('country_id')->references('id')->on('countries');
            /*カラム名:genre_id, 型:bigint unsigned, NOT NULL:〇, FOREIGN KEY:shop(genres) */
            $table->unsignedBigInteger('genre_id')->nullable(false);
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->string('description', 255)->nullable(false);
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
        Schema::dropIfExists('shops');
    }
}
