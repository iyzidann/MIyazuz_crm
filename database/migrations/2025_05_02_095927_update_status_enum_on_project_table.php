<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE TYPE project_status AS ENUM ('pending', 'accepted', 'rejected')");
        
        DB::statement("ALTER TABLE project ALTER COLUMN status TYPE project_status 
            USING status::text::project_status");
        DB::statement("ALTER TABLE project ALTER COLUMN status SET DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE project ALTER COLUMN status TYPE VARCHAR(255)");
        DB::statement("DROP TYPE IF EXISTS project_status");
    }
};
