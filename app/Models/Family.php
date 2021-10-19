<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $table = "families";

    protected $fillable = [
        'no_kk','resident_id','NIK','kepala_keluarga'
    ];

    protected $hidden = [

    ];

    public function residents()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'id');
    }


    public function details()
    {
        return $this->hasMany(FamilyDetail::class, 'family_id', 'id');
    }
    public function births()
    {
        return $this->hasMany(Birth::class, 'family_id', 'id');
    }

}
