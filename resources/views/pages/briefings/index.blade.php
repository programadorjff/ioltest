@extends('layouts.master',['activePage' => 'briefings'])
@section('content')

  <h1>{!! trans('briefings.title') !!}</h1>

  <hr>

  @include('includes.messages')

  <ul class="nav nav-tabs">
    <li class="active"><a href="#list" data-toggle="tab">{!! trans('briefings.show') !!}</a></li>
    <li><a href="#addEdit" data-toggle="tab"><span id="addEditTitleLabel"></span></a></li>
  </ul>

  <div id="myTabContent" class="tab-content">
    <br>
    <div class="tab-pane active in" id="list">
      @if($briefings && $briefings->count())
        <table id="briefings" class="table table-striped" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th>{!! trans('briefings.id') !!}</th>
            <th>{!! trans('briefings.dateBriefing') !!}</th>
            <th>{!! trans('briefings.customerId') !!}</th>
            <th>{!! trans('briefings.customer') !!}</th>
            <th>{!! trans('briefings.customerTypeId') !!}</th>
            <th>{!! trans('briefings.customerType') !!}</th>
            <th>{!! trans('briefings.contactId') !!}</th>
            <th>{!! trans('briefings.contact') !!}</th>
            <th>{!! trans('briefings.productId') !!}</th>
            <th>{!! trans('briefings.product') !!}</th>
            <th>{!! trans('briefings.iolProductId') !!}</th>
            <th>{!! trans('briefings.iolProduct') !!}</th>
            <th>{!! trans('briefings.sourceId') !!}</th>
            <th>{!! trans('briefings.source') !!}</th>
            <th>{!! trans('briefings.sourceTypeId') !!}</th>
            <th>{!! trans('briefings.sourceType') !!}</th>
            <th>{!! trans('briefings.ownerId') !!}</th>
            <th>{!! trans('briefings.owner') !!}</th>
            <th>{!! trans('briefings.challenge') !!}</th>
            <th>{!! trans('briefings.userId') !!}</th>
            <th>{!! trans('profile.user') !!}</th>
            <th>{!! trans('briefings.dateCreated') !!}</th>
            <th>{!! trans('briefings.userUpdatedId') !!}</th>
            <th>{!! trans('briefings.userUpdated') !!}</th>
            <th>{!! trans('briefings.dateUpdated') !!}</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          @foreach($briefings as $briefing)
            <tr>
              <td>{!! $briefing->id !!}</td>
              <td>{!! $briefing->date_briefing->format(trans('system.dateFormat')) !!}</td>
              <td>{!! $briefing->customer_id !!}</td>
              <td>{!! $briefing->customer->name !!}</td>
              <td>{!! $briefing->customer_type_id !!}</td>
              <td>{!! $briefing->customerType->type !!}</td>
              <td>{!! $briefing->contact_id !!}</td>
              <td>{!! $briefing->contact->name !!}</td>
              <td>{!! $briefing->prod_id !!}</td>
              <td>{!! $briefing->product->name !!}</td>
              <td>{!! $briefing->iol_prod_id !!}</td>
              <td>{!! $briefing->iolProduct->name !!}</td>
              <td>{!! $briefing->briefing_source_id !!}</td>
              <td>{!! $briefing->briefingSource->name !!}</td>
              <td>{!! $briefing->briefingSource->briefing_source_type_id !!}</td>
              <td>{!! $briefing->briefingSource->briefingSourceType->type !!}</td>
              <td>{!! $briefing->briefing_owner_id !!}</td>
              <td>{!! $briefing->briefingOwner->name !!}</td>
              <td>{!! $briefing->challenge !!}</td>
              <td>{!! $briefing->user_id!!}</td>
              <td>{!! $briefing->user->email !!}</td>
              <td>{!! $briefing->created_at->format(trans('system.dateFormat')) !!}</td>
              <td>{!! $briefing->last_updated_user_id !!}</td>
              <td>{!! $briefing->userUpdated->email !!}</td>
              <td>{!! $briefing->updated_at->format(trans('system.dateFormat')) !!}</td>
              <td>
                {!! Form::open(array('route' => 'load_edit_budget')) !!}
                <input type="hidden" name="idBriefingRecToEdit" value="{!! $briefing->id !!}">
                <input type="hidden" name="activeTab" value="#addEdit">
                <button type="submit" class="btn btn-default" title="{!! trans('briefings.addBudget') !!}">
                	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
                {!! Form::close() !!}
              </td>
              <td>
                {!! Form::open(array('route' => 'post_budgets')) !!}
                <input type="hidden" name="masterBriefingId" value="{!! $briefing->id !!}">
                <button type="submit" class="btn btn-default" title="{!! trans('briefings.linkedBudgets') !!}">
                	<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                </button>
                {!! Form::close() !!}
              </td>
              <td>
                {!! Form::open(array('route' => 'load_edit_briefing')) !!}
                <input type="hidden" name="idRecToEdit" value="{!! $briefing->id !!}">
                <button type="submit" class="btn btn-default" title="{!! trans('briefings.edit') !!}">
                	<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </button>
                {!! Form::close() !!}
              </td>
              <td>
                {!! Form::open(array('route' => 'delete_briefing')) !!}
                <input type="hidden" name="id" value="{!! $briefing->id !!}">
                <button type="submit" class="close">&times;</button>
                {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
        <div id="dtButtons"></div>
      @else
        <p>{!! trans('master.zeroRecords') !!}</p>
      @endif
    </div>

    <div class="tab-pane" id="addEdit">
      {!! Form::open(array('route' => 'add_update_briefing', 'style'=>'display:inline-block')) !!}
	  <div class="form-group">
	  	<label for="dateBriefing">{!! trans('briefings.dateBriefing') !!}</label>
	  	<div class="input-group">
	  		<input name="dateBriefing" id="dateBriefing" type="text" class="date-input form-control" placeholder="{!! trans('briefings.dateBriefingPH') !!}" />
	  		<span class="input-group-btn">
	  			<button name="dateBriefingButton" id="dateBriefingButton" class="date-button btn btn-default" type="button"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></button>
	  		</span>
	  	</div>
	  	<div id="datePickerBriefing"></div>
	  </div>
      <div class="form-group">
        <label for="customer">{!! trans('briefings.customer') !!}</label>
        <select name="customer" id="customer" class="form-control" placeholder="{!! trans('briefings.customerPH') !!}">
        	<option value="-1/-1">{!! trans('briefings.customerPH') !!}</option>
        @foreach($relationships['customers'] as $customer)
        	<option value="{!! $customer->id !!}/{!! $customer->customerType->id !!}">{!! $customer->name !!}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="customerType">{!! trans('briefings.customerType') !!}</label>
        <select name="customerType" id="customerType" class="form-control" placeholder="{!! trans('briefings.customerTypePH') !!}">
        	<option value="-1">{!! trans('briefings.customerTypePH') !!}</option>
        @foreach($relationships['customerTypes'] as $customerType)
        	<option value="{!! $customerType->id !!}">{!! $customerType->type !!}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="contact">{!! trans('briefings.contact') !!}</label>
        <select name="contact" id="contact" class="form-control" placeholder="{!! trans('briefings.contactPH') !!}">
        </select>
      </div>
      <div class="form-group">
        <label for="product">{!! trans('briefings.product') !!}</label>
        <select name="product" id="product" class="form-control" placeholder="{!! trans('briefings.productPH') !!}">
        	<option value="-1">{!! trans('briefings.productPH') !!}</option>
        @foreach($relationships['products'] as $product)
        	<option value="{!! $product->id !!}">{!! $product->name !!}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="iolProduct">{!! trans('briefings.iolProduct') !!}</label>
        <select name="iolProduct" id="iolProduct" class="form-control" placeholder="{!! trans('briefings.iolProductPH') !!}">
        	<option value="-1">{!! trans('briefings.iolProductPH') !!}</option>
        @foreach($relationships['iolProducts'] as $iolProduct)
        	<option value="{!! $iolProduct->id !!}">{!! $iolProduct->name !!}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="briefingSource">{!! trans('briefings.source') !!}</label>
        <select name="briefingSource" id="briefingSource" class="form-control" placeholder="{!! trans('briefings.sourcePH') !!}">
        </select>
      </div>
      <div class="form-group">
        <label for="briefingOwner">{!! trans('briefings.owner') !!}</label>
        <select name="briefingOwner" id="briefingOwner" class="form-control" placeholder="{!! trans('briefings.ownerPH') !!}">
        	<option value="-1">{!! trans('briefings.ownerPH') !!}</option>
        @foreach($relationships['briefingOwners'] as $briefingOwner)
        	<option value="{!! $briefingOwner->id !!}">{!! $briefingOwner->name !!}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group">
      	<label for="challenge">{!! trans('briefings.challenge') !!}</label>
		<input name="challenge" id="challenge" type="checkbox" value="1">
      </div>
      <div class="form-group">
      	  <input type="hidden" name="idRec" id="idRec" value="*">
	      <button class="btn btn-default" type="submit">{!! trans('briefings.save') !!}</button>
	      {!! Form::close() !!}
	      @if(isset($briefingToEdit))
		  {!! Form::open(array('route' => 'load_edit_budget', 'style'=>'display:inline-block')) !!}
	      <input type="hidden" name="idBriefingRecToEdit" value="{!! $briefingToEdit->id !!}">
	      <input type="hidden" name="activeTab" value="#addEdit">
	      <button type="submit" id="addBudget" class="btn btn-default" title="{!! trans('briefings.addBudget') !!}">
	      	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
	      </button>
	      {!! Form::close() !!}
	      {!! Form::open(array('route' => 'post_budgets', 'style'=>'display:inline-block')) !!}
	      <input type="hidden" name="masterBriefingId" value="{!! $briefingToEdit->id !!}">
	      <button type="submit" id="linkedBudgets" class="btn btn-default" title="{!! trans('briefings.linkedBudgets') !!}">
	      	<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
	      </button>
	      {!! Form::close() !!}
	      @endif
		</div>
    </div>
    
	{!! Html::script('js/briefings.js'); !!}

@stop
