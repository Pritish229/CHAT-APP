<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateDistrect extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Path to the SQL file
        $path = database_path('seeders/sql/statesistrict.sql');

        // Read the SQL file content
        $sql = File::get($path);

        // Execute the SQL
        DB::unprepared($sql);

        $this->command->info('SQL file seeded successfully!');
    }
}
