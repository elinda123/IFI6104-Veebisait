<?php
/*---------------------------------------------------------------------------------*/
/* Newsletter widget */
/*---------------------------------------------------------------------------------*/

class App_Newsletter extends WP_Widget {

   function App_Newsletter() {
  	   $widget_ops = array('description' => 'Newsletter Widget support 2 newsletter services Sendloop and MailChimp' );
       parent::__construct(false, $name = __(tk_theme_name.' - Newsletter', tk_theme_name), $widget_ops);
   }


    function widget($args, $instance) {
		extract( $args );
                $title = $instance['title'];
                $newsletter_service = $instance['service'];
                $mailchimp_key = $instance['mailchimp_key'];
                $mailchimp_list = $instance['mailchimp_list'];
                $sendloop_username = $instance['sendloop_user'];
                $sendloop_list = $instance['sendloop_list'];
                $newsletter_text = $instance['newsletter_text'];

                ?>

		<?php echo $before_widget; ?>
		<?php if ($title) { echo $before_title . $title . $after_title; } ?>

		<?php
		if(!empty($newsletter_service)){?>
                    <div class="bg-newsletter-top left"></div>
                    <div class="newsletter left">
                        <?php if(!empty($newsletter_text)){?><span><?php echo $newsletter_text?></span><?php }?>
                        <div class="bg-newsletter-input">

                  <?php  if($newsletter_service == 'Sendloop'){?>

                                <form action="http://<?php echo $sendloop_username ?>.sendloop.com/subscribe.php" method="post">
                                    <input type="text" name="FormValue_Fields[EmailAddress]" value="" id="FormValue_EmailAddress" class="newsletter_email input-newsletter" src="style/img/menu-contact.png"/>
                                    <input type="submit" name="FormButton_Subscribe" value="" id="FormButton_Subscribe" class="newsletter_button submit-newsletter"/>
                                    <input type="hidden" name="FormValue_ListID" value="<?php echo $sendloop_list ?>" id="FormValue_ListID" />
                                    <input type="hidden" name="FormValue_Command" value="Subscriber.Add" id="FormValue_Command" />
                                </form>
                                <div class="border-down-widget left" style="height:2px"></div>
                                
                    <?php  } elseif ($newsletter_service == 'MailChimp'){ ?>

                             <form id="signup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                      <input type="text" name="email" id="email"  class="input-newsletter"/>
                                      <input type="hidden" name="_mailchimp_key" id="_mailchimp_key" value="<?php echo $mailchimp_key  ?>"/>
                                      <input type="hidden" name="_mailchimp_list" id="_mailchimp_list" value="<?php echo $mailchimp_list?>"/>
                                      <input type="submit" src="" name="submit" value="" class="btn submit-newsletter" alt="Submit" />
                                      <input type="text" style="display: none" value="<?php echo get_template_directory_uri().'/script/mailchimp/inc/store-address.php'?>" name="hidden_path" class="hidden_path">
                                      <div class="clear"></div>
                                      <label for="email" id="address-label">
                                            <span id="response">
                                                    <?php get_template_part('/script/mailchimp/inc/store-address.php'); if(isset ($_GET['submit'])){ echo storeAddress(); } ?>
                                              </span>
                                      </label>
                            </form>
                            <script type="text/javascript" src="<?php echo get_template_directory_uri().'/script/mailchimp/js/mailing-list.js';?>"></script>

                    <?php }?>

                        </div>
                    </div>
                    <div class="bg-newsletter-down left"></div>


		<?php echo $after_widget; ?>
    <?php

   }}

   function update($new_instance, $old_instance) {
	   return $new_instance;
   }

   function form($instance) {

		$title = esc_attr($instance['title']);
                $newsletter_service = esc_attr($instance['service']);
                $mailchimp_key = esc_attr($instance['mailchimp_key']);
                $mailchimp_list = esc_attr($instance['mailchimp_list']);
                $sendloop_username = esc_attr($instance['sendloop_user']);
                $sendloop_list = esc_attr($instance['sendloop_list']);
                $newsletter_text = esc_attr($instance['newsletter_text']);
		?>
       <p>
	   	 <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',tk_theme_name); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       </p>
       <p>
	   	 <label for="<?php echo $this->get_field_id('newsletter_text'); ?>"><?php _e('Newsletter Text:',tk_theme_name); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('newsletter_text'); ?>"  value="<?php echo $newsletter_text; ?>" class="widefat" id="<?php echo $this->get_field_id('newsletter_text'); ?>" />
       </p>
       <p>
	   	 <label for="<?php echo $this->get_field_id('service'); ?>"><?php _e('Chose Service:', tk_theme_name); ?></label><br/>
                 <input type="radio" name="<?php echo $this->get_field_name('service'); ?>" value="Sendloop" <?php if(empty ($newsletter_service) || $newsletter_service == 'Sendloop'){echo 'checked';} ?>>  Sendloop<br/>
                 <input type="radio" name="<?php echo $this->get_field_name('service'); ?>" value="MailChimp" <?php if($newsletter_service == 'MailChimp'){echo 'checked';} ?>>  MailChimp<br/>
       </p>
       <p>
	   	  <label for="<?php echo $this->get_field_id('mailchimp_key'); ?>"><?php _e('MailChimp API Key:',tk_theme_name); ?></label><br/>
	       <input type="text" name="<?php echo $this->get_field_name('mailchimp_key'); ?>"  value="<?php echo $mailchimp_key; ?>" class="" size="28" id="<?php echo $this->get_field_id('mailchimp_key'); ?>" /><br/>
               <span class="description">Grab and insert an API Key from <a href="http://admin.mailchimp.com/account/api/" target="_blank">here</a></span><br/>
       </p>
       <p>
	   	  <label for="<?php echo $this->get_field_id('mailchimp_list'); ?>"><?php _e('MailChimp API List:',tk_theme_name); ?></label><br/>
	       <input type="text" name="<?php echo $this->get_field_name('mailchimp_list'); ?>"  value="<?php echo $mailchimp_list; ?>" class="" size="28" id="<?php echo $this->get_field_id('mailchimp_list'); ?>" /><br/>
               <span class="description">Grab your Lists Unique Id by going to <a href="http://admin.mailchimp.com/lists/" target="_blank">here</a>. Click the "settings" link for the list - the Unique Id is at the bottom of that page.</span><br/>
       </p>
       <p>
	   	  <label for="<?php echo $this->get_field_id('sendloop_user'); ?>"><?php _e('Sendloop Username:',tk_theme_name); ?></label><br/>
	       <input type="text" name="<?php echo $this->get_field_name('sendloop_user'); ?>"  value="<?php echo $sendloop_username; ?>" class="" size="28" id="<?php echo $this->get_field_id('sendloop_user'); ?>" /><br/>
               <span class="description">Insert your Sendloop username. It can be fount when you log in into your Sendloop account it looks like <strong>XXXXX</strong>.sendloop.com</span><br/>
       </p>
       <p>
	   	  <label for="<?php echo $this->get_field_id('sendloop_list'); ?>"><?php _e('Sendloop List ID:',tk_theme_name); ?></label><br/>
	       <input type="text" name="<?php echo $this->get_field_name('sendloop_list'); ?>"  value="<?php echo $sendloop_list; ?>" class="" size="28" id="<?php echo $this->get_field_id('sendloop_list'); ?>" /><br/>
                <span class="description">Insert your Sandloop List Id. It can be found at Subscriber Lists<strong>Your List</strong>Edit List Settings</span><br/>
       </p>

       <?php
   }
   }

register_widget('App_Newsletter');
?>