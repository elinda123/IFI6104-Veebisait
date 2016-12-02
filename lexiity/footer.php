<?php wp_footer();?>





  <?php
        $copyright = get_theme_option(tk_theme_name.'_general_footer_copy');
        if(empty($copyright)) {
            $copyright = 'Crafted by <a href="http://www.themeskingdom.com">Themes Kingdom</a> | Powered by <a href="https://wordpress.org">WordPress</a>';
        }
    ?>


    <!-- FOOTER -->
    <div class="footer left">
        <div class="wrapper">

            <div class="content-center copy">
                <div class="footer-copyright copy"><?php echo $copyright; ?></div><!--/footer-copyright-->
            </div><!--/content-center-->
            
        </div><!--/wrapper-->
    </div><!--/footer-->



</div><!--/container-->
</body>
</html>