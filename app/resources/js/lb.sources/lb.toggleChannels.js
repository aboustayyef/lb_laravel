$(function(){
  $('#channelSelector').change(function(){
    lbApp.showLoadingCurtain();
    window.location = $('#channelSelector option:selected').data('target');
  });
});
