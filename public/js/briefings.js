var inputDateText, pickerBriefing;
var l_xhr, c_xhr;
var customer, $customer;
var customerType, $customerType;
var contact, $contact;
var product, $product;
var iolProduct, $iolProduct;
var briefingSource, $briefingSource;
var briefingOwner, $briefingOwner;

function briefingsConfig() {
	
	var briefingTable = $('#briefings').DataTable({
    	'language': {
    		'search': searchBriefingsLabel
    	},
        'columnDefs': [
	       {
	           'targets': [0,2,4,6,8,10,12,13,14,15,16,17,18,19,20,21,22,23,24],
	           'visible': false,
	           'searchable': false
	       }
	    ]
	});
	
	inputDateText = $('#dateBriefing').pickadate({
		editable: true,
		container: '#datePickerBriefing',
		hiddenName: true
	});
	pickerBriefing = inputDateText.pickadate('picker');
    inputDateText = $('#dateBriefing').on({
        blur: function() {
        	var parsedDate = null;
        	if (isEmpty(this.value))
        		return;
        	parsedDate = Date.parseString(this.value,dateFormatsDJ);
        	if (parsedDate == null && this.value != '') {
        		this.value = dateBriefingError;
        	} else {
        		pickerBriefing.set('select',parsedDate);
        	}
        }
    });

	$('#dateBriefing').off('click focus');

	$('#dateBriefingButton').on('click', function(e) {
	  if (pickerBriefing.get('open')) 
		  pickerBriefing.close();
	  else
		  pickerBriefing.open();
	  e.stopPropagation();
	});
	
	$customer = $('#customer').selectize({
	    load: function(query, callback) {
	        l_xhr && l_xhr.abort();
	        l_xhr = $.ajax({
	            url: '../customers/filtered',
	            type: 'POST',
	            data: {
	            	'name': query
	            },
	            error: function() {
	            	initializeComboBoxRelatedCustomer();
	            	customer.setValue('-1/-1');
	                callback();
	            },
	            success: function(results) {
	            	callback(results);
	            }
	        })
	    },
		persist: false,
		create: function(input, callback) {
			if (!input.length) return;
	    	c_xhr && c_xhr.abort();
	    	c_xhr = $.ajax({
	            url: '../customers/exist',
	            type: 'POST',
	            data: {
	            	'name': input
	            },
	            error: function() {
	            	initializeComboBoxRelatedCustomer();
	                contact.disable();
	                customer.setValue('-1/-1');
	                callback();
	            },
	            success: function(result) {
	            	customerType.setValue(-1);
	            	if (!result.exist) {
	            		contact.enable();
	            		return callback({
	        	            value: '*|' + input + '/-1',
	        	            text: input
	        	        });
	            	} else {
	            		customer.setValue('-1/-1');
	            		return callback();
	            	}
	            }
	        })
	    },
	    onChange: function(value) {
	        if (!value.length) {
	        	initializeComboBoxRelatedCustomer();
	        } else {
	        	var auxValue = value.split('/');
	        	if (auxValue.length > 1) {
	        		customerType.setValue(auxValue[1]);
	        		var auxValue2 = auxValue[0].split('|');
	        		if (auxValue2.length > 1)
	        			auxValue[0] = auxValue2[0];
	        		loadContact(auxValue[0]);
	        	} else {
	        		initializeComboBoxRelatedCustomer();
	        	}
	        }
	    }
	});
	customer = $customer[0].selectize;
	$customerType = $('#customerType').selectize();
	customerType  = $customerType[0].selectize;
	
	$contact = $('#contact').selectize({
		persist: false,
		create: function(input, callback) {
			if (!input.length) return;
	    	c_xhr && c_xhr.abort();
	    	c_xhr = $.ajax({
	            url: '../contacts/exist',
	            type: 'POST',
	            data: {
	            	'customerId' : customer.getValue().split('/')[0],
	            	'name': input
	            },
	            error: function() {
	            	contact.setValue(-1);
	                callback();
	            },
	            success: function(result) {
	            	if (!result.exist)
	            		return callback({
	        	            value: '*|' + input,
	        	            text: input
	        	        });
	            	else {
	            		contact.setValue(-1);
	            		return callback();
	            	}
	            }
	        })
	    }
	});
	contact = $contact[0].selectize;
	contact.disable();

	$product = $('#product').selectize({
	    load: function(query, callback) {
	        l_xhr && l_xhr.abort();
	        l_xhr = $.ajax({
	            url: '../products/filtered',
	            type: 'POST',
	            data: {
	            	'name': query
	            },
	            error: function() {
	            	product.setValue(-1);
	                callback();
	            },
	            success: function(results) {
	            	callback(results);
	            }
	        })
	    },
		persist: false,
		create: function(input, callback) {
			if (!input.length) return;
	    	c_xhr && c_xhr.abort();
	    	c_xhr = $.ajax({
	            url: '../products/exist',
	            type: 'POST',
	            data: {
	            	'name': input
	            },
	            error: function() {
	            	product.setValue(-1);
	                callback();
	            },
	            success: function(result) {
	            	if (!result.exist)
	            		return callback({
	        	            value: '*|' + input,
	        	            text: input
	        	        });
	            	else {
	            		product.setValue(-1);
	            		return callback();
	            	}
	            }
	        })
	    }
	});
	product = $product[0].selectize;
	
	$iolProduct  = $('#iolProduct').selectize();
	iolProduct = $iolProduct[0].selectize;
	
	$briefingSource = $('#briefingSource').selectize({
		labelField: 'text',
	    searchField: ['text'],
	    options: eval(optionsBriefingSource),
	    optgroups: eval(optionsGroupBriefingSource),
	    optgroupField: 'group',
	    optgroupLabelField: 'text'
	});
	briefingSource = $briefingSource[0].selectize;
	briefingSource.setValue(-1);

	$briefingOwner = $('#briefingOwner').selectize();
	briefingOwner = $briefingOwner[0].selectize;
	
	setAddEditTitleTab(addEditTitleLabel);
	setActiveTab(activeTab);
	
	if (activeTab != listTab)
		loadFormValues();
	
	$('a[data-toggle="tab"]').on('click', function (e) {
		if ($(this).context.hash == listTab && !isAdding)
			setAddMode();
	});
}

