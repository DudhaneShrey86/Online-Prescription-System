@extends('layouts.patients-master')
@section('title', 'Consult A Doctor')
@section('csslinks')
<link rel="stylesheet" href="/css/patients-index.css">
@endsection
@section('content')
<br>
<div class="container" id="parentcontainer">
  @if(session()->has('custommsg'))
  <p class="{{session()->get('classes')}} card custommsgs"><span>{{ session()->get('custommsg') }}</span><i class="material-icons small">{{ session()->get('icon') }}</i></p>
  @endif
  <div id="flex-container">
    <div id="small-div">
      <div class="card">
        <div class="card-content" id="filterdiv">
          <p class="flow-text">Filters</p>
          <div class="divider">

          </div>
          <input type="hidden" id="speciality" value="{{ $speciality }}">
          <input type="hidden" id="yrs" value="{{ $yrs }}">
          <form class="" action="" method="get">
            <div class="customrow">
              <p class="blue-grey-text small-text">Specialities</p>
              @forelse($specialities as $speciality)
              <p>
                <label>
                  <input type="checkbox" class="filled-in" name="speciality[]" value="{{ $speciality }}">
                  <span>{{ $speciality }}</span>
                </label>
              </p>
              @empty
              <small>No Speciality Found</small>
              @endforelse
            </div>
            <div class="customrow">
              <p class="blue-grey-text small-text">Years of Experience</p>
              <p>
                <label>
                  <input type="radio" class="with-gap" name="yrs_of_exp" value="below5">
                  <span>Below 5</span>
                </label>
              </p>
              <p>
                <label>
                  <input type="radio" class="with-gap" name="yrs_of_exp" value="5to10">
                  <span>5 to 10</span>
                </label>
              </p>
              <p>
                <label>
                  <input type="radio" class="with-gap" name="yrs_of_exp" value="10+">
                  <span>10+</span>
                </label>
              </p>
            </div>
            <div class="center" id="buttondiv">
              <button type="submit" class="btn amber darken-1">Apply</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div id="big-div">
      <div id="search-doctors-div">
        <div class="card" id="searchdiv">
          <div class="input-field col s12">
            <input type="text" name="search" id="search" value="" autocomplete="off" placeholder="Search A Doctor">
          </div>
        </div>
        <div>
          <p class="flow-text" id="noresult">No Doctors found!</p>
          <div class="card" id="results">
            @forelse($doctors as $doctor)
            <div class="doctordiv">
              <a href="{{ route('patients.consult', $doctor->id) }}" class="itema">
                <div class="customitem">
                  <div class="imagediv">
                    <img src="{{ asset($doctor->profile_link) }}" alt="Profile pic">
                  </div>
                  <div class="contentdiv">
                    <h6>Dr. <span id="name">{{ $doctor->name }}</span></h6>
                    <p><b class="blue-grey-text">{{ $doctor->speciality }}</b></p>
                    <p class="relativediv">
                      <span><i>{{ $doctor->yrs_of_exp }} yrs of experience</i></span>
                      <a href="{{ route('patients.consult', $doctor->id) }}" class="absolutebuttons btn blue btn-small">Consult</a>
                    </p>
                  </div>
                </div>
              </a>
            </div>
            @empty
            <div class="card-content">
              <p class="flow-text">No Doctors Found!</p>
            </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="see_filters_div" class="blue-grey lighten-5">
      <a href="#filter_modal" id="see_filters" class="modal-trigger">See Filters <i class="material-icons right">arrow_drop_up</i></a>
    </div>
    <div id="filter_modal" class="modal modal-fixed-footer bottom-sheet">
      <form class="" action="" method="get">
        <div class="modal-content">
          <p class="flow-text">Filters</p>
          <div class="divider">

          </div>
          <div class="customrow">
            <p class="blue-grey-text small-text">Specialities</p>
            @forelse($specialities as $speciality)
            <p>
              <label>
                <input type="checkbox" class="filled-in" name="speciality[]" value="{{ $speciality }}">
                <span>{{ $speciality }}</span>
              </label>
            </p>
            @empty
            <small>No Speciality Found</small>
            @endforelse
          </div>
          <div class="customrow">
            <p class="blue-grey-text small-text">Years of Experience</p>
            <p>
              <label>
                <input type="radio" class="with-gap" name="yrs_of_exp" value="below5">
                <span>Below 5</span>
              </label>
            </p>
            <p>
              <label>
                <input type="radio" class="with-gap" name="yrs_of_exp" value="5to10">
                <span>5 to 10</span>
              </label>
            </p>
            <p>
              <label>
                <input type="radio" class="with-gap" name="yrs_of_exp" value="10+">
                <span>10+</span>
              </label>
            </p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="apply2" class="btn-small amber darken-1 waves-effect">Apply</button>
        </div>
      </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="/js/patients-index.js" charset="utf-8"></script>
@endsection
