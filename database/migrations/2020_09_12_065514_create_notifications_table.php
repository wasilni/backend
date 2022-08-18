<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificationapps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('push_enum');
            $table->string('title_en');
            $table->string('title_ar');

            $table->longText('body_ar');
             $table->longText('body_en');
            $table->string('image')->nullable();
            $table->longText('data')->nullable();
            $table->boolean('for_user')->default(false);
            $table->boolean('for_driver')->default(false);

            $table->timestamps();
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
        Schema::dropIfExists('notifications');
    }
}
