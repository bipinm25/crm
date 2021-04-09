<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->engine = 'InnoDB';            
            $table->id();
            $table->string('name', 255)->nullable();
            $table->integer('contact_person_id')->default(0);
            $table->string('mobile', 50)->nullable();
            $table->string('email', 125)->nullable();
            $table->integer('status_id')->nullable()->comment('1-hot, 2-cold');
            $table->integer('sub_status_id')->nullable()->comment('1-close,2-canceled,3-in progress');
            $table->text('full_address')->nullable();
            $table->text('google_map_details')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
