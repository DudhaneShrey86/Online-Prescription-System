@extends('layouts.doctors-master')
@section('title', 'Patient Profile')
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
      <img src="{{ asset($patient->profile_link) }}" alt="Profile pic">
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
                  <p class="flow-text">{{ $patient->name }}</p>
                </div>
                <div class="smallmarginbottom">
                  <p><b class="blue-grey-text">Age: {{ $patient->age }}</b></p>
                </div>
                <div class="smallmarginbottom margintop">
                  <p class="small-text">
                    <i>
                      @if($patient->family_is_diabetic == 1)
                      <span class="amber-text text-darken-1">Family members include a diabetic person</span>
                      @else
                      <span class="grey-text">No family member is diabetic</span>
                      @endif
                    </i>
                  </p>
                </div>
                <div class="col s12 l6">
                  <p>Family Allergies:</p>
                  <p class="blue-grey-text small-text">
                    {!! nl2br($patient->family_allergies) !!}
                  </p>
                </div>
                <div class="col s12 l6">
                  <p>Other Family Details:</p>
                  <p class="blue-grey-text small-text">
                    {!! nl2br($patient->family_others) !!}
                  </p>
                </div>
              </div>
              <div class="">
                <a href="{{ route('doctors.index') }}" class="underlined">&larr; Back to consultations</a>
              </div>
            </div>
          </div>
          <div id="blank-div">

          </div>
          <div id="small-div">
            <h6>Contact Details</h6>
            <div class="divider">

            </div>
            <div>
              <div class="row">
                <div>
                  <div class="col s12">
                    <p>Email ID</p>
                    <p class="blue-text"><b>{{ $patient->email }}</b></p>
                  </div>
                  <div class="col s12">
                    <p>Contact</p>
                    <p class="blue-text"><b>{{ $patient->contact }}</b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card" id="illnesses">
      <div class="card-content">
        <h5>Illness History <small class="right">{{ count($patient->history_of_illness) }} illnesses</small></h5>
        <div class="divider">

        </div>
        <div>
          @php
          $illnesses = $patient->history_of_illness;
          $surgeries = $patient->history_of_surgery;
          @endphp
          @forelse($illnesses as $illness)
          <div class="customcard">
            <div class="row marginbottom">
              <div class="col s12 smallmarginbottom">
                <p><b class="blue-grey-text">Illness Description:</b></p>
                <p class="small-text">
                  {!! nl2br($illness) !!}
                </p>
              </div>
              <div class="col s12">
                <p><b class="blue-grey-text">Surgery Details:</b></p>
                <p class="small-text">
                  {!! nl2br($surgeries[$loop->index]) !!}
                </p>
              </div>
            </div>
          </div>
          @empty
          <p class="flow-text">No Illnesses Found!</p>
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
