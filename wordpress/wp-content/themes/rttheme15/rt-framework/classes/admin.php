<?php
#-----------------------------------------
#	RT-Theme admin.php
#	version: 1.0
#-----------------------------------------

#
#	Admin Class
#

class RTThemeAdmin extends RTTheme{

	public $panel_pages = array(
		    'rt_general_options' 	=> 'General Options' ,
		    'rt_typography_options' 	=> 'Typography Options' ,
		    'rt_slider_options' 		=> 'Slider Options' ,
		    'rt_styling_options' 	=> 'Styling Options' ,
		    'rt_sidebar_options' 	=> 'Sidebar Creator' ,
		    'rt_blog_options' 		=> 'Blog Options' ,
		    'rt_portfolio_options' 	=> 'Portfolio Options' ,
		    'rt_product_options' 	=> 'Product Options',
		    'rt_contact_us' 		=> 'Contact Page Options',
		    'rt_social_options' 		=> 'Social Media Options' 
		);
	 
	
	function admin_init(){
		  
		//Theme Version
		$this->rt_get_theme_version();

		//Load Admin Functions
		$this->load_admin_functions();
		 
		//Update Notifier
		add_action('admin_menu', array(&$this,'update_notifier_menu'));		

		//Setup Admin Menu
		add_action('admin_menu', array(&$this,'rt_admin_menus'));
		
		//Load Scripts
		add_action('admin_init', array(&$this,'load_admin_scripts'));
		
		//Load Styles
		add_action('admin_init', array(&$this,'load_admin_styles'));

		//Create Metaboxes
		$this->create_metaboxes();
		
		//Flush rewrite rules
		add_action('admin_init', 'flush_rewrite_rules');
		  
	}
 
	#
	#	Load Admin Functions
	#
    
	function load_admin_functions() {
		include(THEMEFRAMEWORKDIR . "/admin/functions/shortcode_editor.php");
		include(THEMEFRAMEWORKDIR . "/admin/functions/update_notifier.php");	
	}
	
