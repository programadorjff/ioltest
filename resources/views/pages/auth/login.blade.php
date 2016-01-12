@extends('layouts.master')

@section('content')
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <h1 class="page-header">{!! trans('navbar.signIn') !!}</h1>

      @include('includes.messages')

      {!! Form::open(array('route' => 'post_login')) !!}
      <div class="form-group">
        <label for="email">{!! trans('login.email') !!}</label>
        <input name="email" type="email" class="form-control" placeholder="{!! trans('login.placeHolderEmail') !!}" value="{!! trans('login.demoEmail') !!}" required autofocus>
      </div>
      <div class="form-group">
        <label for="password">{!! trans('login.pass') !!}</label>
        <input name="password" type="password" class="form-control" placeholder="{!! trans('login.placeHolderPass') !!}" value="{!! trans('login.demoPass') !!}"
               required>
      </div>
      <button class="btn btn-default btn-block" type="submit">{!! trans('navbar.signIn') !!}</button>
      {!! Form::close() !!}
    </div>
  </div>
@stop
