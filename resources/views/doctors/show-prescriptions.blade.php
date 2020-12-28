@extends('layouts.doctors-master')
@section('title', 'Prescriptions')
@section('csslinks')
<link rel="stylesheet" href="/css/patients-prescription.css">
@endsection
@section('content')
<br>
<div class="container" id="parentcontainer">
  <div class="row">
    @if(session()->has('custommsg'))
    <p class="{{session()->get('classes')}} card custommsgs"><span>{{ session()->get('custommsg') }}</span><i class="material-icons small">{{ session()->get('icon') }}</i></p>
    @endif
    <ul class="col s12 z-depth-0 zeroborder">
      @forelse($consultations as $consultation)
      @php
      $patient = $consultation->patient()->first();
      $prescription = $consultation->prescription()->first();
      @endphp
      <li class="card col s12">
        <div class="card-content row nomarginbottom">
          <div class="col s12 marginbottom">
            <p class="flow-text blue-grey-text">
              <span>{{ $patient->name }}</span>
            </p>
          </div>
          <div class="col s12">
            <h6><b>Illness: {{ $consultation->illness_title }}</b></h6>
            <div class="divider">

            </div>
          </div>
          <div class="col s12 l6 marginbottom pdivs">
            <p><b>Illness Description:</b></p>
            <p class="small-text">
              {!! nl2br($consultation->illness_description) !!}
            </p>
          </div>
          <div class="col s12 l6 marginbottom pdivs">
            <p><b>Surgery Details:</b></p>
            <p class="small-text">
              {!! nl2br($consultation->surgery_details) !!}
            </p>
          </div>
          <div class="col s12 marginbottom pdivs">
            <p><b>Illness timespan:</b></p>
            <p class="small-text">
              {!! nl2br($consultation->time_span) !!}
            </p>
          </div>
          <div class="col s12">
            <br>
          </div>
          <div class="col s12 zeropadding">
            <div class="col s12 l6 marginbottom pdivs">
              <p><b>Care to be taken:</b></p>
              <p class="small-text">
                {!! nl2br($prescription->care_taken) !!}
              </p>
            </div>
            <div class="col s12 l6 marginbottom pdivs">
              <p><b>Medicines:</b></p>
              <p class="small-text">
                {!! nl2br($prescription->medicines) !!}
              </p>
            </div>
          </div>
          @php
          $consultdate = $consultation->created_at;
          $consultdate = date_create($consultdate);
          $consultdate = date_format($consultdate, "jS F Y");
          $prescriptiondate = $prescription->updated_at;
          $prescriptiondate = date_create($prescriptiondate);
          $prescriptiondate = date_format($prescriptiondate, "jS F Y");
          @endphp
          <div class="">
            <div class="col s12 l6 marginbottom pdivs">
              <p><b>Consulted At:</b></p>
              <p class="small-text">
                {{ $consultdate }}
              </p>
            </div>
            <div class="col s12 l6 marginbottom pdivs">
              <p><b>Prescription Given At:</b></p>
              <p class="small-text">
                {{ $prescriptiondate }}
              </p>
            </div>
          </div>
          <div class="col s12">
            <br>
            <p>
              <a href="{{ asset($prescription->prescription_link) }}" class="underlined">Download PDF</a>
              <span class="right">
                <a href="{{ route('doctors.prescriptions.edit', $prescription->id) }}" class="btn"><i class="material-icons">edit</i></a>
                <button type="button" class="deletebutton btn red darken-1 modal-trigger waves-effect waves-light" data-target="confirmationmodal" data-deleteid="{{ $prescription->id }}" title="Delete Prescription"><i class="material-icons">delete</i></button>
              </span>
            </p>
          </div>
        </div>
      </li>
      @empty
      <p class="flow-text">No Prescriptions Found!</p>
      @endforelse
    </ul>
    <div class="modal" id="confirmationmodal">
      <div class="modal-content center">
        <i class="large material-icons white red-text circle">error</i>
        <p class="flow-text">Are you sure you want to delete the prescription? This action cannot be undone!</p>
      </div>
      <div class="modal-footer">
        <button class="btn modal-close waves-effect waves-light">Cancel</button>
        <form style="display: inline" action="{{ route('doctors.prescriptions.destroy', 'ok')}}" method="post">
          @csrf
          {{ method_field('DELETE')}}
          <input type="hidden" id="deleteid" name="deleteid" value="">
          <button class="red btn waves-effect waves-light">Delete</button>
          &nbsp;
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="/js/confirmmodals.js" charset="utf-8"></script>
@endsection
