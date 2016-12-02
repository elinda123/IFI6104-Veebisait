<?php
/**
 * Template part for displaying single events.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package relia
 */

?>  

<div class="row">
    
    <?php get_sidebar( 'left' ); ?>
    
    <div class="col-sm-<?php echo relia_main_width(); ?>"> 

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="post-header">

                <h2 class="post-title">
                    <?php the_title(); ?>
                </h2>
                <br>
                <div class="location">
                    <?php echo get_post_meta( get_the_ID(), 'event_metalocation', true ); ?>
                </div>
                <br>
                <div class="date">
                    
                    <?php echo date( 'M jS, Y', strtotime( get_post_meta( get_the_ID(), 'event_metadate', true ) ) ); ?>

                    <?php echo date( 'g:i', strtotime( get_post_meta( get_the_ID(), 'event_metatime_start', true ) ) ); ?>
                    to <?php echo date( 'g:i a', strtotime( get_post_meta( get_the_ID(), 'event_metatime_end', true ) ) ); ?>

                </div>

            </header>

            <div class="post-content">

                <div class="row">
                
                    <?php if ( has_post_thumbnail() ) : ?>
                    
                        <div class="col-sm-6">

                            <?php the_post_thumbnail( 'full' ); ?>

                        </div>
                    
                    <?php endif; ?>
                    
                    <div class="col-sm-<?php echo has_post_thumbnail() ? '6' : '12'; ?>">
                        
                        <div class="actual-content">

                            <?php the_content(); ?>

                        </div>

                    </div>
                        
                </div>

            </div>

        </article>

    </div>
    
    <?php get_sidebar( 'right' ); ?>    
    
</div>


