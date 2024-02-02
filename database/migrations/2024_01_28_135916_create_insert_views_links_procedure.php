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
        DB::statement('
    CREATE PROCEDURE insert_user_primary_links_views(
        IN p_user_id INT,
        IN p_primary_link_id INT,
        IN p_address VARCHAR(255),
        IN p_created_at DATETIME
    )
    BEGIN
        INSERT INTO user_primary_links_views (user_id, primary_link_id, address, created_at)
        VALUES (p_user_id, p_primary_link_id, p_address, p_created_at);
    END'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS insert_user_primary_links_views');
    }
};
