<script type="text/javascript">
var searchBriefingsLabel = "{!! trans('briefings.searchBriefingsLabel') !!}";
var dateBriefingError = "{!! trans('briefings.dateBriefingError') !!}";
var optionsBriefingSource = [];
var optionsGroupBriefingSource = [];
var lastOptionsGroupBriefingSourceValue = "";
var isAdding = true;
var addTitleLabel = "{!! trans('briefings.add') !!}";
var editTitleLabel = "{!! trans('briefings.edit') !!}";
var addEditTitleLabel = "{!! trans('briefings.edit') !!}";
var listTab = "#list";
var addEditTab = "#addEdit";
var activeTab = listTab;

@if (isset($isAdding))
	isAdding = "{!! $isAdding !!}";
	addEditTitleLabel = "{!! $addEditTitleLabel !!}";
@endif

@if (isset($relationships))
	@foreach($relationships['briefingSources'] as $briefingSource)
		optionsBriefingSource.push("{ value:'{!! $briefingSource->id !!}', text:'{!! $briefingSource->name !!}', group:'{!! $briefingSource->briefingSourceType->id !!}' }");
		if (lastOptionsGroupBriefingSourceValue == "" || (lastOptionsGroupBriefingSourceValue != "" && lastOptionsGroupBriefingSourceValue != "{value: '{!! $briefingSource->briefingSourceType->id !!}', text: '{!! $briefingSource->briefingSourceType->type !!}'}"))
			optionsGroupBriefingSource.push("{value: '{!! $briefingSource->briefingSourceType->id !!}', text: '{!! $briefingSource->briefingSourceType->type !!}'}");
		lastOptionsGroupBriefingSourceValue = "{value: '{!! $briefingSource->briefingSourceType->id !!}', text: '{!! $briefingSource->briefingSourceType->type !!}'}";
	@endforeach
@endif

var vIdRec,vDateBriefing,vCustomer,vCustomerType,vContact,vProduct,vIolProduct,vBriefingSource,vBriefingOwner,vChallenge;

@if (Input::old('idRec') !== null || isset($briefingToEdit))
	activeTab = addEditTab;
	@if (Input::old('idRec') !== null)
		vIdRec = "{!! Input::old('idRec') !!}";
		vDateBriefing = "{!! Input::old('dateBriefing') !!}";
		vCustomer = "{!! Input::old('customer') !!}";
		vCustomerType = "{!! Input::old('customerType') !!}";
		vContact = "{!! Input::old('contact') !!}";
		vProduct = "{!! Input::old('product') !!}";
		vIolProduct = "{!! Input::old('iolProduct') !!}";
		vBriefingSource = "{!! Input::old('briefingSource') !!}";
		vBriefingOwner = "{!! Input::old('briefingOwner') !!}";
		vChallenge = "{!! Input::old('challenge') !!}";
		if (vIdRec != '*') {
			isAdding = false;
			addEditTitleLabel = editTitleLabel;
		}
	@else
		vIdRec = "{!! $briefingToEdit->id !!}";
		vDateBriefing = "{!! $briefingToEdit->date_briefing !!}";
		vCustomer = "{!! $briefingToEdit->customer_id !!}/{!! $briefingToEdit->customer->customer_type_id !!}";
		vCustomerType = "{!! $briefingToEdit->customer_type_id !!}";
		vContact = "{!! $briefingToEdit->contact_id !!}";
		vProduct = "{!! $briefingToEdit->prod_id !!}";
		vIolProduct = "{!! $briefingToEdit->iol_prod_id !!}";
		vBriefingSource = "{!! $briefingToEdit->briefing_source_id !!}";
		vBriefingOwner = "{!! $briefingToEdit->briefing_owner_id !!}";
		vChallenge = "{!! $briefingToEdit->challenge !!}";
	@endif
	if (isEmpty(vDateBriefing))
		vDateBriefing = null;
	else
		vDateBriefing = new Date(vDateBriefing);
	if (isEmpty(vContact))
		vContact = -1;
	if (isEmpty(vChallenge))
		vChallenge = 0;
	vChallenge = (vChallenge == 1);
@endif

if (optionsBriefingSource.length == 0) {
	optionsBriefingSource = "[{}]";
	optionsGroupBriefingSource = "[{}]";
} else {
	optionsBriefingSource.unshift("{ value:'-1', text:'{!! trans('briefings.sourcePH') !!}' }");
	optionsBriefingSource = optionsBriefingSource.join(",");
	optionsBriefingSource = "[" + optionsBriefingSource + "]";
	optionsGroupBriefingSource = optionsGroupBriefingSource.join(",");
	optionsGroupBriefingSource = "[" + optionsGroupBriefingSource + "]";
}

$(document).ready(function() {
	if (typeof briefingsConfig === 'function')
		briefingsConfig();
});
</script>