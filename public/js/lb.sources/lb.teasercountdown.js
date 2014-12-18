$(document).ready(function(){
  $('#list_countdown')
  .countdown("2014/12/22 08:00:00", function(event){
    // $(this).text(
    //   event.strftime('%d  |  %H  |  %M  |  %S')
    // );
    $(this).find('.block').find('.days').text(event.strftime('%d'));
    $(this).find('.block').find('.hours').text(event.strftime('%H'));
    $(this).find('.block').find('.mins').text(event.strftime('%M'));
    $(this).find('.block').find('.secs').text(event.strftime('%S'));
  });
});
