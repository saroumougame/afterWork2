
//var Routing = require('asset/ Routing.js');

"use strict";
    $('#calendar').fullCalendar({
        header: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        // defaultDate: '2018-01-12',
        editable: false, // true
        droppable: false, // this allows things to be dropped onto the calendar  event_calendar_loader
        closeText: "Fermer",
        prevText: "Précédent",
        nextText: "Suivant",
        currentText: "Aujourd'hui",
        monthNames: [ "janvier", "février", "mars", "avril", "mai", "juin",
            "juillet", "août", "septembre", "octobre", "novembre", "décembre" ],
        monthNamesShort: [ "janv.", "févr.", "mars", "avr.", "mai", "juin",
            "juil.", "août", "sept.", "oct.", "nov.", "déc." ],
        dayNames: [ "dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi" ],
        dayNamesShort: [ "dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam." ],
        dayNamesMin: [ "D","L","M","M","J","V","S" ],
        weekHeader: "Sem.",
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        isRTL: false,
        displayEventTime : false,
        showMonthAfterYear: false,
        yearSuffix: "",
        buttonText: {
            year: "Année",
            month: "Mois",
            week: "Semaine",
            day: "Jour",
            list: "Mon planning"
        },
        drop: function() {
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }
        },
        eventLimit: true, // allow "more" link when too many events
        // events: [{"title":"toto","start":"2018-05-27T13:26:52+00:00","url":"http:\/\/www.google.com","backgroundColor":"#FF0000","borderColor":"#FF0000","textColor":"#FFFFFF","className":"my-custom-class","end":"2018-06-28T00:00:00+00:00","allDay":true}]
        eventSources: [
            {
                url: urlCalendar,
              //  url : Routing.generate('event_calendar_loader'),
                type: 'POST',
                // A way to add custom filters to your event listeners
                data: {
                },
                success: function(){
                   // alert('good');
                },
                error: function() {
                   // alert('ereurrrrr !');
                }
            }
        ]


    });

    // Hide default header
    //$('.fc-header').hide();



    // Previous month action
    $('#cal-prev').on('click',function(){
        $('#calendar').fullCalendar( 'prev' );
    });

    // Next month action
    $('#cal-next').on('click',function(){
        $('#calendar').fullCalendar( 'next' );
    });

    // Change to month view
    $('#change-view-month').on('click',function(){
        $('#calendar').fullCalendar('changeView', 'month');

        // safari fix
        $('#content .main').fadeOut(0, function() {
            setTimeout( function() {
                $('#content .main').css({'display':'table'});
            }, 0);
        });

    });

    // Change to week view
    $('#change-view-week').on('click',function(){
        $('#calendar').fullCalendar( 'changeView', 'agendaWeek');

        // safari fix
        $('#content .main').fadeOut(0, function() {
            setTimeout( function() {
                $('#content .main').css({'display':'table'});
            }, 0);
        });

    });

    // Change to day view
    $('#change-view-day').on('click',function(){
        $('#calendar').fullCalendar( 'changeView','agendaDay');

        // safari fix
        $('#content .main').fadeOut(0, function() {
            setTimeout( function() {
                $('#content .main').css({'display':'table'});
            }, 0);
        });

    });

    // Change to today view
    $('#change-view-today').on('click',function(){
        $('#calendar').fullCalendar('today');
    });

    /* initialize the external events
     -----------------------------------------------------------------*/
    $('#external-events .event-control').each(function() {

        // store data so the calendar knows to render an event upon drop
        $(this).data('event', {
            title: $.trim($(this).text()), // use the element's text as the event title
            stick: true // maintain when user navigates (see docs on the renderEvent method)
        });

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });

    });

    $('#external-events .event-control .event-remove').on('click', function(){
        $(this).parent().remove();
    });

    // Submitting new event form
    // $('#add-event').submit(function(e){
    //     e.preventDefault();
    //     var form = $(this);
    //
    //     var newEvent = $('<div class="event-control p-10 mb-10">'+$('#event-title').val() +'<a class="pull-right text-muted event-remove"><i class="fa fa-trash-o"></i></a></div>');
    //
    //     $('#external-events .event-control:last').after(newEvent);
    //
    //     $('#external-events .event-control').each(function() {
    //
    //         // store data so the calendar knows to render an event upon drop
    //         $(this).data('event', {
    //             title: $.trim($(this).text()), // use the element's text as the event title
    //             stick: true // maintain when user navigates (see docs on the renderEvent method)
    //         });
    //
    //         // make the event draggable using jQuery UI
    //         $(this).draggable({
    //             zIndex: 999,
    //             revert: true,      // will cause the event to go back to its
    //             revertDuration: 0  //  original position after the drag
    //         });
    //
    //     });
    //
    //     $('#external-events .event-control .event-remove').on('click', function(){
    //         $(this).parent().remove();
    //     });
    //
    //     form[0].reset();
    //
    //     $('#cal-new-event').modal('hide');
    //
    // });