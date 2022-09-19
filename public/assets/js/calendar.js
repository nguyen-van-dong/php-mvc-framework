$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        header: {
            left: "prev,next day",
            center: "title",
            right: "month,agendaWeek,agendaDay"
        },
        events: "fetch-event",
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        editable: true,
        eventClick: function (event) {
            console.log(event.id)
            window.location.href = `/edit-task?id=${event.id}`;
        }
    });
});

function displayMessage(message) {
    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}