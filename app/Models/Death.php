<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Death extends Model
{
    use HasFactory;

    protected $table = "dies";

    protected $fillable = [
        'resident_id','name','gender','NIK','place_birth','birth_date','job','religion','citizenship','date','time','age','place','penyebab'
    ];

    protected $hidden = [

    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'id');
    }
}
