<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Doctor;
use App\Models\Patient;

class PatientController extends Controller
{
  public function __construct(){
    $this->middleware('auth:patient');
  }

  public function index(){
    $doctors = Doctor::orderBy('yrs_of_exp', 'desc');
    $speciality = null;
    $yrs = null;
    if(request()->has('speciality')){
      $speciality = request()->speciality;
      $doctors = $doctors->whereIn('speciality', $speciality);
      $speciality = json_encode($speciality);
    }
    if(request()->has('yrs_of_exp')){
      $yrs = request()->yrs_of_exp;
      if($yrs == "below5"){
        $doctors = $doctors->whereBetween('yrs_of_exp', [0, 5]);
      }
      else if($yrs == "5to10"){
        $doctors = $doctors->whereBetween('yrs_of_exp', [5, 10]);
      }
      if($yrs == "10+"){
        $doctors = $doctors->whereBetween('yrs_of_exp', [10, 100]);
      }
    }
    $doctors = $doctors->get();
    $specialities = Doctor::distinct('speciality')->pluck('speciality');
    return view('patients.index', ['doctors' => $doctors, 'specialities' => $specialities, 'speciality' => $speciality, 'yrs' => $yrs]);
  }
  public function consult(Doctor $doctor){
    $patient = Auth::guard('patient')->user();
    return view('patients.consult', ['doctor' => $doctor, 'patient' => $patient]);
  }

  public function showPrescriptions(){
    $consultations = Auth::guard('patient')->user()->consultations()->get();
    return view('patients.prescriptions', ['consultations' => $consultations]);
  }

  public function showProfile(Patient $patient){
    $canedit = false;
    if(Auth::guard('patient')->user()->id == $patient->id){
      $canedit = true;
    }
    return view('patients.profile', ['patient' => $patient, 'canedit' => $canedit]);
  }

  public function updateProfile(Patient $patient){
    if($patient->id != Auth::guard('patient')->user()->id){
      return redirect()->back()->with('custommsg', 'Some error occured!')->with('classes', 'red darken-1');
    }
    if(request()->has('profile_link')){
      $data = request()->validate([
        'profile_link' => 'required|mimes:jpeg,png'
      ]);
      $data['profile_link'] = request()->profile_link;
      $file1 = request()->file('profile_link');
      $filename1 = $file1->getClientOriginalName();
      $ext1 = pathinfo($filename1, PATHINFO_EXTENSION);

      $filename1 = str_replace(basename($filename1, ".".$ext1), "profile_pic", $filename1);

      $filename1 = $patient->id."_".$filename1;

      $path = public_path().'/Documents/PatientProfilePic/';

      $file1->move($path,$filename1);
      $filepath1 = '/Documents/PatientProfilePic/'.$filename1;
      $data['profile_link'] = $filepath1;
    }
    $patient->update($data);
    $patient->save();
    return redirect()->back()->with('custommsg', 'Changes Saved!')->with('classes', 'green darken-1');
  }
}
