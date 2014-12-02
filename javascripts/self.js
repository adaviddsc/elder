$(function() {
	//每個人不一樣的標頭
	$.get("header.php", function(data) {
	    $("body").prepend(data);
	    $('.travel-selectBar li').eq(1).addClass('active');
	    $('.travel-selectBar li').eq(1).children('a').append('<span></span>');
	});
	//每個人不一樣的標頭

});