@extends('layouts.login-master-doctors')
@section('title', "Doctor's Registration Page")
@section('sidenavoptions')
<li class=""><a class="waves-effect" href="{{ route('doctors.login') }}">Sign In</a></li>
<li class="active"><a class="waves-effect" href="{{ route('doctors.register') }}">Sign Up</a></li>
@endsection
@section('topnavoptions')
<li class=""><a href="{{ route('doctors.login') }}">Sign In</a></li>
<li class="active"><a href="{{ route('doctors.register') }}">Sign Up</a></li>
@endsection
@section('content')

<div class="container">
  <input type="hidden" id="specialities" value="{{ $specialities }}">
  <div class="row">
    <br>
    <div class="card col s12 l6 center offset-l3">
      <form class="row card-content" action="{{ route('doctors.register.submit') }}" method="post" enctype="multipart/form-data">
        @csrf
        <p class="red-text col s12">{{$errors->first() ?? ''}}</p>
        <h5>Registering as Doctor</h5>
        <div class="divider">

        </div>
        <div class="input-field col s12">
          <input id="name" name="name" type="text" class="validate" required>
          <label for="name">Enter Your Name</label>
          <small>We will include a "Dr." prefix ourselves, please do not type it here</small>
          <span class="helper-text" data-error="Required*" data-success="">@error('name') {{$message}} @enderror</span>
        </div>
        <div class="input-field col s12">
          <input id="speciality" name="speciality" type="text" class="validate" required>
          <label for="speciality">Enter Your Speciality</label>
          <small>What domain you are specialized in</small>
          <span class="helper-text" data-error="Required*" data-success="">@error('speciality') {{$message}} @enderror</span>
        </div>
        <div class="input-field col s12">
          <input id="yrs_of_exp" name="yrs_of_exp" type="number" class="validate" required min="0" step="0.01">
          <label for="yrs_of_exp">Enter Years of Experience</label>
          <small>Specify how many years of working knowledge you have in your field</small>
          <span class="helper-text" data-error="Valid years required*" data-success="">@error('yrs_of_exp') {{$message}} @enderror</span>
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
        <div class="input-field col s12" id="center-input-field">
          <button class="btn waves-effect waves-light blue btn-large">Register</button>
        </div>
        <div class="col s12" id="other-action">
          <div class="divider">

          </div>
          <p>Already have an account? <a href="{{ route('doctors.login') }}" class="underlined">Sign In</a></p>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script src="/js/doctors-register.js" charset="utf-8"></script>
@endsection
