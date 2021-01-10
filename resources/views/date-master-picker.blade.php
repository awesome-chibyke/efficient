<link type="text/css" rel="stylesheet" href="{{asset('date-control/jquery.datetimepicker.min.css')}}" />
<script src="{{asset('date-control/jquery.datetimepicker.full.js')}}"></script>
<script type="text/javascript">

    $('#datetimepick').datetimepicker({
        format:'Y-m-d H:i:s',
        step:05,
        theme:'dark',
        timepicker:true
    });

    $('#datetimepick2').datetimepicker({
        format:'Y-m-d H:i:s',
        step:05,
        theme:'dark',
        timepicker:true
    });

    $('#datetimepicker10').datetimepicker({
        format:'Y-m-d',
        step:05,
        theme:'dark',
        timepicker:false
    });
    $('#datetimepicker11').datetimepicker({
        format:'Y-m-d',
        step:05,
        theme:'dark',
        timepicker:false
    });
    /*
        $('#datetimepicker3').datetimepicker({
            format:'Y-m-d G:i:s',
            step:05,
            theme:'dark'
        });
        $('#datetimepicker4').datetimepicker({
            format:'Y-m-d G:i:s',
            step:05,
            theme:'dark'
        });
        $('#datetimepicker5').datetimepicker({
            format:'Y-m-d G:i:s',
            step:05,
            theme:'dark'
        });*/


    //var $btn = $('#bt1');
    /*$('#open').click(function(){
        $('#datetimepicker2').datetimepicker('show');
    });

    $('#datetimepicker2').datetimepicker({
        format:'Y-m-d',
        step:05
        //widgetParent: $btn,
        //yearOffset:0,
        //lang:'ch',
        //timepicker:false,
        //format:'Y-m-d',
        //formatDate:'Y/m/d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+9070/01/02' // and tommorow is maximum date calendar
    });
    $('#datetimepicker6').datetimepicker({
        //widgetParent: $btn,
        //yearOffset:0,
        //lang:'ch',
        timepicker:false,
        format:'Y-m-d',
        //formatDate:'Y/m/d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+9070/01/02' // and tommorow is maximum date calendar
    });
    $('#datetimepicker5').datetimepicker({
        //widgetParent: $btn,
        //yearOffset:0,
        //lang:'ch',
        timepicker:false,
        format:'Y-m-d',
        //formatDate:'Y/m/d',
        //minDate:'-1970/01/01', // yesterday is minimum date
        //maxDate:'+9070/01/02' // and tommorow is maximum date calendar
    });

    $('#datetimepicker3').datetimepicker({
        datepicker:false,
        format:'H:i:s',
        step:5
    });
    $('#datetimepicker4').datetimepicker({
        //yearOffset:0,
        //lang:'ch',
        timepicker:false,
        format:'Y-m-d',
        //formatDate:'Y/m/d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+9070/01/02' // and tommorow is maximum date calendar
    });*/
    $('#datetimepicker_dark').datetimepicker({theme:'dark'});
    var date = new Date();
    $('#datetimepicker3').datetimepicker({
        inline:true,
        value: date.getFullYear()+'/'+parseFloat(date.getMonth()+1)+'/'+date.getDate()+' '+date.getHours()+':'+date.getMinutes(),
        format:'Y-m-d G:i:s',
        step:05,
        theme:'dark',
        timepicker:false
    });
</script>