@if(($errors = Session::get('errors')) || ($error = Session::get('error')))
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <p><b>{!! trans('system.applicationErrors') !!}</b></p>
    <ul>
    @if(isset($error))
    	<li>{!! $error !!}</li>
    @else
	    @foreach($errors->all() as $auxError)
	    	<li>{!! $auxError !!}</li>
	    @endforeach
	@endif
    </ul>
  </div>
@endif

@if(($messages = Session::get('messages')) || ($message = Session::get('message')))
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <p><b>{!! trans('system.applicationMessages') !!}</b></p>
    <ul>
    @if(isset($message)) 
    	<li>{!! $message !!}</li>
    @else
	    @foreach($messages->all() as $auxMessage)
	    	<li>{!! $auxMessage !!}</li>
	    @endforeach
    @endif
    </ul>
  </div>
@endif