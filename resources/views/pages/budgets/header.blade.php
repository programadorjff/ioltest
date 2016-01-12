<script type="text/javascript">
var searchBudgetsLabel = "{!! trans('budgets.searchBudgetsLabel') !!}";
var dateBudgetError = "{!! trans('briefings.dateBriefingError') !!}";
var dateBudgetValidationError = "{!! trans('budgets.dateBudgetValidationError') !!}";
var newDateBudgetVersionError = "{!! trans('budgets.newDateBudgetVersionError') !!}";
var rejectedReasonPH = "{!! trans('budgets.rejectedReasonPH') !!}";
var optionsBudgetRejected = [];
var isAdding = true;
var isMasterBriefingId = false;
var masterBriefingId = -1;
var addTitleLabel = "{!! trans('budgets.add') !!}";
var editTitleLabel = "{!! trans('budgets.edit') !!}";
var addEditTitleLabel = "{!! trans('budgets.edit') !!}";
var listTab = "#list";
var addEditTab = "#addEdit";
var activeTab = "{!! $activeTab !!}";
var isLoadCommon = true;

@if (isset($isAdding))
	isAdding = "{!! $isAdding !!}";
	addEditTitleLabel = "{!! $addEditTitleLabel !!}";
@endif

@if (isset($masterBriefingId))
	masterBriefingId = "{!! $masterBriefingId !!}";
	if (masterBriefingId > 0)
		isMasterBriefingId = true;
@endif

var vIdRec,vIdBriefingRec,vCustomer,vCustomerType,vIolProduct,vNextBudgetId,vVersionNumber,vLastVersionDate,vNewDateBudgetVersion,vDateBudget,vBudgetType,vTotal,vRejected,vRejectedReason;
@if (Input::old('idRec') !== null || Input::old('idBriefingRec') !== null || isset($budgetToEdit))
	activeTab = addEditTab;
	isLoadCommon = false;
	isMasterBriefingId = true;
	@if (Input::old('idRec') !== null || Input::old('idBriefingRec') !== null)
		vIdRec = "{!! Input::old('idRec') !!}";
		vIdBriefingRec = "{!! Input::old('idBriefingRec') !!}";
		masterBriefingId = vIdBriefingRec;
		vCustomer = "{!! Input::old('customer') !!}";
		vCustomerType = "{!! Input::old('customerType') !!}";
		vIolProduct = "{!! Input::old('iolProduct') !!}";
		vNextBudgetId = "{!! Input::old('budgetId') !!}";
		vVersionNumber = "{!! Input::old('versionNumber') !!}";
		vLastVersionDate = "{!! Input::old('lastVersionDateOriginal') !!}";
		vNewDateBudgetVersion = "{!! Input::old('newDateBudgetVersion') !!}";
		vDateBudget = "{!! Input::old('dateBudget') !!}";
		vBudgetType = "{!! Input::old('budgetType') !!}";
		vTotal = "{!! Input::old('total') !!}";
		vRejected = "{!! Input::old('rejected') !!}";
		vRejectedReason = "{!! Input::old('rejectedReason') !!}";
		if (vIdRec != '*') {
			isAdding = false;
			addEditTitleLabel = editTitleLabel;
		}
	@else
		vIdRec = "{!! $budgetToEdit->id !!}";
		vIdBriefingRec = "{!! $budgetToEdit->briefing_id !!}";
		vCustomer = "{!! $budgetToEdit->briefing->customer->name !!}";
		vCustomerType = "{!! $budgetToEdit->briefing->customerType->type !!}";
		vIolProduct = "{!! $budgetToEdit->briefing->iolProduct->name !!}";
		vNextBudgetId = "{!! $nextBudgetId !!}";
		vVersionNumber = "{!! $versionNumber !!}";
		vLastVersionDate = "{!! $lastVersionDate !!}";
		{{-- vNewDateBudgetVersion = "{!! $newDateBudgetVersion !!}"; --}}
		vNewDateBudgetVersion = null;
		vDateBudget = "{!! $budgetToEdit->date_budget !!}";
		vBudgetType = "{!! $budgetToEdit->budget_type_id !!}";
		vTotal = "{!! $budgetToEdit->total !!}";
		vRejected = "{!! $budgetToEdit->rejected !!}";
		vRejectedReason = "{!! $budgetToEdit->rejected_reason !!}";
	@endif
	if (isEmpty(vLastVersionDate))
		vLastVersionDate = null;
	else
		vLastVersionDate = new Date(vLastVersionDate);
	if (isEmpty(vNewDateBudgetVersion))
		vNewDateBudgetVersion = null;
	else
		vNewDateBudgetVersion = new Date(vNewDateBudgetVersion);
	if (isEmpty(vDateBudget))
		vDateBudget = null;
	else
		vDateBudget = new Date(vDateBudget);
	if (isEmpty(vBudgetType))
		vBudgetType = -1;
	if (isEmpty(vRejected))
		vRejected = 0;
@elseif (isset($masterBriefing))
		vIdRec = "*";
		vIdBriefingRec = "{!! $masterBriefing->id !!}";
		vCustomer = "{!! $masterBriefing->customer->name !!}";
		vCustomerType = "{!! $masterBriefing->customerType->type !!}";
		vIolProduct = "{!! $masterBriefing->iolProduct->name !!}";
		vNextBudgetId = "{!! $nextBudgetId !!}";
@endif

optionsBudgetRejected.push("{ value:'-1', text:'{!! trans('budgets.rejectedPH') !!}' }");
optionsBudgetRejected.push("{ value:'0', text:'{!! trans('budgets.rejectedNotSpec') !!}' }");
optionsBudgetRejected.push("{ value:'1', text:'{!! trans('budgets.rejectedTrue') !!}' }");
optionsBudgetRejected.push("{ value:'2', text:'{!! trans('budgets.rejectedFalse') !!}' }");
optionsBudgetRejected = optionsBudgetRejected.join(",");
optionsBudgetRejected = "[" + optionsBudgetRejected + "]";

$(document).ready(function() {
	if (typeof budgetsConfig === 'function')
		budgetsConfig();
});
</script>