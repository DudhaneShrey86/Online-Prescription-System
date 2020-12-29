<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Prescription;
use PDF;

class PrescriptionController extends Controller
{
  public function __construct(){
    $this->middleware('auth:doctor');
  }

  public function index(){
    $doctor = Auth::guard('doctor')->user();
    $consultations = $doctor->consultations()->where('prescription_given', 1)->get();
    return view('doctors.show-prescriptions', ['consultations' => $consultations, 'doctor' => $doctor]);
  }

  public function showForm(Consultation $consultation){
    return view('doctors.create-prescription', ['consultation' => $consultation]);
  }
  public function showEditForm(Prescription $prescription){
    return view('doctors.edit-prescription', ['prescription' => $prescription]);
  }

  public function store(){
    if(request()->has('consultation_id')){
      $data = request()->validate([
        'care_taken' => 'required',
        'medicines' => 'required',
      ]);
      $consultation = Consultation::find(request()->consultation_id);
      $prescription = $consultation->prescription()->create($data);
      $pdf = PDF::loadView('prescription-pdf', ['consultation' => $consultation, 'prescription' => $prescription]);
      $path = '/Documents/Prescriptions/'.$prescription->id.'_prescription.pdf';
      $pdf->save(public_path().$path);
      $consultation->prescription_given = 1;
      $consultation->save();
      $prescription->prescription_link = $path;
      $prescription->save();
      return redirect()->route('doctors.prescriptions')->with('custommsg', 'Prescription Created Successfully!')->with('classes', 'green darken-1');
    }
    return redirect()->back()->with('custommsg', 'Some error occured!')->with('classes', 'red darken-1');
  }

  public function update(){
    if(request()->has('prescription_id')){
      $data = request()->validate([
        'care_taken' => 'required',
        'medicines' => 'required',
      ]);
      $prescription = Prescription::find(request()->prescription_id);
      $consultation = $prescription->consultation()->first();
      $pdf = PDF::loadView('prescription-pdf', ['consultation' => $consultation, 'prescription' => $prescription]);
      $path = '/Documents/Prescriptions/'.$prescription->id.'_prescription.pdf';
      $pdf->save(public_path().$path);
      $data['prescription_link'] = $path;
      $prescription->update($data);
      return redirect()->route('doctors.prescriptions')->with('custommsg', 'Prescription Updated Successfully!')->with('classes', 'green darken-1');
    }
    return redirect()->back()->with('custommsg', 'Some error occured!')->with('classes', 'red darken-1');
  }
  public function destroy($id){
    try{
      $prescription = Prescription::find(request()->deleteid);
      $consultation = $prescription->consultation()->first();
      $consultation->prescription_given = 0;
      $consultation->save();
      Prescription::destroy(request()->deleteid);
      $message = "Prescription Deleted Succesfully";
      $classes = "amber lighten-1";
      $icon = "done";
    }
    catch(QueryException $e){
      $message = "Some error occured";
      $classes = "red darken-1";
      $icon = "error";
    }
    return redirect()->route('doctors.prescriptions')->with('custommsg', $message)->with('classes', $classes)->with('icon', $icon);
  }
}
