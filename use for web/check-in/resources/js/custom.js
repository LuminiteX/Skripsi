$(function () {
    $('#datetimepicker').datetimepicker({
        format: 'HH:00:00', // set the format to select only the hour
        stepping: 1, // set the stepping to 1 hour
        icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-calendar-check-o',
            clear: 'fa fa-trash-o',
            close: 'fa fa-times'
        }
    });
});
