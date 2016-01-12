var inputDateText, pickerBudget;
var inputDateText2, newPickerBudgetVersion;

var budgetType, $budgetType;
var rejected, $rejected;

function budgetsConfig() {
	
	var budgetTable = $('#budgets').DataTable({
    	'language': {
    		'search': searchBudgetsLabel
    	},
        'columnDefs': [
	       {
	           'targets': [1,3,5,7,9,11,13,15,18,20,21,22,23,24,25],
	           'visible': false,
	           'searchable': false
	       }
	    ]
	});
	
	inputDateText = $('#dateBudget').pickadate({
		editable: true,
		container: '#datePickerBudget',
		hiddenName: true
	});
	pickerBudget = inputDateText.pickadate('picker');
    inputDateText = $('#dateBudget').on({
        blur: function() {
        	var parsedDate = null;
        	if (isEmpty(this.value))
        		return;
        	parsedDate = Date.parseString(this.value,dateFormatsDJ);
        	if (parsedDate == null && this.value != '') {
        		setDateBudgetError(this, pickerBudget, dateBudgetError);
        	} else {
        		pickerBudget.set('select',parsedDate);
        		if (isAdding) {
        			document.getElementById('lastVersionDate').value = this.value;
        			document.getElementById('lastVersionDateOriginalJS').value = parsedDate;
        			document.getElementById('lastVersionDateOriginal').value = parsedDate.format(hiddenDateFormat);
        		}
        		if (parsedDate > new Date(document.getElementById('lastVersionDateOriginalJS').value) || (!isEmpty(newPickerBudgetVersion) && (parsedDate > newPickerBudgetVersion.get('select').obj)))
        			setDateBudgetError(this, pickerBudget, dateBudgetValidationError);
        	}
        }
    });
	$('#dateBudget').off('click focus');
	$('#dateBudgetButton').on('click', function(e) {
	  if (pickerBudget.get('open')) 
		  pickerBudget.close();
	  else
		  pickerBudget.open();
	  e.stopPropagation();
	});
	
	if (!isEmpty(document.getElementById('newDateBudgetVersion'))) {
		inputDateText2 = $('#newDateBudgetVersion').pickadate({
			editable: false,
			container: '#newDatePickerBudgetVersion',
			hiddenName: true
		});		
		newPickerBudgetVersion = inputDateText2.pickadate('picker');
	    inputDateText2 = $('#newDateBudgetVersion').on({
	        change: function() {
	        	var parsedDate = null;
	        	if (isEmpty(this.value))
	        		return;
	        	parsedDate = Date.parseString(this.value,dateFormatsDJ);
	        	if (parsedDate == null && this.value != '') {
	        		this.value = '';
	        		newPickerBudgetVersion.clear();
	        	} else {
	        		if ((parsedDate < new Date(document.getElementById('lastVersionDateOriginalJS').value)) || (parsedDate < pickerBudget.get('select').obj)) {
	        			this.value = '';
	        			newPickerBudgetVersion.clear();
	        			this.value = newDateBudgetVersionError;
	        		}
	        	}
	        }
	    });
		$('#newDateBudgetVersion').off('click focus');
		$('#newDateBudgetVersionButton').on('click', function(e) {
			  if (newPickerBudgetVersion.get('open')) 
				  newPickerBudgetVersion.close();
			  else
				  newPickerBudgetVersion.open();
			  e.stopPropagation();
		});
	}
	
	$budgetType = $('#budgetType').selectize();
	budgetType  = $budgetType[0].selectize;
	
	$('#total').autoNumeric('init',{
        aDec: '.' 
    });
	
	$rejected = $('#rejected').selectize({
		labelField: 'text',
	    searchField: ['text'],
	    options: eval(optionsBudgetRejected),
	    onChange: function(value) {
	    	configureRejectedReason(value);
	    }
	});
	rejected = $rejected[0].selectize;
	rejected.setValue(-1);
	
	if (!isMasterBriefingId) {
		activeTab = listTab;
		setInactiveTab(addEditTab);
	} else if(isLoadCommon) {
		loadCommonFormValues();
	} else {
		loadFormValues();
	}
	
	setAddEditTitleTab(addEditTitleLabel);
	setActiveTab(activeTab);
	
	$('a[data-toggle="tab"]').on('click', function (e) {
		if ($($(this).context.parentElement).hasClass('disabled'))
			e.stopPropagation();
			return;
		if ($(this).context.hash == listTab && !isAdding)
			setAddMode();
	});
	
	$('#addEditForm').submit(function(e) {
		var inputs = $('input, textarea, select')
        	.not(':input[type=button], :input[type=submit], :input[type=reset]');

		$(inputs).each(function() {
			$(this).prop('disabled', false);
		});
		$('#total').val($('#total').autoNumeric('get'));
	});
}

function setAddEditTitleTab(title) {
	document.getElementById("addEditTitleLabel").innerHTML = title;
}

function setActiveTab(tab) {
	$($('.nav-tabs a[href="' + tab + '"]')[0].parentElement).removeClass('disabled');
	$('.nav-tabs a[href="' + tab + '"]').tab('show');
}

function setInactiveTab(tab) {
	$($('.nav-tabs a[href="' + tab + '"]')[0].parentElement).addClass('disabled');
}

function setDateBudgetError(obj, picker, msgError) {
	obj.value = '';
	picker.clear();
	obj.value = msgError;
	if (isAdding) {
		document.getElementById('lastVersionDate').value = '';
		document.getElementById('lastVersionDateOriginalJS').value = '';
		document.getElementById('lastVersionDateOriginal').value = '';
	}
}

function loadCommonFormValues() {
	document.getElementById('idRec').value = vIdRec;
	document.getElementById('idBriefingRec').value = vIdBriefingRec;
	document.getElementById('customer').value  = vCustomer;
	document.getElementById('customerType').value  = vCustomerType;
	document.getElementById('iolProduct').value  = vIolProduct;
	if (isAdding)
		document.getElementById('budgetId').value  = vNextBudgetId;
	else
		document.getElementById('budgetId').value  = vIdRec;
}

function loadFormValues() {
	loadCommonFormValues();
	document.getElementById('versionNumber').value  = vVersionNumber;
	if (!isEmpty(vLastVersionDate)) {
		document.getElementById('lastVersionDate').value = vLastVersionDate.format(objDateFormat);
		document.getElementById('lastVersionDateOriginalJS').value = vLastVersionDate;
		document.getElementById('lastVersionDateOriginal').value = vLastVersionDate.format(hiddenDateFormat);
	}
	if (!isEmpty(newPickerBudgetVersion))
		newPickerBudgetVersion.set('select', vNewDateBudgetVersion);
	pickerBudget.set('select', vDateBudget);
	budgetType.setValue(vBudgetType);
	if (!isEmpty(vTotal))
		$('#total').autoNumeric('set',vTotal);
	rejected.setValue(vRejected);
	document.getElementById('rejectedReason').value = vRejectedReason;
}

function configureRejectedReason(value) {
	var rejectedReason = document.getElementById('rejectedReason');
	if (value > 1) {
		rejectedReason.disabled = false;
		rejectedReason.placeholder = rejectedReasonPH;
	} else {
		rejectedReason.disabled = true;
		rejectedReason.placeholder = '';
		rejectedReason.value = '';
	}
}

function setAddMode() {
	setAddEditTitleTab(addTitleLabel);
	document.getElementById('idRec').value = '*';
	isAdding = true;
	if (!isMasterBriefingId)
		setInactiveTab(addEditTab);
}