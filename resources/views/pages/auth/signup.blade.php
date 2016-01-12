@extends('layouts.master')

@section('content')
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <h1 class="page-header">{!! trans('navBar.signUp') !!}</h1>

      @include('includes.messages')

      {!! Form::open(array('route' => 'post_signup')) !!}
      <div class="form-group">
        <label for="email">{!! trans('login.email') !!}</label>
        <input name="email" type="email" class="form-control" placeholder="{!! trans('login.placeHolderEmail') !!}"
               value="{!! Input::old('email') !!}" required autofocus>
      </div>
      <div class="form-group">
        <label for="password">{!! trans('login.pass') !!}</label>
        <input name="password" type="password" class="form-control" placeholder="{!! trans('login.placeHolderPass') !!}" required>
      </div>
      <div class="form-group">
        <label for="password_confirmation">{!! trans('signUp.passConf') !!}</label>
        <input name="password_confirmation" type="password" class="form-control" placeholder="{!! trans('signUp.passConf') !!}"
               required>
      </div>
      <button class="btn btn-default btn-block" type="submit">{!! trans('navBar.signUp') !!}</button>
      {!! Form::close() !!}
    </div>
  </div>
@stop
