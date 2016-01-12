@extends('layouts.master',['activePage' => 'budgets'])
@section('content')

  <h1>{!! trans('budgets.title') !!}</h1>

  <hr>

  @include('includes.messages')

  <ul class="nav nav-tabs">
    <li class="active"><a href="#list" data-toggle="tab">{!! trans('budgets.show') !!}</a></li>
    <li><a href="#addEdit" data-toggle="tab"><span id="addEditTitleLabel"></span></a></li>
  </ul>

  <div id="myTabContent" class="tab-content">
    <br>
    <div class="tab-pane active in" id="list">
      @if($budgets && $budgets->count())
        <table id="budgets" class="table table-striped" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th>{!! trans('budgets.budgetId') !!}</th>
            <th>{!! trans('briefings.id') !!}</th>
            <th>{!! trans('budgets.dateBudget') !!}</th>
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
            <th>{!! trans('briefings.ownerId') !!}</th>
            <th>{!! trans('briefings.owner') !!}</th>
            <th>{!! trans('budgets.budgetTypeId') !!}</th>
            <th>{!! trans('budgets.budgetType') !!}</th>
            <th>{!! trans('budgets.total') !!}</th>
            <th>{!! trans('budgets.rejectedId') !!}</th>
            <th>{!! trans('budgets.rejected') !!}</th>
            <th>{!! trans('briefings.userId') !!}</th>
            <th>{!! trans('profile.user') !!}</th>
            <th>{!! trans('briefings.dateCreated') !!}</th>
            <th>{!! trans('briefings.userUpdatedId') !!}</th>
            <th>{!! trans('briefings.userUpdated') !!}</th>
            <th>{!! trans('briefings.dateUpdated') !!}</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          @foreach($budgets as $budget)
            <tr>
              <td>{!! $budget->id !!}</td>
              <td>{!! $budget->briefing_id !!}</td>
              <td>{!! $budget->date_budget->format(trans('system.dateFormat')) !!}</td>
              <td>{!! $budget->briefing->customer_id !!}</td>
              <td>{!! $budget->briefing->customer->name !!}</td>
              <td>{!! $budget->briefing->customer_type_id !!}</td>
              <td>{!! $budget->briefing->customerType->type !!}</td>
              <td>{!! $budget->briefing->contact_id !!}</td>
              <td>{!! $budget->briefing->contact->name !!}</td>
              <td>{!! $budget->briefing->prod_id !!}</td>
              <td>{!! $budget->briefing->product->name !!}</td>
              <td>{!! $budget->briefing->iol_prod_id !!}</td>
              <td>{!! $budget->briefing->iolProduct->name !!}</td>
              <td>{!! $budget->briefing->briefing_owner_id !!}</td>
              <td>{!! $budget->briefing->briefingOwner->name !!}</td>
			  <td>{!! $budget->budget_type_id !!}</td>
              <td>{!! $budget->budgetType->type !!}</td>
              <td>{!! number_format((float)$budget->total, 2, '.', ',') !!}</td>
              <td>{!! $budget->rejected !!}</td>
              <td>
              @if($budget->rejected == 0)
              	{!! trans('budgets.rejectedNotSpec') !!}
              @elseif($budget->rejected == 1)
              	{!! trans('budgets.rejectedTrue') !!}
              @else
              	{!! trans('budgets.rejectedFalse') !!}
              @endif
              </td>
              <td>{!! $budget->user_id!!}</td>
              <td>{!! $budget->user->email !!}</td>
              <td>{!! $budget->created_at->format(trans('system.dateFormat')) !!}</td>
              <td>{!! $budget->last_updated_user_id !!}</td>
              <td>{!! $budget->userUpdated->email !!}</td>
              <td>{!! $budget->updated_at->format(trans('system.dateFormat')) !!}</td>
              <td>
                {!! Form::open(array('route' => 'load_edit_briefing')) !!}
                <input type="hidden" name="idRecToEdit" value="{!! $budget->briefing_id !!}">
                <button type="submit" class="btn btn-default" title="{!! trans('budgets.briefingsLinkedTo') !!}">
                	<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
                </button>
                {!! Form::close() !!}
              </td>
              <td>
                {!! Form::open(array('route' => 'load_edit_budget')) !!}
                <input type="hidden" name="idRecToEdit" value="{!! $budget->id !!}">
                <input type="hidden" name="idBriefingRecToEdit" value="{!! isset($masterBriefingId)?$masterBriefingId:'-1'; !!}">
                <button type="submit" class="btn btn-default" title="{!! trans('budgets.edit') !!}">
                	<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </button>
                {!! Form::close() !!}
              </td>
              <td>
                {!! Form::open(array('route' => 'delete_budget')) !!}
                <input type="hidden" name="id" value="{!! $budget->id !!}">
                <input type="hidden" name="masterBriefingId" value="{!! isset($masterBriefingId)?$masterBriefingId:'-1'; !!}">
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
      {!! Form::open(array('route' => 'add_update_budget', 'name' => 'addEditForm', 'id' => 'addEditForm', 'style'=>'display:inline-block')) !!}
      <div class="form-group">
        <label for="customer">{!! trans('briefings.customer') !!}</label>
        <input type="text" name="customer" id="customer" class="form-control" value="" disabled>
      </div>
      <div class="form-group">
        <label for="customerType">{!! trans('briefings.customerType') !!}</label>
        <input type="text" name="customerType" id="customerType" class="form-control" value="" disabled>
      </div>
      <div class="form-group">
        <label for="iolProduct">{!! trans('briefings.iolProduct') !!}</label>
        <input type="text" name="iolProduct" id="iolProduct" class="form-control" value="" disabled>
      </div>
      <div class="form-group">
        <label for="budgetId">{!! trans('budgets.budgetId') !!}</label>
        <input type="number" name="budgetId" id="budgetId" class="form-control" value="-1" disabled>
      </div>
      <div class="form-group">
        <label for="versionNumber">{!! trans('budgets.versionNumber') !!}</label>
        <input type="number" name="versionNumber" id="versionNumber" class="form-control" value="1" disabled>
      </div>
      <div class="form-group">
        <label for="lastVersionDate">{!! trans('budgets.lastVersionDate') !!}</label>
        <input type="text" name="lastVersionDate" id="lastVersionDate" class="form-control" value="" disabled>
        <input type="hidden" name="lastVersionDateOriginalJS" id="lastVersionDateOriginalJS" class="form-control" value="">
        <input type="hidden" name="lastVersionDateOriginal" id="lastVersionDateOriginal" class="form-control" value="">
      </div>
      @if(isset($budgetToEdit) || (Input::old('idRec') !== null && Input::old('idRec') !== '' && Input::old('idRec')> 0))
	  <div class="form-group">
	  	<label for="newDateBudgetVersion">{!! trans('budgets.newDateBudgetVersion') !!}</label>
	  	<input name="newDateBudgetVersion" id="newDateBudgetVersion" type="text" class="date-input form-control" />
	  	<div id="newDatePickerBudgetVersion"></div>
	  </div>
	  @endif
	  <div class="form-group">
	  	<label for="dateBudget">{!! trans('budgets.dateBudget') !!}</label>
	  	<div class="input-group">
	  		<input name="dateBudget" id="dateBudget" type="text" class="date-input form-control" placeholder="{!! trans('briefings.dateBriefingPH') !!}" />
	  		<span class="input-group-btn">
	  			<button name="dateBudgetButton" id="dateBudgetButton" class="date-button btn btn-default" type="button"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></button>
	  		</span>
	  	</div>
	  	<div id="datePickerBudget"> </div>
	  </div>
      <div class="form-group">
        <label for="budgetType">{!! trans('budgets.budgetType') !!}</label>
        <select name="budgetType" id="budgetType" class="form-control" placeholder="{!! trans('budgets.budgetTypePH') !!}">
        	<option value="-1">{!! trans('budgets.budgetTypePH') !!}</option>
        @foreach($relationships['budgetTypes'] as $budgetType)
        	<option value="{!! $budgetType->id !!}">{!! $budgetType->type !!}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="total">{!! trans('budgets.total') !!}</label>
        <input type="text" name="total" id="total" class="form-control" value="" placeholder="{!! trans('budgets.totalPH') !!}">
      </div>
      <div class="form-group">
        <label for="rejected">{!! trans('budgets.rejected') !!}</label>
        <select name="rejected" id="rejected" class="form-control" placeholder="{!! trans('budgets.rejectedPH') !!}">
        </select>
      </div>
      <div class="form-group">
        <label for="rejectedReason">{!! trans('budgets.rejectedReason') !!}</label>
        <textarea name="rejectedReason" id="rejectedReason" class="form-control" rows="5" disabled></textarea>
      </div>
      <div class="form-group">
      	  <input type="hidden" name="idRec" id="idRec" value="-1">
      	  <input type="hidden" name="idBriefingRec" id="idBriefingRec" value="-1">
      	  <button class="btn btn-default" type="submit">{!! trans('briefings.save') !!}</button>
	      @if(isset($budgetToEdit))
	      <button name="newDateBudgetVersionButton" id="newDateBudgetVersionButton" class="date-button btn btn-default" type="button">
	      	{!! trans('budgets.addNewVersion') !!}&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
	      </button>
	      @endif
	      {!! Form::close() !!}
	      @if(isset($budgetToEdit))
	      {!! Form::open(array('route' => 'load_edit_briefing', 'style'=>'display:inline-block')) !!}
	      <input type="hidden" name="idRecToEdit" value="{!! $budgetToEdit->id !!}">
	      <button type="submit" class="btn btn-default" title="{!! trans('budgets.briefingsLinkedTo') !!}">
	      	<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
	      </button>
	      {!! Form::close() !!}
	      @endif
		</div>
    </div>
    
	{!! Html::script('js/budgets.js'); !!}
    
@stop