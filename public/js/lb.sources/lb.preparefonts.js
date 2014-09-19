$(document).ready(function() {

  WebFontConfig = {
    google: { families: [ 'Montserrat', 'Droid Arabic Naskh' ] },

    // when the fonts download, beging masonry layout..
    fontactive: function(fontFamily, fontDescription) {
      console.log('WebFonts have loaded');
      lbApp.veryFirstLoad();
    }
  };

  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })();

});
