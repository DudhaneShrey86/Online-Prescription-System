@extends('layouts.doctors-master')
@section('title', 'Profile Page')
@section('csslinks')
<link rel="stylesheet" href="/css/patients-profile.css">
@endsection
@section('content')
<br>
<div class="container" id="parentcontainer">
  @if(session()->has('custommsg'))
  <p class="{{session()->get('classes')}} card custommsgs"><span>{{ session()->get('custommsg') }}</span><i class="material-icons small">{{ session()->get('icon') }}</i></p>
  @endif
  <div id="parentdiv">
    <div id="imagediv">
      <img src="{{ asset($doctor->profile_link) }}" alt="Profile pic">
      @if($canedit)
      <form id="upload_pic_form" action="{{ route('doctors.profile.submit', $doctor->id) }}" enctype="multipart/form-data" method="post">
        @csrf
        <label for="profile_link" class="btn waves-effect blue"><i class="material-icons left">edit</i><span>Change Pic</span></label>
        <input type="file" name="profile_link" id="profile_link" value=""><br>
        <span class="helper-text" data-error="Required*" data-success="">@error('profile_link') {{$message}} @enderror</span>
      </form>
      @endif
    </div>
    <div id="contentdiv" class="card">
      <div class="card-content">
        <div id="flex-container">
          <div id="big-div">
            <h6>Details</h6>
            <div class="divider">

            </div>
            <div class="">
              <div class="row">
                <div class="smallmarginbottom">
                  <p class="flow-text">{{ $doctor->name }}</p>
                </div>
                <div class="smallmarginbottom">
                  <p><b class="blue-grey-text">Speciality: {{ $doctor->speciality }}</b></p>
                </div>
                <div class="col s12">
                  {{ $doctor->yrs_of_exp }} years of experience
                </div>
                <div>
                  <div class="col s12 l6">
                    <p>Email ID</p>
                    <p class="blue-text"><b>{{ $doctor->email }}</b></p>
                  </div>
                  <div class="col s12 l6">
                    <p>Contact</p>
                    <p class="blue-text"><b>{{ $doctor->contact }}</b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="blank-div">

          </div>
          <div id="small-div">
            <h6>Prescriptions</h6>
            <div class="divider">

            </div>
            <div>
              <div class="row">
                <div class="col s12">
                  <p><b>Total No. of prescriptions given:</b></p>
                  <p> {{ count($consultations) }} </p>
                </div>
                <div class="col s12">
                  <a href="{{ route('doctors.prescriptions') }}" class="btn blue fullbuttons">View Prescriptions</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card" id="prescriptions">
      <div class="card-content">
        <h5>Prescriptions Given</h5>
        <div class="divider">

        </div>
        <div>
          @forelse($consultations as $consultation)
          @php
          $prescription = $consultation->prescription()->first();
          @endphp
          <div class="customcard">
            <div class="row marginbottom">
              <div class="col s12 smallmarginbottom borderbottom">
                <h6>For: {{ $consultation->patient()->first()->name}}</h6>
                <p><b class="blue-grey-text">Illness: {{ $consultation->illness_title }}</b></p>
              </div>
              <div class="col s12 smallmarginbottom">
                <p><b class="blue-grey-text">Care to be taken:</b></p>
                <p class="small-text blue-grey-text">
                  {!! nl2br($prescription->care_taken) !!}
                </p>
              </div>
            </div>
          </div>
          @empty
          <h6>No Prescriptions Found!</h6>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="/js/patients-profile.js" charset="utf-8"></script>
@endsection
