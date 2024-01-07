<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class file extends Model
{
    use HasFactory;

     protected $fillable = ['name', 'path','criteria_file','target_type','target_id','file_date_created','file_time_created']; // Add other fillable columns if needed

}
