$('document').ready(function(){

// Add to Reading List
$(document).on('click', 'li.addToSaved', function(){
  event.stopPropagation();
  var $this = $(this); // to persist variable through closure;
  $.ajax({
    url: lbApp.rootPath + '/posts/saved/add/' + $(this).data('postid'),
    type: "Get",
    success: function(){

      // replace share menu from "add to saved" to remove From saved
      $("li[data-postid='" + $this.data('postid') + "']").removeClass('addToSaved').addClass('removeFromSaved').html('<i class="fa fa-clock-o"></i>Remove from reading list');

      // add +1 to the favorites counter on the sidebar
      $counterBubble = $('li > .amount.saved');
      $initialValue = parseInt($counterBubble.text());
      $newValue = $initialValue + 1;
      $counterBubble.text($newValue);

      // declare victory
      console.log('Successfully added ' + $this.data('postid') + ' to reading list');
    }
  });
});
// Remove From Favorites
$(document).on('click', 'li.removeFromSaved', function(){
  event.stopPropagation();
  var $this = $(this); // to persist variable through closure;
  $.ajax({
    url: lbApp.rootPath + '/posts/saved/remove/' + $(this).data('postid'),
    type: "Get",
    success: function(){

      // replace from "remove From saved" to "add to saved"
      $("li[data-postid='" + $this.data('postid') + "']").removeClass('removeFromSaved').addClass('addToSaved').html('<i class="fa fa-clock-o"></i>Read it later');

      // add +1 to the favorites counter on the sidebar
      $counterBubble = $('li > .amount.saved');
      $initialValue = parseInt($counterBubble.text());
      $newValue = $initialValue - 1;
      $counterBubble.text($newValue);

      // declare victory
      console.log('Successfully removed ' + $this.data('postid') + ' from reading list');
    }
  });
});


});
