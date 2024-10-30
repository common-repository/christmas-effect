<?php
/*
Plugin Name: Christmas Effect
Description: Christmas is coming and you might want to put some effects on your web page.
Version: 1.0
Requires at least: 4.0
Tested up to: 4.8
Author: php-developer  
Author URI: https://profiles.wordpress.org/php-developer-1
Contributors: php-developer 
Tags: blog,snow effect, celebration, Christmas, Christmas ecommerce,Christmas store,Christmas sales, Christmas sell,Christmas shop,Christmas cart, Christmas woo commerce
License: GPLv2 or later   
License URI: http://www.gnu.org/licenses/gpl-2.0.html 
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
add_action( 'admin_menu', 'ce_add_admin_menu' );
add_action( 'admin_init', 'ce_settings_init' );
add_action( 'wp_enqueue_scripts', 'snoweffect_scripts_basic',999 );

function ce_add_admin_menu(){ 
    add_menu_page( 'Christmas Effect', 'Christmas Effect', 'manage_options', 'christmas_effect', 'ce_options_page' );
}
function ce_settings_init(  ) { 

    register_setting( 'pluginPage', 'ce_settings' );

    add_settings_section(
        'ce_pluginPage_section', 
        __( 'Setup Effect on your website.', 'wordpress' ), 
        'ce_settings_section_callback', 
        'pluginPage'
    );
    /// this section for turn off that effect or now
    add_settings_field( 
        'ce_checkbox_active', 
        __( 'Tick mark to Disable', 'wordpress' ), 
        'ce_checkbox_active_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    +/// this new section is for setfull default settings 
    add_settings_field( 
        'ce_checkbox_default', 
        __( 'Apply Default Settings.', 'wordpress' ), 
        'ce_checkbox_default_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    /// seting to get class name / ID where you need to set effects
    add_settings_field( 
        'ce_text_classnames', 
        __( 'Enter ID or class name', 'wordpress' ), 
        'ce_text_classnames_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    
    /// seting to set character
    add_settings_field( 
        'ce_text_character', 
        __( 'Enter character for show effects', 'wordpress' ), 
        'ce_text_character_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    
    /// seting to set know effect colors
    add_settings_field( 
        'ce_text_colors', 
        __( 'Enter color code for show effects', 'wordpress' ), 
        'ce_text_colors_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    
    /// seting to set speed effects
    add_settings_field( 
        'ce_text_speed', 
        __( 'Enter Speed for show effects', 'wordpress' ), 
        'ce_text_speed_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    
    /// seting to set Height effects
    add_settings_field( 
        'ce_text_height', 
        __( 'Enter Height for show effects', 'wordpress' ), 
        'ce_text_height_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    
    /// seting to set frequency effects
    add_settings_field( 
        'ce_text_frequency', 
        __( 'Enter frequency for show effects', 'wordpress' ), 
        'ce_text_frequency_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    
    /// seting to set small size effects
    add_settings_field( 
        'ce_text_small', 
        __( 'Enter size for small Character', 'wordpress' ), 
        'ce_text_small_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    
    /// seting to set large size effects
    add_settings_field( 
        'ce_text_large', 
        __( 'Enter size for large Character', 'wordpress' ), 
        'ce_text_large_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    
    /// seting to set rotation effects
    add_settings_field( 
        'ce_text_rotation', 
        __( 'Enter element rotation', 'wordpress' ), 
        'ce_text_rotation_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    
    /// seting to set rotationVariance effects
    add_settings_field( 
        'ce_text_rotationvariance', 
        __( 'Enter element rotation Variance', 'wordpress' ), 
        'ce_text_rotationvariance_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    
    /// seting to set startRotation effects
    add_settings_field( 
        'ce_text_startrotation', 
        __( 'Enter element start Rotation Variance', 'wordpress' ), 
        'ce_text_startrotation_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    
    /// seting to set wind effects
    add_settings_field( 
        'ce_text_wind', 
        __( 'Enter value for wind', 'wordpress' ), 
        'ce_text_wind_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    
    /// seting to set wind effects
    add_settings_field( 
        'ce_text_windvariance', 
        __( 'Enter wind Variance', 'wordpress' ), 
        'ce_text_windvariance_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    
     
    /// if you want to show on WooCommerce Product details image t.
    add_settings_field( 
        'ce_select_product_image', 
        __( 'Do you want to show on WooCommer Product image ?', 'wordpress' ), 
        'ce_select_product_image_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    
    /// setting for WooCommerce image Charactor
    add_settings_field( 
        'ce_text_WooCommerce', 
        __( 'Enter Charactor for WooCommerce', 'wordpress' ), 
        'ce_text_WooCommerce_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    /// setting for WooCommerce image Charactor color
    add_settings_field( 
        'ce_text_WooCommerce_color', 
        __( 'Enter Charactor for WooCommerce color', 'wordpress' ), 
        'ce_text_WooCommerce_color_render', 
        'pluginPage', 
        'ce_pluginPage_section' 
    );
    

}


function ce_checkbox_active_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='checkbox' name='ce_settings[ce_checkbox_active]' <?php checked( $options['ce_checkbox_active'], 1 ); ?> value='1'>     <br/> 
    <?php

}
function ce_checkbox_default_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='checkbox'  name='ce_settings[ce_default_active]' <?php checked( $options['ce_default_active'], 1 ); ?> value='1'>    <br/> 
    <?php
    echo _e('This will apply Default Settings. Below setting will not apply.'); 

}
function ce_text_classnames_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='text' placeholder="Eg .myClass #myId" name='ce_settings[ce_text_classnames]' value='<?php echo $options['ce_text_classnames']; ?>'>       <br/> 
    <?php
    echo _e('You have to add class name with period (.) and Elements ID by Hash (#). You can add multipal elements by space. Example <b>.home #comments .mycunstomClass</b>'); 
}
function ce_text_colors_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='text' placeholder='Eg "red" '  name='ce_settings[ce_text_colors]' value='<?php echo $options['ce_text_colors']; ?>'>    <br/> 
    <?php
    echo _e('You can add multipal color name with comma(,) separator like this Example <b>Red, Green, Blue, #ffd705</b>'); 
}
function ce_text_character_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='text' placeholder="Eg * ~ # ^ A X Z" name='ce_settings[ce_text_character]' value='<?php echo $options['ce_text_character']; ?>'>    <br/> 
    <?php
    echo _e('You can add any character which you want to display as snow effect. Example <b>* ~ # ^ A X Z</b>'); 
}
function ce_text_speed_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='text' disabled="disabled" placeholder="Eg 5000" name='ce_settings[ce_text_speed]' value='<?php echo $options['ce_text_speed']; ?>'>     <br/> 
    <?php
    echo _e('You can add integer number only for snow speed. <b>Low number is equal to High speed. Eg: 500 = High Speed and 5000 = Slow Speed</b>'); 
}
function ce_text_height_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='text' disabled="disabled" placeholder="Eg 500" name='ce_settings[ce_text_height]' value='<?php echo $options['ce_text_height']; ?>'>    <br/> 
    <?php
     echo _e('Add integer number only for snow effect height. <b>It Will set from Top to Bottom.</b>'); 
}
function ce_text_frequency_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='text' disabled="disabled" maxlength="3" placeholder="Eg 50" name='ce_settings[ce_text_frequency]' value='<?php echo $options['ce_text_frequency']; ?>'>     <br/> 
    <?php
    echo _e('Add integer number only for frequency. <b>Low number is equal to more frequency.</b>'); 
}
function ce_text_small_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='text' disabled="disabled" maxlength="3" placeholder="Eg 15" name='ce_settings[ce_text_small]' value='<?php echo $options['ce_text_small']; ?>'>     <br/> 
    <?php
    echo _e('Add integer number only for smallest text size. <b>Low number is smaller text.</b>'); 
}
function ce_text_large_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='text' disabled="disabled" name='ce_settings[ce_text_large]' placeholder="Eg 45"  value='<?php echo $options['ce_text_large']; ?>'>   <br/> 
    <?php
    echo _e('Add integer number only for Largest text size. <b>High number is Largest text.</b>'); 
}
function ce_text_rotation_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='text' disabled="disabled" name='ce_settings[ce_text_rotation]' placeholder="Eg 90" value='<?php echo $options['ce_text_rotation']; ?>'>   <br/> 
    <?php
    echo _e('Add integer number only for text rotation. <b>High number is more rotation.</b>'); 
}
function ce_text_rotationvariance_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='text' disabled="disabled" name='ce_settings[ce_text_rotationvariance]' placeholder="Eg 25"  value='<?php echo $options['ce_text_rotationvariance']; ?>'>    <br/> 
    <?php
    echo _e('Add integer number only for text rotation variance. <b>High number for more variance.</b>'); 
}
function ce_text_startrotation_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='text' disabled="disabled" name='ce_settings[ce_text_startrotation]' placeholder="Eg 45" value='<?php echo $options['ce_text_startrotation']; ?>'>     <br/> 
    <?php
    echo _e('Add integer number for setup starting position of rotation. <b>High number for more rotation.</b>'); 
}
function ce_text_wind_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='text' disabled="disabled" name='ce_settings[ce_text_wind]' value='<?php echo $options['ce_text_wind']; ?>'>
    <?php
    echo _e('Add integer number for setup wind speed. <b>High number for more wind.</b>'); 
}
function ce_text_windvariance_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='text' disabled="disabled" name='ce_settings[ce_text_windvariance]' value='<?php echo $options['ce_text_windvariance']; ?>'>    <br/>  
    <?php
    echo _e('Add integer number for setup wind variance. <b>High number for more variance for each elements.</b>');
}
function ce_text_WooCommerce_color_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    <input type='text' disabled="disabled" name='ce_settings[ce_text_WooCommerce_color]' value='<?php echo $options['ce_text_WooCommerce_color']; ?>'>    <br/>  
    <?php
    echo _e('Add color code (single code only).</b>');
}

function ce_select_product_image_render(  ) {  
    $options = get_option( 'ce_settings' );
    ?>
    <select disabled="disabled" name='ce_settings[ce_select_product_image]'>
        <option value='1' <?php selected( $options['ce_select_product_image'], 1 ); ?>>Yes</option>
        <option value='2' <?php selected( $options['ce_select_product_image'], 2 ); ?>>No</option>
    </select> <br/>                             
<?php   echo _e('Select Yes to show only snow effect on your Product details page main images. Note <b>Only Details page</b>');                                    
}

function ce_text_WooCommerce_render(  ) { 

    $options = get_option( 'ce_settings' );
    ?>
    
      <input disabled="disabled" type='text' placeholder="* ~" name='ce_settings[ce_text_WooCommerce]' value='<?php echo $options['ce_text_WooCommerce']; ?>'>       <br/> 
    <?php
       echo _e('This will apply on WooCommerce image element on detail page.'); 
}
                                        
function ce_settings_section_callback(  ) { 
    echo __( 'From section you can setup effect and other option as per you need and requirement on you website.', 'wordpress' );
}


function ce_options_page() { 
?>
<form action='options.php' method='post'>
        <h2>Christmas Effect</h2>
        <?php
        settings_fields( 'pluginPage' );
        do_settings_sections( 'pluginPage' );
        submit_button();        
        ?>
</form>
<?php
}
function snoweffect_scripts_basic()
{      
    
    // Register the script like this for a plugin:
    wp_register_script( 'custom-script', plugins_url( '/js/jquery.flurry.min.js', __FILE__ ) );
    // Register the script like this for a theme:
    wp_register_script( 'custom-script', get_template_directory_uri() . '/js/jquery.flurry.min.js',$deps = array(), $ver = false, $in_footer = false  );  
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'custom-script' );
}



add_action('wp_head','snoweffect_scripts_basic');  


add_action('admin_head','snoweffect_scripts_basic');
add_action('admin_footer','codeforsnow'); 

function codeforsnow(){
    $options = get_option( 'ce_settings' ); 
     
    if(isset($options['ce_text_classnames'])  && $options['ce_text_classnames']!='' ){
        
        $class_name = (explode(" ",$options['ce_text_classnames']));
    }else{
        $class_name[] = 'body';
    }
    //character
    if(isset($options['ce_text_character']) && $options['ce_text_character']!=''  ){
        
        $character_name = $options['ce_text_character'];
    }else{
        $character_name = '❄';
    }
    if(isset($options['ce_text_colors']) && $options['ce_text_colors']!=''){ 
    
         $colors_name = explode(",",$options['ce_text_colors']);
         for($j=0;$j<count($colors_name);$j++){
             $colors_string .= '"'.$colors_name[$j].'",';
         } 
         $colors_name = NULL;        
         $colors_name = rtrim($colors_string,",");
    }
    //$colors_name = '"red","blue","green"';     woocommerce-product-gallery
    if(isset($options['ce_text_speed']) && $options['ce_text_speed']!=''){          
        $speed_name = $options['ce_text_speed'];
    } 
    if(isset($options['ce_text_height']) && $options['ce_text_height']!=''){          
        $height_name = $options['ce_text_height'];
    }
    if(isset($options['ce_text_frequency']) && $options['ce_text_frequency']!=''){          
        $frequency_name = $options['ce_text_frequency'];
    }
    if(isset($options['ce_text_small']) && $options['ce_text_small']!=''){          
        $small_name = $options['ce_text_small'];
    }
    if(isset($options['ce_text_large']) && $options['ce_text_large']!=''){          
        $large_name = $options['ce_text_large'];
    }
    if(isset($options['ce_text_rotation']) && $options['ce_text_rotation']!=''){          
        $rotation_name = $options['ce_text_rotation'];
    }
    if(isset($options['ce_text_rotationvariance']) && $options['ce_text_rotationvariance']!=''){          
        $rotationvariance_name = $options['ce_text_rotationvariance'];
    }
    if(isset($options['ce_text_startrotation']) && $options['ce_text_startrotation']!=''){          
        $startrotation_name = $options['ce_text_startrotation'];
    }
    if(isset($options['ce_text_wind']) && $options['ce_text_wind']!=''){          
        $wind_name = $options['ce_text_wind'];
    }
    if(isset($options['ce_text_windvariance']) && $options['ce_text_windvariance']!=''){          
        $windvariance_name = $options['ce_text_windvariance'];
    }
    if(isset($options['ce_select_product_image']) && $options['ce_select_product_image']!=''){          
        $wooComm = $options['ce_select_product_image'];
    }
    if(isset($options['ce_text_WooCommerce']) && $options['ce_text_WooCommerce']!=''){          
        $wooComm_imag = $options['ce_text_WooCommerce'];
    }else{
          $wooComm_imag = '❄';
    }
    if(isset($options['ce_text_WooCommerce_color']) && $options['ce_text_WooCommerce_color']!=''){          
        $wooComm_imag_color = $options['ce_text_WooCommerce_color'];
    }else{
          $wooComm_imag_color = 'white';
    }
    
    
    
    if($options['ce_checkbox_active']!='1'){     
         
    ?>    
    <script type="text/javascript"> ///keyur
      jQuery(document).ready( function() {
         <?php if($_REQUEST['page']!='christmas_effect' && is_admin()){ ?>
               //ce_start_effect();
         <?php }else { ?>
         ce_start_effect();
         <?php } ?>
        
      });
      
      function ce_start_effect(){ 
          
         <?php if($wooComm=='1'){ ?>
        
          jQuery('.woocommerce-product-gallery').flurry({ character: "<?php echo $wooComm_imag; ?>", color: ['<?php echo $wooComm_imag_color; ?>']});
         <?php } ?> 
          
        <?php if($options['ce_default_active']=='1'  ){ ?>
        
        jQuery('body').flurry();  
        
        <?php }else{
            
        for($i=0;$i<count($class_name);$i++){ 
        $cls_name = $class_name[$i];   
        ?>
        jQuery('<?php echo $cls_name; ?>').flurry({
              <?php if(isset($character_name)){?>
              character: "<?php echo $character_name; ?>",
              <?php } ?>
              <?php if(isset($colors_name)){?>
              color: [<?php echo $colors_name; ?>],
              <?php } ?>
              <?php if(isset($speed_name)){?>
              speed: ['<?php echo $speed_name; ?>'],
              <?php } ?>
              <?php if(isset($height_name)){?>
              height:['<?php echo $height_name; ?>'],
              <?php } ?>
               <?php if(isset($frequency_name)){?>
              frequency: ['<?php echo $frequency_name; ?>'],
              <?php } ?>
               <?php if(isset($small_name)){?>
              small: ['<?php echo $small_name; ?>'],
              <?php } ?>              
               <?php if(isset($large_name)){?>
              large:['<?php echo $large_name; ?>'],
               <?php } ?>               
               <?php if(isset($rotation_name)){?>
              rotation: ['<?php echo $rotation_name; ?>'],
               <?php } ?>
               <?php if(isset($rotationvariance_name)){?>
              rotationVariance: ['<?php echo $rotationvariance_name; ?>'],
               <?php } ?>
               <?php if(isset($startrotation_name)){?>
              startRotation: ['<?php echo $startrotation_name; ?>'],
               <?php } ?>
               <?php if(isset($wind_name)){?>
              wind: ['<?php echo $wind_name; ?>'],
              <?php } ?>
              <?php if(isset($windvariance_name)){?>
              windVariance: ['<?php echo $windvariance_name; ?>'],
              <?php } ?>
              opacityEasing: "cubic-bezier(1,0,.96,.9)"
            });           
        <?php 
        }
        } ?>
        }
    </script>
<?php    
    }
}
add_action('wp_footer','codeforsnow',999);   
//http://wpsettingsapi.jeroensormani.com/
?>