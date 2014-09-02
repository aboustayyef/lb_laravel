$('document').ready(function(){

// Add to favorites
$(document).on('click', 'li.addToFavorites', function(){
  event.stopPropagation();
  var $this = $(this); // to persist variable through closure;
  $.ajax({
    url: lbApp.rootPath + '/posts/favorites/add/' + $(this).data('blogid'),
    type: "Get",
    success: function(){

      // replace all instances of share menu from "add to favorites" to remove From Favorites
      $("li[data-blogid='" + $this.data('blogid') + "']").each(function(){
        $(this).removeClass('addToFavorites').addClass('removeFromFavorites').html('<i class="fa fa-star"></i>Remove it from your favorites');
      });

      // add +1 to the favorites counter on the sidebar
      $counterBubble = $('li > .amount.favorites');
      $initialValue = parseInt($counterBubble.text());
      $newValue = $initialValue + 1;
      $counterBubble.text($newValue);

      // declare victory
      console.log('Successfully added ' + $this.data('blogid') + ' to favorites');
    }
  });
});
// Remove From Favorites
$(document).on('click', 'li.removeFromFavorites', function(){
  event.stopPropagation();
  var $this = $(this); // to persist variable through closure;
  $.ajax({
    url: lbApp.rootPath + '/posts/favorites/remove/' + $(this).data('blogid'),
    type: "Get",
    success: function(){

      // replace all instances of share menu from "remove From Favorites" to "add to favorites"
      $("li[data-blogid='" + $this.data('blogid') + "']").each(function(){
        $(this).removeClass('removeFromFavorites').addClass('addToFavorites').html('<i class="fa fa-star"></i>Add it to your favorites');
      });

      // add +1 to the favorites counter on the sidebar
      $counterBubble = $('li > .amount.favorites');
      $initialValue = parseInt($counterBubble.text());
      $newValue = $initialValue - 1;
      $counterBubble.text($newValue);

      // declare victory
      console.log('Successfully added ' + $this.data('blogid') + ' to favorites');
    }
  });
});


});
