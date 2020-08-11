<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->string('first_name', 200)->nullable();
            $table->string('last_name', 200)->nullable();
            $table->string('email_address', 200)->nullable();
            $table->enum('gender', ['male','female'])->nullable();
            $table->date('dob')->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('landline')->nullable();
            $table->string('zipcode')->nullable();
            $table->integer('countryId')->index('countryId')->nullable();
            $table->integer('locationId')->index('locationId')->nullable();
            $table->dateTime('appointment')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->integer('stateId')->index('stateId');
            $table->boolean('terms')->nullable();
            $table->boolean('status')->default(1);

            $table->softDeletes();
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
        Schema::dropIfExists('patients');
    }
}
