<?php
function button_create($user_id){
	$user = "custom=" . $user_id;
	$sendPayData = array(
		"METHOD" => "BMCreateButton",
		"VERSION" => "65.2",
		"USER" => "theforge.friends4ever_api1.gmail.com",
		"PWD" => "FMJ3DTHWY6RNNDMR",
		"SIGNATURE" => "AFcWxV21C7fd0v3bYYYRCpSSRl31ANYjVdBO0-MTm3dVs79MoiUxtkRO",
		"BUTTONCODE" => "ENCRYPTED",
		"BUTTONTYPE" => "BUYNOW",
		"BUTTONSUBTYPE" => "SERVICES",
		"BUTTONCOUNTRY" => "CA",
		"BUTTONIMAGE" => "reg", // put ginny image here
		"BUTTONIMAGEURL" => "http://theforge.me/friends4ever/images/plus-01.png",  // put ginny image here
		"L_BUTTONVAR1" => "item_number=1",
		"L_BUTTONVAR2" => "item_name=30 Day Subcsription",
		"L_BUTTONVAR3" => "amount=0.30", // todo change for live
		"L_BUTTONVAR4" => "currency_code=USD",
		"L_BUTTONVAR5" => "no_shipping=1",
		"L_BUTTONVAR6" => "no_note=1",
		"L_BUTTONVAR7" => "notify_url=http://theforge.me/friends4ever/includes/pay/listener.php",
		"L_BUTTONVAR8" => "cancel_return=http://theforge.me/friends4ever/",
		"L_BUTTONVAR9" => "return=http://theforge.me/friends4ever/html/instadd.html",
		"L_BUTTONVAR10" => $user
	);

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_URL, 'https://api-3t.paypal.com/nvp?'.http_build_query($sendPayData));
	$nvpPayReturn = curl_exec($curl);
	curl_close($curl);

	$edit = urldecode($nvpPayReturn);
	$front_removed = ltrim($edit, 'WEBSITECODE=');
	$end_removed = substr($front_removed, 0, strpos($front_removed, "&EMAILLINK"));
	return $end_removed;
}