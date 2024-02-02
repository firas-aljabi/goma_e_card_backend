<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE PROCEDURE insert_profile_address(IN profileId INT, IN address VARCHAR(255))
            BEGIN
                INSERT INTO views (profile_id, address, created_at)
                VALUES (profileId, address, NOW());
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS insert_profile_address');
    }
};
