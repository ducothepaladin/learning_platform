<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Courses;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $folderPath = database_path('data');

        $jsonFiles = File::files($folderPath);


        foreach($jsonFiles as $file) {

            $filecontent = File::get($file);
            $fileName = pathinfo($file->getFilename(), PATHINFO_FILENAME);

            Courses::factory()->create([
                'name' => $fileName,
                'body' => $filecontent
            ]);
        }

    }
}
