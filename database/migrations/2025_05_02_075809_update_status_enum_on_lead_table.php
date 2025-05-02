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
        DB::statement("CREATE TYPE lead_status AS ENUM ('new', 'negotiation', 'won', 'lost')");

        DB::statement("ALTER TABLE lead ALTER COLUMN status DROP DEFAULT");
        DB::statement("ALTER TABLE lead ALTER COLUMN status TYPE lead_status USING status::lead_status");
        DB::statement("ALTER TABLE lead ALTER COLUMN status SET DEFAULT 'new'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE lead ALTER COLUMN status DROP DEFAULT");
        DB::statement("ALTER TABLE lead ALTER COLUMN status TYPE VARCHAR(255)");
        DB::statement("DROP TYPE lead_status");
    }
};
