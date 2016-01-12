@extends('layouts.master')

@section('content')

  @include('includes.messages')

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <h1>{!! trans('dashboard.welcome') !!}, {!! Auth::user()->email !!}</h1>

    <p>&nbsp;&nbsp;&nbsp;{!! trans('dashboard.message') !!}</p>
    <ul>
        <li><a href="{{ route('get_briefings') }}">{!! trans('navBar.briefings') !!}</a></li>
        <li><a href="{{ route('get_budgets') }}">{!! trans('navBar.budgets') !!}</a></li>
        <li><a href="{!! route('show_profile', Auth::user()->id) !!}">{!! trans('navBar.profile') !!}</a></li>
        <li><a href="{{ route('get_settings') }}">{!! trans('navBar.settings') !!}</a></li>
    </ul>
    <br>
    
    <p><a href="{{ route('get_logout') }}" class="btn btn-primary" role="button">{!! trans('navBar.signOut') !!}</a></p>
  </div>

@stop
