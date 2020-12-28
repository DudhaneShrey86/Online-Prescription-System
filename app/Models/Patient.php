<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable
{
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name',
      'age',
      'email',
      'password',
      'contact',
      'history_of_illness',
      'history_of_surgery',
      'family_is_diabetic',
      'family_allergies',
      'family_others',
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
    'history_of_illness' => 'array',
    'history_of_surgery' => 'array',
  ];
  public $timestamps = false;
  protected $guard = 'patient';

  public function consultations(){
    return $this->hasMany('App\Models\Consultation');
  }
}
