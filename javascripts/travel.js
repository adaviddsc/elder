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

function closeMarker(marker,action){
  var i=0;
  while( marker[i]!=undefined ){
    marker[i].setAnimation(null);
    i++;
  }
}

$(function() {
  //每個人不一樣的標頭
  $.get("header.php", function(data) {
    $("body").prepend(data);
    $('.travel-selectBar li').eq(2).addClass('active');
    $('.travel-selectBar li').eq(2).children('a').append('<span></span>');
  });
  //每個人不一樣的標頭

  var screenHeight = document.body.scrollHeight - 50;
  $('.travel-leftMap').height(screenHeight);
  $('.travel-rightContain').height(screenHeight);
  $('.travel-body').height(screenHeight-60);
  $('.travel-header').height(57);

  var i=0;
  while(travel_title[i]!=null){
    if (i%2==0){
      $('.travel-bodyLeft').append('<div class="travel-box" articleNumber="'+i+'"><div class="travel-boxImg"><img src="../readfile/readfile.php?id='+travel_photo[travel_articleID[i]][0]+'" data-toggle="modal" data-target="#myModal-travelInfo"></div><div class="travel-boxBottom"><h1 class="travel-title">'+travel_title[i]+'</h1><div class="travel-selfInfo"><img src="../images/self.jpg"><h1 class="travel-selfName">張允</h1><i class="fa fa-map-marker findPosition"></i><i class="fa fa-heart" id="travel-like"><h1 class="like-count">3895</h1></i></div></div></div>');
    }
    if (i%2==1){
      $('.travel-bodyRight').append('<div class="travel-box" articleNumber="'+i+'"><div class="travel-boxImg"><img src="../readfile/readfile.php?id='+travel_photo[travel_articleID[i]][0]+'" data-toggle="modal" data-target="#myModal-travelInfo"></div><div class="travel-boxBottom"><h1 class="travel-title">'+travel_title[i]+'</h1><div class="travel-selfInfo"><img src="../images/self.jpg"><h1 class="travel-selfName">張允</h1><i class="fa fa-map-marker findPosition"></i><i class="fa fa-heart" id="travel-like"><h1 class="like-count">3895</h1></i></div></div></div>');
    }
    i++;
  }
  /*$('.travel-bodyLeft').append('<div class="travel-box" articleNumber="0" country="日本" address="富士山"><div class="travel-boxImg"><img src="../images/日本.jpg" data-toggle="modal" data-target="#myModal-travelInfo"></div><div class="travel-boxBottom"><h1 class="travel-title">富士山三日遊</h1><div class="travel-selfInfo"><img src="../images/self.jpg"><h1 class="travel-selfName">張允</h1><i class="fa fa-map-marker findPosition"></i><i class="fa fa-heart" id="travel-like"><h1 class="like-count">3895</h1></i></div></div></div>');
  $('.travel-bodyLeft').append('<div class="travel-box" articleNumber="1" country="台灣" address="阿里山"><div class="travel-boxImg"><img src="../images/a.jpg" data-toggle="modal" data-target="#myModal-travelInfo"></div><div class="travel-boxBottom"><h1 class="travel-title">阿里山日出美景</h1><div class="travel-selfInfo"><img src="../images/self.jpg"><h1 class="travel-selfName">張允</h1><i class="fa fa-map-marker findPosition"></i><i class="fa fa-heart" id="travel-like"><h1 class="like-count">205</h1></i></div></div></div>');
  $('.travel-bodyLeft').append('<div class="travel-box" articleNumber="2" country="法國" address="巴黎鐵塔"><div class="travel-boxImg"><img src="../images/b.jpg" data-toggle="modal" data-target="#myModal-travelInfo"></div><div class="travel-boxBottom"><h1 class="travel-title">法國巴黎鐵塔</h1><div class="travel-selfInfo"><img src="../images/self.jpg"><h1 class="travel-selfName">張允</h1><i class="fa fa-map-marker findPosition"></i><i class="fa fa-heart" id="travel-like"><h1 class="like-count">1580</h1></i></div></div></div>');
  $('.travel-bodyRight').append('<div class="travel-box" articleNumber="3" country="夏威夷" address="檀香山"><div class="travel-boxImg"><img src="../images/c.jpg" data-toggle="modal" data-target="#myModal-travelInfo"></div><div class="travel-boxBottom"><h1 class="travel-title">夏日夏威夷風情</h1><div class="travel-selfInfo"><img src="../images/self.jpg"><h1 class="travel-selfName">張允</h1><i class="fa fa-map-marker findPosition"></i><i class="fa fa-heart" id="travel-like"><h1 class="like-count">3895</h1></i></div></div></div>');
  $('.travel-bodyRight').append('<div class="travel-box" articleNumber="4" country="美國" address="大峽谷"><div class="travel-boxImg"><img src="../images/d.jpg" data-toggle="modal" data-target="#myModal-travelInfo"></div><div class="travel-boxBottom"><h1 class="travel-title">美國大峽谷，挑戰你的膽量</h1><div class="travel-selfInfo"><img src="../images/self.jpg"><h1 class="travel-selfName">張允</h1><i class="fa fa-map-marker findPosition"></i><i class="fa fa-heart" id="travel-like"><h1 class="like-count">1580</h1></i></div></div></div>');
  $('.travel-bodyRight').append('<div class="travel-box" articleNumber="5" country="台灣" address="墾丁沙灘"><div class="travel-boxImg"><img src="../images/e.jpg" data-toggle="modal" data-target="#myModal-travelInfo"></div><div class="travel-boxBottom"><h1 class="travel-title">夢想的海灘</h1><div class="travel-selfInfo"><img src="../images/self.jpg"><h1 class="travel-selfName">張允</h1><i class="fa fa-map-marker findPosition"></i><i class="fa fa-heart" id="travel-like"><h1 class="like-count">1580</h1></i></div></div></div>');
  */

  $('#item-info-twzipcode').twzipcode({
    countyName: 'addr_county',
    districtName: 'addr_area'
  });
  $('#item-info-twzipcode').children().children('select').addClass("form-control");
  
  var latlng = new google.maps.LatLng(23.69781, 120.96051499999999); /*台灣座標*/
  var map;
  var marker = new Array();
  var address = new Array();
  var geocoder = new google.maps.Geocoder();
  var mapOptions = {
    zoom: 8,
    center: latlng
  };
  map = new google.maps.Map(document.getElementById('google-map'), mapOptions);
  var article_count = $('.travel-box').length;
  var i=0;
  while( i!=article_count ){
    (function(address,c) {
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          marker[c] = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location,
            animation: google.maps.Animation.DROP,
          });
          google.maps.event.addListener(marker[c], 'click', function() {
            closeMarker(marker,'animation');
            marker[c].setAnimation(google.maps.Animation.BOUNCE);
            map.setCenter(marker[c].getPosition());
          });
        }
      });
    })(travel_address[$(".travel-box").eq(i).attr('articleNumber')],i);
    i++;
  }

  
  $(".findPosition").on("click", function(event) {
    var articleNumber = $(this).parents('.travel-box').attr('articleNumber');
    google.maps.event.trigger(marker[articleNumber], 'click', {});
  });
  $("#add-travelPhoto , #add-travelPhoto-pre").on("click", function(event) {
    $(".item-info-images-input").click();
  });
  $(".item-info-images-input").change(function() {
    readURL(this, "#add-travelPhoto-pre");
    $("#add-travelPhoto").hide();
  });
  $(".travel-boxImg").on("click", function(event) {
    var articleNumber = $(this).parents('.travel-box').attr('articleNumber');
    $("#myModal-travelInfo").attr('articleNumber',articleNumber);
  });
  
  $('#myModal-travelInfo').on('show.bs.modal', function (e) {
    $('#addTravel-photoGallery').carousel();
    var articleNumber = $(this).attr('articleNumber');
    $('.dialog-travelInfo-title').html(travel_title[articleNumber]);
    $('.dialog-travelInfo-address h1').html(travel_address[articleNumber]);
    $('.travelInfo-date').html(travel_date[articleNumber]);
    travel_detail[articleNumber] = travel_detail[articleNumber].replace(/&lt;br&gt;/g,"<br>");
    travel_detail[articleNumber] = travel_detail[articleNumber].replace(/&amp;nbsp/g,"&nbsp");
    $('.dialog-travelInfo-text').html(travel_detail[articleNumber]);

    $('#addTravel-li li').remove();
    $('#addTravel-img div').remove();
    var i=0;
    while(travel_photo[travel_articleID[articleNumber]][i]!=null){
      if (i==0){
        $('#addTravel-li').append('<li data-target="#addTravel-photoGallery" data-slide-to="'+articleNumber+'" class="active"></li>');
        $('#addTravel-img').append('<div class="item active"><img src="../readfile/readfile.php?id='+travel_photo[travel_articleID[articleNumber]][i]+'"></div>');
      }
      else{
        $('#addTravel-li').append('<li data-target="#addTravel-photoGallery" data-slide-to="'+articleNumber+'"></li>');
        $('#addTravel-img').append('<div class="item"><img src="../readfile/readfile.php?id='+travel_photo[travel_articleID[articleNumber]][i]+'"></div>');
      }
      i++;
    }
  });

  /*$(".travel-body").mCustomScrollbar({
    theme:"rounded-dark",
    scrollButtons:{
      enable:true
    }
  });
  $(".dialog-travelInfo-text").mCustomScrollbar({
    theme:"rounded-dark",
    scrollButtons:{
      enable:true
    }
  });*/

  if (addTravel_alert!=undefined){
    swal(addTravel_alert);
  }
});
