<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyDetail extends Model
{
    use HasFactory;

    protected $table = "family_details";

    protected $fillable = [
        'family_id','no_kk','kepala_keluarga','hubungan','resident_id','resident'
    ];

    protected $hidden = [

    ];

    public function family()
    {
        return $this->belongsTo(Family::class, 'family_id', 'id');
    }
    public function residents()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'id');
    }

    public function births()
    {
        return $this->hasMany(Birth::class, 'family_id', 'id');
    }


}
