<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Admin\VehicleType;
class CreateVehicleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('vehicle_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('service_location_id');
            $table->string('name');
            $table->string('description');
            $table->string('short_description');
            $table->string('supported_vehicles');
            $table->enum('is_taxi',['taxi','delivery'])->nullable();
            $table->string('icon')->nullable();
            $table->integer('capacity')->default(0);
            $table->boolean('is_accept_share_ride')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('service_location_id')
                    ->references('id')
                    ->on('service_locations')
                    ->onDelete('cascade');

        });


         VehicleType::create([
            // 'name' => $data['name'],
            'id' => '63060678-3ed7-4d98-9729-efd5b4c43e96',
            'name' => 'رحلة نسائية',
            'icon' =>'lEBGnsUq8jtKobp4YqMDKD5deCMxz10xJrzdSdqV.jpg',
              'capacity' => '7',
            'description' => 'للنساء فقط',
            'short_description' => 'للنساء فقط',
            'supported_vehicles' => 'للنساء فقط',
            'is_taxi' => 'taxi',




        ]);
         VehicleType::create([
            // 'name' => $data['name'],
            'id' => 'e5b2b5f9-a7e0-40e1-a8e7-a1092e26133a',
            'name' => 'رحلبة اقتصادية',
            'icon' =>'n8BlBVZjBF7ZaycaRJaNbiAdvYSdlDxM4hOGzf3O.jpg',
              'capacity' => '7',
            'description' => 'موديل 2020 فادنى  ',
            'short_description' => ' ديل 2020 فادنى',
            'supported_vehicles' => ' ديل 2020 فادنى',
            'is_taxi' => 'taxi',




        ]);
         VehicleType::create([
            // 'name' => $data['name'],
            'id' => 'f87e6b56-d06f-4996-a272-78a728d7f0dd',
            'name' => 'رحلة تميز',
            'icon' =>'d65woaggS06GkEkf4mLcggXEIeaW0wVdiIMLYhKI.jpg',
              'capacity' => '7',
            'description' => 'موديل 2020 فاى  ',
            'short_description' => '2020 فاعلى ',
            'supported_vehicles' => ' 2020 فاعلى',
            'is_taxi' => 'taxi',




        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_types');

    }
}
