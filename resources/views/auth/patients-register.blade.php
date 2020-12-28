@extends('layouts.login-master-doctors')
@section('title', "Patient's Registration Page")
@section('sidenavoptions')
<li class=""><a class="waves-effect" href="{{ route('patients.login') }}">Sign In</a></li>
<li class="active"><a class="waves-effect" href="{{ route('patients.register') }}">Sign Up</a></li>
@endsection
@section('topnavoptions')
<li class=""><a href="{{ route('patients.login') }}">Sign In</a></li>
<li class="active"><a href="{{ route('patients.register') }}">Sign Up</a></li>
@endsection
@section('content')

<div class="container">
  <div class="row">
    <br>
    <div class="card col s12 l6 center offset-l3">
      <form class="row card-content" action="{{ route('patients.register.submit') }}" method="post" enctype="multipart/form-data">
        @csrf
        <p class="red-text col s12">{{$errors->first() ?? ''}}</p>
        <h5>Registering as Patient</h5>
        <div class="divider">

        </div>
        <div class="input-field col s12">
          <input id="name" name="name" type="text" class="validate" required>
          <label for="name">Enter Your Name</label>
          <span class="helper-text" data-error="Required*" data-success="">@error('name') {{$message}} @enderror</span>
        </div>
        <div class="input-field col s12">
          <input id="age" name="age" type="number" class="validate" required min="0">
          <label for="age">Enter Your Age</label>
          <span class="helper-text" data-error="Valid age required*" data-success="">@error('age') {{$message}} @enderror</span>
        </div>
        <div class="input-field col s12">
          <input id="email" name="email" type="email" class="validate" required>
          <label for="email">Enter Your Email ID</label>
          <span class="helper-text" data-error="Valid email address *" data-success="">@error('email') {{$message}} @enderror</span>
        </div>
        <div class="input-field col s12">
          <input id="password" name="password" type="password" class="validate" required>
          <label for="password">Enter A Password</label>
          <small>Minimum 8 characters</small>
          <span class="helper-text" data-error="Required*" data-success="">@error('password') {{$message}} @enderror</span>
        </div>
        <div class="input-field col s12">
          <input id="password_confirmation" name="password_confirmation" type="password" class="validate" required>
          <label for="password_confirmation">Retype your Password</label>
          <span class="helper-text" data-error="Required*" data-success="">@error('password_confirmation') {{$message}} @enderror</span>
        </div>
        <div class="input-field col s12">
          <input id="contact" name="contact" type="number" class="validate" >
          <label for="contact">Enter Your Contact Number</label>
          <span class="helper-text" data-error="Required*" data-success="">@error('contact') {{$message}} @enderror</span>
        </div>
        <div class="col s12 left-align marginbothbig">
          <h6 class="centeralign relativediv"><span>History Of Illnesses</span><span class="absolutebuttons"><button type="button" id="addillness" class="btn waves-effect waves-light"><i class="material-icons">add</i></button> <button type="button" id="removeillness" class="btn waves-effect waves-light red darken-1" disabled><i class="material-icons">delete</i></button></span> </h6>
          <div class="divider">

          </div>
          <p class="grey-text">Give a short description about your previous illnesses</p>
          <br>
          <div id="illnessesdiv">
            <div class="input-field col s12 illnessfield">
              <textarea name="illnesses[]" id="illness1" class="materialize-textarea validate"></textarea>
              <label for="illness1">Enter Illness Details</label>
            </div>
            <div class="col s12 input-field surgeryfield">
              <textarea name="surgeries[]" id="surgery1" class="materialize-textarea validate"></textarea>
              <label for="surgery1">Enter Surgery Details for the Illness</label>
            </div>
          </div>
        </div>
        <div class="input-field col s12" id="center-input-field">
          <button class="btn waves-effect waves-light blue btn-large">Register</button>
        </div>
        <div class="col s12" id="other-action">
          <div class="divider">

          </div>
          <p>Already have an account? <a href="{{ route('patients.login') }}" class="underlined">Sign In</a></p>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script src="/js/patients-register.js" charset="utf-8"></script>
@endsection
