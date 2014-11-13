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
						    	$(".login-message").text(response[0].status);
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
		    			$(".login-message").text("帳號或密碼錯誤");
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

});

