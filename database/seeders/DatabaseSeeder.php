<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::beginTransaction();
        try {
            $this->call(UserSeeder::class);
            $this->call(RoomSeeder::class);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('[DatabaseSeeder][run] error ' . $e->getMessage());
        }
    }
}
