<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'illness_title',
        'illness_description',
        'surgery_details',
        'transaction_id',
        'time_span',
        'prescription_given',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    public function doctor(){
      return $this->belongsTo('App\Models\Doctor');
    }
    public function patient(){
      return $this->belongsTo('App\Models\Patient');
    }
    public function prescription(){
      return $this->hasOne('App\Models\Prescription');
    }
}
