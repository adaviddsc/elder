function EncryptData(data,key,iv){
	var key_enc = CryptoJS.enc.Latin1.parse(key);
	var iv_enc  = CryptoJS.enc.Latin1.parse(iv);
	var encrypted = CryptoJS.AES.encrypt(data, key_enc, { iv: iv_enc,mode:CryptoJS.mode.CBC,padding:CryptoJS.pad.ZeroPadding});
	return encrypted;
}
function DecryptData(data,key,iv){
	var key_dec = CryptoJS.enc.Latin1.parse(key);
	var iv_dec  = CryptoJS.enc.Latin1.parse(iv);
	var decrypt_data = CryptoJS.AES.decrypt(data, key_dec, { iv: iv_dec,mode:CryptoJS.mode.CBC,padding:CryptoJS.pad.ZeroPadding});
	//return decrypt_data.toString(CryptoJS.enc.Utf8);
	//alert(CryptoJS.enc.Utf8.stringify(decrypt_data));
	return decrypt_data;
}
$(function() {
	$(".temp1").attr("href",xss);
	$(".temp").append(xss);
	$(".session").append(session);

	$(".login-button").on("click", function(event) {
		var username = $(this).siblings('input[name=username]').val();
		var password = $(this).siblings('input[name=password]').val();
		var key = calcMD5(password).substring(0,16);

		var maxNum = 9999999;
		var minNum = 1;
		var IV_A = Math.floor(Math.random() * (maxNum - minNum + 1)) + minNum;
		IV_A = calcMD5(IV_A.toString()).substring(0,16);

		$.ajax({
		    url: "../account/login-step1.php",
		    data: "username="+username+"&IV_A="+IV_A+"",
		    type: "post",
		    dataType: "json",
		    success: function(response) {
		    	var data = response[0].EncryptData;
		    	if (data!="none"){
		    		//$(".login-message").text(data);
		    		var tempString = DecryptData(data,key,IV_A).toString();
		    		if( tempString.length==48 ){
		    			var IV_B = DecryptData(data,key,IV_A).toString(CryptoJS.enc.Utf8).substring(0,16);
		    			var enc_data = EncryptData(username,key,IV_B).toString();
		    			enc_data = enc_data.replace(/\+/g, ",");
		    			$.ajax({
						    url: "../account/login-step2.php",
						    data: "username="+username+"&enc_data="+enc_data+"",
						    type: "post",
						    dataType: "json",
						    success: function(response) {
						    	//$(".login-message").text(response[0].status);
						    	if (response[0].status=="success"){
						    		$(".login-message").text("登入成功");
						    	}
						    	else{
						    		$(".login-message").text("此區域為危險用戶!!!");
						    	}
						    },
						    error: function( req, status, err ) {
						    	console.log( 'something went wrong:', status, err );
				      			alert('something went wrong:'+ status + err);
						    }
						});
		    		}
		    		else{
		    			$.ajax({
						    url: "../account/remove-IV_B.php",
						    data: "username="+username+"",
						    type: "post",
						    dataType: "json",
						    success: function(response) {
						    	if(response[0].remove){
						    		$(".login-message").text("帳號或密碼錯誤");
						    	}
						    },
						    error: function( req, status, err ) {
						    	console.log( 'something went wrong:', status, err );
				      			alert('something went wrong:'+ status + err);
						    }
						});
		    		}
		    	}
		    	else{
		    		$(".login-message").text("帳號不存在");
		    	}
		    },
		    error: function( req, status, err ) {
		    	console.log( 'something went wrong:', status, err );
      			alert('something went wrong:'+ status + err);
		    }
		});
	});
	$(".regist-button").on("click", function(event) {
		var username = $(this).siblings('input[name=username]').val();
		var password = $(this).siblings('input[name=password]').val();
		var password_again = $(this).siblings('input[name=password-again]').val();
		$.ajax({
		    url: "../account/regist.php",
		    data: "username="+username+"&password="+password+"&password_again="+password_again+"",
		    type: "post",
		    dataType: "json",
		    success: function(response) {
		    	//alert(response[0].status);
		    	//$(".login-message").text(response[0].status);
		    	if (response[0].status=="success"){
		    		$(".regist-message").text("註冊成功");
		    	}
		    	else if (response[0].status=="again"){
		    		$(".regist-message").text("資料有誤或不完整，請重新填寫");
		    	}
		    	else if (response[0].status=="used"){
		    		$(".regist-message").text("此帳號已有人使用");
		    	}
		    	else{
		    		$(".regist-message").text("資料包含非法字元，請重新填寫");
		    	}
		    },
		    error: function( req, status, err ) {
		    	console.log( 'something went wrong:', status, err );
      			alert('something went wrong:'+ status + err);
		    }
		});
	});
});

