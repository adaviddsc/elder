$(function() {
  $( ".middle-nav" ).find('li').hover(
    function() {
      $( this ).addClass('tada animated');
    }, function() {
      $( this ).removeClass('tada animated');
    }
  );
});

