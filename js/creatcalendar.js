$(function() {
    $('#month').fullCalendar({
        header: {
            left: 'prev,next',
            center: '',
            right: 'title',
        },
        defaultView:'month',
        editable: false,
        dragOpacity: {
            agenda: .5,
            '':.6,
        },

        selectable: true,
        unselectAuto: false,

        dayClick: function(date, allDay, jsEvent, view) {
            $('#calendar').fullCalendar('gotoDate', date);
            $('#calendar2').fullCalendar('gotoDate', date);
            $('#calendar3').fullCalendar('gotoDate', date);
            $('#calendar4').fullCalendar('gotoDate', date);
            $('#calendar5').fullCalendar('gotoDate', date);
            $('#calendar6').fullCalendar('gotoDate', date);
            $('#calendar7').fullCalendar('gotoDate', date);
            if ($("#weekpage").hasClass("active")) {
                $(".fc-cell-overlay").css({"background-color":"gold", "left":"0", "width":"100%"});
            }
        },
    });
});

function CreatCalendar(room='', left="", center="", right="", view="agendaDay", height=1200){
    $('#calendar' + room).fullCalendar({
        header: {
            left: left,
            center: center,
            right: right,
        },
        minTime: 8,
        maxTime: 23,
        height: height,
        defaultView: view,
        editable: true,
        allDaySlot: false,
        dragOpacity: {
            agenda: .5,
            '':.6,
        },
        eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
            $.post("do.php?action=drag&calendar=calendar" + room,{id:event.id,daydiff:dayDelta,minudiff:minuteDelta,allday:allDay},function(msg){
                if(msg!=1){
                    alert(msg);
                    revertFunc();
                }
            });
        },
        
         eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
            $.post("do.php?action=resize&calendar=calendar" + room,{id:event.id,daydiff:dayDelta,minudiff:minuteDelta},function(msg){
                if(msg!=1){
                    alert(msg);
                    revertFunc();
                }
            });
        },
        
        
        selectable: true,
        select: function( startDate, endDate, allDay, jsEvent, view ){
            var start =$.fullCalendar.formatDate(startDate,'yyyy-MM-dd');
            var end =$.fullCalendar.formatDate(endDate,'yyyy-MM-dd');
            var starthour = $.fullCalendar.formatDate(startDate, 'HH');
            var endhour = $.fullCalendar.formatDate(endDate, 'HH');
            var startmin = $.fullCalendar.formatDate(startDate, 'mm');
            var endmin = $.fullCalendar.formatDate(endDate, 'mm');
            $.fancybox({
                'type':'ajax',
                'href':'event.php?action=add&calendar=calendar' + room + '&date=' + start + '&end=' + end + '&starthour=' + starthour + '&endhour=' + endhour + '&startmin=' + startmin + '&endmin=' + endmin
            });
        },
        
        
        
        
        events: 'json.php?calendar=calendar' + room,
        /*dayClick: function(date, allDay, jsEvent, view) {
            var selDate =$.fullCalendar.formatDate(date,'yyyy-MM-dd');
            $.fancybox({
                'type':'ajax',
                'href':'event.php?action=add&calendar=calendar' + room + '&date='+selDate
            });
        },*/
        eventClick: function(calEvent, jsEvent, view) {
            $.fancybox({
                'type':'ajax',
                'href':'event.php?action=edit&calendar=calendar' + room + '&id='+calEvent.id
            });
        }
    });
};
