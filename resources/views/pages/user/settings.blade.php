@extends('layouts.master')

@section('content')

  <h1>{!! trans('navBar.settings') !!}</h1>

  <hr>

  @include('includes.messages')

  <ul class="nav nav-tabs">
    <li class="active"><a href="#email" data-toggle="tab">{!! trans('userSettings.emailSetting') !!}</a></li>
    <li><a href="#password" data-toggle="tab">{!! trans('userSettings.passSetting') !!}</a></li>
  </ul>

  <div id="myTabContent" class="tab-content">
    <div class="tab-pane active in" id="email">
      <h3>{!! trans('userSettings.changeEmail') !!}</h3>
      {!! Form::open(array('route' => 'change_email')) !!}
      <div class="form-group">
        <label for="current_email">{!! trans('userSettings.currentEmail') !!}</label>
        <input name="current_email" type="email" class="form-control"
               value="{!! Auth::user()->email !!}" disabled>
      </div>
      <div class="form-group">
        <label for="new_email">{!! trans('userSettings.newEmail') !!}</label>
        <input name="new_email" type="email" class="form-control" placeholder="{!! trans('userSettings.newEmail') !!}" required>
      </div>
      <div class="form-group">
        <label for="current_password">{!! trans('userSettings.currentPass') !!}</label>
        <input name="current_password" type="password" class="form-control" placeholder="{!! trans('userSettings.currentPass') !!}"
               required>
      </div>
      <button class="btn btn-default" type="submit">{!! trans('userSettings.changeEmail') !!}</button>
      {!! Form::close() !!}
    </div>

    <div class="tab-pane" id="password">
      <h3>{!! trans('userSettings.changePass') !!}</h3>
      {!! Form::open(array('route' => 'change_password')) !!}
      <div class="form-group">
        <label for="current_password">{!! trans('userSettings.currentPass') !!}</label>
        <input name="current_password" type="password" class="form-control" placeholder="{!! trans('userSettings.currentPass') !!}"
               required>
      </div>
      <div class="form-group">
        <label for="new_password">{!! trans('userSettings.newPass') !!}</label>
        <input name="new_password" type="password" class="form-control" placeholder="{!! trans('userSettings.newPass') !!}" required>
      </div>
      <div class="form-group">
        <label for="new_password_confirmation">{!! trans('userSettings.confNewPass') !!}</label>
        <input name="new_password_confirmation" type="password" class="form-control"
               placeholder="{!! trans('userSettings.confNewPass') !!}" required>
      </div>
      <button class="btn btn-default" type="submit">{!! trans('userSettings.changePass') !!}</button>
      {!! Form::close() !!}
    </div>
  </div>

@stop
