<?php get_header();
$prefix = 'tk_';
$show_home_content= get_theme_option(tk_theme_name.'_home_use_home_content');
$show_call_to_action= get_theme_option(tk_theme_name.'_home_use_call_to_action');
?>





    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">

<?php $headline = get_theme_option(tk_theme_name.'_general_headline'); ?>

            <div class="title-page left">
                <?php if($headline){ ?><span><?php echo $headline; ?></span><?php } ?>
            </div><!--/title-page-->

            <div class="content-center left">

                <?php $show_counter = get_theme_option(tk_theme_name.'_general_show_counter'); ?>

                <?php if(!empty($show_counter)){ ?>

                    <div class="time-content left">
                        <!-- <h6><?php //_e('Time to Launch', tk_theme_name); ?></h6> -->
                        <div class="time-content-bg left">
                        <?php
                            $counter_date = get_theme_option(tk_theme_name.'_general_datepicker');
                            $counter_date = explode('-', $counter_date);
                            $counter_hour = get_theme_option(tk_theme_name.'_general_datepicker_hour');
                            $counter_min = get_theme_option(tk_theme_name.'_general_datepicker_min');
                            $use_countdown = get_theme_option(tk_theme_name.'_general_use_countdown');

                            ?>

                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            var time = new Date();
                            time = new Date(<?php echo $counter_date[2]; ?>,<?php echo $counter_date[1]; ?>-1,<?php echo $counter_date[0]; ?>,<?php echo $counter_hour; ?>,<?php echo $counter_min; ?>);
                            jQuery('.jcounter').countdown({
                                until: time,
                                timeSeparator: " ",
                                description: '',
                                format:'DHMS',
                                compactLabels: ['', '', '', ''],
                                layout: '<div class="time-one left"><span> {dn} </span><p> {dl} </p></div>\n\
                                            <div class="time-one left"><span> {hn} </span><p> {hl} </p></div> \n\
                                            <div class="time-one left"><span> {mn} </span><p> {ml} </p></div> \n\
                                            <div class="time-one left"><span> {sn} </span><p> {sl} </p></div>'
                            });
                        });
                    </script>

                            <div class="jcounter"></div>

                        </div><!--/time-content-bg-->
                    </div><!--/time-content-->

                <?php } ?>

                <!--ABOUT-->
                <div class="shortcodes left">

                                    <?php
                                    /* Run the loop to output the page.
                                                                     * If you want to overload this in a child theme then include a file
                                                                     * called loop-page.php and that will be used instead.
                                    */
                                    //get_template_part( 'loop', 'page' );
                                    wp_reset_query();
                                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                                            the_content();
                                        endwhile;
                                    else:
                                    endif;
                                    wp_reset_query();
                                    ?>


                </div><!-- /shortcodes-right -->




                <?php
                $newsletter_type = get_theme_option(tk_theme_name.'_newsletter_newsletter_service');
                $sendloop_username = get_theme_option(tk_theme_name.'_newsletter_sendloop_username');
                $sendloop_list_id = get_theme_option(tk_theme_name.'_newsletter_sendloop_list_id');

                $newsletter_headline = get_theme_option(tk_theme_name.'_newsletter_newsletter_headline');
                $newsletter_text = get_theme_option(tk_theme_name.'_newsletter_newsletter_text');

                if($newsletter_type !== "None") { ?>

                    <?php } ?>



                        <?php  if($newsletter_type == 'Sendloop'){ ?>

                        <form action="http://<?php echo $sendloop_username ?>.sendloop.com/subscribe.php" method="post">
                            <div class="form left">
                                <div class="form-border-top left"></div><!--/form-border-top-->
                                <div class="form-content left">
                                    <div class="form-content-text left">
                                        <span><?php echo $newsletter_headline; ?></span>
                                        <p><?php echo $newsletter_text; ?></p>
                                    </div><!--/form-content-text-->
                                    <div class="form-right right">
                                            <form method="post" action="">

                                                    <div class="form-input left">
                                                        <input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="Sign up!" name="FormValue_Fields[EmailAddress]" value="" id="FormValue_EmailAddress" class="newsletter_email"  />
                                                    </div><!--/form-input-->

                                                    <div class="form-input-button left">
                                                        <input  type="submit" name="FormButton_Subscribe" value="" id="FormButton_Subscribe" class="submit-sidebar-button newsletter_button"/>
                                                    </div><!--/form-input-button-->

                                                <input type="hidden" name="FormValue_ListID" value="<?php echo $sendloop_list_id ?>" id="FormValue_ListID" />
                                                <input type="hidden" name="FormValue_Command" value="Subscriber.Add" id="FormValue_Command" />
                                            </form>
                                        </div><!--/form-right-->
                                </div><!--/form-content-->
                            </div><!--/form-->
                        </form>


                    <?php }elseif($newsletter_type == 'Mailchimp'){ ?>
                                <?php get_template_part('script/mailchimp/mailchimp')?>
                    <?php } ?>







            </div><!--/content-center-->



        </div><!--/wrapper-->
    </div><!--/content-->




<?php get_footer(); ?>