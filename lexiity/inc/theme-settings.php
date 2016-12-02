<?php
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
    tk_theme_install();
}
function populate_theme_options(){
    GLOBAL $tabs,$wp_version;
    $pages = @get_all_pages();
    foreach ($tabs as $r1) {
        foreach ($r1 as $r2) {
            if (count($r2) > 0) {
                foreach ((array)$r2 as $r3) {
                    if(@$r3['value'] != '' && strlen($r3['name']) != 1 && $r3['type'] != 'select' && $r3['type'] != 'radio' && $r3['type'] != 'checkbox'){
                        if ( version_compare( $wp_version, '3.4', '>=' ) ) {update_option(wp_get_theme().'_'.$r1['id'].'_'.$r3['name'], $r3['value']);}else{update_option(get_current_theme().'_'.$r1['id'].'_'.$r3['name'], $r3['value']);}
                    }
                }
            }
        }
    }
}

function tk_theme_install() {
   global $wpdb;
   populate_theme_options(); //populate options from file
}

add_action('wp_head', 'tk_theme_head', 99);

function tk_theme_head(){
    if(isset($_REQUEST['ipn'])){
        if($_REQUEST['ipn'] == 'paypal'){
            include("ipn_paypal.php");
        }//ipn from paypal
        if($_REQUEST['ipn'] == '2co'){
            include("ipn_2co.php");
        }//ipn from 2checkout.com
    }//isset ipn
}

function get_theme_option($option_name){
    GLOBAL $tabs;
    $option_value = get_option($option_name);

    if(is_array($option_value)){
        if(count($option_value) > 2){
            return stripslashes_deep($option_value);
        }else{
            return (stripslashes($option_value['0']));
        }
    }else{
        if($option_value != ''){
            return (stripslashes($option_value));
        }
    }
}

function my_admin_scripts() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('my-upload');
}

function my_admin_styles() {
    wp_enqueue_style('thickbox');
}

if (isset($_GET['page']) && isset($_GET['page'])) {
    add_action('admin_print_scripts', 'my_admin_scripts');
    add_action('admin_print_styles', 'my_admin_styles');
}

add_action('admin_head', 'includeScript');

function get_first_tab() {
    GLOBAL $tabs;
    require_once('admin-settings.php');
    $i = 0;
    foreach ($tabs as $tab) {
        if ($tab['pg']['slug'] == $_GET['page']) {
            if ($i == 0) {
                return $tab['id'];
            }
        }
    }
}

function get_all_pages() {
    GLOBAL $tabs;
    $pages = array();
    require_once('admin-settings.php');
    $i = 0;
    $last_val = '';
    foreach ((array)$tabs as $tab) {
        if ($last_val != $tab['pg']) {
            $pages[] = $tab['pg'];
            $last_val = $tab['pg'];
        }
    }
    return $pages;
}

function includeScript() {
    ?>
<script type='text/javascript'>

       jQuery(document).ready(function() {

       var formfield;
           jQuery('.st_upload_button').click(function() {
               formfield ='checker';
               targetfield = jQuery(this).prev('.upload-url');
               post_id = '';
               tb_show('', 'media-upload.php?post_id='+post_id+'&type=image&amp;TB_iframe=true');
               return false;
           });

     window.original_send_to_editor = window.send_to_editor;
     window.send_to_editor = function(html){

       if (formfield) {
                    imgurl = jQuery(html).attr('href');
                    jQuery(targetfield).val(imgurl);
                    formfield = null;
                    tb_remove();
               }

               else {
           window.original_send_to_editor(html);
                       formfield = null;
       }
           }

// Repeatable meta boxes
    jQuery('.repeatable-add').click(function() {
        field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
        fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
        jQuery('.upload-url', field).val('').attr('name', function(index, name) {
            return name.replace(/(\d+)/, function(fullMatch, n) {
                return Number(n) + 1;
            });
        })
        field.insertAfter(fieldLocation, jQuery(this).closest('td'))
        return false;
    });

    jQuery('.repeatable-remove').click(function(){
        jQuery(this).parent().remove();
        return false;
    });

<?php
function check_is_admin_post(){
$current_page = basename($_SERVER['REQUEST_URI'], ".php");
if (preg_match("/post-new/i", $current_page) || isset($_GET['post'])) {
return true;
    }else{
        return false;
    }
}

if(check_is_admin_post()){
?>
    jQuery('.custom_repeatable').sortable({
        opacity: 0.6,
        revert: true,
        cursor: 'move',
        handle: '.sort'
    });
        <?php } ?>

           jQuery( ".admin-datepicker" ).datepicker({ dateFormat: "dd-mm-yy" });


       });

</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri().'/script/jscolor/jscolor.js';?>"></script>

       

    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri().'/script/jscolor/jscolor.js';?>"></script>
    <link rel="stylesheet" media="screen" href="<?php echo get_stylesheet_directory_uri().'/script/datepicker/css/smoothness/jquery-ui-1.10.3.custom.css';?>" type="text/css" />
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri().'/script/datepicker/js/jquery-ui-1.10.3.custom.min.js';?>"></script>


    <?php
}


