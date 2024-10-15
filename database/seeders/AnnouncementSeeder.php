<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement; // Adjust the namespace if necessary

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        // Example data to seed
        Announcement::create([
            'title' => 'First Announcement',
            'start_date' => now(),
            'end_date' => now()->addDays(7),
            'course_id' => 19, // Make sure this ID exists in your courses table
        ]);

        // You can add more announcements here
    }
}

