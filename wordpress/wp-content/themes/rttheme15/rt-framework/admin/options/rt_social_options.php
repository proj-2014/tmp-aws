<?php 
$options = array ();
	foreach($this->social_media_icons as $key => $value){
			array_push($options, 
						array(
						"name" 	=> $key. __(" icon link",'rt_theme_admin'), 
						"id" 	=> THEMESLUG."_".$value."",
						"type" 	=> "text", "hr" => "true"
						)
					);  
	} 
?>