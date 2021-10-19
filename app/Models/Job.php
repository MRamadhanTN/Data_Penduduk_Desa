<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = "jobs";

    protected $fillable = [
        'id',
        'name'
    ];

    protected $hidden = [

    ];

    public function residents()
    {
        return $this->hasMany(Resident::class, 'job_id');
    }
}
