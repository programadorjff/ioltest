<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="_token" content="{!! csrf_token() !!}"/>
  <link rel="icon" href="../../favicon.ico">

  <title>{!! trans('master.title') !!}</title>

  {!! Html::style('css/style.css'); !!}
  {!! Html::style('css/themes/classic.css'); !!}
  {!! Html::style('css/themes/classic.date.css'); !!}
  {!! Html::style('css/bootstrap.min.css'); !!}
  {!! Html::style('css/selectize/selectize.bootstrap3.css'); !!}
  {!! Html::style('css/datatables.bootstrap.min.css'); !!}
  {!! Html::style('css/buttons.datatables.min.css'); !!}

</head>

<body role="document">
@include('includes.navbar')
<div class="container theme-showcase" role="main">

  @yield('content')

</div>
{!! Html::script('js/app.js'); !!}
{!! Html::script('js/jquery.min.js'); !!}
{!! Html::script('js/autonumeric.min.js'); !!}
{!! Html::script('js/bootstrap.min.js'); !!}
{!! Html::script('js/datatables.min.js'); !!}
{!! Html::script('js/datatables.buttons.min.js'); !!}
{!! Html::script('js/datatables.bootstrap.min.js'); !!}
{!! Html::script('js/buttons.bootstrap.min.js'); !!}
{!! Html::script('js/buttons.flash.min.js'); !!}
{!! Html::script('js/buttons.html5.min.js'); !!}
{!! Html::script('js/buttons.print.min.js'); !!}
{!! Html::script('js/date.js'); !!}
{!! Html::script('js/jszip.min.js'); !!}
{!! Html::script('js/pdfmake.min.js'); !!}
{!! Html::script('js/vfs_fonts.js'); !!}
{!! Html::script('js/picker.js'); !!}
{!! Html::script('js/picker.date.js'); !!}
{!! Html::script('js/selectize.js'); !!}
{!! Html::script('js/selectize.no.delete.js'); !!}

@include('js.application')
</body>
</html>
