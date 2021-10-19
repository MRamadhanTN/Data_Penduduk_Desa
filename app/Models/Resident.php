<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $table = "residents";

    protected $fillable = [
        'NIK','name','place_birth','birth','job_id','job','category','gender','RT','RW','address','provinces_id','provinces','regencies_id','regencies','districts_id','districts','villages_id','villages','religion', 'education','kewarganegaraan','status','blood_group', 'family_id', 'kepala_keluarga', 'no_kk',
    ];

    protected $hidden = [

    ];

    // belongsTo
    public function kelurahan()
    {
        return $this->belongsTo(Village::class, 'villages_id', 'id');
    }
    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'districts_id', 'id');
    }
    public function kabupaten()
    {
        return $this->belongsTo(Regency::class, 'regencies_id', 'id');
    }
    public function provinsi()
    {
        return $this->belongsTo(Province::class, 'provinces_id', 'id');
    }
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    // hasMany
    public function deaths()
    {
        return $this->hasMany(Death::class, 'resident_id', 'id');
    }
    public function families()
    {
        return $this->hasMany(Family::class, 'resident_id', 'id');
    }
    public function detailsFamilies()
    {
        return $this->hasMany(FamilyDetail::class, 'resident_id', 'id');
    }
    public function births()
    {
        return $this->hasMany(Birth::class, 'resident_id', 'id');
    }
}
