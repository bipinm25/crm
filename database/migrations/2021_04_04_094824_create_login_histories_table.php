<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_histories', function (Blueprint $table) {
            $table->engine = 'InnoDB';            
            $table->id();
            $table->string('login_ip',30)->nullable();
            $table->string('username',100)->nullable();
            $table->integer('user_id')->default(0);
            $table->text('login_details')->nullable();
            $table->tinyInteger('login_attempt_status')->nullable()->comment('0-success, 1 - failed');
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_histories');
    }
}