function initializeComboBoxRelatedCustomer() {
	customerType.setValue(-1);
	contact.setValue(-1);
}

function loadContact(customerId) {
	contact.disable();
	contact.clearOptions();
	contact.load(function(callback) {
    	l_xhr && l_xhr.abort();
    	l_xhr = $.ajax({
            url: '../contacts/contactsByCustomer',
            type: 'POST',
            data: {
            	'customerId': customerId
            },
            error: function() {
            	contact.setValue(-1);
            	callback();
            },
            success: function(results) {
            	callback(results);
            	contact.userOptions = {};
            	if (isEmpty(vContact) || vContact < 1)
            		contact.setValue(-1);
            	else {
            		contact.setValue(vContact);
            		vContact = null;
            	}
            	if (customerId > 0 || customerId == '*')
            		contact.enable();
            	else
            		contact.disable();
            }
        })
    });
}

function setAddEditTitleTab(title) {
	document.getElementById("addEditTitleLabel").innerHTML = title;
}

function setActiveTab(tab) {
	$('.nav-tabs a[href="' + tab + '"]').tab('show');
}

function loadFormValues() {
	document.getElementById('idRec').value = vIdRec;
	pickerBriefing.set('select', vDateBriefing);
	customer.setValue(vCustomer);
	customerType.setValue(vCustomerType);
	product.setValue(vProduct);
	iolProduct.setValue(vIolProduct);
	briefingSource.setValue(vBriefingSource);
	briefingOwner.setValue(vBriefingOwner);
	document.getElementById('challenge').checked = vChallenge;
}

function setAddMode() {
	setAddEditTitleTab(addTitleLabel);
	document.getElementById('idRec').value = '*';
	document.getElementById('addBudget').style.display = 'none';
	document.getElementById('linkedBudgets').style.display = 'none';
	isAdding = true;
}