add_action('admin_menu', 'tk_settings_page_init');
$tabs = '';

function tk_settings_page_init() {
    global $wp_version;
    $tk_theme_name = get_option('tk_theme_name');
    $pages = @get_all_pages();
    if ( version_compare( $wp_version, '3.4', '>=' ) ) {$theme_data = wp_get_theme(TEMPLATEPATH . '/style.css');}else{$theme_data = get_theme_data(TEMPLATEPATH . '/style.css');}
    $settings_page = '';
    for ($i = 0; $i <= count($pages) - 1; $i++) {
        if ($i == 0) {
            $settings_page .= add_menu_page($pages[$i]['slug'], ucfirst(tk_theme_name), 'edit_theme_options', $pages[$i]['slug'], 'tk_settings_page');
            $settings_page .= add_submenu_page($pages[0]['slug'], $pages[$i]['page_title'], $pages[$i]['menu_title'], 'edit_theme_options', $pages[$i]['slug'], 'tk_settings_page');
        } else {
            $settings_page .= add_submenu_page($pages[0]['slug'], $pages[$i]['page_title'], $pages[$i]['menu_title'], 'edit_theme_options', $pages[$i]['slug'], 'tk_settings_page');
        }
    }
}

    if (@$_POST["ilc-settings-submit"] == 'Y') {
        if (@$_GET['tab'] == '') {
            $tab = get_first_tab();
        } else {
            $tab = @$_GET['tab'];
        }
        $required_error = 0;

        foreach ($_POST as $var => $value) {
            if ($var != '_wpnonce' && $var != '_wp_http_referer' && $var != 'Submit' && $var != 'ilc-settings-submit' && !preg_match("/_required/i", $var)) {//$_POST variables which we don't want to save as options
                if (@$_POST[$var . '_required'] == 'yes') {
                    if ($_POST[$var] == '') {
                        $required_error++;
                    }
                }
            }
        }

        if ($required_error == 0) {
            tk_save_theme_settings();
            $url_parameters = isset($tab) ? 'updated=true&tab=' . $tab : 'updated=true';
        } else {
            $url_parameters = isset($tab) ? 'error=true&tab=' . $tab : 'error=true';
        }
        wp_redirect(admin_url('admin.php?page=' . $_GET['page'] . '&' . $url_parameters));
    }
    
    
function tk_advert() {
    include('advert-widget.php');
}

function tk_save_theme_settings() {
    global $pagenow;
    $tk_theme_name = get_option('tk_theme_name');
    if (@$_GET['tab'] == '') {
        $tab = get_first_tab();
    } else {
        $tab = @$_GET['tab'];
    }
    if ($pagenow == 'admin.php' && isset($_GET['page'])) {
        if (isset($tab)) {

            foreach ($_POST as $var => $value) {
                if ($var != '_wpnonce' && $var != '_wp_http_referer' && $var != 'Submit' && $var != 'ilc-settings-submit' && !preg_match("/_required/i", $var)) {//$_POST variables which we don't want to save as options
                    update_option($tk_theme_name.'_'.$tab . '_' . $var, $value);
                }
            }
        }
    }
}

