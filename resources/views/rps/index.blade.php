@extends('layouts.app')

@section('content')
 <div class="container">
      <div align="center">
        <img src="{{ asset('uploads/rps.png') }}" id="logo" />
      </div>

      <h2 id="title">Rock Paper Scissors</h2>
      <div class="row">

          <h3 align="center"  ><a class="font" href="{{ route('login') }}" > Login</a>/<a class="font" href="{{ route('register') }}" >Registration</a></h3>
          <h2 align="center"> OR </h2>
          <h3 align="center"><a class="font" href="{{ route('home.playAsAGuest') }}" >Play as a Guest</a></h3>
      </div>


   @endsection