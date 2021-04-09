<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->engine = 'InnoDB';            
            $table->id();
            $table->integer('company_id')->default(0)->nullable()->comment('0 - internal staff');
            $table->integer('staff_type')->default(1)->nullable()->comment('1-internal staff, 2-other compnay staff');
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->enum('gender', ['male','female','other'])->nullable();
            $table->string('mobile', 50)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email', 125)->nullable();
            $table->text('full_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->boolean('status')->default(1)->comment('1-active, 0-Inactive');            
            $table->timestamps();
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('deleted_by');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
