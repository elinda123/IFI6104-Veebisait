<?php
$args = array(
	'orderby'            => 'name',
	'hide_empty'         => 1,
	'depth'              => 10,
);
$categories = get_categories($args);

$new_array = array();

foreach ($categories as $category_list ) {
    $array_to_add = array(
                'id' => 'cat_'.$category_list->term_id,
                'name' => 'cat_'.$category_list->term_id,
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    '',
                ),
                'label' => $category_list->cat_name,
                'desc' => '',
            );
    array_push($new_array, $array_to_add );
}

$tabs = array(

        /*************************************************************/
        /************GENERAL OPTIONS*******************************/
        /*************************************************************/

    array(
        'pg' => array(
            'slug' => 'theme-settings',
            'menu_title' => 'Theme Settings',
            'page_title' => 'Theme Settings'
        ),
        'id' => 'general',
        'name' => 'General Options',

        'fields' => array(

           array(
                'id' => 'header_logo',
                'name' => 'header_logo',
                'type' => 'file',
                'value' => get_template_directory_uri()."/style/img/logo.png",
                'label' => 'Header Logo',
                'desc' => 'JPEG, GIF or PNG image, 150x30px recommended, up to 500KB',
            ),

            array(
                'id' => 'favicon',
                'name' => 'favicon',
                'type' => 'file',
                'value' => get_template_directory_uri()."/style/img/favicon.ico",
                'label' => 'Favicon',
                'desc' => 'File format: ICO, dimenstions: 16x16',

            ),

            array(
                'id' => 'google_analytics',
                'name' => 'google_analytics',
                'type' => 'textarea',
                'value' => '',
                'label' => 'Google Analytics code',
                'desc' => '',
                'options' => array(
                    'rows' => '5',
                    'cols' => '80'
                )
            ),




            array(
                'id' => 'logo_catchline',
                'name' => 'logo_catchline',
                'type' => 'text',
                'value' => '',
                'label' => 'Logo Catchline',
                'desc' => 'Text which appears under the logo',
                'options' => array(
                    'size' => '100'
                )
            ),


            array(
                'id' => 'headline',
                'name' => 'headline',
                'type' => 'text',
                'value' => '',
                'label' => 'Headline Text',
                'desc' => 'Set the headline text',
                'options' => array(
                    'size' => '100'
                )
            ),

            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                )
            ),

            
            array(
                'id' => 'show_counter',
                'name' => 'show_counter',
                'type' => 'checkbox',
                'value' => '',
                'label' => 'Show Countdown',
                'desc' => '',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'If checked countdown will be shown',
                ),
            ),


            array(
                'id' => 'colors',
                'name' => 'colors',
                'type' => 'radio',
                'value' => array(
                    'default',
                    'blue',
                    'green',
                    'grey',
                    'orange',
                    'red',
                ),
                'caption' => array(
                    'Default',
                    'Blue',
                    'Green',
                    'Grey',
                    'Orange',
                    'Red',
                ),
                'label' => __('Choose Countdown Color', 'lexiity'),
                'desc' => __('Choose color for countdown.', 'lexiity'),
            ),


            array(
                'id' => 'countdown_headline',
                'name' => 'countdown_headline',
                'type' => 'text',
                'value' => '',
                'label' => 'Countdown Text',
                'desc' => '',
                'value' => '',
                'caption' => array(
                    '',
                )
            ),



            array(
                'id' => 'datepicker',
                'name' => 'datepicker',
                'type' => 'datepicker',
                'value' => '',
                'label' => 'Date of the event',
                'desc' => 'Use calendar and chose the day for your event'
            ),

            array(
                'id' => 'datepicker_hour',
                'name' => 'datepicker_hour',
                'type' => 'select',
                'value' => array(
                                       array('00', '00'),
                    array('01', '01'),
                    array('02', '02'),
                    array('03', '03'),
                    array('04', '04'),
                    array('05', '05'),
                    array('06', '06'),
                    array('07', '07'),
                    array('08', '08'),
                    array('09', '09'),
                    array('10', '10'),
                    array('11', '11'),
                    array('12', '12'),
                    array('13', '13'),
                    array('14', '14'),
                    array('15', '15'),
                    array('16', '16'),
                    array('17', '17'),
                    array('18', '18'),
                    array('19', '19'),
                    array('20', '20'),
                    array('21', '21'),
                    array('22', '22'),
                    array('23', '23'),
                ),
                'label' => 'Time of event - Hour',
                'desc' => 'Select at what time event starts (hours)',
            ),

            array(
                'id' => 'datepicker_min',
                'name' => 'datepicker_min',
                'type' => 'select',
                'value' => array(
                                       array('00', '00'),
                    array('01', '01'),
                    array('02', '02'),
                    array('03', '03'),
                    array('04', '04'),
                    array('05', '05'),
                    array('06', '06'),
                    array('07', '07'),
                    array('08', '08'),
                    array('09', '09'),
                    array('10', '10'),
                    array('11', '11'),
                    array('12', '12'),
                    array('13', '13'),
                    array('14', '14'),
                    array('15', '15'),
                    array('16', '16'),
                    array('17', '17'),
                    array('18', '18'),
                    array('19', '19'),
                    array('20', '20'),
                    array('21', '21'),
                    array('22', '22'),
                    array('23', '23'),
                    array('24', '24'),
                    array('25', '25'),
                    array('26', '26'),
                    array('27', '27'),
                    array('28', '28'),
                    array('29', '29'),
                    array('30', '31'),
                    array('32', '32'),
                    array('33', '33'),
                    array('34', '34'),
                    array('35', '35'),
                    array('36', '36'),
                    array('37', '37'),
                    array('38', '38'),
                    array('39', '39'),
                    array('40', '40'),
                    array('41', '41'),
                    array('42', '42'),
                    array('43', '43'),
                    array('44', '44'),
                    array('45', '45'),
                    array('46', '46'),
                    array('47', '47'),
                    array('48', '48'),
                    array('49', '49'),
                    array('50', '50'),
                    array('51', '51'),
                    array('52', '52'),
                    array('53', '53'),
                    array('54', '54'),
                    array('55', '55'),
                    array('56', '56'),
                    array('57', '57'),
                    array('58', '58'),
                    array('59', '59'),


                    ),
                'label' => 'Time of event - Minutes',
                'desc' => 'Select at what time event starts (minutes)',
            ),

            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                )
            ),     

            array(
                'id' => 'twitter_username',
                'name' => 'twitter_username',
                'type' => 'text',
                'value' => '',
                'label' => 'Twitter Username',
                'desc' => 'Sets the link to your twitter in the header.',
                'options' => array(
                    'size' => '100'
                )
            ),

            array(
                'id' => 'facebook_username',
                'name' => 'facebook_username',
                'type' => 'text',
                'value' => '',
                'label' => 'Facebook Username',
                'desc' => 'Sets the link to your facebook in the header',
                'options' => array(
                    'size' => '100'
                )
            ),


            array(
                'id' => 'plus_username',
                'name' => 'plus_username',
                'type' => 'text',
                'value' => '',
                'label' => 'Google Plus username',
                'desc' => 'Sets the link to your google account in the header',
                'options' => array(
                    'size' => '100'
                )
            ),



            array(
                'id' => 'rss_link',
                'name' => 'rss_link',
                'type' => 'text',
                'value' => '',
                'label' => 'RSS Link',
                'desc' => 'Set link for rss feed',
                'options' => array(
                    'size' => '100'
                )
            ),

            array(
                'id' => 'pinterest_username',
                'name' => 'pinterest_username',
                'type' => 'text',
                'value' => '',
                'label' => 'Pinterest Username',
                'desc' => 'Sets the username for your pinterest account.',
                'options' => array(
                    'size' => '100'
                )
            ),


            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                )
            ),



            array(
                'id' => 'footer_copy',
                'name' => 'footer_copy',
                'type' => 'text',
                'value' => 'Crafted by <a href="http://www.themeskingdom.com">Themes Kingdom</a> | Powered by <a href="https://wordpress.org">WordPress</a>',
                'label' => 'Footer Copy Text',
                'desc' => 'Text which appears in footer as copyright text',
                'options' => array(
                    'size' => '100'
                )
            ),

        ),
    ),



    //NEWSLETTER
    array(
        'pg' => array(
            'slug' => 'theme-settings',
            'menu_title' => 'Theme Settings',
            'page_title' => 'Theme Settings'
        ),
        'id' => 'newsletter',
        'name' => __('Newsletter', 'lexiity'),
        'fields' => array(

            array(
                'id' => 'newsletter_service',
                'name' => 'newsletter_service',
                'type' => 'radio',
                'value' => array(
                    'Mailchimp',
                    'Sendloop',
                    'None',
                ),
                'caption' => array(
                    'Mailchimp',
                    'Sendloop',
                    'None',
                ),
                'label' => __('Newsletter Service', 'lexiity'),
                'desc' => __('Use <a href="http://sendloop.com/">Sendloop</a> as your newsletter manager or use <a href="http://mailchimp.com/">Mailchimp</a> as your newsletter manager.', 'lexiity'),
            ),
            array(
                'id' => 'mailchimp_api_key',
                'name' => 'mailchimp_api_key',
                'type' => 'text',
                'value' => '',
                'label' => __('Mailchimp API Key', 'lexiity'),
                'desc' =>__('Grab and insert an API Key from <a href="http://admin.mailchimp.com/account/api/">here</a>', 'lexiity'),
                'options' => array(
                    'size' => '100'
                )
            ),
            array(
                'id' => 'mailchimp_api_list',
                'name' => 'mailchimp_api_list',
                'type' => 'text',
                'value' => '',
                'label' => __('Mailchimp API List', 'lexiity'),
                'desc' => __('Grab your Lists Unique Id by going to <a href="http://admin.mailchimp.com/lists/">here</a>. Click the "settings" link for the list - the Unique Id is at the bottom of that page.', 'lexiity'),
                'options' => array(
                    'size' => '100'
                )
            ),
            array(
                'id' => 'sendloop_username',
                'name' => 'sendloop_username',
                'type' => 'text',
                'value' => '',
                'label' => __('Sendloop Username', 'lexiity'),
                'desc' => __('Insert your Sendloop username. It can be fount when you log in into your Sendloop account it looks like <strong>XXXXX</strong>.sendloop.com', 'lexiity'),
                'options' => array(
                    'size' => '100'
                )
            ),

            array(
                'id' => 'sendloop_list_id',
                'name' => 'sendloop_list_id',
                'type' => 'text',
                'value' => '',
                'label' => __('Sendloop List ID', 'lexiity'),
                'desc' => __('Insert your Sandloop List Id. It can be found at Subscriber Lists-><strong>Your List</strong>->Edit List Settings', 'lexiity'),
                'options' => array(
                    'size' => '100'
                )
            ),

            array(
                'id' => 'newsletter_headline',
                'name' => 'newsletter_headline',
                'type' => 'text',
                'value' => '',
                'label' => __('Newsletter Headline', 'lexiity'),
                'desc' => __('', 'lexiity'),
                'options' => array(
                    'size' => '100'
                )
            ),

            array(
                'id' => 'newsletter_text',
                'name' => 'newsletter_text',
                'type' => 'text',
                'value' => '',
                'label' => __('Newsletter Text', 'lexiity'),
                'desc' => __('', 'lexiity'),
                'options' => array(
                    'size' => '100'
                )
            ),
        ),
    ),
);



?>