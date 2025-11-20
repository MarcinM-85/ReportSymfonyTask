let datePickerElements = document.querySelectorAll('[data-datepicker]');
if( datePickerElements.length > 0 )
    flatpickr(datePickerElements);

let dateTimePickerElements = document.querySelectorAll('[data-datetimepicker]');
if( dateTimePickerElements.length > 0 )
    flatpickr(dateTimePickerElements, {enableTime: true, dateFormat: "Y-m-d H:i", time_24hr: true});