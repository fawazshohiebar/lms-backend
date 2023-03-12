<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DefineAttendanceStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('attendances', function (Blueprint $table) {
  
  $table->dropColumn('Status');
            $table->enum('Status', ['Present', 'Late', 'Absent'])->change();
        });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('attendances', function (Blueprint $table) {
  
            $table->string('Status')->change();
        });
            
    }
}
