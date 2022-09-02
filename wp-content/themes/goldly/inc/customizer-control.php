<?php
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'goldly_GeneratePress_Upsell_Section' ) ) {

	/**
	 * Astra_Pro_Customizer Initial setup
	 */
	class goldly_GeneratePress_Upsell_Section extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'ast-description';
	
	/**
         * Set ID.
         *
         * @var public $id
         */
        public $id = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();		

		$this->json['label']       = esc_html( $this->label );
		$json['id'] = $this->id;
            return $json;
	}

	/**
	 * Render the control's content.
	 *
	 * @see WP_Customize_Control::render_content()
	 */
	protected function render_content() {
		?>
		<h3 class="section-heading">
            <?php echo esc_html( $this->label ); ?>      
        </h3>
		<?php
	}
	}

}
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Goldly_Custom_Radio_Image_Control' ) ) {
	class Goldly_Custom_Radio_Image_Control extends WP_Customize_Control {
	
	/**
	 * Declare the control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'radio-image';
	
	/**
	 * Render the control to be displayed in the Customizer.
	 */
	public function render_content() {
		if ( empty( $this->choices ) ) {
			return;
		}			
		
		$name = '_customize-radio-' . $this->id;
		?>
		<span class="customize-control-title">
			<?php echo esc_html( $this->label ); ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
		</span>
		<div id="input_<?php echo esc_attr( $this->id ); ?>" class="image">
			<?php foreach ( $this->choices as $value => $label ) : ?>
					<label for="<?php echo esc_attr( $this->id ) . esc_attr( $value ); ?>">
						<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo esc_attr( $this->id ) . esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
						<img src="<?php echo esc_html( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
						</input>
					</label>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
}
if ( ! function_exists( 'goldly_breadcrumb_title' ) ) {
	function goldly_breadcrumb_title() {
		
		if ( is_home() || is_front_page()):
			
			single_post_title();
			
		elseif ( is_day() ) : 
										
			printf( esc_html( 'Daily Archives: %s', 'experoner' ), get_the_date() );
		
		elseif ( is_month() ) :
		
			printf( esc_html( 'Monthly Archives: %s', 'experoner' ), (get_the_date( 'F Y' ) ));
			
		elseif ( is_year() ) :
		
			printf( esc_html( 'Yearly Archives: %s', 'experoner' ), (get_the_date( 'Y' ) ) );
			
		elseif ( is_category() ) :
		
			printf( esc_html( 'Category Archives: %s', 'experoner' ), (single_cat_title( '', false ) ));

		elseif ( is_tag() ) :
		
			printf( esc_html( 'Tag Archives: %s', 'experoner' ), (single_tag_title( '', false ) ));
			
		elseif ( is_404() ) :

			printf( esc_html( 'Error 404', 'experoner' ));
			
		elseif ( is_author() ) :
		
			printf( esc_html( 'Author: %s', 'experoner' ), (get_the_author( '', false ) ));			
			
		elseif ( class_exists( 'woocommerce' ) ) : 
			
			if ( is_shop() ) {
				woocommerce_page_title();
			}
			
			elseif ( is_cart() ) {
				the_title();
			}
			
			elseif ( is_checkout() ) {
				the_title();
			}
			
			else {
				the_title();
			}
		else :
				the_title();
				
		endif;
	}
}
if ( ! function_exists( 'goldly_breadcrumb_sections' ) ) :
	function goldly_breadcrumb_sections( $selector = 'header' ) {
		get_template_part( 'template-parts/theme_option/breadcrumb' );
	}
endif;
if ( ! function_exists( 'Goldly_featuredimage_slider' ) ) :
	function Goldly_featuredimage_slider( $selector = 'header' ) {
		get_template_part( 'template-parts/theme_option/featured_slider' );
	}
endif;
if ( ! function_exists( 'Goldly_featured_section' ) ) :
	function Goldly_featured_section( $selector = 'header' ) {
		get_template_part( 'template-parts/theme_option/featured_section' );
	}
endif;
if ( ! function_exists( 'Goldly_about_section' ) ) :
	function Goldly_about_section( $selector = 'header' ) {
		get_template_part( 'template-parts/theme_option/about_section' );
	}
endif;
if ( ! function_exists( 'Goldly_our_portfolio_section' ) ) :
	function Goldly_our_portfolio_section( $selector = 'header' ) {
		get_template_part( 'template-parts/theme_option/our_portfolio' );
	}
endif;
if ( ! function_exists( 'Goldly_our_team_section' ) ) :
	function Goldly_our_team_section( $selector = 'header' ) {
		get_template_part( 'template-parts/theme_option/our_team' );
	}
endif;
if ( ! function_exists( 'Goldly_our_testimonial_section' ) ) :
	function Goldly_our_testimonial_section( $selector = 'header' ) {
		get_template_part( 'template-parts/theme_option/our_testimonial' );
	}
endif;
if ( ! function_exists( 'Goldly_our_services_section' ) ) :
	function Goldly_our_services_section( $selector = 'header' ) {
		get_template_part( 'template-parts/theme_option/our_services' );
	}
endif;
if ( ! function_exists( 'goldly_social_section' ) ) :
	function goldly_social_section( $selector = 'header' ) {
		get_template_part( 'template-parts/social_info/social_secion' );
	}
endif;
if ( ! function_exists( 'Goldly_our_sponsors_section' ) ) :
	function Goldly_our_sponsors_section( $selector = 'header' ) {
		get_template_part( 'template-parts/theme_option/our_sponsors' );
	}
endif;
if ( ! function_exists( 'Goldly_widget_section' ) ) :
	function Goldly_widget_section( $selector = 'header' ) {
		get_template_part( 'template-parts/theme_option/widget_section' );
	}
endif;



if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'goldly_custom_ordering' ) ) {

class goldly_custom_ordering extends WP_Customize_Control {
/**
* The type of control being rendered
*/
public $type = 'sortable_repeater';
/**
* Enqueue our scripts and styles
*/
public function enqueue() {
wp_enqueue_script( 'goldly_custom_controls_js', trailingslashit( get_template_directory_uri() ) . 'assets/js/customizer-rep.js', array( 'jquery' ), '1.0', true );
}
/**
* Render the control in the customizer
*/
public function render_content() {
        ?>
          <div class="drag_and_drop_control">
                <?php if( !empty( $this->label ) ) { ?>
                	<h3 class="section-heading">
	                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                </h3>
                <?php } ?>
                <?php if( !empty( $this->description ) ) { ?>
                    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php } ?>
                <?php
                $goldly_diseble = get_theme_mod( 'goldly_diseble' );
				$goldly_diseble_arr =  explode(",",$goldly_diseble); 
				
                ?>
                <ul class="sortable">
                	<?php
						$valuechoices = $this->choices;
						foreach ($valuechoices as $key => $value) {
							?>
							<li class="repeater <?php echo (in_array($key, $goldly_diseble_arr)?'invisibility':'');?>" value="<?php echo esc_attr($key)?>" id='<?php echo esc_attr($key)?>'>
		                        <div class="repeater-input">
		                        	<i class='dashicons dashicons-visibility visibility'></i>
		                        	<?php echo esc_attr($value); ?>
		                        </div>
		                    </li>
							<?php
						}								
					?>	
                </div>
 
            </div>
        <?php
        }
}
}
if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'goldly_documentation_Upsell_Section' ) ) {
    /**
     * Create our upsell section.
     * Escape your URL in the Customizer using esc_url().
     *
     * @since unknown
     */
    class goldly_documentation_Upsell_Section extends WP_Customize_Section {
        /**
         * Set type.
         *
         * @var public $type
         */
        public $type = 'gp-upsell-section';

        /**
         * Set pro URL.
         *
         * @var public $pro_url
         */
        public $pro_url = '';

        /**
         * Set pro text.
         *
         * @var public $pro_text
         */
        public $pro_text = '';

        /**
         * Set ID.
         *
         * @var public $id
         */
        public $id = '';

        /**
         * Send variables to json.
         */
        public function json() {
            $json = parent::json();
            $json['pro_text'] = $this->pro_text;
            $json['pro_url']  = esc_url( $this->pro_url );
            $json['id'] = $this->id;
            return $json;
        }

        /**
         * Render content.
         */
        protected function render_template() {
            ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

                <h3 class="accordion-section-title">
                    {{ data.title }}

                    <# if ( data.pro_text && data.pro_url ) { #>
                    <a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
                </h3>
            </li>   
            <?php
        }
    }
}
if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'goldly_pro_Section' ) ) {
    /**
     * Create our upsell section.
     * Escape your URL in the Customizer using esc_url().
     *
     * @since unknown
     */
    class goldly_pro_Section extends WP_Customize_Section {
        /**
         * Set type.
         *
         * @var public $type
         */
        public $type = 'gp-upselles-section';

        /**
         * Set pro URL.
         *
         * @var public $pro_url
         */
        public $pro_url = '';

        /**
         * Set pro text.
         *
         * @var public $pro_text
         */
        public $pro_text = '';

        /**
         * Set ID.
         *
         * @var public $id
         */
        public $id = '';

        /**
         * Send variables to json.
         */
        public function json() {
            $json = parent::json();
            $json['pro_text'] = $this->pro_text;
            $json['pro_url']  = esc_url( $this->pro_url );
            $json['id'] = $this->id;
            return $json;
        }

        /**
         * Render content.
         */
        protected function render_template() {
            ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

                    <# if ( data.pro_text && data.pro_url ) { #>
                    <a href="{{ data.pro_url }}" class="button button-secondary alignright button_pro" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
            </li>   
            <?php
        }
    }
}
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Goldly_pro_option_Control' ) ) {
	class Goldly_pro_option_Control extends WP_Customize_Control {
	
	/**
	 * Declare the control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'more-option';
	/**
         * Set ID.
         *
         * @var public $id
         */
        public $id = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	/*public function to_json() {
		parent::to_json();		

		$this->json['label']       = esc_html( $this->label );
		$json['id'] = $this->id;
            return $json;
	}*/
	 public function json() {
            $json = parent::json();
            $this->json['label']       = esc_html( $this->label );
            $json['id'] = $this->id;
            return $json;
        }
	/**
	 * Render the control to be displayed in the Customizer.
	 */
	protected function render_content() {
		$proverslink = apply_filters('goldly_proversinline', 'https://www.xeeshop.com/product/goldly-pro');
		?>
		<div class="title_pro_heading">
<!-- 			<label for="_customize-input-<?php echo esc_html( $this->id ); ?>" class="customize-control-title title_pro"><?php echo esc_html( $this->label ); ?> </label> -->
			<label class='customize-control-title'>More Options Available in Goldly Pro!</label>
			<a href="<?php echo $proverslink;?>" class="button button-secondary button_more_pro" target="_blank">Lern More</a>
		</div>
		<?php
	}
}
}
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Goldly_Custom_Radio_Control' ) ) {
	class Goldly_Custom_Radio_Control extends WP_Customize_Control {
	
	/**
	 * Declare the control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'radio-select';
	
	/**
	 * Render the control to be displayed in the Customizer.
	 */
	public function render_content() {
		if ( empty( $this->choices ) ) {
			return;
		}			
		
		$name = '_customize-radio-' . $this->id;

		?>
		<span class="customize-control-title">
			<?php echo esc_html( $this->label ); ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
		</span>
		<div id="input_<?php echo esc_attr( $this->id ); ?>" class="general_design_tab">
			<?php foreach ( $this->choices as $value => $label ) : 
				//print_r($label);
				?>
					<label for="<?php echo esc_attr( $this->id ) . esc_attr( $value ); ?>">
						<input class="general-design-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo esc_attr( $this->id ) . esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
						<h2><?php echo esc_html( $label ); ?></h2>
					</label>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WP_Customize_Transparent_Color_Control' ) ) {
	


	class WP_Customize_Transparent_Color_Control extends WP_Customize_Control {

	
	public $type = 'alpha-color';

	
	public $palette;

	
	public $show_opacity;

	
	public function enqueue() {
		wp_enqueue_script( 'goldly_custom_controls_js', trailingslashit( get_template_directory_uri() ) . 'assets/js/customizer-rep.js', array( 'jquery' ), '1.0', true );
	}

	
	public function render_content() {

		// Process the palette
		if ( is_array( $this->palette ) ) {
			$palette = implode( '|', $this->palette );
		} else {
			// Default to true.
			$palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
		}

		// Support passing show_opacity as string or boolean. Default to true.
		$show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';

		// Begin the output. ?>
		<label>
			<?php // Output the label and description if they were passed in.
			if ( isset( $this->label ) && '' !== $this->label ) {
				echo '<span class="customize-control-title">' . sanitize_text_field( $this->label ) . '</span>';
			}
			if ( isset( $this->description ) && '' !== $this->description ) {
				echo '<span class="description customize-control-description">' . sanitize_text_field( $this->description ) . '</span>';
			} ?>
			<input class="alpha-color-picker" type="text" data-show-opacity="<?php echo $show_opacity; ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?>  />
		</label>
		<?php
	}
}
}
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Goldly_drag_drop_option_Control' ) ) {
	class Goldly_drag_drop_option_Control extends WP_Customize_Control {
	
	/**
	 * Declare the control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'more-option';
	/**
         * Set ID.
         *
         * @var public $id
         */
        public $id = '';
	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	 public function json() {
            $json = parent::json();
            $this->json['label']       = esc_html( $this->label );
            $json['id'] = $this->id;
            return $json;
            }
	/**
	 * Render the control to be displayed in the Customizer.
	 */
	protected function render_content() {
		?>
		<div class="title_pro_heading">
			<label for="_customize-input-<?php echo esc_html( $this->id ); ?>" class="customize-control-title title_pro"><?php echo esc_html( $this->label ); ?> </label>
			<!-- <label class='customize-control-title'>More Options Available in Goldly Pro!</label> -->
			<a href="https://www.xeeshop.com/product/goldly-pro" class="button button-secondary button_more_pro" target="_blank">Lern More</a>
		</div>
		<?php
	}
}
}