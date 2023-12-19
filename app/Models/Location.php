<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'locations'; // Specify the table name

    public function user()
    {
        return $this->hasOne(User::class, 'job_location');
    }    

}
