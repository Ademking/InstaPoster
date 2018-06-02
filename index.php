<?php
set_time_limit(0);
date_default_timezone_set('UTC');
require __DIR__.'/vendor/autoload.php';


//////////////////////
//////////////////////
/////// CONFIG ///////

require 'config.php';

$debug = true;
$truncatedDebug = true;

//////////////////////
//////////////////////
//////////////////////






function download_img_from_url($imgurl , $photopath) {
	
		$fileName = "$photopath";
		$fileUrl  = "$img_url";
		$ch = curl_init($fileUrl); // set the url to open and download
		$fp = fopen($fileName, 'wb'); // open the local file pointer to save downloaded image
		curl_setopt($ch, CURLOPT_FILE, $fp); // tell curl to save to the file pointer
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // tell curl to follow redirects
		curl_exec($ch); // fetch the image and save it with curl
		curl_close($ch); // close curl
		fclose($fp); // close the local file pointer
	
}

download_img_from_url($img_url, $photoFilename);


$ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
try {
    $ig->login($username, $password);
} catch (\Exception $e) {
    echo 'Something went wrong: '.$e->getMessage()."\n";
    exit(0);
}
try {
   
   


$metadata = ['caption' => "$image_description"];
$ig->timeline->uploadPhoto($photoFilename, $metadata);
 echo "Upload Done!"  ;
   
   
   
   
   
} catch (\Exception $e) {
    echo 'Something went wrong: '.$e->getMessage()."\n";
}
?>