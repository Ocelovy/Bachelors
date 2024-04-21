<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmbulanceIdToPatientRecordsTable extends Migration
{
    public function up()
    {
        Schema::table('patient_records', function (Blueprint $table) {
            $table->unsignedBigInteger('ambulance_id')->nullable();
            $table->foreign('ambulance_id')->references('id')->on('ambulances');
        });
    }

    public function down()
    {
        Schema::table('patient_records', function (Blueprint $table) {
            $table->dropForeign(['ambulance_id']);
            $table->dropColumn('ambulance_id');
        });
    }
}

