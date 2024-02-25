<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
        try{
            $this->call(UserSeeder::class);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            Log::error('[DatabaseSeeder][run] error '. $e->getMessage());
        }
    }
}
