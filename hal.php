<?php

if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") {
    header("Location: https://02b7cf4.netsolhost.com/voicedestination/" . $_SERVER["REQUEST_URI"], true, 301);
    exit;
}
	$ga_asset_file_root = basename(__FILE__, '.php');
	$ga_csv = $ga_asset_file_root . ".csv";

	if ($_SERVER['QUERY_STRING'] && stristr($_SERVER['QUERY_STRING'], '%7C')) {

		if (!file_exists($ga_csv)) {
		    $fp = fopen($ga_csv, 'wb');
		    fputcsv($fp , array ('Timestamp', 'User', 'Turn', 'Current', 'Previous', 'Request', 'Type'));
		    fclose($fp);
		}

		$pieces = explode("%7C", str_replace("t=", "", $_SERVER['QUERY_STRING']));
		array_unshift($pieces, time());

	    $fp = fopen($ga_csv, 'a');
	    fputcsv($fp, $pieces);
	    fclose($fp);
	}

	#$ga_option_0_title = "Live on over 1 billion devices tomorrow.";
	$ga_option_0_title = "Ask for a New Voice Destination";
	$ga_option_0_subtitle = "Menu";
	$ga_option_0_image = "https://02b7cf4.netsolhost.com/voicedestination/uploads/1920x1080-default.jpg";
	$ga_option_0_description = "Ask For a New Voice Destination will walk you through creating your next voice destination. Your Live Demo will be available across 1.1 billion Google Assistant enabled devices by tomorrow.";
	$ga_option_0_button_text = "Hear More";
	$ga_option_0_button_url = "https://www.youtube.com/embed/gYVabrVtCBU";
	
	$ga_option_1_title = "When Will Mine Be Ready?";
	$ga_option_1_subtitle = "How Do I Get One?";
	$ga_option_1_image = "https://02b7cf4.netsolhost.com/voicedestination/uploads/1920x1080-default.jpg";
	$ga_option_1_description = "Find out how long it takes for the Live Demo of your Voice Destination to go live on 1.1b devices around the globe.";
	$ga_option_1_button_text = "Start Yours";
	$ga_option_1_button_url = "https://02b7cf4.netsolhost.com/voicedestination/" . $ga_asset_file_root . ".php#admin";
	
	$ga_option_2_title = "Why Would I Want One?";
	$ga_option_2_subtitle = "What Is It?";
	$ga_option_2_image = "https://02b7cf4.netsolhost.com/voicedestination/uploads/1920x1080-default.jpg";
	$ga_option_2_description = "Learn what a Voice Destination is, and realize why you already need one.";
	$ga_option_2_button_text = "Create One";
	$ga_option_2_button_url = "https://02b7cf4.netsolhost.com/voicedestination/" . $ga_asset_file_root . ".php#admin";
	
	$ga_option_3_title = "What's the Backstory?";
	$ga_option_3_subtitle = "Who Makes Them?";
	$ga_option_3_image = "https://02b7cf4.netsolhost.com/voicedestination/uploads/1920x1080-default.jpg";
	$ga_option_3_description = "Hear from the people working behind the scenes on the voice of your brand.";
	$ga_option_3_button_text = "Make Yours";
	$ga_option_3_button_url = "https://02b7cf4.netsolhost.com/voicedestination/" . $ga_asset_file_root . ".php#admin";
	
	$ga_client_id = "";
	
	$pieces = explode("%7C", $_SERVER['QUERY_STRING']);
	$prefix = pathinfo(basename($_SERVER['PHP_SELF']), PATHINFO_FILENAME);

