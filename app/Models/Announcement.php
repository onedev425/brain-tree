<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
     // Specify the table name if it doesn't follow Laravel's conventions
     protected $table = 'announcements'; 

     // Specify the fillable fields to allow mass assignment
     protected $fillable = [
         'title', // Add other fields here
         'start_date',
         'end_date',
         'course_id',
     ];

        // Define the relationship with the Course model
        public function course()
        {
            return $this->belongsTo(Course::class);
        }
}
