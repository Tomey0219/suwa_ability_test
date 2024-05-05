<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('first_name',255)->nullable(false);
            $table->string('last_name',255)->nullable(false);
            $table->integer('gender')->nullable(false);
            $table->string('email',255)->nullable(false);
            $table->string('tel',255)->nullable(false);
            $table->string('address',255)->nullable(false);
            $table->string('building',255);
            $table->text('detail')->nullable(false);
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
        Schema::dropIfExists('contacts');
    }
}
