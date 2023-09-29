$(document).ready(function () {
    $('#calendar').fullCalendar({
        editable: true,
        height: 600,
        width: "100%",
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        selectable: true,
        selectHelper: true,

        eventRender: function (event, element) {
            if (event.status === 'Not Yet Paid' || event.amount_paid === 0.00) {
                element.popover({
                    title: 'Today\s Due Date',
                    content: event.description,
                    trigger: 'hover',
                    placement: 'right',
                    container: 'body',
                    html: true
                });
                return true;

            } else {
                return false;
            }
        },

        events: {
            url: '/calendar',
            method: 'GET',
            failure: function () {
                alert('there was an error while fetching events!');
            },
            success: function (data) {
                console.log(data); // Log the data received from the server
            }
        },

        // eventRender: function (event, element) {
        //     element.popover({
        //         title: 'Today\s Due Date',
        //         content: event.description,
        //         trigger: 'hover',
        //         placement: 'right',
        //         container: 'body',
        //         html: true
        //     });
        // },

        // eventRender: function (event, element){
        //     if(event.status === 'Unpaid' || event.amount_paid === 0){
        //         return true;
        //     }else {
        //         return false;
        //     }
        // },

        eventStartEditable: false
    });
});
