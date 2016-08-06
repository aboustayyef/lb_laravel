
<script type="text/javascript">
  
  var breaking_point = 500; // screen width at which mobile kicks in
  var url = window.location.href;
  
  if (screen.width <= breaking_point) {

    if (url.split('/mobile/').length == 1) { // if url does not contain /mobile/ , prepend it

      //remove protocole and host:
      var url_parts = url.split('/'); 
      url_parts.shift();url_parts.shift();url_parts.shift() 
      url_parts = url_parts.join('/'); 

      // redirect to prepended /mobile url
      window.location = '/mobile/' + url_parts;

    }    

  }else{

    if (url.split('/mobile/').length > 1) { // if url contains /mobile/ remove it
      window.location = url.split('/mobile/').join('/');
    }

  }

</script>