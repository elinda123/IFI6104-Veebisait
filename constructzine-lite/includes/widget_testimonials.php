<?php

function register_testimonial_widget() {
    register_widget( 'Testimonials_Widget' );
}
add_action( 'widgets_init', 'register_testimonial_widget' );


class Testimonials_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'constructzine_widget_testimonials', // Base ID
			__( 'Testimonials', 'constructzine-lite' ), // Name
			array( 'description' => __( 'A Testimonial Widget', 'constructzine-lite' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
				extract($args);
				$defaults = array( 
					'title' => __( 'What customers says', 'constructzine-lite' ),
					'first_name' => __( 'Ionut Neagu', 'constructzine-lite' ),
					'tst1' =>  __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus justo at justo facilisis, et gravida lacus ornare. Proin nisl mauris, pretium et euismod a, congue quis odio.', 'constructzine-lite' ),
					'second_name' => __( 'Marius Cristea', 'constructzine-lite' ),
					'tst2' =>  __( 'Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus sed magna ante. Duis sodales, dui vitae tincidunt aliquet, augue magna pharetra libero, nec congue nibh felis congue purus.', 'constructzine-lite' )
					);
					
				$instance = wp_parse_args( (array) $instance, $defaults ); 
     	        echo $before_widget;
		?>
		<div class="feedback block">
			<h2 class="block-title">
				<?php if(!empty($instance['title'])) echo $instance['title']; ?>
			</h2>

			<div class="feedback">
				<p class="feedback-meta">
					<strong>
						<?php if(!empty($instance['first_name'])) echo $instance['first_name']; ?>							
					</strong>
				</p><!--/.feedback-meta-->
				<blockquote>
					<p><?php if(!empty($instance['tst1'])) echo $instance['tst1']; ?></p>
				</blockquote><!--/.feedback-entry-->
			</div>

			<div class="feedback">
				<p class="feedback-meta">
					<strong>
						<?php if(!empty($instance['second_name'])) echo $instance['second_name']; ?>
					</strong>
				</p><!--/.feedback-meta-->
				<blockquote>
					<p><?php if(!empty($instance['tst2'])) echo $instance['tst2']; ?></p>
				</blockquote>
			</div>
		</div>
		<?php
		echo $after_widget;
	}
	
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['first_name'] = strip_tags( $new_instance['first_name'] );
		$instance['tst1'] = strip_tags( $new_instance['tst1'] );
		$instance['second_name'] = strip_tags( $new_instance['second_name'] );
		$instance['tst2'] = strip_tags( $new_instance['tst2'] );

		return $instance;
	}
	
	
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
     	        $defaults = array( 
					'title' => __( 'What customers says', 'constructzine-lite' ),
					'first_name' => __( 'Ionut Neagu', 'constructzine-lite' ),
					'tst1' =>  __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus justo at justo facilisis, et gravida lacus ornare. Proin nisl mauris, pretium et euismod a, congue quis odio.', 'constructzine-lite' ),
					'second_name' => __( 'Marius Cristea', 'constructzine-lite' ),
					'tst2' =>  __( 'Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus sed magna ante. Duis sodales, dui vitae tincidunt aliquet, augue magna pharetra libero, nec congue nibh felis congue purus.', 'constructzine-lite' )
					);
					
				$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Testimonial Title:','constructzine-lite' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'first_name' ); ?>"><?php _e( 'Testimonial 1 - Name:','constructzine-lite' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'first_name' ); ?>" name="<?php echo $this->get_field_name( 'first_name' ); ?>" type="text" value="<?php echo esc_attr( $instance['first_name'] ); ?>">
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'tst1' ); ?>"><?php _e( 'Testimonial 1 - Content:','constructzine-lite' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('tst1'); ?>" name="<?php echo $this->get_field_name('tst1'); ?>"><?php echo esc_attr( $instance['tst1'] ); ?></textarea>
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'second_name' ); ?>"><?php _e( 'Testimonial 2 - Name:','constructzine-lite' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'second_name' ); ?>" name="<?php echo $this->get_field_name( 'second_name' ); ?>" type="text" value="<?php echo esc_attr( $instance['second_name'] ); ?>">
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'tst2' ); ?>"><?php _e( 'Testimonial 2 - Content:','constructzine-lite' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('tst2'); ?>" name="<?php echo $this->get_field_name('tst2'); ?>"><?php echo esc_attr( $instance['tst2'] ); ?></textarea>
		</p>
		<?php 
	}

} 