function tk_admin_tabs($current) {
    GLOBAL $tabs;

    if ($current == '') {
        $current = get_first_tab();
    }

    require_once('admin-settings.php');

    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';

    $i = 0;
    foreach ($tabs as $tab) {
        if ($tab['pg']['slug'] == $_GET['page']) {
            if ($i == 0) {
                $i++;
            }
            $class = ( $tab['id'] == $current ) ? ' nav-tab-active' : '';
            echo '<a class="nav-tab' . $class . '"  href="?page=' . $_GET['page'] . '&tab=', $tab['id'], '">', $tab['name'], '</a>';
        }
    }
    echo '</h2>';
}

function tk_settings_page($par) {
    global $pagenow, $wp_version;
    $settings = get_option("tk_theme_settings");
    if ( version_compare( $wp_version, '3.4', '>=' ) ) {$theme_data = wp_get_theme(TEMPLATEPATH . '/style.css');}else{$theme_data = get_theme_data(TEMPLATEPATH . '/style.css');}
    ?>

    <div class="wrap">
        <h2><?php
    $pages = @get_all_pages();
    for ($i = 0; $i <= count($pages) - 1; $i++) {
        if ($pages[$i]['slug'] == $_GET['page']) {
            echo $pages[$i]['page_title'];
        }
    }
    ?></h2>

        <?php
        if ('true' == esc_attr(@$_GET['error']))
            echo '<div class="error" ><p>All fields marked with (*) are required.</p></div>';
        if ('true' == esc_attr(@$_GET['updated']))
            echo '<div class="updated" ><p>Theme Settings updated.</p></div>';

        if (isset($_GET['tab']))
            tk_admin_tabs($_GET['tab']); else
            tk_admin_tabs(get_first_tab());
        ?>

        <div id="poststuff">
            <form method="post" action="<?php admin_url('admin.php?page=' . $_GET['page']); ?>">
                <?php
                wp_nonce_field("ilc-settings-page");
                if ($pagenow == 'admin.php' && isset($_GET['page'])) {
                    if (isset($_GET['tab']))
                        $tab = $_GET['tab'];
                    else
                        $tab = get_first_tab();

                    echo '<table class="form-table">';


                    GLOBAL $tabs;
                    $tk_theme_name = get_option('tk_theme_name');
                    foreach ($tabs as $r1) {
                        if ($r1['id'] == $tab) {
                            $row_items = 1;
                            foreach ($r1 as $r2) {

                                if ($row_items == 4) {
                                    if (count($r2) > 0) {

                                        foreach ($r2 as $r3) {

                                            if (@$r3['options']['required'] == 'yes') {
                                                $required = '* ';
                                                $required_hidden_field = '<input type="hidden" name="' . $r3['name'] . '_required" value="yes">';
                                            } else {
                                                $required = '';
                                                $required_hidden_field = '<input type="hidden" name="' . $r3['name'] . '_required" value="no">';
                                            }

                                            if(isset($_GET['dev'])){
                                                $dev = '<br /><font color="red">'.$tk_theme_name.'_'.$tab . '_' . $r3['name'].'</font>';
                                            }else{
                                                $dev = '';
                                            }

                                            if ($r3['type'] == 'text') {//TYPE: TEXT

                                                if (isset($r3['options']['size'])) {
                                                    $size = 'size = "'.$r3['options']['size'].'"';
                                                }else{
                                                    $size = '';
                                                }
                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);

                                                } else {
                                                    $val = $r3['value'];

                                                }


                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>'.$dev.'</th>
                                                                        <td>
                                                                            <input id="' . $r3['id'] . '" name="' . $r3['name'] . '" type="' . $r3['type'] . '" value="' . htmlspecialchars(stripslashes($val)) . '" ' . @$r3['options']['readonly'] . ' '.$size.' />
                                                                            <span class="description"><br />' . $r3['desc'] . '</span>
                                                                            ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';
                                            }

                                            if ($r3['type'] == 'label') {//TYPE: LABEL

                                                if (isset($r3['options']['size'])) {
                                                    $size = 'size = "'.$r3['options']['size'].'"';
                                                }else{
                                                    $size = '';
                                                }
                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);

                                                } else {
                                                    $val = $r3['value'];

                                                }


                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>'.$dev.'</th>
                                                                    </tr>';
                                            }

                                            if ($r3['type'] == 'colorpicker') {//TYPE: COLORPICKER

                                                if (isset($r3['options']['size'])) {
                                                    $size = 'size = "'.$r3['options']['size'].'"';
                                                }else{
                                                    $size = '';
                                                }


                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);

                                                } else {
                                                    $val = $r3['value'];

                                                }
                                                if(!empty($r3['clear']) && $r3['clear']=='yes'){$clear = '<input type="button" value="Clear" style="margin-left:15px" name="clear'.$r3['id'].'" id="clear'.$r3['id'].'"/>';}else{$clear='';}
                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>'.$dev.'</th>
                                                                        <td>
                                                                            <input id="' . $r3['id'] . '" name="' . $r3['name'] . '" type="text" value="' . $val . '" class="color" '.$size.' />
                                                                            <span class="description">' . $r3['desc'] . '</span><input type="button" value="Reset" style="margin-left:15px" name="button'.$r3['id'].'" id="button_'.$r3['id'].'"/>
                                                                            ' .$clear. $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';?>

                                            <script type="text/javascript">
                                                jQuery(document).ready(function(){
                                                    jQuery('#button_<?php echo $r3['id']?>').live('click', function(){
                                                        jQuery('#<?php echo $r3['id']?>').val('<?php echo $r3['value']?>');
                                                    })
                                                })
                                            </script>

                                            <?php
                                            }

                                            if ($r3['type'] == 'datepicker') {//TYPE: DATEPICKER

                                                if (isset($r3['options']['size'])) {
                                                    $size = 'size = "'.$r3['options']['size'].'"';
                                                }else{
                                                    $size = '';
                                                }


                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);

                                                } else {
                                                    $val = $r3['value'];

                                                }

                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>'.$dev.'</th>
                                                                        <td>
                                                                            <input id="' . $r3['id'] . '" name="' . $r3['name'] . '" type="text" value="' . $val . '" class="admin-datepicker" '.$size.' />
                                                                            <span class="description">' . $r3['desc'] . '</span>
                                                                            ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';
                                            }

                                            if ($r3['type'] == 'hidden') {//TYPE: HIDDEN
                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                echo '<tr>'.$dev.'
                                                                        <td>
                                                                            <input id="' . $r3['id'] . '" name="' . $r3['name'] . '" type="' . $r3['type'] . '" value="' . stripslashes($val) . '" />
                                                                                ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';
                                            }

                                            if ($r3['type'] == 'password') {//TYPE: PASSWORD
                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>'.$dev.'</th>
                                                                        <td>
                                                                            <input id="' . $r3['id'] . '" name="' . $r3['name'] . '" type="' . $r3['type'] . '" value="' . $val . '" />
                                                                            <span class="description">' . $r3['desc'] . '</span>
                                                                                ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';
                                            }

                                            if ($r3['type'] == 'radio') {//TYPE: RADIO
                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>'.$dev.'</th>
                                                                        <td>';

                                                for ($i = 0; $i < (count($r3['value'])); $i++) {
                                                    if ($r3['value'][$i] == $val) {
                                                        $checked = 'checked="checked"';
                                                    } else {
                                                        $checked = '';
                                                    }
                                                    echo '<input type="' . $r3['type'] . '" name="' . $r3['name'] . '" value="' . $r3['value'][$i] . '" ' . $checked . ' /> ' . $r3['caption'][$i] . '<br />';
                                                }


                                                echo '
                                                                            <span class="description">' . $r3['desc'] . '</span>
                                                                                ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';
                                            }

                                            if ($r3['type'] == 'checkbox') {//TYPE: CHECKBOX
                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);
                                                    @$val_database = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                    @$val_database = array();
                                                }
                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>'.$dev.'</th>
                                                                        <td>';

                                                for ($i = 0; $i < (count($r3['value'])); $i++) {

                                                    if (@in_array($r3['value'][$i], $val_database)) {
                                                        $checked = 'checked="checked"';

                                                    } else {
                                                        $checked = '';
                                                    }

                                                    echo '<input type="' . $r3['type'] . '" name="' . $r3['name'] . '[]" value="' . $r3['value'][$i] . '" ' . $checked . ' /> ' . $r3['caption'][$i] . '<br />';
                                                }

                                                echo '<input type="' . $r3['type'] . '" name="' . $r3['name'] . '[]" value="" style="display:none;" checked />';

                                                echo '
                                                                            <span class="description">' . $r3['desc'] . '</span>
                                                                                ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';
                                            }

                                            if ($r3['type'] == 'select') {//TYPE: SELECT
                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>'.$dev.'</th>
                                                                        <td>
                                                                            <select name="' . $r3['name'] . '" id="' . $r3['id'] . '">';

                                                for ($i = 0; $i < (count($r3['value'])); $i++) {
                                                    if ($r3['value'][$i][1] == $val) {
                                                        $selected = 'selected="selected"';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                    echo '<option value="' . $r3['value'][$i][1] . '" ' . $selected . '>' . $r3['value'][$i][0] . '</option>';
                                                }


                                                echo '</select>
                                                                            <span class="description"><br />' . $r3['desc'] . '</span>
                                                                            ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';
                                            }


                                            //TYPE: STYLE CHANGER
                                            if ($r3['type']  == 'stylechanger') {
                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                ?>
                                            <div class="option-section" style="max-width: 960px;">

                                                <?php foreach ($r3['styles'] as $styleobject) {
                                                    if ($styleobject == $val) {
                                                        $checked = 'checked="checked"';
                                                    } else {
                                                        $checked = '';
                                                    }
                                                    ?>
                                            <div class="one-style" style="display: inline-block;margin: 50px 10px 10px 10px">
                                            <input type="radio" name="<?php echo $r3['name']; ?>" style="display: inline-block;position: relative;left: 50%;top: -170px;" value="<?php echo $styleobject; ?>"  class="style-radio" <?php echo $checked?> >
                                            <div class="style-preview" style="background-image:url(<?php echo get_template_directory_uri()?>/style/stylechanger/<?php echo $styleobject?>.png);background-position: center center;width: 150px;height: 150px;display: inline-block;border:1px solid #DFDFDF"></div>
                                            </div>
                                                    <?php } ?>
                                            <label class="option-description"><?php echo $r3['description']?></label>
                                            </div>
                                                <?php   }


                                            if ($r3['type'] == 'textarea') {//TYPE: TEXTAREA
                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>'.$dev.'</th>
                                                                        <td>
                                                                            <textarea name="' . $r3['name'] . '" id="' . $r3['id'] . '" rows="' . @$r3['options']['rows'] . '" cols="' . @$r3['options']['cols'] . '">' . stripslashes($val) . '</textarea><br />
                                                                            <span class="description">' . $r3['desc'] . '</span>
                                                                                ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';
                                            }

                                            if ($r3['type'] == 'file') {//TYPE: FILE
                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {

                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                if(!empty($r3['clear']) && $r3['clear']=='yes'){$clear = '<input type="button" value="Clear" style="margin-left:15px" name="clear'.$r3['id'].'" id="clear'.$r3['id'].'"/>';}else{$clear='';}
                                                echo '<tr valign="top">
                                                                        <th scope="row">' . $required . '' . $r3['label'] . ' '.$dev.'</th>
                                                                        <td><label for="' . $r3['id'] . '">
                                                                        <input class="upload-url" id="' . $r3['id'] . '" type="text" size="36" name="' . $r3['name'] . '" value="' . $val . '" />
                                                                        <input class="st_upload_button" id="' . $r3['id'] . '_button" type="button" value="Upload" />'.$clear.'
                                                                        <br /><span class="description">' . $r3['desc'] . '</span>
                                                                        </label></td>
                                                                        ' . $required_hidden_field . '
                                                                      </tr>';
                                            }


                                            if ($r3['type'] == 'file_image') {//TYPE: FILE IMAGE
                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {

                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                echo '<tr valign="top">
                                                                        <th scope="row">' . $required . '' . $r3['label'] . ' '.$dev.'</th>
                                                                        <td><label for="' . $r3['id'] . '">

                                                                        <input class="upload-url" id="' . $r3['id'] . '" type="text" size="36" name="' . $r3['name'] . '" value="' . $val . '" />
                                                                        <input class="st_upload_button" id="' . $r3['id'] . '_button" type="button" value="Upload" />';
                                                if ($val != '') {
                                                    echo '<img src="' . $val . '" width="30" height="30" />';
                                                }
                                                echo '<br /><span class="description">' . $r3['desc'] . '</span>
                                                                            </label></td>
                                                                            ' . $required_hidden_field . '
                                                                      </tr>';
                                            }

                                            if ($r3['type'] == 'hr') {//TYPE: HR (horizontal line)

                                                echo '<tr valign="top">
                                                        <td colspan="2"><hr class="hr2" style="background-color: '.@$r3['options']['color'].';color: '.@$r3['options']['color'].';width: '.@$r3['options']['width'].';height: 1px;border: 0 none;"></td>
                                                      </tr>';
                                            }

                                            if ($r3['type'] == 'button') {//TYPE: button (custom button)

                                                echo '<tr valign="top">
                                                        <td colspan="2" style="margin-left:0;padding-left:0"><input type="button" class="button-secondary" value="'.$r3['value'].'" name="' . $r3['name'] . '" id="' . $r3['id'] . '"/></td>
                                                      </tr>';
                                            }

                                            if ($r3['type'] == 'pages') {//TYPE: dropdown Pages
                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>'.$dev.'</th>
                                                                        <td>';

                                                                        $args = array(
                                                                           'selected'         => $val,
                                                                            'echo'             => 1,
                                                                            'name'             => $r3['name']);
                                                                             wp_dropdown_pages( $args );
                                                                            '<span class="description"><br />' . $r3['desc'] . '</span>
                                                                            ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';

                                                }

                                            if ($r3['type'] == 'category') {//TYPE: dropdown Categories
                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>'.$dev.'</th>
                                                                        <td>';

                                                                        $args = array(
                                                                           'selected'         => $val,
                                                                            'echo'             => 1,
                                                                            'name'             => $r3['name']);
                                                                             wp_dropdown_categories( $args );
                                                                            '<span class="description"><br />' . $r3['desc'] . '</span>
                                                                            ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';

                                                }

                                            if ($r3['type'] == 'author') {//TYPE: dropdown Authors
                                                if (get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name.'_'.$tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>'.$dev.'</th>
                                                                        <td>';

                                                                        $args = array(
                                                                           'selected'         => $val,
                                                                            'name'             => $r3['name']);
                                                                             wp_dropdown_users( $args );
                                                                            '<span class="description"><br />' . $r3['desc'] . '</span>
                                                                            ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';

                                                }
                                                                             
                                                
                                                
                                                
                                                
                                        }
                                    }
                                }
                                $row_items++;
                            }
                        }
                    }


                    echo '</table>';
                }
                ?>
                <p class="submit" style="clear: both;">
                    <input type="submit" name="Submit"  class="button-primary" value="Update Settings" />
                    <input type="hidden" name="ilc-settings-submit" value="Y" />
                </p>
            </form>
        </div>
    </div>

        <script type="text/javascript">

        jQuery(document).ready(function(){

            jQuery('#button_test').live('click', function(){

                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo get_template_directory_uri()?>/inc/reset_colors.php"
                }).done(function( ) {
                    alert( 'Colors now have default values again!' );
                });


            })

        })

    </script>
<?php } ?>