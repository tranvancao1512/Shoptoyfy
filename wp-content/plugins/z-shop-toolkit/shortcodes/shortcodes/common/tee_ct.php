<?php 


class toolkit_basr_shortcode_tee_ct extends toolkit_basr_shortcode {

	// shortcode name 

	public $shortcode = 'tee_ct';

	// public $animation = 'true';  //  enable this to use make shortcode support animation

	// this->base = $prefix + $shortcode;

	// register script 

	public function register_script ( ) {

	}

	// Enqueue script, style 

	public function enqueue_script ( $extra = array() ) {
		if ( is_singular() ) {
			
			global $post;

			if ( has_shortcode( $post->post_content, "{$this->base}" ) ) {
				
				parent::enqueue_script();

			}
		}
	}

	// map shortcode to vc

	public function vc_map_shortcode() {
		vc_map( array(
						'base' 				=> $this->base,
						'name' 				=> esc_html__( 'Tee CountDown', 'basr-core' ),
						'class' 			=> '',
						'category' 			=> $this->cat,
						'icon' 				=> $this->icon,
						'params' 			=> array(
							array(
								'param_name'       => $this->base . '_id',
								'heading'          => esc_html__( 'ID', 'basr-core' ),
								'type'             => 'textfield',
								'value'            =>  0,
								'edit_field_class' => 'hidden',
							),
							array(
								'param_name'       => 'date',
								'heading'          => esc_html__( 'ID', 'basr-core' ),
								'type'             => 'textfield',
								'value'            =>  0,
							),

							toolkit_basr_vcf_class(),

							// toolkit_basr_vcf_animate( $i =  0,1,2 ); anable animation , animation name, animation delay .

							// More fields here 

						),
					) 
				);
	}

	// Render html

	public function generate_html( $atts, $content = null ) {

		$sc_atts =  array( 
						$this->base . '_id' 				=> ''				,
						// atts here  
						'date'								=> '',

						'classes'							=> ''				,
					);

		extract( shortcode_atts( $sc_atts, $atts ) );

		// Enqueue 

		$this->enqueue_script();

		// get id 
		
		$id = ${$this->base . '_id'} ;

		// get class

		$classes .= $this->get_class( '' ); // pass id setting if need vc custome css class

		// set up shortcode here

			// variable ...

		// Start out put

		$output  = '<div id="' . $id . '" class="' . $classes . '" ' . $this->animation_data( $sc_atts ) . '>';

		// content
		$rand = rand( 4, 15 ); 

		$output .= '<div class="progressbar">HURRY! ONLY <span>' . $rand . '</span>LEFT IN STOCK!<div class="status"></div></div>';

		$output .= '<div id="tee-ct" class="tee-ct" data-date="' . $date . '">';
			$output .= '<span class="days"></span>';
			$output .= '<span class="hours"></span>';
			$output .= '<span class="minutes"></span>';
			$output .= '<span class="seconds"></span>';
		$output .= '</div>';

		$output .= '<div><p class="progressbar_text">Sale Ends Once The timer Hits Zero!</p></div>';

		// $output .= wpb_js_remove_wpautop( $content, true );

		$output .= '</div>';

		// filter 

		$output = apply_filters( 'basr_{$this->base}_filter', $output );

		return $output;
	}

	// Render custom css

	public function generate_shortcode_css ( $atts ) {

		extract( shortcode_atts( array(
			$this->base . '_id' 		=> ''			,
			'classes'					=> ''			,
			// atts here

		), $atts ) );

		$id = '#' . ${ $this->base . '_id' };

		$css = '';

		return $css;
	}

}
