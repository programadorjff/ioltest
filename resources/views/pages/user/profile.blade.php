@extends('layouts.master')

@section('content')

  <h1>{!! trans('profile.user') !!} #{!! $user->email !!}</h1>
  <p>{!! trans('profile.owner', ['count' => $user->briefingCount(),'tableRows' => $briefingRows]) !!}</p>

  <hr>

  <p>{!! trans('profile.footer') !!}</p>

@stop