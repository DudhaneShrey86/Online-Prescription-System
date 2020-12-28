<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\Sequence;

class Doctor extends Authenticatable
{
  use HasFactory, Notifiable;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name',
    'speciality',
    'email',
    'password',
    'contact',
    'yrs_of_exp',
    'profile_link',
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
  * The attributes that should be cast to native types.
  *
  * @var array
  */
  protected $casts = [

  ];
  public $timestamps = false;
  protected $guard = 'doctor';

  public function run_factory(){
    $doctors = Doctor::factory()->count(20)->state(new Sequence(
      ['speciality' => 'Physician'],
      ['speciality' => 'Dermatologist'],
      ['speciality' => 'Neurologist'],
      ['speciality' => 'Dentist'],
      ['speciality' => 'Pathologist'],
    ))->create();
  }
  public function consultations(){
    return $this->hasMany('App\Models\Consultation');
  }
}
