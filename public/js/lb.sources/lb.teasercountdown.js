$(document).ready(function(){
  $('#list_countdown')
  .countdown("2014/12/22 08:00:00", function(event){
    $(this).text(
      event.strftime('%d  |  %H  |  %M  |  %S')
    );
  });
});
