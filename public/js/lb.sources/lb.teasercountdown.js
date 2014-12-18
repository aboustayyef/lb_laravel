$(document).ready(function(){
  var hour = 8;
  tz = new Date();
  hour += tz.getTimezoneOffset();
  var datestring = "2014/12/22 ";
  if (hour < 0) {
    datestring = "2014/12/21 ";
    hour +=24;
  };
  var dateTimeString = datestring + hour + ":00:00";
  $('#list_countdown')
  .countdown(dateTimeString, function(event){
    // $(this).text(
    //   event.strftime('%d  |  %H  |  %M  |  %S')
    // );
    $(this).find('.block').find('.days').text(event.strftime('%d'));
    $(this).find('.block').find('.hours').text(event.strftime('%H'));
    $(this).find('.block').find('.mins').text(event.strftime('%M'));
    $(this).find('.block').find('.secs').text(event.strftime('%S'));
  });
});
