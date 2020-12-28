@extends('layouts.patients-master')
@section('title', 'Consultation Page')
@section('csslinks')
<link rel="stylesheet" href="/css/patients-consult.css">
@endsection
@section('content')
<br>
<div class="container" id="parentcontainer">
  @if(session()->has('custommsg'))
  <p class="{{session()->get('classes')}} card custommsgs"><span>{{ session()->get('custommsg') }}</span><i class="material-icons small">{{ session()->get('icon') }}</i></p>
  @endif
  <div class="row">
    <div class="card col s12 l6 offset-l3">
      <div class="card-content">
        <p class="flow-text center">Consulting Dr. {{ $doctor->name }}</p>
        <div class="divider">

        </div>
        <ul class="tabs" id="tabs">
          <li class="tab"><a href="#firstdiv"></a></li>
          <li class="tab"><a href="#seconddiv"></a></li>
          <li class="tab"><a href="#thirddiv"></a></li>
        </ul>
        <form class="" action="{{ route('patients.consult.create') }}" method="post">
          @csrf
          <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
          <div id="firstdiv" class="row nomarginbottom">
            <h6 class="center">Illness Details</h6>
            <div class="input-field col s12">
              <input id="illness_title" name="illness_title" type="text" class="validate">
              <label for="illness_title">Illness</label>
              <small>What Illness do you have</small>
              <span class="helper-text red-text" data-error="required*" data-success="">@error('illness_title') {{$message}} @enderror</span>
            </div>
            <div class="input-field col s12">
              <textarea name="illness_description" id="illness_description" class="materialize-textarea validate"></textarea>
              <label for="illness_description">Description</label>
              <small>Give a short description about your illness</small>
              <span class="helper-text red-text" data-error="required*" data-success="">@error('illness_description') {{$message}} @enderror</span>
            </div>
            <div class="input-field col s12">
              <textarea name="surgery_details" id="surgery_details" class="materialize-textarea validate"></textarea>
              <label for="surgery_details">Surgery Details</label>
              <small>What surgery did you have for this illness</small>
              <span class="helper-text red-text" data-error="required*" data-success="">@error('surgery_details') {{$message}} @enderror</span>
            </div>
            <div class="input-field col s12">
              <input id="time_span" name="time_span" type="text" class="validate">
              <label for="time_span">Time Span</label>
              <small>How long have you had this illness (Eg: Over 15 days)</small>
              <span class="helper-text red-text" data-error="required*" data-success="">@error('time_span') {{$message}} @enderror</span>
            </div>
            <div class="input-field col s12 center">
              <button type="button" class="btn blue longbuttons" data-id="seconddiv">Next</button>
            </div>
          </div>
          <div id="seconddiv" class="row nomarginbottom">
            <h6 class="center">Family Medical History</h6>
            <br>
            <div class="col s12 input-field">
              <p>
                <label>
                  @if($patient->family_is_diabetic == 1)
                  <input type="checkbox" class="filled-in" name="family_is_diabetic" checked value="1">
                  @else
                  <input type="checkbox" class="filled-in" name="family_is_diabetic" value="1">
                  @endif
                  <span>Family Member is Diabetic</span>
                </label>
              </p>
              <small>Tick the box if any of your family member has diabetis or related illness</small>
            </div>
            <div class="input-field col s12">
              <textarea name="family_allergies" id="family_allergies" class="materialize-textarea">{{ $patient->family_allergies }}</textarea>
              <label for="family_allergies">Allergies in Family</label>
              <small>Mention if any of your family member has allergies</small>
              <span class="helper-text red-text" data-error="required*" data-success="">@error('family_allergies') {{$message}} @enderror</span>
            </div>
            <div class="input-field col s12">
              <textarea name="family_others" id="family_others" class="materialize-textarea">{{ $patient->family_others }}</textarea>
              <label for="family_others">Other Details</label>
              <small>Any other family related details you want to share with the doctor</small>
              <span class="helper-text red-text" data-error="required*" data-success="">@error('family_others') {{$message}} @enderror</span>
            </div>
            <div class="input-field col s12 center">
              <button type="button" class="btn blue-grey lighten-2 longbuttons marginright" data-id="firstdiv">Prev</button>
              <button type="button" class="btn blue longbuttons" data-id="thirddiv">Next</button>
            </div>
          </div>
          <div id="thirddiv" class="row nomarginbottom">
            <h6 class="center">Payment</h6>
            <p class="center">Pay using QR code or UPI ID</p>
            <div class="center paydiv">
              <img src="/images/qr.png" alt="">
              <p><b>UPI ID: some@oksome</b></p>
              <p><b>Amount to be paid: ₹ 600</b></p>
            </div>
            <div class="input-field col s12">
              <input id="transaction_id" name="transaction_id" type="text" class="validate">
              <label for="transaction_id">Transaction ID</label>
              <span class="helper-text red-text" data-error="required*" data-success="">@error('transaction_id') {{$message}} @enderror</span>
            </div>
            <div class="col s12">
              <p><b class="blue-grey-text">Consent for online consultation</b></p>
              <p class="small-text">
                I have understood that this is an online consultation without a physical checkup of my symptoms.
                The doctor hence relies on my description of the problem or scanned reports provided by me.
                With this understanding, I hereby give my consent for online consultation
              </p>
            </div>
            <div class="input-field col s12">
              <p>
                <label>
                  <input type="checkbox" id="accept_consent" class="filled-in" name="save_details" value="1">
                  <span>I accept</span>
                </label>
              </p>
            </div>
            <div class="input-field col s12 center">
              <button type="button" class="btn blue-grey lighten-2 longbuttons marginright" data-id="seconddiv">Prev</button>
              <button type="submit" id="submitbutton" disabled class="btn blue longbuttons" data-id="thirddiv">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="/js/patients-consult.js" charset="utf-8"></script>
@endsection
