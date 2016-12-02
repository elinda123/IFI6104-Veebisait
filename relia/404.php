<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package relia
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <div class="container">

            <div class="row">

                <div class="col-sm-12">

                    <section class="error-404 not-found">
                        <header class="page-header">
                            <h1 class="page-title"><?php esc_html_e('404 - Page not found', 'relia'); ?></h1>
                        </header><!-- .page-header -->

                    </section><!-- .error-404 -->

                </div>

            </div>

        </div>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
