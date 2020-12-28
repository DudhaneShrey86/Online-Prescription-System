@extends('layouts.doctors-master')
@section('title', 'Consultations')
@section('csslinks')
<!-- <link rel="stylesheet" href="/css/patients-index.css"> -->
@endsection
@section('content')
<br>
<div class="container" id="parentcontainer">
  <div class="row">
    <br>
    @if(session()->has('custommsg'))
    <p class="{{session()->get('classes')}} card custommsgs"><span>{{ session()->get('custommsg') }}</span><i class="material-icons small">{{ session()->get('icon') }}</i></p>
    @endif
    <ul class="col s12 collapsible z-depth-0 zeroborder">
      @forelse($consultations as $consultation)
      @php
      $patient = $consultation->patient()->first();
      @endphp
      <li class="card col s12">
        <div class="card-content row nomarginbottom">
          <div class="col s12 marginbottom">
            <p class="flow-text blue-grey-text">
              <span>{{ $patient->name }}</span>
              <span class="right">Age: {{ $patient->age }}</span>
            </p>
          </div>
          <div class="col s12">
            <p><b>Illness: {{ $consultation->illness_title }}</b></p>
          </div>
          <div class="col s12 small-text margintop">
            @php
            $date = $consultation->created_at;
            $date = date_create($date);
            $date = date_format($date, "jS F Y");
            @endphp
            <p>Consulted On: {{ $date }}</p>
          </div>
        </div>
        <div class="card-action zeropadding relativediv">
          <div class="collapsible-header">
            <button type="button" class="btn">Details</button>
          </div>
        </div>
        <div class="collapsible-body smallpadding">
          <div class="row">
            <div class="col s12">
              <p class="flow-text">Illness Details</p>
              <div class="divider">

              </div>
            </div>
            <div class="col s12 marginbottom">
              <h6 class="card-title">{{ $consultation->illness_title }}</h6>
            </div>
            <div class="col s12">
              <p><b>Timespan: {{ $consultation->time_span }}</b></p>
            </div>
            <div class="col s12 l6">
              <p class="smallmarginbottom"><b class="blue-grey-text">Description:</b></p>
              <p class="small-text">
                {!! nl2br($consultation->illness_description) !!}
              </p>
            </div>
            <div class="col s12 l6">
              <p class="smallmarginbottom"><b class="blue-grey-text">Surgery Details:</b></p>
              <p class="small-text">
                {!! nl2br($consultation->surgery_details) !!}
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <p class="flow-text">Patient Details</p>
              <div class="divider">

              </div>
            </div>
            <div class="col s12 l8">
              <h6 class="card-title">{{ $patient->name }}</h6>
            </div>
            <div class="col s12 l4 rightonlarge">
              <p class="smallmarginbottom"><a href="{{ route('doctors.patients.seeprofile', $patient->id) }}" class="underlined">See Profile</a></p>
            </div>
            <div class="col s12 marginbottom">
              <p><b>Age: {{ $patient->age }}</b></p>
            </div>
            <div class="col s12 l6">
              <p class="smallmarginbottom"><b class="blue-grey-text">Email:</b></p>
              <p class="blue-text">{{ $patient->email }}</p>
            </div>
            <div class="col s12 l6">
              <p class="smallmarginbottom"><b class="blue-grey-text">Contact:</b></p>
              <p class="blue-text">{{ $patient->contact }}</p>
            </div>
            <div class="col s12">
              <br>
              <h6><b class="blue-grey-text">Family History:</b></h6>
            </div>
            <div class="col s12">
              <p><i>
                @if($patient->family_is_diabetic == 1)
                Family includes a person with diabetes
                @else
                None of the family members have diabetes
                @endif
              </i></p>
            </div>
            <div class="col s12 l6">
              <p class="smallmarginbottom"><b class="blue-grey-text">Family Member Allergies:</b></p>
              <p class="small-text">
                {!! nl2br($patient->family_allergies) !!}
              </p>
            </div>
            <div class="col s12 l6">
              <p class="smallmarginbottom"><b class="blue-grey-text">Other Family Details:</b></p>
              <p class="small-text">
                {!! nl2br($patient->family_others) !!}
              </p>
            </div>
            <div class="col s12">
              <br>
              <a href="{{ route('doctors.prescriptions.create', $consultation->id) }}" class="btn blue">Write A Prescription</a>
            </div>
          </div>
        </div>
      </li>
      @empty
      <p class="flow-text">No Consultations Found!</p>
      @endforelse
    </ul>
  </div>
</div>
@endsection
@section('scripts')
<!-- <script src="/js/confirmmodals.js" charset="utf-8"></script> -->
@endsection
