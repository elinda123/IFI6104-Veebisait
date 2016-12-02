<?php
  if ( !class_exists( 'Kirki' ) ) {
    return;
  }
  if ( class_exists( 'WooCommerce' ) && get_option( 'show_on_front' ) != 'page' ) {
  	Kirki::add_section( 'istore_woo_demo_section', array(
  		'title'		 => __( 'WooCommerce Homepage Demo', 'istore' ),
  		'priority'	 => 10,
  	) );
  }
  
  Kirki::add_field( 'istore_settings', array(
  	'type'			 => 'switch',
  	'settings'		 => 'istore_demo_front_page',
  	'label'			 => __( 'Enable Demo Homepage?', 'istore' ),
  	'description'	 => sprintf( __( 'When the theme is first installed and WooCommerce plugin activated, the demo mode would be turned on. This will display some sample/example content to show you how the website can be possibly set up. When you are comfortable with the theme options, you should turn this off. You can create your own unique homepage - Check the %s page for more informations.', 'istore' ), '<a href="' . admin_url( 'themes.php?page=maxstore-welcome' ) . '"><strong>' . __( 'Theme info', 'istore' ) . '</strong></a>' ),
  	'section'		 => 'istore_woo_demo_section',
  	'default'		 => 1,
  	'priority'		 => 10,
  ) );
  Kirki::add_field( 'istore_settings', array(
  	'type'				 => 'radio-buttonset',
  	'settings'			 => 'istore_front_page_demo_style',
  	'label'				 => esc_html__( 'Homepage Demo Styles', 'istore' ),
  	'description'		 => sprintf( __( 'The demo homepage is enabled. You can choose from some predefined layouts or make your own %s.', 'istore' ), '<a href="' . admin_url( 'themes.php?page=maxstore-welcome' ) . '"><strong>' . __( 'custom homepage template', 'istore' ) . '</strong></a>' ),
  	'section'			 => 'istore_woo_demo_section',
  	'default'			 => 'style-one',
  	'priority'			 => 10,
  	'choices'			 => array(
  		'style-one'	 => __( 'Layout one', 'istore' ),
  		'style-two'	 => __( 'Layout two', 'istore' ),
  	),
  	'active_callback'	 => array(
  		array(
  			'setting'	 => 'istore_demo_front_page',
  			'operator'	 => '==',
  			'value'		 => 1,
  		),
  	),
  ) );
  Kirki::add_field( 'istore_settings', array(
  	'type'				 => 'switch',
  	'settings'			 => 'istore_front_page_demo_banner',
  	'label'				 => __( 'Homepage top section', 'istore' ),
  	'description'		 => esc_html__( 'Enable or disable demo homepage top section with custom image and random category products.', 'istore' ),
  	'section'			 => 'istore_woo_demo_section',
  	'default'			 => 1,
  	'priority'			 => 10,
  	'active_callback'	 => array(
  		array(
  			'setting'	 => 'istore_demo_front_page',
  			'operator'	 => '==',
  			'value'		 => 1,
  		),
  	),
  ) );
  Kirki::add_field( 'istore_settings', array(
  	'type'				 => 'image',
  	'settings'			 => 'istore_front_page_demo_banner_img',
  	'label'				 => __( 'Banner image', 'istore' ),
  	'section'			 => 'istore_woo_demo_section',
  	'default'			 => get_template_directory_uri() . '/template-parts/demo-img/demo-image-top.jpg',
  	'priority'			 => 10,
  	'active_callback'	 => array(
  		array(
  			'setting'	 => 'istore_front_page_demo_banner',
  			'operator'	 => '==',
  			'value'		 => 1,
  		),
  		array(
  			'setting'	 => 'istore_demo_front_page',
  			'operator'	 => '==',
  			'value'		 => 1,
  		),
  	),
  ) );
  Kirki::add_field( 'istore_settings', array(
  	'type'				 => 'text',
  	'settings'			 => 'istore_front_page_demo_banner_title',
  	'label'				 => __( 'Banner title', 'istore' ),
  	'default'			 => __( 'MaxStore', 'istore' ),
  	'section'			 => 'istore_woo_demo_section',
  	'priority'			 => 10,
  	'active_callback'	 => array(
  		array(
  			'setting'	 => 'istore_front_page_demo_banner',
  			'operator'	 => '==',
  			'value'		 => 1,
  		),
  		array(
  			'setting'	 => 'istore_demo_front_page',
  			'operator'	 => '==',
  			'value'		 => 1,
  		),
  	),
  ) );
  Kirki::add_field( 'istore_settings', array(
  	'type'				 => 'text',
  	'settings'			 => 'istore_front_page_demo_banner_desc',
  	'label'				 => __( 'Banner description', 'istore' ),
  	'default'			 => __( 'Edit this section in customizer', 'istore' ),
  	'section'			 => 'istore_woo_demo_section',
  	'priority'			 => 10,
  	'active_callback'	 => array(
  		array(
  			'setting'	 => 'istore_front_page_demo_banner',
  			'operator'	 => '==',
  			'value'		 => 1,
  		),
  		array(
  			'setting'	 => 'istore_demo_front_page',
  			'operator'	 => '==',
  			'value'		 => 1,
  		),
  	),
  ) );
  Kirki::add_field( 'istore_settings', array(
  	'type'				 => 'text',
  	'settings'			 => 'istore_front_page_demo_banner_url',
  	'label'				 => __( 'Banner url', 'istore' ),
  	'default'			 => '#',
  	'section'			 => 'istore_woo_demo_section',
  	'priority'			 => 10,
  	'active_callback'	 => array(
  		array(
  			'setting'	 => 'istore_front_page_demo_banner',
  			'operator'	 => '==',
  			'value'		 => 1,
  		),
  		array(
  			'setting'	 => 'istore_demo_front_page',
  			'operator'	 => '==',
  			'value'		 => 1,
  		),
  	),
  ) );
  Kirki::add_field( 'istore_settings', array(
  	'type'				 => 'custom',
  	'settings'			 => 'istore_demo_page_intro',
  	'label'				 => __( 'Products', 'istore' ),
  	'section'			 => 'istore_woo_demo_section',
  	'description'		 => esc_html__( 'If you dont see any products or categories on your homepage, you dont have any products probably. Create some products and categories first.', 'istore' ),
  	'priority'			 => 10,
  	'active_callback'	 => array(
  		array(
  			'setting'	 => 'istore_demo_front_page',
  			'operator'	 => '==',
  			'value'		 => 1,
  		),
  	),
  ) );
  Kirki::add_field( 'istore_settings', array(
  	'type'			 => 'custom',
  	'settings'		 => 'istore_demo_dummy_content',
  	'label'			 => __( 'Need Dummy Products?', 'istore' ),
  	'section'		 => 'istore_woo_demo_section',
  	'description'	 => sprintf( esc_html__( 'When the theme is first installed, you dont have any products probably. You can easily import dummy products with only few clicks. Check %s tutorial.', 'istore' ), '<a href="' . esc_url( 'https://docs.woocommerce.com/document/importing-woocommerce-dummy-data/' ) . '" target="_blank"><strong>' . __( 'THIS', 'istore' ) . '</strong></a>' ),
  	'priority'		 => 10,
  ) );
  Kirki::add_field( 'istore_settings', array(
  	'type'			 => 'custom',
  	'settings'		 => 'istore_demo_pro_features',
  	'label'			 => __( 'Need More Features?', 'istore' ),
  	'section'		 => 'istore_woo_demo_section',
  	'description'	 => '<a href="' . esc_url( 'http://themes4wp.com/product/maxstore-pro/' ) . '" target="_blank" class="button button-primary">' . sprintf( esc_html__( 'Learn more about %s PRO', 'istore' ), 'MaxStore' ) . '</a>',
  	'priority'		 => 10,
  ) );