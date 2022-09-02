<?php
if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'ecommercegoldly_documentation_Upsell_Sections' ) ) {
    /**
     * Create our upsell section.
     * Escape your URL in the Customizer using esc_url().
     *
     * @since unknown
     */
    class ecommercegoldly_documentation_Upsell_Sections extends WP_Customize_Section {
        /**
         * Set type.
         *
         * @var public $type
         */
        public $type = 'gp-upsell-sections';

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

if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'ecommercegoldly_pro_Section' ) ) {
    /**
     * Create our upsell section.
     * Escape your URL in the Customizer using esc_url().
     *
     * @since unknown
     */
    class ecommercegoldly_pro_Section extends WP_Customize_Section {
        /**
         * Set type.
         *
         * @var public $type
         */
        public $type = 'gp-upselles-sections';

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
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'ecommercegoldly_pro_option_Control' ) ) {
	class ecommercegoldly_pro_option_Control extends WP_Customize_Control {
	
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
			<label class='customize-control-title'>More Options Available in Ecommerce Goldly Pro!</label>
			<a href="https://www.xeeshop.com/product/ecommerce-goldly-pro/" class="button button-secondary button_more_pro" target="_blank">Lern More</a>
		</div>
		<?php
	}
}
}
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'ecommercegoldly_Drag_Drop_pro_option_Control' ) ) {
    class ecommercegoldly_Drag_Drop_pro_option_Control extends WP_Customize_Control {
    
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
            <label class='customize-control-title'><?php echo esc_attr($this->label); ?></label>
            <a href="https://www.xeeshop.com/product/ecommerce-goldly-pro/" class="button button-secondary button_more_pro" target="_blank">Lern More</a>
        </div>
        <?php
    }
}
}
if ( ! function_exists( 'Goldly_full_banner_section' ) ) :
    function Goldly_full_banner_section( $selector = 'header' ) {
        get_template_part( 'customizer/theme_option/full_banner' );
    }
endif;
if ( ! function_exists( 'Goldly_product_category_section' ) ) :
    function Goldly_product_category_section( $selector = 'header' ) {
        get_template_part( 'customizer/theme_option/product_category' );
    }
endif;