	#
	#	Update Notifier
	#
		// Adds an update notification to the WordPress Dashboard menu
		function update_notifier_menu() {  
			global $xml,$theme_data,$themeupdatestatus;
				$themeupdatestatus = get_option(THEMESLUG.'_update_notifications');
				$update = "";
				
				if($themeupdatestatus){
					$xml 		= get_latest_theme_version(NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
					$theme_data	= wp_get_theme(); // Read theme current version from the style.css
					
					if( (float)$xml->latest > (float)$theme_data['Version']) { // Compare current theme version with the remote XML version
						$update = '<span class="update-plugins count-1"><span class="update-count">'.$xml->latest.'</span></span>';
					}
				}
					 
					$k = array('update_notifications' => __("Theme Updates ",'rt_theme_admin') .@$update);
					array_merge($this->panel_pages, $k);
					$this->panel_pages = array_merge($this->panel_pages, $k);
		}
		
		
	#
	#	Javascript Messages
	#

	function javascript_messages(){
	
		$jMessages=array( 
					
					"sidebar_names_confirm" => __("Sidebar names cannot be empty.",'rt_theme_admin'),
					"sidebar_delete_confirm" => __("Do you want to delete this sidebar.",'rt_theme_admin'),
					"new_sidebar_name_confirm" => __("Write a sidebar name for the new sidebar.",'rt_theme_admin'),
					"new_sidebar_content_confirm" => __("Select contents for the sidebar.",'rt_theme_admin')
					);
		
		if($jMessages){
			echo "\n";
			echo '<script type="text/javascript">'."\n";
			echo '//<![CDATA['."\n";
				foreach($jMessages as $k => $v){
					echo 'var '.$k.'=\''.$v.'\';'."\n";
				}
			echo '//]]>'."\n";
			echo '</script>'."\n";
		} 
	
	}
	

	#
	#	Admin Panel
	#

	function rt_admin_menus(){
	
		$capability = 'edit_theme_options'; // Administrator can acsess the panel pages
		
		add_menu_page(THEMENAME, THEMENAME, $capability, 'rt_general_options', array(&$this, 'load_menu_page'), THEMEADMINURI .'/images/generic.png');
		
		foreach($this->panel_pages  as $menu_slug => $page_title){
			add_submenu_page( 'rt_general_options', $page_title, $page_title, $capability, $menu_slug , array(&$this, 'load_menu_page'));
		}
		
	
	}

	#
	#	Load Menu Pages
	#
    
	function load_menu_page(){
		
		//Javascript Messages
		$this->javascript_messages();
		
		//Admin Header
		$this->admin_header();    
		
		if($_GET['page']=="rt_sidebar_options"){
			
			if ('save' == isset($_REQUEST['action']) ) {
 
				update_option('rt_sidebar_options', $_POST);

				echo '<div class="ok_box">';
				echo '	<p>'.__('Options saved successfully', 'rt_theme_admin').'</p>';
				echo '</div>';
			}
			
			require_once(THEMEFRAMEWORKDIR . "/classes/sidebar.php");			

		}elseif($_GET['page']=="update_notifications"){//update notifier
			
			include(THEMEFRAMEWORKDIR . "/admin/pages/update_notifications.php");
			
		}else{

			include(THEMEADMINDIR . "/options/" . $_GET['page'].'.php');
			
			if ('save' == isset($_REQUEST['action']) ) {
			    $this->rt_save_options($options);
			}	
			
			//Generate this form
			$this->rt_generate_form_page($options);
			
		}

		//Admin Footer
		$this->admin_footer();
	}


	#
	#	Save Options
	#
	
	function rt_save_options($options){
		
		foreach ($options as $value) { 

		$id= isset( $value['id'] ) ? $value['id'] : "";
		$id_array=str_replace("[]","", $id);

			if( isset( $_REQUEST[$id_array] ) && is_array( $_REQUEST[$id_array] ) ){ 
				$request_value=serialize( $_REQUEST[ $id_array ] ); 
			}else{

				$request_value= isset( $_REQUEST[ $id ] ) ? stripslashes( $_REQUEST[ $id ] ) : "";
			}

			if( @isset( $request_value ) &&  ( ( isset($value['default']) && $request_value != $value['default'] ) || ( !isset($value['dont_save']) ) ) ) {
				update_option( $id, $request_value );
			}else{
				update_option( $id, '' );
			}

		}

		echo '<div class="ok_box">';
		echo '	<p>'.__('Options saved successfully', 'rt_theme_admin').'</p>';
		echo '</div>';	
	
	}

	#
	#	Load Admin Scripts
	#

	function load_admin_scripts(){
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('iphone-style-checkboxes', THEMEADMINURI . '/js/iphone-style-checkboxes.js');
		wp_enqueue_script('admin-scripts', THEMEADMINURI . '/js/script.js');
		wp_enqueue_script('color-picker', THEMEADMINURI . '/js/colorpicker.js');
		wp_enqueue_script('clue-tip', THEMEADMINURI . '/js/jquery.cluetip.min.js');
		wp_enqueue_script('jquery-tools', THEMEADMINURI . '/js/rangeinput.js');
		wp_enqueue_script('jquery-amselect', THEMEADMINURI . '/js/jquery.asmselect.js');
	}

	#
	#	Load Admin Styles
	#
	
	function load_admin_styles(){
		wp_enqueue_style('admin-style', THEMEADMINURI . '/css/admin.css');
		wp_enqueue_style('iphone-style-checkboxes', THEMEADMINURI . '/css/checkboxes.css');
		wp_enqueue_style('color-picker-style', THEMEADMINURI . '/css/colorpicker.css');
		wp_enqueue_style('clue-tip-style', THEMEADMINURI . '/css/jquery.cluetip.css');		
		add_editor_style('editor-style.css'); //editor style
	}

   
	#
	#	Get Theme Data
	#
	
	function rt_get_theme_version(){
		$theme_data = wp_get_theme();  
		return $this->version = $theme_data['Version'];
	}

	#
	#	Create Metaboxes
	#

	function create_metaboxes() {
		//load metabox class
		include(THEMEFRAMEWORKDIR . "/classes/metaboxes.php"); 
		
		//portfolio
		include(THEMEADMINDIR . "/options/portfolio_custom_fields.php"); 
		$rt_portfolio_custom_fields = new rt_meta_boxes($settings,$customFields);

		//slider
		include(THEMEADMINDIR . "/options/slider_custom_fields.php"); 
		$rt_slider_custom_fields = new rt_meta_boxes($settings,$customFields);

		//home page
		include(THEMEADMINDIR . "/options/home_custom_fields.php"); 
		$rt_home_page_custom_fields = new rt_meta_boxes($settings,$customFields);

		//products
		include(THEMEADMINDIR . "/options/product_custom_fields.php"); 
		$rt_product_custom_fields = new rt_meta_boxes($settings,$customFields);	
	}
	
	#
	#	Create Admin Header
	#

	function admin_header(){
		
		//javascript values
		echo '<script type="text/javascript">'."\n";
		echo '// <![CDATA['."\n";
		echo 'var frameworkurl="'.THEMEADMINURI.'/pages/rt-fonts.php";'."\n";
		echo '// ]]>'."\n";
		echo '</script>'."\n";
		
		
		echo '<div class="rt-admin-wrapper">';
		 
		echo '	<!-- Left Side -->';
		echo '	<div class="box left-col">';
		echo '	<!-- theme info -->';
		echo '    <div class="theme_name">'. THEMENAME .'</div>';
		echo '    <div class="theme_name_2">'.__('THEME OPTIONS','rt_theme_admin').'</div>';
		echo '    <br /><br />';
		echo '	    <div class="infoline">';
		echo '		    <div class="version">'.__('Version','rt_theme_admin').' '.$this->version.'</div> <div>|</div> <div class="version"><a href="admin.php?page=update_notifications">'.__('Changelog','rt_theme_admin').'</a></div>';
		echo '	    </div> ';
		echo '	<!-- / theme info -->';
		
		echo '	<br /><br />';
			
		echo '	<!-- theme menu -->';
		echo '	<ul class="theme_menu">';

		foreach($this->panel_pages  as $menu_slug => $page_title){
			if($_GET['page']==$menu_slug){
				$active = "active";
			}else{
				$active = "";
			}
			echo '<li class="'.$menu_slug.' '.$active.'"><a href="'.WPADMINURI.'admin.php?page='.$menu_slug.'">'.$page_title.'</a></li>';
		}
		
		echo '	</ul>';
		echo '	<!-- / theme menu -->';			
			
		echo '</div>';
		echo '<!-- / Left Side -->';
		
		echo '<!-- Right Side -->';
		echo '<div class="box right-col">';

		if($this->panel_pages[$_GET['page']]){
			echo '	<h3 class="page_title">'.$this->panel_pages[$_GET['page']].'</h3>';
			echo '	<hr /> ';
		}

	}

	#
	#	Create Admin Footer
	#

	function admin_footer(){ 
	echo <<<FOOTER
		</div>
		<!-- / Right Side -->
		
		 <div class="clear"></div>
		</div>
FOOTER;
	}

	#
	#	Create Color Pickers
	#
	
	function color_picker($id,$hex){
	 
		echo '<script type="text/javascript" language="javascript">'. "\n";
		echo 'jQuery(document).ready(function(){'. "\n";
			echo 'jQuery(\'.'.$id.'.colorSelector\').ColorPicker({'. "\n";
			echo 'color: \''.$hex.'\','. "\n";
			echo 'onShow: function (colpkr) {'. "\n";
			echo '	jQuery(colpkr).fadeIn(500);'. "\n";
			echo '	return false;'. "\n";
			echo '},'. "\n";
			echo 'onHide: function (colpkr) {'. "\n";
			echo '	jQuery(colpkr).fadeOut(500);'. "\n";
			echo '	return false;'. "\n";
			echo '},'. "\n";
			echo 'onChange: function (hsb, hex, rgb) {'. "\n";
			echo '	jQuery(\'.'.$id.'.colorSelector div\').css(\'backgroundColor\', \'#\' + hex);'. "\n";
			echo '	jQuery(\'#'.$id.'\').attr(\'value\',\'#\' + hex);'. "\n";
			echo '}'. "\n";
			echo '});'. "\n";
		echo '});'. "\n";
		echo '</script>'. "\n";
	}


	#
	#	Create Form Page
	#
	
	function rt_generate_form_page($options){
	 
		echo '<form action="admin.php?page='. $_GET['page'].'" method="POST" id="'.$_GET['page'].'">';
		$this->rt_generate_forms($options);
	    
			echo '<table>';
			echo '    <tr>';
			echo '	<td class="col1" colspan="2">';
			echo '		<input type="submit" value="'.__('Save Options','rt_theme_admin').'"> ';
			echo __('or','rt_theme_admin');
			echo ' <a href="?page=rt_general_options&reset_settings=true" class="reset" ';
			echo 'onclick="return confirm(\''.__('Are you sure that you want to reset all the theme settings?','rt_theme_admin').'\');"';
			echo '>'.__('reset settings','rt_theme_admin').'</a>';
			echo '	</td>';
			echo '</table><br />';
		
		echo '<input type="hidden" name="action" value="save" class="save">';    
		echo '</form>';
	 
	}


	#
	#	Create Admin Forms
	#

	function rt_generate_forms($options) { 
	
		foreach($options as $k => $v){
			
			$id 			=  (!empty($v['id'])) ? $v['id'] : "";
			$name 			=  (!empty($v['name'])) ? $v['name'] : "";
			$desc 			=  (!empty($v['desc'])) ? $v['desc'] : "";
			$purpose 		=  (!empty($v['purpose'])) ? $v['purpose'] : "";
			$class 			=  (!empty($v['class'])) ? $v['class'] : "";
			$fontSystem 	=  (!empty($v['font-system'])) ? $v['font-system'] : "";
			$hr 			=  (!empty($v['hr'])) ? $v['hr'] : "";
			$purpose 		=  (!empty($v['purpose'])) ? $v['purpose'] : "";
			$content_type	=  (!empty($v['content_type'])) ? $v['content_type'] : "";
			$select			=  (!empty($v['select'])) ? $v['select'] : "";
			$field_value 	= get_option($id);			


			$field_value = get_option($id);
			
			//help
			if(!empty($v['help'])){
				$help ='<td class="col3"><a class="question" href="#" rel="'.THEMEADMINURI.'/pages/help.php?tipID='.$v['id'].'&tipName='.$v['name'].'&adminURI='.THEMEADMINURI.'" title="'.$v['name'].'"></a></td>';
			}else{
				$help ='<td class="col3"> </td>';
			}
			
			//default value
			if(!empty($v['default']) && !empty($v['dont_save']) && empty($field_value)){
				$field_value=$v['default'];
			}
			
			//exact value
			if(!empty($v['value'])){
				$field_value=$v['value'];
			}		
			
			switch ($v['type']){
				#
				#	Info
				#
				case 'info';			
					
				echo '<div class="info">'.$desc.'</div>'; 		
				
				break;
							
				#
				#	Headings
				#
				case 'heading';			
				
				echo '<table class="seperator">';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><h4 class="sub_title">'.$v['name'].'</h4>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '</table>'; 		
				
				break;

				#
				#	Info Text
				#
				case 'info_text';			
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element">'.$field_value.'</div></td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';		
				
				break;
			
			
				#
				#	Text Fields
				#
				case 'text';			
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element"><input type="text" name="'.$v['id'].'" value="'.htmlentities($field_value,ENT_QUOTES, "UTF-8").'" id="'.$v['id'].'" class="'.$class.'"></div></td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';		
				
				break;
				
	
				#
				#	Button
				#
				case 'button';
				
				echo '<table>'; 
				echo '    <tr>';
				echo '	<td class="col2"><input type="button" value="'.$v['name'].'" id="'.$v['id'].'" class="'.$v['class'].' button"/>';
				echo $help;
				echo '    </tr>';
				echo '</table>';		
				
				break;
			
			
				#
				#	Upload
				#
				case 'upload';
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element upload"><input type="text" name="'.$v['id'].'" value="'.$field_value.'" id="'.$v['id'].'" class="upload_field"></div><input type="button" value="Upload" class="rttheme_upload_button '.$v['id'].' button"/>';
				echo $help;
				echo '    </tr>';
				
				
				if($field_value){
					echo '<tr><td class="col2" colspan="2">';
					echo '<div class="form_element check"><img class="loadit" src="'.$field_value.'"></div>';
					echo '<img src="'.THEMEADMINURI.'/images/delete.png" class="delete" id="delete_'.$v['id'].'">';			
					echo '</td></tr>';				
				}else{
					echo '<tr style="display:none;"><td class="col2" colspan="2">';
					echo '<div class="form_element check"><img class="loadit" src="'.THEMEADMINURI.'/images/blank.png"></div>';
					echo '<img src="'.THEMEADMINURI.'/images/delete.png" class="delete" id="delete_'.$v['id'].'">';			
					echo '</td></tr>';				
				} 
				
				
				echo '</table>';		
				
				break;
				
				#
				#	Checkbox
				#
				case 'checkbox';
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element check"><input type="checkbox" name="'.$v['id'].'"';
				    
				    if($field_value=="checked" || $field_value=="on"){
					echo ' checked="checked" '; 
				    }
				    
				echo 'id="'.$v['id'].'"/></div></td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';	 
				break;
				
				#
				#	Select
				#
				case 'select';
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				
				//font demo
				$fontDemo 	=  (!empty($v['font-demo'])) ? $v['font-demo'] : "";

				
				if(!empty($fontDemo)){
				//font-family name
				$font_family_name = isset($this->google_fonts[$field_value][0]) ? $this->google_fonts[$field_value][0] : "";					
				echo '    <tr>';
				echo '	<td class="col1" colspan="2">';
				echo '	<iframe scrolling="no" id="'.$v['id'].'_iframe" class="fontdemo" src="'.THEMEADMINURI.'/pages/rt-fonts.php?font='.$field_value.'&system='.$v['font-system'].'&family_name='.$font_family_name.'">Your browser does not support iframes.</iframe>';
				echo '	</td>';
				echo '    </tr>';
				} 

				$extraClass  =  (!empty($v['sidebuttonName'])) ? "withbutton": '';
	
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element">';
				echo '	<select name="'.$v['id'].'" id="'.$v['id'].'" class="'.$class.' '.$fontSystem.' '. $extraClass .' ">';
					
					if($select) echo '<option value="">'.$select.'</option>';
					    
					foreach($v['options'] as $option_value => $option_name){	 
						//if array
						if(is_array($option_name)){
							$option_name = $option_name[1];
							//font-family name
							$font_family_name = isset($this->google_fonts[$option_value][0]) ? $this->google_fonts[$option_value][0] : ""; 
						}else{
							$font_family_name = "";
						}
			
					    if ($field_value==$option_value){
						echo '<option value="'.$option_value.'" class="'.$font_family_name.'__" selected>'.$option_name.'</option>';
					    }else{
						echo '<option value="'.$option_value.'" class="'.$font_family_name.'___" >'.$option_name.'</option>';
					    } 
					} 
					    
				echo '	</select>';
				echo '</div></td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';		
				
				break;
	
	
				#
				#	Multiple Select
				#
				case 'selectmultiple';
				$selected = "";
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				 
	
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element">';

				
				
				if(!empty($purpose)){
					$saved_array=$v['default'];
				}else{
					$saved_array=$field_value;
					if(!is_array($saved_array)) $saved_array = unserialize($field_value);	
				}
				 
				if($select) {
					echo '<select multiple name="'.$v['id'].'" id="'.$v['id'].'" class="multiple '.$class.' '.$fontSystem.'"  title="'.$select.'">';  
				}else{
					echo '<select multiple name="'.$v['id'].'" id="'.$v['id'].'" class="multiple '.$class.' '.$fontSystem.'"  title="'.__('Select','rt_theme_admin').'">';
				}
			
					foreach($v['options'] as $option_value => $option_name){
						
						
						//if value selected
						if(is_array($saved_array)){
							
							foreach($saved_array as $a_key => $a_value){
								if (	$a_value ==  $option_value ){
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
				echo $help;
				echo '    </tr>';
				echo '</table>';		
				
				break;		
				
				
				#
				#	Color Picker
				#
				case 'colorpicker';
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element color"><input type="text" name="'.$v['id'].'" value="'.$field_value.'" id="'.$v['id'].'"></div>';
				echo '	<div class="'.$v['id'].' colorSelector"><div style="background-color: '.$field_value.'"></div></div></td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';
				
				$this ->color_picker($v['id'],$field_value);
				
				break;
	
				#
				#	Range input
				#
				case 'rangeinput';			
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element"><input type="text" class="range" name="'.$v['id'].'" id="'.$v['id'].'" min="'.$v['min'].'" max="'.$v['max'].'" step="1" value="'.$field_value.'" /></div></td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';		
				
				break;
			
				#
				#	Textarea
				#
				case 'textarea';
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element"><textarea name="'.$v['id'].'" id="'.$v['id'].'">'.htmlspecialchars($field_value).'</textarea></div>';
				echo '	</td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';
							 
				 
				break;
	
				#
				#	Div sidebar
				#
				case 'div'; 
				echo '<div id="'.$v['id'].'" class="sidebar_div '.$class.'">';
				echo '<div class="sidebar_title">'.$v['name'].'<div class="openclose '.$v['id'].'">+</div></div>'; 
				break;
	
				#
				#	Divend 
				#
				case 'divend'; 
				echo '</div>'; 
				break; 			
	
			}
		
				
				#
				#	HR
				#
				if($hr=="true") echo "<hr />";
		}
	}


}
?>
