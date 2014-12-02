<?php
function img_filter($img_name,$img_tm_name,$location,$alert,$message){
  	$i=0;
	while(!empty($img_name[$i])){
		$imageinfo = getimagesize($img_tm_name[$i]);
		if( $imageinfo['mime']!='image/gif' && $imageinfo['mime']!='image/jpeg' && $imageinfo['mime']!='image/png' && isset($imageinfo) ){
			$_SESSION[$alert] = $message;
		    header('Location:'.$location);
		    exit(0);
		}

		$filename = strtolower($img_name[$i]);
		$whitelist = array('jpg', 'png', 'gif', 'jpeg');
		$backlist = array('php', 'php3', 'php4', 'phtml', 'exe', 'htaccess');
		$tmp = explode('.', $filename);
		$file_extension = end($tmp);

		if(!in_array($file_extension, $whitelist) || isset($file_extension[4]) )
		{
			$_SESSION[$alert] = $message;
		    header('Location:'.$location);
		    exit(0);
		}
		if(in_array($file_extension, $backlist))
		{
			$_SESSION[$alert] = $message;
		    header('Location:'.$location);
		    exit(0);
		}
		$uniq_filename = sha1(uniqid(rand()));
		$fileToUpload_name[$i] = $uniq_filename.'.'.$file_extension;
		$i++;
	}
  	return $fileToUpload_name;
}
?>