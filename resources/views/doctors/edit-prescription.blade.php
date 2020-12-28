@extends('layouts.doctors-master')
@section('title', 'Edit Prescription')
@section('csslinks')
<style media="screen">
  .smallmargintop{
    margin-top: 10px;
  }
</style>
<!-- <link rel="stylesheet" href="/css/patients-index.css"> -->
@endsection
@section('content')
<br>
<div class="container">
  <div class="row">
    <br>
    <div class="card col s12 l6 offset-l3">
      <form class="row nomarginbottom card-content" id="prescription-form" action="{{ route('doctors.prescriptions.store') }}" method="post">
        @csrf
        @php
        $consultation = $prescription->consultation()->first();
        @endphp
        <input type="hidden" name="prescription_id" value="{{ $prescription->id }}">
        <p class="red-text col s12">{{$errors->first() ?? ''}}</p>
        <p class="flow-text center">Editing prescription: {{ $consultation->first()->patient()->first()->name }}</p>
        <h6 class="center">Illness: {{ $consultation->illness_title }}</h6>
        <div class="divider">

        </div>
        <div class="input-field col s12">
          <textarea name="care_taken" id="care_taken" class="materialize-textarea validate" data-length="500">{{ $prescription->care_taken }}</textarea>
          <label class="active" for="care_taken">Care To Be Taken</label>
          <span class="helper-text" data-error="Required*" data-success="">@error('care_taken') {{$message}} @enderror</span>
        </div>
        <div class="input-field col s12">
          <textarea name="medicines" id="medicines" class="materialize-textarea validate">{{ $prescription->medicines }}</textarea>
          <label class="active" for="medicines">Medicines to be used</label>
          <span class="helper-text" data-error="Required*" data-success="">@error('medicines') {{$message}} @enderror</span>
        </div>
        <div class="input-field col s12 center">
          <button type="button" class="btn blue longbuttons" id="previewprescription">Preview</button>
        </div>
        <div class="col s12 center small-text margintop">
          <a href="{{ route('doctors.prescriptions') }}" class="underlined">&larr; Back To Prescriptions</a>
        </div>
      </form>
      <div class="modal" id="prescriptionmodal">
        <div class="modal-content">
          <div class="row">
            <h5 class="center">Logo Name</h5>
            <div class="divider">

            </div>
            <div class="col s12 l6">
              <p><b class="blue-grey-text">Doctor: </b>Dr. {{ $consultation->doctor()->first()->name }}</p>
            </div>
            <div class="col s12 l6">
              <p><b class="blue-grey-text">For Patient: </b>{{ $consultation->patient()->first()->name }}</p>
            </div>
            <div class="col s12">
              <p><b class="blue-grey-text">Illness: </b>{{ $consultation->illness_title }}</p>
            </div>
            <div class="col s12">
              <p class="nomarginbottom"><b class="blue-grey-text">Care to be taken:</b></p>
              <p class="smallmargintop" id="care_taken_holder">

              </p>
            </div>
            <div class="col s12">
              <p class="nomarginbottom"><b class="blue-grey-text">Medicines to be used:</b></p>
              <p class="smallmargintop" id="medicines_holder">

              </p>
            </div>
            <div class="col s12">
              <p class="grey-text"><small>Date: <span id="date_holder"></span></small> </p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="submitbutton" class="btn blue waves-effect">Submit</button>
          <a href="#!" class="modal-close btn-flat waves-effect">Cancel</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="/js/doctors-create-prescription.js" charset="utf-8"></script>
@endsection