if (strpos($_SERVER['QUERY_STRING'], 'audio') || strpos($_SERVER['REQUEST_URI'], 'audio')){
	
	header("Content-type: audio/mp3");
	header("Location: uploads/" . $ga_asset_file_root . "_" . $pieces[4] . ".mp3");

} else if (strpos($_SERVER['QUERY_STRING'], 'icon') || strpos($_SERVER['REQUEST_URI'], 'icon')){

	header("Content-type: image/jpg");
	header("Location: uploads/" . $ga_asset_file_root . "_" . $pieces[4] . ".jpg");

} else if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

	if ($_POST["ga_submit"] == "create" && $_POST["ga_new_title"]) {

		$o_root = $ga_asset_file_root . '.php';
		$n_name = $str = strtolower(preg_replace( '/[^a-z0-9 ]/i', '', $_POST["ga_new_title"])) . "_";
		$n_prefix = uniqid($n_name);		
		$n_root = $n_prefix . ".php";

		if (!copy($o_root, $n_root)) {

		    echo "failed to copy $file...\n";
		} else {

			$o_prefix = 'uploads/hal_';
			$n_prefix = 'uploads/' . $n_prefix . '_';

			$images = array(
				"0",
				"1",
				"2",
				"3"
			);

			$sounds = array(
				"welcome", 
				"comeback", 
				"feedback", 
				"goodbye", 
				"later", 
				"menu",
				"thanks",
				"1",
				"2",
				"3",
				"1_0",
				"1_1",
				"1_2",
				"1_3",
				"1_4",
				"1_5",
				"1_6"
			);

			foreach ($images as $image) {
				$o_image = $o_prefix . $image . ".jpg";
				$n_image = $n_prefix . $image . ".jpg";
				if (!copy($o_image, $n_image)) {
				    echo "failed to copy";
				}
			}

			foreach ($sounds as $sound) {
				$o_sound = $o_prefix . $sound . ".mp3";
				$n_sound = $n_prefix . $sound . ".mp3";
				if (!copy($o_sound, $n_sound)) {
				    echo "failed to copy";
				}
			}

			chmod($n_root,0777);			
			header("Location: https://02b7cf4.netsolhost.com/voicedestination/" . $n_root, true, 301);		
		}	

	} else {

		$path = "uploads/";
		$valid_formats1 = array("mp3", "ogg", "flac");

		$ga_option_0_title = $_POST["ga_option_0_title"];
		$ga_option_0_image = $_POST["ga_option_0_image"];
		$ga_option_0_description = $_POST["ga_option_0_description"];
		$ga_option_0_button_text = $_POST["ga_option_0_button_text"];
		$ga_option_0_button_url = $_POST["ga_option_0_button_url"];
		
		$ga_option_1_title = $_POST["ga_option_1_title"];
		$ga_option_1_subtitle = $_POST["ga_option_1_subtitle"];
		$ga_option_1_image = $_POST["ga_option_1_image"];
		$ga_option_1_description = $_POST["ga_option_1_description"];
		$ga_option_1_button_text = $_POST["ga_option_1_button_text"];
		$ga_option_1_button_url = $_POST["ga_option_1_button_url"];
		
		$ga_option_2_title = $_POST["ga_option_2_title"];
		$ga_option_2_subtitle = $_POST["ga_option_2_subtitle"];
		$ga_option_2_image = $_POST["ga_option_2_image"];
		$ga_option_2_description = $_POST["ga_option_2_description"];
		$ga_option_2_button_text = $_POST["ga_option_2_button_text"];
		$ga_option_1_button_url = $_POST["ga_option_1_button_url"];
		
		$ga_option_3_title = $_POST["ga_option_3_title"];
		$ga_option_3_subtitle = $_POST["ga_option_3_subtitle"];
		$ga_option_3_image = $_POST["ga_option_3_image"];
		$ga_option_3_description = $_POST["ga_option_3_description"];
		$ga_option_3_button_text = $_POST["ga_option_3_button_text"];
		$ga_option_3_button_url = $_POST["ga_option_3_button_url"];
		
		$ga_client_id = $_POST["ga_client_id"];

		for ($x = 0; $x <= 3; $x++) {
			$lookFor = 'audio_' . $x;
			$option = 'option_' . $x;
		    $audio = $_FILES[$lookFor]['name'];
		    $size = $_FILES[$lookFor]['size'];

		    if(strlen($audio)) {
		        list($raw, $ext) = explode(".", $audio);
		        if(in_array($ext,$valid_formats1)) {
		        	$actual_audio_name = $raw.".".$ext;
			        $new_audio_name = $ga_asset_file_root . "_raw." . $ext;
					$tmp = $_FILES[$lookFor]['tmp_name'];
					if(move_uploaded_file($tmp, $path.$new_audio_name)) {
						$audError = $lookFor . " audio success";
						if (!empty($_POST[$option])) {
							foreach($_POST[$option] as $selected){
								copy($path.$new_audio_name,$path.$ga_asset_file_root . "_" . $selected . "." . $ext);
							}
						}
					} else {
						$audError = $option . " audio upload failed";              
					}
		        } else {
						$audError = "wrong file type (audio " . $option . " upload error)";                          	
		        }
		        echo($audError);
		    }		
		}


		for ($x = 0; $x <= 3; $x++) {
			$imageName = "image_" . $x;
			$target_file = $path . basename($_FILES[$imageName]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$IMAGE_HEIGHT = 1080;
			$IMAGE_WIDTH = 1920;

			if(isset($_FILES[$imageName]["name"])) {
				if($imageFileType != "jpg" && $imageFileType != "jpeg") {
				  $imgError = "Sorry, only JPG files are allowed.";
				  $uploadOk = 0;
				}     

				$check = getimagesize($_FILES[$imageName]["tmp_name"]);
				
				if($check !== false) {
					$imgError = "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					$imgError = "File is not an image.";
					$uploadOk = 0;
				}

				if ($uploadOk == 0) {
					$imgError = "Sorry, image " . $x . " was not uploaded.";
				} else {
					$tmp_file_name = $_FILES[$imageName]['tmp_name'];
					$ext = strtolower(pathinfo($_FILES[$imageName]['name'], PATHINFO_EXTENSION));
					$actual_file_name = $path . basename($_FILES[$imageName]['name'], "." . $ext) . ".jpg";

					if(getimagesize($tmp_file_name)){
						$image_array = getimagesize($tmp_file_name);
						$mime_type = $image_array['mime'];

						list($width_orig, $height_orig) = getimagesize($tmp_file_name);

						if($mime_type == "image/jpeg"){
							if($image_p = imagecreatetruecolor($IMAGE_WIDTH, $IMAGE_HEIGHT)){
								if($image = imagecreatefromjpeg($tmp_file_name)){
									$exif=exif_read_data($_FILES[$imageName]['tmp_name'],'IFD0');
									if($exif['Orientation']==3 || $exif['Orientation']==6){
										//ini_set('memory_limit', '256M');
										$image=imagerotate($image,270,0);
										$width_orig = $image_array[1];
										$height_orig = $image_array[0];
									}

									$old_x          =   imageSX($image);
									$old_y          =   imageSY($image);

									$old_ratio		= 	$old_x/$old_y;
									$new_ratio		= 	$IMAGE_WIDTH/$IMAGE_HEIGHT;

									if($old_ratio == $new_ratio) 
									{
										$ga_width    =   $IMAGE_WIDTH;
										$ga_height    =   $IMAGE_HEIGHT;
									}

									if($old_ratio > $new_ratio) 
									{
										$ga_width    =   $IMAGE_WIDTH;
										$ga_height    =   $old_y*($IMAGE_HEIGHT/$old_x);
									}

									if($old_ratio < $new_ratio) 
									{
										$ga_width    =   $old_x*($IMAGE_WIDTH/$old_y);
										$ga_height    =   $IMAGE_HEIGHT;
									}

									$width_new = $height_orig * ($IMAGE_WIDTH / $IMAGE_HEIGHT);
									$height_new = $width_orig * ($IMAGE_HEIGHT / $IMAGE_WIDTH);

									if($width_new > $width_orig){
										$width = $width_orig;
										$height = $height_new;
										$w_point = 0;
										$h_point = (($height_orig - $height_new) / 2);
									} else {
										$width = $width_new;
										$height = $height_orig;
										$w_point = (($width_orig - $width_new) / 2);
										$h_point = 0;
									}

									if(imagecopyresampled($image_p, $image, 0, 0, $w_point, $h_point, $IMAGE_WIDTH, $IMAGE_HEIGHT, $width, $height)){

											if(imagejpeg($image_p, $actual_file_name, 100)){

												imagedestroy($image_p);
												imagedestroy($image);

												$filename = $path . $ga_asset_file_root . "_" . $x . ".jpg";
												
												if(rename($actual_file_name, $filename)){
													switch ($x) {
													    case 0:
															$ga_option_0_image = $filename;
													        break;
													    case 1:
															$ga_option_1_image = $filename;
													        break;
													    case 2:
															$ga_option_2_image = $filename;
													        break;
													    case 3:
															$ga_option_3_image = $filename;
													        break;
													}											
												} else {
													switch ($x) {
													    case 0:
															$ga_option_0_image = "https://image.cnbcfm.com/api/v1/image/106161538-1570071966284gettyimages-1178179427.jpeg";
													        break;
													    case 1:
															$ga_option_1_image = "https://image.cnbcfm.com/api/v1/image/106161538-1570071966284gettyimages-1178179427.jpeg";
													        break;
													    case 2:
															$ga_option_2_image = "https://image.cnbcfm.com/api/v1/image/106161538-1570071966284gettyimages-1178179427.jpeg";
													        break;
													    case 3:
															$ga_option_3_image = "https://image.cnbcfm.com/api/v1/image/106161538-1570071966284gettyimages-1178179427.jpeg";
													        break;
													}
												}

											}
									} else {
										imagedestroy($image);
										imagedestroy($image_p);
										$imgError = "Image Processing Error";
									}
								} else {
									imagedestroy($image_p);
									$imgError = "Image Processing Error";
								}
							} else {
								$imgError = "Image Processing Error. Please try again later.";
							}
						} else {
							$imgError = "Only JPEG, PNG and GIF images are allowed.";
						}

					} else {
						$imgError = "Bad image format";
					} 

				}
				echo($imgError);
			}

		}
		
		$content = file_get_contents($ga_asset_file_root . '.php'); 

		$content = preg_replace('/\$ga_option_0_title=\"(.*?)\";/', '$ga_option_0_title="sdfsdfsdfsdfsdf";', $content);
		$content = preg_replace('/\$ga_option_0_image=\"(.*?)\";/', '$ga_option_0_image="";', $content);
		$content = preg_replace('/\$ga_option_0_description=\"(.*?)\";/', '$ga_option_0_description="";', $content);
		$content = preg_replace('/\$ga_option_0_button_url=\"(.*?)\";/', '$ga_option_0_button_url="https://www.youtube.com/embed/gYVabrVtCBU";', $content);
		$content = preg_replace('/\$ga_option_0_button_text=\"(.*?)\";/', '$ga_option_0_button_text="Hear More";', $content);

		$content = preg_replace('/\$ga_option_1_title=\"(.*?)\";/', '$ga_option_1_title="When Will Mine Be Ready?";', $content);
		$content = preg_replace('/\$ga_option_1_subtitle=\"(.*?)\";/', '$ga_option_1_subtitle="How Do I Get One?";', $content);
		$content = preg_replace('/\$ga_option_1_description=\"(.*?)\";/', '$ga_option_1_description="";', $content);
		$content = preg_replace('/\$ga_option_1_button_url=\"(.*?)\";/', '$ga_option_1_button_url="https://02b7cf4.netsolhost.com/voicedestination/hal.php#admin";', $content);
		$content = preg_replace('/\$ga_option_1_button_text=\"(.*?)\";/', '$ga_option_1_button_text="Start Yours";', $content);

		$content = preg_replace('/\$ga_option_2_title=\"(.*?)\";/', '$ga_option_2_title="Why Would I Want One?";', $content);
		$content = preg_replace('/\$ga_option_2_subtitle=\"(.*?)\";/', '$ga_option_2_subtitle="What Is It?";', $content);
		$content = preg_replace('/\$ga_option_2_description=\"(.*?)\";/', '$ga_option_2_description="";', $content);
		$content = preg_replace('/\$ga_option_2_button_url=\"(.*?)\";/', '$ga_option_2_button_url="https://02b7cf4.netsolhost.com/voicedestination/hal.php#admin";', $content);
		$content = preg_replace('/\$ga_option_2_button_text=\"(.*?)\";/', '$ga_option_2_button_text="Create One";', $content);

		$content = preg_replace('/\$ga_option_3_title=\"(.*?)\";/', '$ga_option_3_title="What\'s the Backstory?";', $content);
		$content = preg_replace('/\$ga_option_3_subtitle=\"(.*?)\";/', '$ga_option_3_subtitle="Who Makes Them?";', $content);
		$content = preg_replace('/\$ga_option_3_description=\"(.*?)\";/', '$ga_option_3_description="";', $content);
		$content = preg_replace('/\$ga_option_3_button_url=\"(.*?)\";/', '$ga_option_3_button_url="https://02b7cf4.netsolhost.com/voicedestination/hal.php#admin";', $content);
		$content = preg_replace('/\$ga_option_3_button_text=\"(.*?)\";/', '$ga_option_3_button_text="Make Yours";', $content);

		file_put_contents($ga_asset_file_root . '.php', $content);

	}
} else {
?>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">	
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<style type="text/css">
	:root {
	  --xxlarge: 1.7em;
	  --xlarge: 1.5em;
	  --large: 1.25em;
	  --medium: 1.2em;
	}
	body {
		color: lightgray;
		background: black; 
		font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
		margin: auto;
		font-size: 4vw;
	}

	form {
		margin-block-end: 20em;
	}
	h1 {
		font-size: 2em;
		padding: .25em;
	}
	h2, h4, legend, summary {
		padding: .25em 0;
	}
	h2 {
		font-size: var(--xxlarge);
	}
	h4,
	a.btn,
	input.form-control.form-control-lg, 
	select.form-control.form-control-lg, 
	input.form-control-file.form-control-lg 
	{
		font-size: var(--xlarge);
	}
	legend, 
	summary,
	a.btn-audio,
	label.btn-audio, 
	span.btn-audio,
	label.btn-image, 
	span.btn-image,	textarea.p,
	textarea.form-control-file.form-control-lg,
	input.h3.form-control.form-control-lg	
	{
		font-size: var(--large);
	}
	input.h4.form-control.form-control-lg,
	input.form-control.form-control-lg.yt.url,
	input.form-control.form-control-lg.yt.cue {
		font-size: var(--medium);
	}
	p, label, li:not(.nav-item), option, a.btn.btn-primary {
		font-size: 1em;
	}
	label.btn
	{
		height: calc(2.25em);
		font-size: 1em;
		padding: .5em .75em;
		margin: .25em;
	}	
	a.btn-audio,
	label.btn-audio, 
	span.btn-audio,
	label.btn-image, 
	span.btn-image 	
	{
		height: calc(2.25em);
		margin: .25em 0 0 .25em;
		padding: 0 .75em;
		border-radius: 50%;
	 }	
	label.btn-audio, 
	label.btn-image {
		padding-top: .5em;
	}
	span.btn-audio, span.btn-image {
		padding: .5em;
	}
	a.btn,
	input.form-control.form-control-lg, 
	select.form-control.form-control-lg, 
	input.form-control-file.form-control-lg {
		height: calc(2.5em);
		padding: .25em .5em;
		line-height: 2em;
		border-radius: .25em;
		margin: .25em;
		width: 95%;
	}
	input.form-control.form-control-lg.members {
		width: calc(2em);
		height: calc(2.5em);
		padding: 0em;
		border-radius: .25em;
		margin: .25em;
		display: inline-block;
		vertical-align: middle;
	}
	input.form-control.form-control-lg, 
	select.form-control.form-control-lg, 
	input.form-control-file.form-control-lg,
	textarea {
		background: none;
		color: lightgray;
		/*margin-bottom: 5em;*/
	}
	input.h3.form-control.form-control-lg,
	textarea.form-control-file.form-control-lg,
	textarea.p	
	 {
		margin: .25em .25em 1.25em .25em;		
	}
	textarea.h1 {
		height: calc(5em);
		width: 100%;		
		padding: .25em .5em;
		font-size: 2em;
		line-height: 2.5em;
		border: none;
	}
	textarea.p {
		height: calc(5em);
		width: 100%;
		padding: .25em .5em;
		line-height: 1.75em;
		border: none;
	}
	textarea.form-control-file.form-control-lg {
		height: calc(6em);
		padding: .25em .5em;
		line-height: 2em;
		border: none;
	}
	input.h3.form-control.form-control-lg {
		border: none;
		width: 85%;	
		display: inline;
		padding: 0;
		margin: 0;
	}
	input.h4.form-control.form-control-lg {
		border: none;			
		width: 85%;	
		display: inline;
	}
	hr {
		height: 0px;
		border: none;
		border-top: .5em solid black;
	}
	input.form-control.form-control-lg.yt.url {
		width: 70%;
	}
	input.form-control.form-control-lg.yt.cue {
		width: 20%;
	}
	.mt-5 {
		margin-top: 1.25em;
	}
	.intro li {
		list-style: none;
		margin: .5em auto;
	}
	.icon {
		width: 2.25em;
		height: auto;
		margin-left: 2px;
	}
	.overlay label {
	  position: relative;
	  top: 40%;
	  width: 2.75em;
	  margin: auto;
	  transition: opacity 0.5s ease;
	  opacity: 0;
	}
	label.btn-audio, 
	label.btn-image {
		background: #006600;
		text-align: center;
		color: white;
		border: none;
		transition: all 0.2s;
	}
	label.btn:not(.active):not(.toggle-on):not(.toggle-off) {
		color: lightgray;
		background-color: black;
		border-color: gray;	 	
	}
	label.btn-image {
		background: gray;
	}
	.hidden,
	fieldset.recordings,
	figcaption,
	label[for*="alt"],
	label[for*="-image-upload"],
	input[id*="alt"],
	input[for*="-image-upload"],
	input[type="file"][class="audio"],
	input[type="file"][class="image"],
	.voiceAd,
	.dailyPush,
	.multiTribe,
	.yt
	{
		display: none;
	}
	div.hero {
		position: relative;
		margin: 0 -15px 2px;
	}
	.ga_image {
	    max-height: 33%;
	    width: 100%;		
	}
	img.ga_image:before {
	    content: ' ';
	    display: block;
	    position: absolute;
	    height: 100%;
	    width: 100%;
	    background-image: url(https://02b7cf4.netsolhost.com/voicedestination/uploads/1920x1080-default.jpg);
		background-position: center; /* Center the image */
		background-repeat: no-repeat; /* Do not repeat the image */
		background-size: cover; /* Resize the background image to cover the entire container */	    
	}
	iframe {
		display: none;
		margin: 2% -5%;
	}
	.overlay {
	/*input[type="file"][class="image"] {*/
	  position: absolute;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  background: rgba(0, 0, 0, 0);
	  transition: background 0.5s ease;
	  text-align: center;
	}
	.hero:hover .overlay {
	  display: block;
	  background: rgba(0, 0, 0, .3);
	}
	.hero:hover .overlay label {
	  opacity: 1;
	}
	.card-body {
		padding: 0;
	}
	.card {
		background: transparent;
	}
	.dest-type {
		color: white;
	}
 	textarea, input {
		background: transparent;
	}
	.navbar-dark.bg-dark {
		background-color: black!important;
	}
	nav img {
		width: 80px;
		height: auto;
	}
	button:focus,
	.btn:focus {
		border-color : purple;
	}
	#body input:focus, textarea:focus, .btn:focus, button:focus, summary:focus {
	  border-color: #347fb6;
	  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(52, 127, 182, 0.6);
	  outline: 0 none;
	}
	.intro .btn.dest-type {
		width: 100%;
	}
	.intro ul {
		padding-left: 0;
	}
	.btn-primary {
		background-color: #3380b6;
		border-color: #3380b6;
	}
	.toast {
		background: green;
		display: none;
	    position: fixed;
	    top: 0;
	    left: 0;
	    width: 100%;
	    max-width: 100%;
	    min-width: 100%;
	    z-index: 10;
	}
	.toast-header img {
		height: 50px;
		width: auto;
	}
	.voiceAd .btn {
		width: 70%;
	}
	@media (min-width: 768px) {
		#body {
			width: 767px;
			font-size: 14px;
			margin: auto;
		}
	}
	.btn-dark {
	    color: #fff;
	    background-color: black;
	    border-color: black;
	}	
	table.dataTable tbody tr {
	    background-color: #333;
	}	
	.dataTables_wrapper .dataTables_filter input,
	.dataTables_wrapper .dataTables_length select {
	    background-color: #999;
	}
	.dataTables_wrapper {
		margin-top: 10em;
	}
	.loading {
	  font-size: 1em;
	}

	.loading:after {
	  overflow: hidden;
	  display: inline-block;
	  vertical-align: bottom;
	  -webkit-animation: ellipsis steps(4,end) 900ms infinite;      
	  animation: ellipsis steps(4,end) 900ms infinite;
	  content: "\2026"; /* ascii code for the ellipsis character */
	  width: 0px;
	}

	@keyframes ellipsis {
	  to {
	    width: 1.25em;    
	  }
	}

	@-webkit-keyframes ellipsis {
	  to {
	    width: 1.25em;    
	  }
	}
	.modal, .modal input.form-control.form-control-lg {
		color: black;
	}
	.fa:hover {
		cursor: pointer;
	}
	.required label:after {
	  content:"*";
	  color:red;
	}
	input:invalid,
	textarea:invalid,
	select:invalid {
	  color: #b94a48;
	  border-color: #ee5f5b;
	  &:focus {
	    border-color: darken(#ee5f5b, 10%);
	    .box-shadow(0 0 6px lighten(#ee5f5b, 20%));    
	  }
	}
	</style>
</head>
<body id="body">
	<a name="top"></a>
	<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="5000" data-animation="true">
		<div class="toast-header">
			<img src="https://02b7cf4.netsolhost.com/voicedestination/uploads/ga.png" alt="...">
			<strong class="mr-auto loading">Autosaving Changes</strong>
			<input class="autosave-btn" type="checkbox" checked data-toggle="toggle" data-on="Autosave On" data-off="Autosave Off" data-onstyle="success" data-offstyle="danger" data-size="mini"data-width="200" data-height="45">
			<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	</div>	
	<form enctype="multipart/form-data" id="form" action="<?=$_SERVER['PHP_SELF']?>" method="post" target="ga_assets">
		<datalist id="tribes">
			<option value="Tribe 1">
			<option value="Tribe 2">
			<option value="Gold Circle">
			<option value="Bronze Members">
			<option value="Platinum Club">
		</datalist>
		<input class="hidden" type="text" id="ga_submit" name="ga_submit" value="publish" />
		<iframe id="ga_assets" name="ga_assets" src="<?=$_SERVER['PHP_SELF']?>"></iframe>
		<div class="container-fluid">
			<div class="hero">
				<img id="ga_image_0" src="uploads/<?=$ga_asset_file_root?>_0.jpg" class="card-img-top ga_image" alt="<?=$ga_option_0_title?>">
				<div class="overlay">
					<label class="btn-image voiceAd dailyPush multiTribe" for="image_0"><i class="fa fa-camera"></i></label>
					<input type="file" class="image" name="image_0" id="image_0" accept="image/*" capture="camera">
				</div>
			</div>
			<textarea id="ga_option_0_title" name="ga_option_0_title" placeholder="Hey Google, Talk to the Voice of My Brand"class="h1" ><?=$ga_option_0_title?></textarea>

			<iframe
				id="video"
				width="110%" 
				height="35%" 
				frameborder="0" 
				allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>

			<p class="card-text multiTribe voiceAd dailyPush site"><textarea id="ga_option_0_description" name="ga_option_0_description" placeholder="<?=$ga_option_0_description?>" class="p"></textarea></p>	   
			<p class="card-text voiceAd site">
				<a class="btn btn-primary" data-toggle="collapse" href="#collapse_button_0" role="button" aria-expanded="false" aria-controls="collapse_button_0" id="ga_option_0_button">
					<?=$ga_option_0_button_text?>
				</a>
				<label class="btn-audio admin name_audio_files" for="option_0_audio_file" id="mic_0"><i class="fa fa-microphone"></i></label>
				<input name="audio_0" id="option_0_audio_file" type="file" class="audio" accept="audio/*" capture />
				<span id="audio_0" class="btn-audio play admin"><i class="fa fa-play"></i></span>

				<input id="ga_option_0_yt_audio" name="ga_option_0_yt_audio" value="<?=$ga_option_0_yt_audio?>" placeholder="YouTube URL w/start cue" type="text" class="yt url form-control form-control-lg" />
				<input 
					type="text" 
					id="cue_0" 
					name="cue_0" 
					list="until"
					class="form-control form-control-lg yt cue" 
					placeholder="for"
					/>
				<datalist id="until">
					<option value=":05">
					<option value=":10">
					<option value=":15">
				</datalist>			
			</p>
			<div class="collapse" id="collapse_button_0">
				<div class="card card-body">
					<input 
					type="text" 
					id="ga_option_0_button_text" 
					name="ga_option_0_button_text" 
					class="form-control form-control-lg" 
					value="<?=$ga_option_0_button_text?>" 
					placeholder="Option 0 Button Text"
					onkeyup="javascript:document.getElementById('ga_option_0_button').innerHTML = this.value" 
					/>
					<input 
					type="text" 
					id="ga_option_0_button_url" 
					name="ga_option_0_button_url" 
					class="form-control form-control-lg" 
					value="<?=$ga_option_0_button_url?>" 
					placeholder="Option 0 Button URL" 
					onkeyup="javascript:document.getElementById('ga_option_0_button').href = this.value" 
					/>
				</div>
			</div>

			<figure class="hidden">
				<audio id="audio_url" controls src="">Your browser does not support the <code>audio</code> element.</audio>
			</figure>	

			<details class="multiTribe dailyPush site">
				<summary><input id="ga_option_1_title" name="ga_option_1_title" value="<?=$ga_option_1_title?>" placeholder="Option 1 Title" type="text" class="h3 form-control form-control-lg" /></summary>
				<div class="hero">
					<img id="ga_image_1" src="uploads/<?=$ga_asset_file_root?>_1.jpg" class="card-img-top ga_image" alt="<?=$ga_option_0_title?>">
					<div class="overlay">
						<label class="btn-image voiceAd dailyPush multiTribe" for="image_1"><i class="fa fa-camera"></i></label>
						<input id="image_1" name="image_1" type="file" class="image" accept="image/*" capture="camera">
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-subtitle"><input id="ga_option_1_subtitle" name="ga_option_1_subtitle" value="<?=$ga_option_1_subtitle?>" placeholder="Option 1 Subtitle" type="text" class="h4 form-control form-control-lg" /></h4>
						<p class="card-text"><textarea id="ga_option_1_description" name="ga_option_1_description" placeholder="<?=$ga_option_1_description?>" class="p"></textarea></p>
						<select id="multitribe_1" name="multitribe_1" class="form-control form-control-lg multiTribe user">
							<option>For...</option>
							<option>Unregistered Guests</option>
							<option>Tribe 1</option>
							<option>Tribe 2</option>
						</select>
						<select id="audio_select_1" name="audio_select_1" class="form-control form-control-lg name_audio_files dailyPush multiTribe">
							<option value="_1">The Question of the Day</option>
							<option value="_welcome">"Can I send you daily updates?"</option>
							<option value="_menu">"Choose or say one of these."</option>
							<option value="_thanks">"Thank you for doing that."</option>
							<option value="_later">"Alright, maybe next time."</option>
							<option value="_comeback">"Sorry, I didn't catch that."</option>
							<option value="_feedback">"Any feedback before you go?"</option>
							<option value="_goodbye">"Thanks & See You Tomorrow!"</option>
						</select>
						<div class="btn-group user admin audio_1" id="<?=$ga_asset_file_root?>_1">
							<div class="btn-group btn-group-toggle" data-toggle="buttons">
								<label class="btn btn-info audio_1">
									<input type="checkbox" name="option_1[]" value="1_0" id="option_1_0" autocomplete="off">S
								</label>
								<label class="btn btn-light audio_1">
									<input type="checkbox" name="option_1[]" value="1_1" id="option_1_1" autocomplete="off">M
								</label>
								<label class="btn btn-secondary audio_1">
									<input type="checkbox" name="option_1[]" value="1_2" id="option_1_2" autocomplete="off">T
								</label>
								<label class="btn btn-warning audio_1">
									<input type="checkbox" name="option_1[]" value="1_3" id="option_1_3" autocomplete="off">W
								</label>
								<label class="btn btn-primary audio_1">
									<input type="checkbox" name="option_1[]" value="1_4" id="option_1_4" autocomplete="off">T
								</label>
								<label class="btn btn-success audio_1">
									<input type="checkbox" name="option_1[]" value="1_5" id="option_1_5" autocomplete="off">F
								</label>
								<label class="btn btn-danger audio_1">
									<input type="checkbox" name="option_1[]" value="1_6" id="option_1_6" autocomplete="off">S
								</label>
							</div>
							<label class="btn-audio name_audio_files" for="option_1_audio_file" id="mic_1"><i class="fa fa-microphone"></i></label>
							<input id="option_1_audio_file" name="audio_1" type="file" class="audio" accept="audio/*" capture />
							<span data-root="<?=$ga_asset_file_root?>" id="audio_1" class="btn-audio play"><i class="fa fa-play"></i></span>
						</div>
						<input type="text" id="ga_option_1_yt_audio" name="ga_option_1_yt_audio" placeholder="YouTube URL w/start cue" class="yt url form-control form-control-lg" />
						<input 
							type="text" 
							id="cue_1" 
							name="cue_1" 
							list="until"
							class="form-control form-control-lg yt cue" 
							placeholder="for"
							/>
						<p class="card-text mt-5">
							<a class="btn btn-primary" data-toggle="collapse" href="#collapse_button_1" role="button" aria-expanded="false" aria-controls="collapse_button_1" id="ga_option_1_button">
								<?=$ga_option_1_button_text?>
							</a>
						</p>
						<div class="collapse" id="collapse_button_1">
							<div class="card card-body">
								<input 
								type="text" 
								id="ga_option_1_button_text" 
								name="ga_option_1_button_text" 
								class="form-control form-control-lg" 
								value="<?=$ga_option_1_button_text?>" 
								placeholder="Option 1 Button Text"
								onkeyup="javascript:document.getElementById('ga_option_1_button').innerHTML = this.value" 
								/>
								<input 
								type="text" 
								id="ga_option_1_button_url" 
								name="ga_option_1_button_url" 
								class="form-control form-control-lg" 
								value="<?=$ga_option_1_button_url?>" 
								placeholder="Option 1 Button URL" 
								onkeyup="javascript:document.getElementById('ga_option_1_button').href = this.value" 
								/>
							</div>
						</div>
					</div>
				</div>			
			</details>
			<details class="dailyPush multiTribe site">
				<summary><input id="ga_option_2_title" name="ga_option_2_title" value="<?=$ga_option_2_title?>" placeholder="Option 2 Title" type="text" class="h3 form-control form-control-lg" /></summary>
				<div class="hero">
					<img id="ga_image_2" src="uploads/<?=$ga_asset_file_root?>_2.jpg" class="card-img-top ga_image" alt="<?=$ga_option_0_title?>">
					<div class="overlay">
						<label class="btn-image voiceAd dailyPush multiTribe" for="image_2"><i class="fa fa-camera"></i></label>
						<input id="image_2" name="image_2" type="file" class="image" accept="image/*" capture="camera">
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-subtitle"><input id="ga_option_2_subtitle" name="ga_option_2_subtitle" value="<?=$ga_option_2_subtitle?>" placeholder="Option 2 Subtitle" type="text" class="h4 form-control form-control-lg" /></h4>
						<p class="card-text"><textarea id="ga_option_2_description" name="ga_option_2_description" placeholder="<?=$ga_option_2_description?>" class="p"></textarea></p>
						<select id="multitribe_2" name="multitribe_2" class="form-control form-control-lg multiTribe user">
							<option>For...</option>
							<option>Unregistered Guests</option>
							<option>Tribe 1</option>
							<option>Tribe 2</option>
						</select>
						<div class="btn-group user admin audio_2" id="<?=$ga_asset_file_root?>_2">
							<div class="btn-group btn-group-toggle" data-toggle="buttons">
								<label class="btn btn-info audio_2">
									<input type="checkbox" name="option_2[]" value="1_0" id="option_2_0" autocomplete="off">S
								</label>
								<label class="btn btn-light audio_2">
									<input type="checkbox" name="option_2[]" value="1_1" id="option_2_1" autocomplete="off">M
								</label>
								<label class="btn btn-secondary audio_2">
									<input type="checkbox" name="option_2[]" value="1_2" id="option_2_2" autocomplete="off">T
								</label>
								<label class="btn btn-warning audio_2">
									<input type="checkbox" name="option_2[]" value="1_3" id="option_2_3" autocomplete="off">W
								</label>
								<label class="btn btn-primary audio_2">
									<input type="checkbox" name="option_2[]" value="1_4" id="option_2_4" autocomplete="off">T
								</label>
								<label class="btn btn-success audio_2">
									<input type="checkbox" name="option_2[]" value="1_5" id="option_2_5" autocomplete="off">F
								</label>
								<label class="btn btn-danger audio_2">
									<input type="checkbox" name="option_2[]" value="1_6" id="option_2_6" autocomplete="off">S
								</label>
							</div>
							<label class="btn-audio name_audio_files" for="option_2_audio_file" id="mic_2"><i class="fa fa-microphone"></i></label>
							<input id="option_2_audio_file" name="audio_2" type="file" class="audio" accept="audio/*" capture />
							<span id="audio_2" class="btn-audio play"><i class="fa fa-play"></i></span>
						</div>
						<input id="ga_option_2_yt_audio" name="ga_option_2_yt_audio" placeholder="YouTube URL w/start cue" type="text" class="yt url form-control form-control-lg" />
						<input 
							id="cue_2" 
							name="cue_2" 
							type="text" 
							list="until"
							class="form-control form-control-lg yt cue" 
							placeholder="for"
							/>
						<p class="card-text mt-5">
							<a class="btn btn-primary" data-toggle="collapse" href="#collapse_button_2" role="button" aria-expanded="false" aria-controls="collapse_button_2" id="ga_option_2_button">
								<?=$ga_option_2_button_text?>
							</a>
						</p>
						<div class="collapse" id="collapse_button_2">
							<div class="card card-body">
								<input 
								id="ga_option_2_button_text" 
								name="ga_option_2_button_text" 
								type="text" 
								class="form-control form-control-lg" 
								value="<?=$ga_option_2_button_text?>" 
								placeholder="Option 2 Button Text"
								onkeyup="javascript:document.getElementById('ga_option_2_button').innerHTML = this.value" 
								/>
								<input 
								id="ga_option_2_button_url" 
								name="ga_option_2_button_url" 
								type="text" 
								class="form-control form-control-lg" 
								value="<?=$ga_option_2_button_url?>" 
								placeholder="Option 2 Button URL" 
								onkeyup="javascript:document.getElementById('ga_option_2_button').href = this.value" 
								/>
							</div>
						</div>
					</div>
				</div>			
			</details>
			<details class="dailyPush multiTribe site">
				<summary><input id="ga_option_3_title" name="ga_option_3_title" value="<?=$ga_option_3_title?>" placeholder="Option 3 Title" type="text" class="h3 form-control form-control-lg" /></summary>
				<div class="hero">
					<img id="ga_image_3" src="uploads/<?=$ga_asset_file_root?>_3.jpg" class="card-img-top ga_image" alt="<?=$ga_option_0_title?>">
					<div class="overlay">
						<label class="btn-image voiceAd dailyPush multiTribe" for="image_3"><i class="fa fa-camera"></i></label>
						<input id="image_3" name="image_3" type="file" class="image" accept="image/*" capture="camera">
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h4 class="card-subtitle"><input id="ga_option_3_subtitle" name="ga_option_3_subtitle" value="<?=$ga_option_3_subtitle?>" placeholder="Option 3 Subtitle" type="text" class="h4 form-control form-control-lg" /></h4>
						<p class="card-text"><textarea id="ga_option_2_description" name="ga_option_2_description" placeholder="<?=$ga_option_2_description?>" class="p"></textarea></p>

						<select id="multitribe_3" name="multitribe_3" class="form-control form-control-lg multiTribe user">
							<option>For...</option>
							<option>Unregistered Guests</option>
							<option>Tribe 1</option>
							<option>Tribe 2</option>
						</select>
						<div class="btn-group user admin audio_3" id="<?=$ga_asset_file_root?>_3">
							<div class="btn-group btn-group-toggle" data-toggle="buttons">
								<label class="btn btn-info audio_3">
									<input type="checkbox" name="option_3[]" value="1_0" id="option_3_0" autocomplete="off">S
								</label>
								<label class="btn btn-light audio_3">
									<input type="checkbox" name="option_3[]" value="1_1" id="option_3_1" autocomplete="off">M
								</label>
								<label class="btn btn-secondary audio_3">
									<input type="checkbox" name="option_3[]" value="1_2" id="option_3_2" autocomplete="off">T
								</label>
								<label class="btn btn-warning audio_3">
									<input type="checkbox" name="option_3[]" value="1_3" id="option_3_3" autocomplete="off">W
								</label>
								<label class="btn btn-primary audio_3">
									<input type="checkbox" name="option_3[]" value="1_4" id="option_3_4" autocomplete="off">T
								</label>
								<label class="btn btn-success audio_3">
									<input type="checkbox" name="option_3[]" value="1_5" id="option_3_5" autocomplete="off">F
								</label>
								<label class="btn btn-danger audio_3">
									<input type="checkbox" name="option_3[]" value="1_6" id="option_3_6" autocomplete="off">S
								</label>
							</div>
							<label class="btn-audio name_audio_files" for="option_3_audio_file" id="mic_3"><i class="fa fa-microphone"></i></label>
							<input id="option_3_audio_file" name="audio_3" type="file" class="audio" accept="audio/*" capture />
							<span id="audio_3" class="btn-audio play"><i class="fa fa-play"></i></span>
						</div>
						<input id="ga_option_3_yt_audio" name="ga_option_3_yt_audio" placeholder="YouTube URL w/start cue" type="text" class="yt url form-control form-control-lg" />
						<input 
							id="cue_3" 
							name="cue_3" 
							type="text" 
							list="until"
							class="form-control form-control-lg yt cue" 
							placeholder="for" />
						<p class="card-text mt-5">
							<a class="btn btn-primary" data-toggle="collapse" href="#collapse_button_2" role="button" aria-expanded="false" aria-controls="collapse_button_2" id="ga_option_3_button">
								<?=$ga_option_3_button_text?>
							</a>
						</p>
						<div class="collapse" id="collapse_button_2">
							<div class="card card-body">
								<input 
								id="ga_option_3_button_text" 
								name="ga_option_3_button_text" 
								type="text" 
								class="form-control form-control-lg" 
								value="<?=$ga_option_3_button_text?>" 
								placeholder="Option 3 Button Text"
								onkeyup="javascript:document.getElementById('ga_option_3_button').innerHTML = this.value" 
								/>
								<input 
								id="ga_option_3_button_url" 
								name="ga_option_3_button_url" 
								type="text" 
								class="form-control form-control-lg" 
								value="<?=$ga_option_3_button_url?>" 
								placeholder="Option 3 Button URL" 
								onkeyup="javascript:document.getElementById('ga_option_3_button').href = this.value" 
								/>
							</div>
						</div>
					</div>
				</div>			
			</details>		
			<details id="terms" name="#terms">
				<summary>Terms of Service</summary>
				<div>
					<h1>Terms of Service for the "<span class="ga_option_0_title"></span>" Google Action</h1>
					<p>This Terms of Service notice discloses the terms of service for the <em  class="ga_option_0_title"></em> Google Action.</p>
					<p>Our Responsibilities. We are responsible for:</p>
					<p>(a) Customer service and claims, and communications and reporting among the individuals and entities involved in providing our Services;</p>
					<p>(b) Protecting any and all personally identifiable information (PII) you share with us;</p>
					<p>(c) Safeguarding of accounts, usernames, and passwords;</p>
					<p>(d) All necessary rights to grant the licenses in this Agreement and to provide our Services through Actions on Google;</p>
					<p>(e) Providing accurate information. All information, authorizations, and Settings we provide are complete, correct, and current;</p>
					<p>(f) Avoiding deceptive practices. We do not engage in deceptive, misleading, and/or unethical practices in connection with our Services or their promotion and will make no false or misleading representations with regard to Google or its products or services;</p>
					<p>(g) Compliance with Laws. We comply with all applicable laws, rules, and regulations in connection with Actions on Google;</p>
					<p>(h) Authorization to Act. We are authorized to act on behalf of, have bound to these Terms, and will be liable under these Terms for, each individual or entity involved in our Services.</p>
					<p>If you feel that we are not abiding by this privacy policy, you should contact us immediately via telephone at +16177856994 or via email at support@voicengage.co.</p>
				</div>
			</details>
			<details id="policy" name="#policy">
				<summary>Privacy Policy</summary>
				<div>
					<h1>Privacy Notice for the "<span class="ga_option_0_title"></span>" Google Action</h1>
					<p>This privacy notice discloses the privacy practices for the <em class="ga_option_0_title"></em> Google Action.</p>
					<p>This privacy notice applies solely to information collected by this Google Assistant Action. It will notify you of the following:</p>
					<ul>
						<li>What personally identifiable information is collected from you through the Action, how it is used and with whom it may be shared.</li>
						<li>What choices are available to you regarding the use of your data.</li>
						<li>The security procedures in place to protect the misuse of your information.</li>
						<li>How you can correct any inaccuracies in the information.</li>
					</ul>
					<h2>Information Collection, Use, and Sharing</h2>
					<p>We are the sole owners of the information collected on this Action.</p>
					<p>We only have access to/collect information that you voluntarily give us via email or other direct contact from you.</p>
					<p>We will not sell or rent this information to anyone.</p>
					<p>We will use your information to respond to you, regarding the reason you contacted us. We will not share your information with any third party outside of our organization, other than as necessary to fulfill your request, e.g. to ship an order.</p>
					<p>Unless you ask us not to, we may contact you via email in the future to tell you about specials, new products or services, or changes to this privacy policy.</p>

					<h2>Your Access to and Control Over Information</h2>
					<p>You may opt out of any future contacts from us at any time.</p>
					<p>You can do the following at any time by contacting us via support@voicengage.co or +16177856994:</p>
					<ul>
						<li>See what data we have about you, if any.</li>
						<li>Change/correct any data we have about you.</li>
						<li>Have us delete any data we have about you.</li>
						<li>Express any concern you have about our use of your data.</li>
					</ul>
					<h2>Security</h2>
					<p>We take precautions to protect your information. When you submit sensitive information via the Action, your information is protected both online and offline.</p>
					<p>Wherever we collect sensitive information (such as credit card data), that information is encrypted and transmitted to us in a secure way. You can verify this by looking for a lock icon in the address bar and looking for "https" at the beginning of the address of the Web page.</p>
					<p>While we use encryption to protect sensitive information transmitted online, we also protect your information offline. Only employees who need the information to perform a specific job (for example, billing or customer service) are granted access to personally identifiable information. The computers/servers in which we store personally identifiable information are kept in a secure environment.</p>
					<p>If you feel that we are not abiding by this privacy policy, you should contact us immediately via telephone at +16177856994 or via email at support@voicengage.co.</p>
				</div>
			</details>
			<div class="admin">
			<?	
				$row = 1;
				if (($handle = fopen($ga_csv, "r")) !== FALSE) {
				   
				    echo '<table id="csv" class="table table-dark table-striped table-hover">';
				   
				    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				        $num = count($data);
				        if ($row == 1) {
				            echo '<thead><tr>';
				        }else{
				            echo '<tr>';
				        }
				       
				        for ($c=0; $c < $num; $c++) {
				            //echo $data[$c] . "<br />\n";
				            if(empty($data[$c])) {
				            } else {
								
								$array = explode(',', $data[$c]); 
				            	$value = $data[$c];
								
								foreach($array as $value) {
						            if ($row == 1) {
						                echo '<th>'.$value.'</th>';
						            }else{
						                echo '<td>'.$value.'</td>';
						            }
								}
				            }
				        }
				       
				        if ($row == 1) {
				            echo '</tr></thead><tbody>';
				        }else{
				            echo '</tr>';
				        }
				        $row++;
				    }
				   
				    echo '</tbody></table>';
				    fclose($handle);
				}
			?>
			</div>
		</div>
		<span id="option_1_title" class="hidden"><?=$ga_option_1_title?></span>
		<span id="option_2_title" class="hidden"><?=$ga_option_2_title?></span>
		<span id="option_3_title" class="hidden"><?=$ga_option_3_title?></span>
		<span id="option_1_subtitle" class="hidden"><?=$ga_option_1_subtitle?></span>
		<span id="option_2_subtitle" class="hidden"><?=$ga_option_2_subtitle?></span>
		<span id="option_3_subtitle" class="hidden"><?=$ga_option_3_subtitle?></span>
		<span id="option_1_description" class="hidden"><?=$ga_option_1_description?></span>
		<span id="option_2_description" class="hidden"><?=$ga_option_2_description?></span>
		<span id="option_3_description" class="hidden"><?=$ga_option_3_description?></span>
		<span id="option_1_button_text" class="hidden"><?=$ga_option_1_button_text?></span>
		<span id="option_2_button_text" class="hidden"><?=$ga_option_2_button_text?></span>
		<span id="option_3_button_text" class="hidden"><?=$ga_option_3_button_text?></span>
		<span id="option_1_button_url" class="hidden"><?=$ga_option_1_button_url?></span>
		<span id="option_2_button_url" class="hidden"><?=$ga_option_2_button_url?></span>
		<span id="option_3_button_url" class="hidden"><?=$ga_option_3_button_url?></span>
		<span id="client_id" class="hidden"><?=$ga_client_id?></span>
		<input type="hidden" id="asset_file_root" name="ga_asset_file_root" value="<?=$ga_asset_file_root?>" />
		<input type="hidden" id="audio_file_prefix" name="ga_audio_file_prefix" />
		<input type="hidden" id="audio_file_suffix" name="ga_audio_file_suffix" />
	<nav class="navbar navbar-dark bg-dark fixed-bottom">
		<a class="navbar-brand" href="#"><img alt="Powered by Voicengage" src="https://02b7cf4.netsolhost.com/voicedestination/uploads/logo.jpg" class="admin" /></a>
		<a class="navbar-brand hide-sm" href="#">Live on 1.1b iOS & Android devices with <img class="icon" src="https://02b7cf4.netsolhost.com/voicedestination/uploads/ga.png" /></a>
		<div class="btn-group">
			<button class="btn-dark autosave admin" type="button"><i class="fa fa-save"></i></button>
			<button class="btn-dark upload admin" type="button" data-toggle="modal" data-target="#publishNew"><i class="fa fa-upload"></i></button>
		</div>
	</nav>
	<div class="modal fade" id="publishNew" tabindex="-1" role="dialog" aria-labelledby="publishNewTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Publish Changes / Create New</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<p>
	      		All saved updates will be immediately available in your Voice Destination.<sup>&reg;</sup> <em>This action cannot be undone.</em>
	      	</p>
	        <p class="text-center">
	        	- OR -
	        </p>
	      	<p>
	      		To create a new Voice Destination<sup>&reg;</sup> from this one, change title below.
	      	</p>
	      	<p class="required">
		      	<label for="ga_new_title">Title</label> <small><em>(Please use 3 - 12 characters)</em></small>
				<div class="input-group mb-3">
				  <input id="ga_new_title" name="ga_new_title" value="<?=$ga_asset_file_root?>" placeholder="Voice Destination Title" type="text" class="form-control" aria-label="Voice Destination Title" required>
				  <div class="input-group-append">
				    <button class="btn btn-secondary" type="button" id="refresh-title"><i class="fa fa-refresh" id="title-refresh"></i></button>
				  </div>
				</div>		      	
			</p>
	      	<p id="webhook_id">
		      	<label for="ga_client_id">Google Client Id</label>
				<div class="input-group mb-3">
				  <input id="ga_client_id" name="ga_client_id" placeholder="Google Client ID" type="text" class="form-control" aria-label="Google Client ID" value="<?=$ga_client_id?>">
				  <div class="input-group-append">
				    <button class="btn btn-secondary" type="button" id="refresh-id"><i class="fa fa-refresh" id="id-refresh"></i></button>
				  </div>
				</div>
			</p>
			<textarea id="webhook" class="hidden">
const {
  conversation,
  Card,
  Collection,
  Simple,
  List,
  Media,
  Image,
  Table,
	Suggestion  
} = require('@assistant/conversation');
const functions = require('firebase-functions');
const destUrl = `https://02b7cf4.netsolhost.com/voicedestination/<?=$ga_asset_file_root?>.php`;

const app = conversation({
  clientId: 'GOOGLECLIENTID',
  debug: true
});

const ASSISTANT_LOGO_IMAGE = new Image({
  url: 'https://developers.google.com/assistant/assistant_96.png',
  alt: 'Google Assistant logo',
});

var OPTION = [];

OPTION[0] = {
  'TITLE': `<?=$ga_option_0_title?>`, 
  'SUBTITLE': `<?=$ga_option_0_subtitle?>`, 
  'DESCRIPTION': `<?=$ga_option_0_description?>`, 
  'BUTTON_NAME': `<?=$ga_option_0_button_text?>`
};

OPTION[1] = {
  'TITLE': `<?=$ga_option_1_title?>`, 
  'SUBTITLE': `<?=$ga_option_1_subtitle?>`, 
  'DESCRIPTION': `<?=$ga_option_1_description?>`, 
  'BUTTON_NAME': `<?=$ga_option_1_button_text?>`
};

OPTION[2] = {
  'TITLE': `<?=$ga_option_2_title?>`, 
  'SUBTITLE': `<?=$ga_option_2_subtitle?>`, 
  'DESCRIPTION': `<?=$ga_option_2_description?>`, 
  'BUTTON_NAME': `<?=$ga_option_2_button_text?>`
};

OPTION[3] = {
  'TITLE': `<?=$ga_option_3_title?>`, 
  'SUBTITLE': `<?=$ga_option_3_subtitle?>`, 
  'DESCRIPTION': `<?=$ga_option_3_description?>`, 
  'BUTTON_NAME': `<?=$ga_option_3_button_text?>`
};

function url(conv, option, fileType) {
  const defaultGUID = 'xxxxxx';
  const token = (conv.user.params.tokenPayload && conv.user.params.tokenPayload.email) ? conv.user.params.tokenPayload.email : defaultGUID;
  const turn = conv.session.params.turn ?  conv.session.params.turn : 0;
  const strOption = option ?  option : 'idk';
  const feedback = conv.session.params.feedback ?  conv.session.params.feedback : 'none';
  const comeback = conv.session.params.comeback ?  conv.session.params.comeback : 'none';
  let urlReq = new URL(destUrl);
  const qs = 't=' + token + '|' + turn + '|' + feedback + '|' + comeback + '|' + strOption + '|' + fileType;
  urlReq.searchParams.set('qs', qs);  
  const encodedUrl = encodeURI(urlReq);  
  return urlReq;
}

// Simple
app.handle('simple', (conv) => {
  conv.add(new Simple({
    speech: 'This is the first simple response.',
    text: 'This is the 1st simple response.',
  }));
  conv.add(new Simple({
    speech: 'This is the last simple response.',
    text: 'This is the last simple response.',
  }));
});

// Image
app.handle('image', (conv) => {
  conv.add('This is an image prompt!');
  conv.add(ASSISTANT_LOGO_IMAGE);
});

// Card
app.handle('card', (conv) => {
  conv.add('This is a card.');
  conv.add(new Card({
    'title': 'Card Title',
    'subtitle': 'Card Subtitle',
    'text': 'Card Content',
    'image': new Image({
							url: url(conv, 1, 'icon'),
      				alt: OPTION[0].TITLE
    				})
  }));
});

// Table
app.handle('table', (conv) => {
  conv.add('This is a table.');
  conv.add(new Table({
    'title': 'Table Title',
    'subtitle': 'Table Subtitle',
    'image': ASSISTANT_LOGO_IMAGE,
    'columns': [{
      'header': 'Column A',
    }, {
      'header': 'Column B',
    }, {
      'header': 'Column C',
    }],
    'rows': [{
      'cells': [{
        'text': 'A1',
      }, {
        'text': 'B1',
      }, {
        'text': 'C1',
      }],
    }, {
      'cells': [{
        'text': 'A2',
      }, {
        'text': 'B2',
      }, {
        'text': 'C2',
      }],
    }, {
      'cells': [{
        'text': 'A3',
      }, {
        'text': 'B3',
      }, {
        'text': 'C3',
      }],
    }],
  }));
});

// Collection
app.handle('collection', (conv) => {
  conv.add('This is a collection.');
  // Override prompt_option Type with display
  // information for Collection items.
  conv.session.typeOverrides = [{
    name: 'prompt_option',
    mode: 'TYPE_REPLACE',
    synonym: {
      entries: [
        {
          name: 'ITEM_1',
          synonyms: ['Item 1', 'First item'],
          display: {
             title: 'Item #1',
             description: 'Description of Item #1',
             image: ASSISTANT_LOGO_IMAGE,
          },
        },
        {
          name: 'ITEM_2',
          synonyms: ['Item 2', 'Second item'],
          display: {
             title: 'Item #2',
             description: 'Description of Item #2',
             image: ASSISTANT_LOGO_IMAGE,
          },
        },
        {
          name: 'ITEM_3',
          synonyms: ['Item 3', 'Third item'],
          display: {
             title: 'Item #3',
             description: 'Description of Item #3',
             image: ASSISTANT_LOGO_IMAGE,
          },
        },
        {
          name: 'ITEM_4',
          synonyms: ['Item 4', 'Fourth item'],
          display: {
             title: 'Item #4',
             description: 'Description of Item #4',
             image: ASSISTANT_LOGO_IMAGE,
          },
        },
      ],
    },
  }];
  conv.add(new Collection({
    title: 'Collection Title',
    subtitle: 'Collection subtitle',
    items: [
      {
        key: 'ITEM_1',
      },
      {
        key: 'ITEM_2',
      },
      {
        key: 'ITEM_3',
      },
      {
        key: 'ITEM_4',
      },
    ],
  }));
});

// List
app.handle('list', (conv) => {
  conv.add(`<speak><audio src="${url(conv,'menu','audio')}">Here are your options:</audio></speak>`);
  // Override prompt_option Type with display
  // information for List items.
  conv.session.typeOverrides = [{
    name: 'prompt_option',
    mode: 'TYPE_REPLACE',
    synonym: {
      entries: [
        {
          name: 'ITEM_1',
          synonyms: ['Item 1', 'First item'],
          display: {
            title: OPTION[1].TITLE,
            description: OPTION[1].DESCRIPTION,
            image: new Image({
							url: url(conv, 1, 'icon'),
      				alt: OPTION[1].TITLE
    				}),
          },
        },
        {
          name: 'ITEM_2',
          synonyms: ['Item 2', 'Second item'],
          display: {
             title: OPTION[2].TITLE,
             description: OPTION[2].DESCRIPTION,
            image: new Image({
							url: url(conv, 2, 'icon'),
      				alt: OPTION[2].TITLE
    				}),
          },
        },
        {
          name: 'ITEM_3',
          synonyms: ['Item 3', 'Third item'],
          display: {
             title: OPTION[3].TITLE,
             description: OPTION[3].DESCRIPTION,
            image: new Image({
							url: url(conv, 3, 'icon'),
      				alt: OPTION[3].TITLE
    				}),
          },
        },
      ],
    },
  }];
  conv.add(new List({
    title: OPTION[0].TITLE,
    items: [
      {
        key: 'ITEM_1',
      },
      {
        key: 'ITEM_2',
      },
      {
        key: 'ITEM_3',
      },
    ],
  }));
  conv.add(new Suggestion({'title': OPTION[1].SUBTITLE}));
  conv.add(new Suggestion({'title': OPTION[2].SUBTITLE}));
  conv.add(new Suggestion({'title': OPTION[3].SUBTITLE}));
  conv.add(new Suggestion({'title': OPTION[0].SUBTITLE}));
  conv.add(new Suggestion({'title': 'Get Daily'}));
});

// Option
app.handle('option', (conv) => {
	showOption(conv);
});

app.handle('sked', (conv) => {
	conv.scene.next.name = 'Daily_AccountLinked_DailyUpdates';
});

app.handle('hi', (conv) => {
	conv.add(`<speak><audio src="${url(conv,'welcome','audio')}">Sign up!</audio></speak>`);
});

app.handle('nav', (conv) => {
	conv.add(`<speak><audio src="${url(conv,'menu','audio')}">Menu</audio></speak>`);
});

app.handle('thx', (conv) => {
  const name = (conv.user.params.tokenPayload && conv.user.params.tokenPayload.given_name) ? `, ${conv.user.params.tokenPayload.given_name}.` : `.`;
	conv.add(`<speak><audio src="${url(conv,'thanks','audio')}">Thanks${name}</audio></speak>`);
});

app.handle('ok', (conv) => {
  const name = (conv.user.params.tokenPayload && conv.user.params.tokenPayload.given_name) ? `, ${conv.user.params.tokenPayload.given_name}.` : `.`;
	conv.add(`<speak><audio src="${url(conv,'later','audio')}">Got it${name}. Maybe another time.</audio></speak>`);
});

app.handle('ask', (conv) => {
	let strAudio;
  if (conv.session.params.comeback) {
    strAudio = 'feedback';
  } else {
    strAudio = 'comeback';
    conv.session.params.comeback = conv.request.intent.query;    
  }
  conv.add(`<speak><audio src="${url(conv,strAudio,'audio')}">Sorry, say that again?</audio></speak>`);
});

app.handle('bye', (conv) => {
  conv.session.params.feedback = conv.request.intent.query;
  const name = (conv.user.params.tokenPayload && conv.user.params.tokenPayload.given_name) ? `, ${conv.user.params.tokenPayload.given_name}.` : `.`;
	conv.add(`<speak><audio src="${url(conv,'goodbye','audio')}">Goodbye${name}</audio></speak>`);
});

function showOption(conv){
  
  let intOption, selectedOption, scene_text, intro_button_text;

  selectedOption = conv.session.params.prompt_option ? conv.session.params.prompt_option.toLowerCase().replace(/_/g, ' #') : conv.intent.name;
  intOption = parseInt(selectedOption.slice(-1));
  scene_text = (intOption > -1) ? OPTION[intOption].DESCRIPTION : `Try saying, "${OPTION[1].SUBTITLE}" or "${OPTION[2].SUBTITLE}" or "${OPTION[3].SUBTITLE}. And if you get lost, just say, "Menu" to see all your options in one place.`;
  intro_button_text = (intOption > -1) ? OPTION[intOption].BUTTON_NAME : OPTION[0].TITLE;    

  //conv.add(`You selected ${selectedOption} in the scene named ${conv.scene.name}.`);
	conv.add(`<speak><audio src="${url(conv,intOption,'audio')}">${OPTION[intOption].TITLE}</audio></speak>`);
  conv.add(new Card({
    'title': OPTION[intOption].TITLE,
    'text': scene_text,
    'image': new Image({
            url: url(conv, intOption, 'icon'),
            alt: OPTION[intOption].TITLE
          }),
    'button': {
      'name': intro_button_text,
      'open': {
              'url': url(conv, intOption, 'url')
            }
    }      
  }));    
  conv.add(new Suggestion({'title': OPTION[1].SUBTITLE}));
  conv.add(new Suggestion({'title': OPTION[2].SUBTITLE}));
  conv.add(new Suggestion({'title': OPTION[3].SUBTITLE}));
  conv.add(new Suggestion({'title': OPTION[0].SUBTITLE}));
  conv.add(new Suggestion({'title': 'Get Daily'}));
  
}

// Media
app.handle('media', (conv) => {
  conv.add('This is a media response');
  conv.add(new Media({
    mediaObjects: [
      {
        name: 'Media name',
        description: 'Media description',
        url: 'https://actions.google.com/sounds/v1/cartoon/cartoon_boing.ogg',
        image: {
          large: ASSISTANT_LOGO_IMAGE,
        }
      }
    ],
    mediaType: 'AUDIO',
    optionalMediaControls: ['PAUSED', 'STOPPED']
  }));
});

// Media Status
app.handle('media_status', (conv) => {
  const mediaStatus = conv.intent.params.MEDIA_STATUS.resolved;
  switch(mediaStatus) {
    case 'FINISHED':
      conv.add('Media has finished playing.');
      break;
    case 'FAILED':
      conv.add('Media has failed.');
      break;
    case 'PAUSED' || 'STOPPED':
      conv.add(new Media({
        mediaType: 'MEDIA_STATUS_ACK'
      }));
      break;
    default:
      conv.add('Unknown media status received.');
  }
});

exports.ActionsOnGoogleFulfillment = functions.https.onRequest(app);
				</textarea>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	        <button type="button" class="btn btn-info" id="getWebhook"><i class="fa fa-copy"></i> <span id="copyText">Copy Webhook</span></button>
	        <button type="button" class="btn btn-primary publish" id="publishOrCreate">Publish Changes</button>
	      </div>
	    </div>
	  </div>
	</div>
	</form>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/1.0.11/jquery.csv.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			
			$('[data-toggle="tooltip"]').tooltip();

			$('#csv').DataTable();			
			
			$('.image').on('change', function () {
				$('form').submit();
			});			
			
			$('.autosave').on('click',function() {
				$('.toast').toast('show');
				document.getElementById("form").target = "_self";
				document.getElementById('form').submit();
			});
			
			$('#getWebhook').on('click',function() {
				const textToCopy = document.getElementById("webhook").value;
				let webhook = textToCopy.replace("GOOGLECLIENTID", $('#ga_client_id').val());
				navigator.clipboard.writeText(webhook)
				  .then(() => {$('#copyText').html('<em>Copied Webhook</em>');})
				  .catch((error) => { $('#copyText').text('Copy failed'); })
			});

			$('#ga_option_0_title').change(function() {
			  $('.ga_option_0_title').text($('#ga_option_0_title').val());
			});

			$('#ga_assets').on('load',function() {
				$.each($(".ga_image"), function() {
					var imgsrc = $(this).attr("src");
					$(this).attr("src", imgsrc + "?timestamp=" + new Date().getTime());
				});				
			});

			$('#audio_1, #audio_2').on('click',function() {
				$(this).siblings(".btn-group").find("label.active").slice(1).removeClass("active");
				var prefix = $(this).siblings(".btn-group").find("label.active input").val();
				var suffix = $(this).siblings(".btn-group").find("label.active input").val();
				var audioURL = 'https://02b7cf4.netsolhost.com/voicedestination/uploads/<?=$ga_asset_file_root?>' + prefix + suffix + '.mp3';
				var defaultURL = 'https://02b7cf4.netsolhost.com/voicedestination/uploads/<?=$ga_asset_file_root?>_2.mp3';
				$.ajax({
				    url : audioURL,
				    type : 'HEAD'
				}).done(function() {
				}).fail(function() {
				}).always(function(data) {
					console.log(data.statusText);
					var src = data.statusText === 'error' ? defaultURL : audioURL; 
					console.log(src);
					var audio = document.getElementById('audio_url');
					audio.setAttribute("src", src);
					audio.load();
					document.getElementById('audio_url').play();
				});
			});

			$('#audio_1').on('click',function() {
				var $option = $('#audio_select_1').find('option:selected');
				if($option.index() == 0){
					$(this).siblings(".btn-group").find("label.active").slice(1).removeClass("active");
				} else {
					$(this).siblings(".btn-group").find("label").addClass("active");					
				}
			});

			$('#audio_select_1').on('change',function() {
				var $option = $('#audio_select_1').find('option:selected');
				$(this).siblings(".btn-group").find("label.active").removeClass("active");
				if($option.index() != 0){
					$(this).siblings(".btn-group").find("label").addClass("active");					
				}
			});

			$('.name_audio_files').on('click change',function() {
				if(this.id == 'mic_0'){
					$("#audio_file_prefix").val("_0");
					$("#audio_file_suffix").val("_0");					
				} else if(this.id == 'audio_select_1'){
					var $option = $(this).find('option:selected');
					$("#audio_file_prefix").val("_0");
					$("#audio_file_suffix").val($option.val());
					if($option.index() > 0){
						$("label.audio_0").addClass("active");
						$("label.audio_0 input").prop("checked", true);
					} else {
						$("label.audio_0").removeClass("active");
						$("label.audio_0 input").prop("checked", false);						
					}				
				} else {
					$("#audio_file_prefix").val(this.id);
				}
			});

			$('#ga_new_title').on('keyup',function() {
				if ($("#ga_new_title").val() !== '<?=$ga_asset_file_root?>'){
					$("#ga_client_id").val("");
					$("#publishOrCreate").html("Create New Project");
				} else {
					$("#ga_client_id").val('<?=$ga_client_id?>');
					$("#publishOrCreate").html("Publish Changes");
				}
			});

			$('#refresh-title').on('click', function(){
		        document.getElementById('title-refresh').classList.add('fa-spin');
		        setTimeout(function(){
		        	document.getElementById('title-refresh').classList.remove('fa-spin');
		        }, 500);				
				$("#ga_new_title").val('<?=$ga_asset_file_root?>');
			});

			$('#refresh-id').on('click', function(){
		        document.getElementById('id-refresh').classList.add('fa-spin');
		        setTimeout(function(){
		        	document.getElementById('id-refresh').classList.remove('fa-spin');
		        }, 500);				
				$("#ga_client_id").val('<?=$ga_client_id?>');
			});

			$('#publishOrCreate').on('click',function() {
				if ($("#ga_new_title").val() !== '<?=$ga_asset_file_root?>'){
					$("#ga_submit").val("create");
					$("#form").attr("target", "_self");
					$("#form").submit();					
				} else {
					$("#ga_submit").val("publish");
					$("#form").submit();										
				}
			});
		});

		const hash = window.location.hash;

        if (hash === '#sales') {
			$('.btn-audio').hide();
			$('.yt').show();
			$('.user').hide();
		} else if (hash === '#admin' || hash === '#nfaa' || hash === '#new' || location.search.indexOf('qs=') > -1) {
			$('.admin').show();
			document.getElementById('ga_option_0_title').value = 'Hey Google, Ask [My Brand] about [Something]';
			for (let element of document.getElementsByClassName("admin")){element.style.display="block";}
			for (let element of document.getElementsByClassName("dailyPush")){element.style.display="block";}
			for (let element of document.getElementsByClassName("multiTribe")){element.style.display="block";}				
			//$('.site').hide();

        	if (hash === '#nfaa') {
				let prefix = window.prompt('Prefix for all related assets', $('#asset_file_root').val());
				$('#asset_file_root').val(prefix);        		
        	}
		} else {
			$("#video").attr("src", $('#ga_option_0_button_url').val());				
			$('.site, #video').show();
			$("p").removeClass("mt-5");
			$('#ga_option_0_button').attr("href", $('#ga_option_0_button_url').val()).removeAttr('data-toggle');
			$('#ga_option_1_button').attr("href", $('#ga_option_1_button_url').val()).removeAttr('data-toggle');
			$('#ga_option_2_button').attr("href", $('#ga_option_2_button_url').val()).removeAttr('data-toggle');
			$('#ga_option_3_button').attr("href", $('#ga_option_3_button_url').val()).removeAttr('data-toggle');
			$('#form input, #form select, #form textarea').attr('readonly', 'readonly');				
			$('.admin').detach();
		}
	</script>
</body>
</html>
<?
}
?>
