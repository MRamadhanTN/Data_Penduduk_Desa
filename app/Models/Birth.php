<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Birth extends Model
{
    use HasFactory;

    protected $table = "births";

    protected $fillable = [
        'resident_id','name','father','mother','gender','birth','place_birth','weight','width','family_id','detail_id'
    ];

    protected $hidden = [

    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'id');
    }
    public function detail()
    {
        return $this->belongsTo(FamilyDetail::class, 'detail_id', 'id');
    }
    public function family()
    {
        return $this->belongsTo(Family::class, 'family_id', 'id');
    }
}
