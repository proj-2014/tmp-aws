<?php
#-----------------------------------------
#	RT-Theme metaboxes.php
#	version: 1.0
#-----------------------------------------

#
# 	Custom Fields
#
 

	class rt_meta_boxes {
		#
		# @var $prefix
		# @var $customFields
		# @var $settings
		#
		
		var $prefix = THEMESLUG;
		var $customFields;
		var $settings;
		
 
		/**
		* Constructor
		*/
		function __construct($settings,$customFields) {

			$this->settings = $settings;
			$this->customFields = $customFields;
			
			add_action( 'admin_menu', array( &$this, 'createCustomFields' ) );
			add_action( 'save_post', array( &$this, 'saveCustomFields' ) );
		}
		 
		/**
		* Create the new Custom Fields meta box
		*/
		function createCustomFields() {
			if ( function_exists( 'add_meta_box' ) ) {
				add_meta_box( $this->settings['slug'], $this->settings['name'], array( &$this, 'displayCustomFields' ), $this->settings['scope'], $this->settings['context'], $this->settings['priority'] );
			}
		}
		/**
		* Display the new Custom Fields meta box
		*/
		function displayCustomFields() {
			global $post;
			?>
			 <div class="box right-col metaboxes">
				<?php
				wp_nonce_field($this->settings['slug'], $this->settings['slug'].'_wpnonce', false, true );
				foreach ( $this->customFields as $customField ) {
					
					if(isset($customField[ 'name' ])){
						$field_value = get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true );
					}else{
						$field_value = "";
					} 				 

					if( !isset( $_GET['action'] ) && isset( $customField[ 'default' ] ) ) {
						$field_value = $customField[ 'default' ];
					} 
					
					$id				= isset( $customField[ 'name' ] ) ? $this->prefix . $customField[ 'name' ] : "";
					$title			= isset( $customField[ 'title' ] ) ? $customField[ 'title' ] : "";
					$description   	= isset( $customField[ 'description' ] ) ? $customField[ 'description' ]: ""; 
					$richEditor 	= isset( $customField[ 'richeditor' ] ) ? $customField[ 'richeditor' ]: "";
					$help 			= isset( $customField[ 'help' ] ) ? $customField[ 'help' ]: "";
					$select 		= isset( $customField[ 'select' ] ) ? $customField[ 'select' ]: "";
					$class 			= isset( $customField[ 'class' ] ) ? $customField[ 'class' ]: "";
					$font_system 	= isset( $customField[ 'font-system' ] ) ? $customField[ 'font-system' ]: "";
 
			 
			 
					// Check capability
					if ( !current_user_can( $this->settings['capability'], $post->ID ) ){
						$output = false;
					}else{
						$output = true;
					}
						
						
					// Output if allowed
					if ( $output ) { ?>

							<?php
							switch ( $customField[ 'type' ] ) {
								case "checkbox": {
									// Checkbox
									echo '<table>';
									echo '    <tr>';
									echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
									if($description) echo '<div class="desc">' . htmlspecialchars($description) . '</div>';
									echo '	</td>';
									echo '    </tr>';
									echo '    <tr>';
									echo '	<td class="col2"><div class="form_element check"><input type="checkbox" name="'.$id.'"';
									    
									    if($field_value=="checked" || $field_value=="on"){
										echo ' checked="checked" '; 
									    }
									    
									echo 'id="'.$id.'"/></div></td>';
									if(isset($customField[ 'help' ])){	echo '<td class="col3"><a class="question" href="#" rel="'.THEMEADMINURI.'/pages/help.php?tipID=' . $id.'&tipName='.$title.'&adminURI='.THEMEADMINURI.'" title="'.$title.'"></a></td>';}
									echo '    </tr>';
									echo '</table>';
									break;
								}
								
								case "select": {
									// Select
									echo '<table>';
									echo '    <tr>';
									echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
									if($description) echo '<div class="desc">' . htmlspecialchars($description) . '</div>';
									echo '	</td>';
									echo '    </tr>';
									echo '    <tr>';
									echo '	<td class="col2"><div class="form_element">';
									echo '	<select name="'.$id.'" id="'.$id.'">';
										
										if($select) echo '<option value="">'.$select.'</option>';
										
										foreach($customField['options'] as $option_value => $option_name){
										    if ($field_value==$option_value){
											echo '<option value="'.$option_value.'" selected>'.$option_name.'</option>';
										    }else{
											echo '<option value="'.$option_value.'">'.$option_name.'</option>';
										    }
										} 
										    
									echo '	</select>';
									echo '</div></td>';
									if(isset($customField[ 'help' ])){	echo '<td class="col3"><a class="question" href="#" rel="'.THEMEADMINURI.'/pages/help.php?tipID=' . $id.'&tipName='.$title.'&adminURI='.THEMEADMINURI.'" title="'.$title.'"></a></td>';}
									echo '    </tr>';
									echo '</table>';									
									break;
								}

 
								case 'selectmultiple':{
									$selected  = "";
									
									//Multiple Select
									echo '<table>';
									echo '    <tr>';
									echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
									if($description) echo '<div class="desc">'.htmlspecialchars($description).'</div>';
									echo '	</td>';
									echo '    </tr>';
									 
						
									echo '    <tr>';
									echo '	<td class="col2"><div class="form_element">';
						
									
									$saved_array=$field_value; 
						 
						
									echo '<select multiple name="'.$id.'" id="'.$id.'" class="multiple '.$class.' '.$font_system.'"  title="'.__('Select','rt_theme_admin').'">';
								
										foreach($customField['options'] as $option_value => $option_name){
											
											
											//if value selected
											if(is_array($saved_array)){
												
												foreach($saved_array as $a_key => $a_value){
													if ( $a_value ==  $option_value ){
														$selected="selected";
													}
													
												}
											}
								
											//if array
											if(is_array($option_name)){
												$option_name = $option_name[1];
											}
											
											if(!$option_value) $option_value=" ";
								
											echo '<option value="'.$option_value.'" '.$selected.'>'.$option_name.'</option>';
											$selected="";
										}
										
						
									echo '	</select>';
									echo '</div></td>';
									echo @$help;
									echo '    </tr>';
									echo '</table>';		
								
									break;
								}
			 
								case 'textarea':{
									// Textarea
								
									echo '<table>';
									echo '    <tr>';
									echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
									if($description) echo '<div class="desc">' . htmlspecialchars($description) . '</div>';
									echo '	</td>';
									echo '    </tr>';
									echo '    <tr>';
									echo '	<td class="col2"><div class="form_element"><textarea name="'.$id.'" id="'.$id.'">'.htmlspecialchars($field_value).'</textarea></div>';
									echo '	</td>';
									if(isset($customField[ 'help' ])){	echo '<td class="col3"><a class="question" href="#" rel="'.THEMEADMINURI.'/pages/help.php?tipID=' . $id.'&tipName='.$title.'&adminURI='.THEMEADMINURI.'" title="'.$title.'"></a></td>';}
									echo '    </tr>';
									echo '</table>';
					
									break;
								}
								
								case "upload": {
									// rt-upload button																		
									
									echo '<table>';
									echo '    <tr>';
									echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
									if($description) echo '<div class="desc">' . htmlspecialchars($description) . '</div>';
									echo '	</td>';
									echo '    </tr>';
									echo '    <tr>';
									echo '	<td class="col2"><div class="form_element upload"><input type="text" name="'.$id.'" value="'.$field_value.'" id="'.$id.'" class="upload_field"></div><input type="button" value="Upload" class="rttheme_upload_button '.$id.' button"/>';
									if(isset($customField[ 'help' ])){	echo '<td class="col3"><a class="question" href="#" rel="'.THEMEADMINURI.'/pages/help.php?tipID=' . $id.'&tipName='.$title.'&adminURI='.THEMEADMINURI.'" title="'.$title.'"></a></td>';}
									echo '    </tr>';
									
									
									if($field_value){
										echo '<tr><td class="col2" colspan="2">';
										echo '<div class="form_element check"><img class="loadit" src="'.$field_value.'"></div>';
										echo '<img src="'.THEMEADMINURI.'/images/delete.png" class="delete" id="delete_'.$id.'">';			
										echo '</td></tr>';				
									}else{
										echo '<tr style="display:none;"><td class="col2" colspan="2">';
										echo '<div class="form_element check"><img class="loadit" src="'.THEMEADMINURI.'/images/blank.png"></div>';
										echo '<img src="'.THEMEADMINURI.'/images/delete.png" class="delete" id="delete_'.$id.'">';			
										echo '</td></tr>';				
									} 
									
									echo '</table>';	

									break;
								}
								
								case 'heading':	{		
											
									echo '<table class="seperator">';
									echo '    <tr>';
									echo '	<td class="col1" colspan="2"><h4 class="sub_title">'.$title.'</h4>';
									echo '	    <div class="desc">'.htmlspecialchars($description).'</div>';
									echo '	</td>';
									echo '    </tr>';
									echo '</table>';
									
									break;
								}

								#
								#	Range input
								#
								case 'rangeinput':	{		
								
									echo '<table>';
									echo '    <tr>';
									echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$title.'</label>';
									if($description) echo '<div class="desc">'.htmlspecialchars($description).'</div>';
									echo '	</td>';
									echo '    </tr>';
									echo '    <tr>';
									echo '	<td class="col2"><div class="form_element"><input type="text" class="range" name="'.$id.'" id="'.$id.'" min="'.@$customField[ 'min' ].'" max="'.@$customField[ 'max' ].'" step="1" value="'.$field_value.'" /></div></td>';
									echo $help;
									echo '    </tr>';
									echo '</table>';		
									
									break;
								}
								
								default: {
									// Plain text field 
								
									echo '<table>';
									echo '    <tr>';
									echo '	<td class="col1" colspan="2"><label for="' . $id .'">' . $title . '</label>';
									if($description) echo '<div class="desc">' . htmlspecialchars($description) . '</div>';
									echo '	</td>';
									echo '    </tr>';
									echo '    <tr>';
									echo '	<td class="col2"><div class="form_element"><input type="text" name="'. $id .'" value="'.$field_value.'" id="' . $id .'"></div></td>';
									if(isset($customField[ 'help' ])){	echo '<td class="col3"><a class="question" href="#" rel="'.THEMEADMINURI.'/pages/help.php?tipID=' . $id.'&tipName='.$title.'&adminURI='.THEMEADMINURI.'" title="'.$title.'"></a></td>';}
									echo '    </tr>';
									echo '</table>';
								}
							}

							//	HR
							if(isset($customField[ 'hr' ])=="true") echo "<hr />";

							?>						

					<?php
					}
				} ?>
			</div>
			<?php
		}


		#
		# find vimeo and youtube id from url
		#
		function find_tube_video_id($url){
			$tubeID="";
		
			if( strpos($url, 'youtube')  ) {	
				$tubeID=parse_url($url, PHP_URL_QUERY);			
				$tubeID=str_replace("/", "", $tubeID);
				$v= preg_split('/&|=/', $tubeID);
				$tubeID = $v[1];
			}
			
			if( strpos($url, 'vimeo')  ) {
				$tubeID=parse_url($url, PHP_URL_PATH);			
				$tubeID=str_replace("/", "", $tubeID);	
			}	
		
			return $tubeID;
		}
		
		#
		# Save Images into the uploads dir
		#
		function get_content($url)
		{
		    $ch = curl_init();
		
		    curl_setopt ($ch, CURLOPT_URL, $url);
		    curl_setopt ($ch, CURLOPT_HEADER, 0);
		
		    ob_start();
		
		    curl_exec ($ch);
		    curl_close ($ch);
		    $string = ob_get_contents();
		
		    ob_end_clean();
		   
		    return $string;    
		}

		function save_video_images($url){
			
			$saved_image_url ="";
			
			//find the video id
			$video_id = $this->find_tube_video_id($url);
			
			//get uploads dir of WP
			$uploads = wp_upload_dir();
			
			//wich service
			if( strpos($url, 'youtube')  ) $type = 'youtube';			
			if( strpos($url, 'vimeo')  ) $type = 'vimeo';


			if( function_exists('file_get_contents') ) {
				if(isset($type) && isset($video_id)){
				
					//Youtube image					
					if($type=='youtube') $image = 'http://img.youtube.com/vi/'.$video_id.'/0.jpg';
				
					//Vimeo image					
					if($type=='vimeo'){
						$hash = @unserialize($this->get_content("http://vimeo.com/api/v2/video/$video_id.php"));
						if($hash) $image = $hash[0]['thumbnail_large'];
					}
				
					if($image){
						$save_as = $uploads['path'].'/'.$video_id.'-'.$type.'.jpg';
						$get_image = @$this->get_content($image);
						if($get_image){
							@file_put_contents($save_as, $get_image);
							$saved_image_url = $uploads['url'].'/'.$video_id.'-'.$type.'.jpg';
						}
					}
				}	
			}
			
			return $saved_image_url;
		}


		#
		# Save the new Custom Fields values
		# 
		function saveCustomFields( $post_id ) {
			global $post;
			$theFields = isset ( $_POST[ $this->settings['slug'].'_wpnonce' ] )  ? $_POST[ $this->settings['slug'].'_wpnonce' ] : "" ;

			if (!wp_verify_nonce( $theFields, $this->settings['slug'] ) )
				return $post_id;
			
			foreach ( $this->customFields as $customField ) {
				
				$customField_Name = @$customField['name'];
			
				if ( current_user_can( $this->settings['capability'], $post_id ) ) {
					
					$value = @$_POST[ $this->prefix . str_replace("[]","", $customField['name']) ];				
								
								//save tube image
								if($this->prefix . @$customField[ 'name' ] == $this->prefix .'_portfolio_video'){							
									
									$save_tube_thumbnail = $this->save_video_images($value);							
		
									//update thumbnail
									if($save_tube_thumbnail) {
										update_post_meta( $post_id, $this->prefix . '_portfolio_video_thumbnail', $save_tube_thumbnail );
									}else{
										delete_post_meta( $post_id, $this->prefix . '_portfolio_video_thumbnail' );
									}
								}
								
								
					if ( isset( $_POST[ $this->prefix . $customField_Name ] ) || isset( $_POST[ $this->prefix . str_replace("[]","", @$customField['name']) ] )  ) {								
						update_post_meta( $post_id, $this->prefix . $customField_Name, $value );
					} else {
						delete_post_meta( $post_id, $this->prefix . $customField_Name );
					}
				}
			}
		}
		 
	} // End Class
 
?>