document.addEventListener('DOMContentLoaded', function() {

    // Date variable
    var newDate = new Date();

    /**
     *
     * @getDynamicMonth() fn. is used to validate 2 digit number and act accordingly
     *
    */
    function getDynamicMonth() {
        getMonthValue = newDate.getMonth();
        if (getMonthValue < 10) {
            return `0${getMonthValue+1}`;
        } else {
            return `${getMonthValue+1}`;
        }
    }

    // console.log(getDynamicMonth())

    // Modal Elements
    var getModalFormEl = document.querySelector('#event-form');
    var getDeleteFormEl = document.querySelector('#form-delete-event');
    var getModalTitleEl = document.querySelector('#title');
    var getModalDescEl = document.querySelector('#description');
    var getModalStartDateEl = document.querySelector('#start_date');
    var getModalEndDateEl = document.querySelector('#end_date');
    var getModalAddBtnEl = document.querySelector('.btn-add-event');
    var getModalUpdateBtnEl = document.querySelector('.btn-update-event');
    var getFooterEventEl = document.querySelector('.foot-event');
    var getFooterDeleteEl = document.querySelector('.foot-delete');
    var alterStartDate = document.querySelector('#alter_start_date');
    var alterEndDate = document.querySelector('#alter_end_date');
    var calendarsEvents = {
        Learning: 'primary',
        Activity: 'success',
        Important: 'danger',
        Project: 'warning',
    }

    // Calendar Elements and options
    var calendarEl = document.querySelector('.calendar');

    var checkWidowWidth = function() {
        if (window.innerWidth <= 1199) {
            return true;
        } else {
            return false;
        }
    }

    var calendarHeaderToolbar = {
        left: 'prev next addEventButton',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    }

    var calendarEventsList = [];

    eventLists.forEach(function(a) {
        var newItem = {
            id: a.id,
            title: a.title,
            description: a.description,
            start: a.start_date,
            end: a.end_date,
            extendedProps: {
                calendar: a.remark
            }
        };

        calendarEventsList.push(newItem);
    });

    // Calendar Select fn.
    var calendarSelect = function(info) {
        getModalFormEl.action = '/admin/kalendar/';
        getModalAddBtnEl.style.display = 'block';
        getModalUpdateBtnEl.style.display = 'none';
        getFooterEventEl.style.display = 'flex';
        getFooterDeleteEl.style.display = 'none';
        myModal.show()
        getModalStartDateEl.value = info.startStr;
        getModalEndDateEl.value = info.endStr;
    }

    // Calendar AddEvent fn.
    var currentDate = new Date();
    var dd = String(currentDate.getDate()).padStart(2, '0');
    var mm = String(currentDate.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = currentDate.getFullYear();
    var combineDate = `${yyyy}-${mm}-${dd}T00:00:00`;
    alterStartDate.value = combineDate;
    alterEndDate.value = combineDate;
    var calendarAddEvent = function() {
        getModalFormEl.action = '/admin/kalendar/';
        getModalAddBtnEl.style.display = 'block';
        getModalUpdateBtnEl.style.display = 'none';
        getFooterEventEl.style.display = 'flex';
        getFooterDeleteEl.style.display = 'none';
        myModal.show();
        getModalStartDateEl.value = combineDate;
        getModalEndDateEl.value = combineDate;
    }

    // Calendar eventClick fn.
    var calendarEventClick = function(info) {
        var eventObj = info.event;

        if (eventObj.url) {
          window.open(eventObj.url);

          info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
        } else {
            var getModalEventId = eventObj._def.publicId;
            var getModalEventLevel = eventObj._def.extendedProps['calendar'];
            var getModalCheckedRadioBtnEl = document.querySelector(`input[value="${getModalEventLevel}"]`);
            var startDate = new Date(eventObj.start);
            var endDate = new Date(eventObj.end);

            function formatToISO(dateString) {
                var date = new Date(dateString);
                var year = date.getFullYear();
                var month = ('0' + (date.getMonth() + 1)).slice(-2); // Months are zero-based
                var day = ('0' + date.getDate()).slice(-2);
                var hours = ('0' + date.getHours()).slice(-2);
                var minutes = ('0' + date.getMinutes()).slice(-2);
                var seconds = ('0' + date.getSeconds()).slice(-2);
                var formattedDate = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes + ':' + seconds;
                return formattedDate;
            }

            getDeleteFormEl.action = '/admin/kalendar/' + eventObj.id;
            getModalFormEl.action = '/admin/kalendar/' + eventObj.id;
            getModalFormEl.method = 'PATCH';
            document.getElementById('methodInput').value = 'PATCH';
            getModalTitleEl.value = eventObj.title;
            getModalDescEl.value = eventObj.extendedProps.description;
            getModalStartDateEl.value = formatToISO(startDate);
            getModalEndDateEl.value = formatToISO(endDate);
            getModalCheckedRadioBtnEl.checked = true;
            // getModalUpdateBtnEl.setAttribute('data-fc-event-public-id', getModalEventId)
            getModalAddBtnEl.style.display = 'none';
            getModalUpdateBtnEl.style.display = 'block';
            getFooterEventEl.style.display = 'none';
            getFooterDeleteEl.style.display = 'flex';
            myModal.show();
        }
    }


    // Activate Calender
    var calendar = new FullCalendar.Calendar(calendarEl, {
        selectable: true,
        height: checkWidowWidth() ? 900 : 1052,
        initialView: checkWidowWidth() ? 'listWeek' : 'dayGridMonth',
        initialDate: `${newDate.getFullYear()}-${getDynamicMonth()}-07`,
        headerToolbar: calendarHeaderToolbar,
        events: calendarEventsList,
        select: calendarSelect,
        unselect: function() {
            console.log('unselected')
        },
        customButtons: {
            addEventButton: {
                text: 'Add Event',
                click: calendarAddEvent
            }
        },
        eventClassNames: function ({ event: calendarEvent }) {
            const getColorValue = calendarsEvents[calendarEvent._def.extendedProps.calendar];
            return [
              // Background Color
              'event-fc-color fc-bg-' + getColorValue
            ];
        },

        eventClick: calendarEventClick,
        windowResize: function(arg) {
            if (checkWidowWidth()) {
                calendar.changeView('listWeek');
                calendar.setOption('height', 900);
            } else {
                calendar.changeView('dayGridMonth');
                calendar.setOption('height', 1052);
            }
        }

    });

    // Add Event
    // getModalAddBtnEl.addEventListener('click', function() {
    //     getModalFormEl.preventDefault()
    //     var getModalCheckedRadioBtnEl = document.querySelector('input[name="event-level"]:checked');
    //     var getTitleValue = getModalTitleEl.value;
    //     var setModalStartDateValue = getModalStartDateEl.value;
    //     var setModalEndDateValue = getModalEndDateEl.value;
    //     var getModalCheckedRadioBtnValue = (getModalCheckedRadioBtnEl !== null) ? getModalCheckedRadioBtnEl.value : '';
    //     calendar.addEvent({
    //         id: uuidv4(),
    //         title: getTitleValue,
    //         start: setModalStartDateValue,
    //         end: setModalEndDateValue,
    //         allDay: true,
    //         extendedProps: { calendar: getModalCheckedRadioBtnValue }
    //     })
    //     myModal.hide()
    // })
    // Update Event
    // getModalUpdateBtnEl.addEventListener('click', function() {
    //     var getPublicID = this.dataset.fcEventPublicId;
    //     var getTitleUpdatedValue = getModalTitleEl.value;
    //     var getEvent = calendar.getEventById(getPublicID);
    //     var getModalUpdatedCheckedRadioBtnEl = document.querySelector('input[name="event-level"]:checked');
    //     var getModalUpdatedCheckedRadioBtnValue = (getModalUpdatedCheckedRadioBtnEl !== null) ? getModalUpdatedCheckedRadioBtnEl.value : '';
    //     getEvent.setProp('title', getTitleUpdatedValue);
    //     getEvent.setExtendedProp('calendar', getModalUpdatedCheckedRadioBtnValue);
    //     myModal.hide()
    // })
    // Calendar Renderation

    calendar.render();

    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'))
    var modalToggle = document.querySelector('.fc-addEventButton-button ')

    document.getElementById('exampleModal').addEventListener('hidden.bs.modal', function (event) {
        getModalTitleEl.value = '';
        getModalStartDateEl.value = '';
        getModalEndDateEl.value = '';
        var getModalIfCheckedRadioBtnEl = document.querySelector('input[name="event-level"]:checked');
        if (getModalIfCheckedRadioBtnEl !== null) { getModalIfCheckedRadioBtnEl.checked = false; }
    })
});
