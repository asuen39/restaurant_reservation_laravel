<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            /*カラム名:id, 型:bigint unsigned, PRIMARY KEY:〇 */
            $table->bigIncrements('id');
            /*カラム名:name, 型:varchar(255), NOT NULL:〇 */
            $table->string('name', 255)->nullable(false);
            /*カラム名:email, 型:varchar(255), NOT NULL:〇 */
            $table->string('email', 255)->unique(false);
            /*カラム名:password, 型:varchar(255), NOT NULL:〇 */
            $table->string('password', 255)->nullable(false);
            /*カラム名:email_verification_token, 型:string */
            $table->string('email_verification_token')->nullable();
            /*カラム名:email_verified_at, 型:timestamp */
            $table->timestamp('email_verified_at')->nullable();
            /*カラム名:created_at, 型:timestamp */
            $table->timestamp('created_at')->useCurrent()->nullable();
            /*カラム名:updated_at, 型:timestamp */
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
        Schema::dropIfExists('admins');
    }
}
