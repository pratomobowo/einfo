<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDispositionFieldsToActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected', 'disposed'])->default('pending')->after('location');
            $table->unsignedBigInteger('original_official_id')->nullable()->after('official_id');
            $table->foreign('original_official_id')->references('id')->on('officials')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign(['original_official_id']);
            $table->dropColumn(['status', 'original_official_id']);
        });
    }
}
