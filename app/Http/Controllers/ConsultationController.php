<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Prescription;

class ConsultationController extends Controller
{
  public function create(){
    if(request()->doctor_id){
      $doctor = Doctor::find(request()->doctor_id);
      if($doctor != null){
        $data = request()->validate([
          'illness_title' => 'required',
          'illness_description' => 'required',
          'surgery_details' => 'required',
          'time_span' => 'required',
          'family_allergies' => 'required',
          'family_others' => 'required',
          'transaction_id' => 'required',
        ]);
        $data['doctor_id'] = $doctor->id;
        $data1 = [];
        if(request()->has('family_is_diabetic')){
          $data1['family_is_diabetic'] = 1;
        }
        else{
          $data1['family_is_diabetic'] = 0;
        }
        $data1['family_allergies'] = request()->family_allergies;
        $data1['family_others'] = request()->family_others;
        $patient = Auth::guard('patient')->user();
        $illnessarray = $patient->history_of_illness;
        $surgeryarray = $patient->history_of_surgery;
        array_push($illnessarray, $data['illness_description']);
        array_push($surgeryarray, $data['surgery_details']);
        $data1['history_of_illness'] = $illnessarray;
        $data1['history_of_surgery'] = $surgeryarray;
        $patient->update($data1);
        $patient->consultations()->create($data);
        return redirect()->route('patients.prescriptions')->with('custommsg', 'Consultation submitted')->with('classes', 'green darken-1');
      }
      return redirect()->back()->with('custommsg', 'Some error occured!')->with('classes', 'red darken-1');
    }
    return redirect()->back()->with('custommsg', 'Some error occured!')->with('classes', 'red darken-1');
  }
}
