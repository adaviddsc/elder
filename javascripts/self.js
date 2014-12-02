var readURL;
readURL = function(input, img) {
  var reader;

  if (input.files && input.files[0]) {
    reader = new FileReader();
    reader.onload = function(e) {
      $(img).attr("src", e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
};
$(function() {
	//每個人不一樣的標頭
	$.get("header.php", function(data) {
	    $("body").prepend(data);
	    $('.travel-selectBar li').eq(1).addClass('active');
	    $('.travel-selectBar li').eq(1).children('a').append('<span></span>');
	});
	//每個人不一樣的標頭
	$("#add-selfPhoto,#add-selfPhoto-img").on("click", function(event) {
		$(".add-selfPhoto-input").click();
	});
	$(".add-selfPhoto-input").change(function() {
		readURL(this, "#add-selfPhoto-img");
		$("#add-selfPhoto").hide();
	});
	if (addSelf_alert!=undefined){
	    swal(addSelf_alert);
	}
});