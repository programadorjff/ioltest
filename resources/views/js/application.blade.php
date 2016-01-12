<script type="text/javascript">
var auxMonthsFull = "{!! trans('datePicker.monthsFull') !!}";
var auxMonthsShort = "{!! trans('datePicker.monthsShort') !!}";
var auxWeekdaysFull = "{!! trans('datePicker.weekdaysFull') !!}"; 
var auxWeekdaysShort = "{!! trans('datePicker.weekdaysShort') !!}";
var todayDP = "{!! trans('datePicker.today') !!}";
var clearDP = "{!! trans('datePicker.clear') !!}";
var closeDP = "{!! trans('datePicker.close') !!}";
var firstDayDP = parseInt("{!! trans('datePicker.firstDay') !!}");
var dateFormatDP = "{!! trans('datePicker.dateFormat') !!}";
var dateFormatToSubmitDP = "{!! trans('datePicker.dateFormatToSubmit') !!}";
var monthsFullDP = auxMonthsFull.split(',');
var monthsShortDP = auxMonthsShort.split(',');
var weekdaysFullDP = auxWeekdaysFull.split(','); 
var weekdaysShortDP = auxWeekdaysShort.split(',');

var auxDateFormats = "{!! trans('date.dateFormats') !!}"; 
var dateFormatsDJ = auxDateFormats.split(',');

var objDateFormat = "{!! trans('date.dateFormat') !!}";
var hiddenDateFormat = "yyyy-MM-dd HH:mm:ss";

var labelCreateSelectize = "{!! trans('selectize.labelCreate') !!}";

$(document).ready(function() {

	jQuery.extend(jQuery.fn.dataTable.defaults, {
		"buttons": [
			{"extend": "copy",
			"text": "{!! trans('master.buttonCopy.text') !!}"},
			"csv","excel","pdf",
			{"extend": "print",
			"text": "{!! trans('master.buttonPrint.text') !!}"},
		],
    	"pagingType": "full_numbers",
    	"language": {
        	"lengthMenu": "{!! trans('master.lengthMenu') !!}",
        	"zeroRecords": "{!! trans('master.zeroRecords') !!}",
        	"info": "{!! trans('master.info') !!}",
        	"infoEmpty": "{!! trans('master.infoEmpty') !!}",
        	"infoFiltered": "{!! trans('master.infoFiltered') !!}",
        	"search": "{!! trans('master.search') !!}",
        	"paginate": {
            	"first":      "{!! trans('master.first') !!}",
            	"last":       "{!! trans('master.last') !!}",
            	"next":       "{!! trans('master.next') !!}",
            	"previous":   "{!! trans('master.previous') !!}"
        	},
        	"buttons": {
                "copyTitle": "{!! trans('master.buttonCopy.title') !!}",
                "copySuccess": {
                    "_": "{!! trans('master.buttonCopy.info0') !!}",
                    "1": "{!! trans('master.buttonCopy.info1') !!}"
                }
            }
    	},
    	"initComplete": function() {
            $(this).DataTable().buttons().container().appendTo($('#dtButtons'));
        }
	});

    jQuery.extend(jQuery.fn.pickadate.defaults, {
        monthsFull: monthsFullDP,
        monthsShort: monthsShortDP,
        weekdaysFull: weekdaysFullDP,
        weekdaysShort: weekdaysShortDP,
        selectYears: true,
        selectMonths: true,
        today: todayDP,
        clear: clearDP,
        close: closeDP,
        firstDay: firstDayDP,
        format: dateFormatDP,
        formatSubmit: dateFormatToSubmitDP
    });

    jQuery.extend(jQuery.fn.selectize.defaults, {
        labelCreate: labelCreateSelectize
    });

    $.ajaxSetup({
    	   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    
});
</script>
@if(isset($activePage))
	@if($activePage == 'briefings')
		@include('pages.briefings.header')
	@elseif($activePage == 'budgets')
		@include('pages.budgets.header')
	@endif
@endif