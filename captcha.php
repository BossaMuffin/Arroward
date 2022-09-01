<?php session_start();

$captcha = rand(10000, 999999);
		$captcha_img = imagecreatetruecolor(90, 40);
		$fill_color = imagecolorallocate($captcha_img, 230, 230, 230);
		imagefilledrectangle($captcha_img, 0, 0, 90, 40, $fill_color);
		
		$text_color = imagecolorallocate($captcha_img, 10, 10, 10, 10);
		$captcha_font = "FONT/new_cicle/NewCicleGordita.ttf";
		imagettftext($captcha_img, 20, 5, 5, 30, $text_color, $captcha_font, $captcha);
		
		header("content-type:image/jpeg");
		imagejpeg($captcha_img);
		//imagedestroy($captcha_$img);
		
		




		 

