<?php
/**
 * Plugin Name: Recent Products Block
 * Description: Display WooCommerce Recent Products
 * Version: 1.0.0
 * Author: bPlugins LLC
 * Author URI: http://bplugins.com
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: recent-products
 */

// ABS PATH
if ( !defined( 'ABSPATH' ) ) { exit; }

// Constant
define( 'WRP_PLUGIN_VERSION', 'localhost' === $_SERVER['HTTP_HOST'] ? time() : '1.0.0' );
define( 'WRP_ASSETS_DIR', plugin_dir_url( __FILE__ ) . 'assets/' );

// Generate Styles
class WRPStyleGenerator {
	public static $styles = [];
	public static function addStyle( $selector, $styles ){
		if( array_key_exists( $selector, self::$styles ) ){
			self::$styles[$selector] = wp_parse_args( self::$styles[$selector], $styles );
		}else { self::$styles[$selector] = $styles; }
	}
	public static function renderStyle(){
		$output = '';
		foreach( self::$styles as $selector => $style ){
			$new = '';
			foreach( $style as $property => $value ){
				if( $value == '' ){
					$new .= $property;
				}else {
					$new .= " $property: $value;";
				}
			}
			$output .= "$selector { $new }";
		}
		return $output;
	}
}

// WooCommerce Recent Products
class WRPRecentProducts{
	function __construct(){
		add_action( 'plugins_loaded', [$this, 'pluginsLoaded'] );
		add_action( 'init', [$this, 'onInit'] );
	}

	function pluginsLoaded(){
		if ( !did_action( 'woocommerce_loaded' ) ) {
			add_action( 'admin_notices', [$this, 'wooCommerceNotLoaded'] );
			return;
		}
	}

	function wooCommerceNotLoaded(){
		if ( !current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$woocommerce = 'woocommerce/woocommerce.php';

		if ( $this->isPluginInstalled( $woocommerce ) ) {
			$activationUrl = wp_nonce_url( 'plugins.php?action=activate&amp;plugin='. $woocommerce .'&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_'. $woocommerce );

			$message = sprintf( __( '%1$s WooCommerce Recent Products Block.%2$s requires %1$sWooCommerce%2$s plugin to be active. Please activate WooCommerce to continue.', 'recent-products' ), "<strong>", "</strong>" );

			$button_text = __( 'Activate WooCommerce', 'recent-products' );
		} else {
			$activationUrl = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' );

			$message = sprintf( __( '%1$s WooCommerce Recent Products Block.%2$s requires %1$sWooCommerce%2$s plugin to be installed and activated. Please install WooCommerce to continue.', 'recent-products' ), '<strong>', '</strong>' );

			$button_text = __( 'Install WooCommerce', 'recent-products' );
		}

		$button = '<p><a href="'. esc_url( $activationUrl ) . '" class="button-primary">'. esc_html( $button_text ) .'</a></p>';

		printf( '<div class="error"><p>%1$s</p>%2$s</div>', $message, $button );
	}

	function isPluginInstalled( $basename ) {
		if ( !function_exists( 'get_plugins' ) ) {
			include_once ABSPATH .'/wp-admin/includes/plugin.php';
		}

		$installedPlugins = get_plugins();

		return isset( $installedPlugins[$basename] );
	}

	function onInit() {
		wp_register_style( 'wrp-recent-products-editor-style', plugins_url( 'dist/editor.css', __FILE__ ), [ 'wp-edit-blocks' ], WRP_PLUGIN_VERSION ); // Backend Style
		wp_register_style( 'wrp-recent-products-style', plugins_url( 'dist/style.css', __FILE__ ), [ 'wp-editor' ], WRP_PLUGIN_VERSION ); // Frontend Style

		register_block_type( __DIR__, [
			'editor_style'		=> 'wrp-recent-products-editor-style',
			'style'				=> 'wrp-recent-products-style',
			'render_callback'	=> [$this, 'render']
		] ); // Register Block

		wp_set_script_translations( 'wrp-recent-products-editor-script', 'recent-products', plugin_dir_path( __FILE__ ) . 'languages' ); // Translate
	}

	function render( $attributes ){
		extract( $attributes );

		$className = $className ?? '';
		$wrpBlockClassName = 'wp-block-wrp-recent-products ' . $className . ' align' . $align;

		$products = wc_get_products( [
			'limit'			=> $productsPerPage,
			'orderby'		=> 'date',
			'order'			=> 'DESC',
			'stock_status'	=> $stockStatus,
			'category'		=> $selectedCategories
		] );

		if( empty( $products ) ){
			ob_start(); ?>
				<h3 class='wrpNoProductFound'><?php echo __( 'No product found! Please add some or change query...', 'recent-products' ); ?></h3>
			<?php return ob_get_clean();
		}

		// Generate Styles
		$wrpStyles = new WRPStyleGenerator();
		$wrpStyles::addStyle( "#wrpRecentProducts-$cId .wrpRecentProducts", [
			'grid-gap' => "$rowGap $columnGap"
		] );
		$wrpStyles::addStyle( "#wrpRecentProducts-$cId .wrpProduct", [
			'text-align' => $textAlign,
			$productBG['styles'] ?? 'background: #0000' => '',
			$productBorder['styles'] ?? '' => '',
			$productShadow['styles'] ?? '' => '',
		] );
		$wrpStyles::addStyle( "#wrpRecentProducts-$cId .wrpProduct .productTitle", [
			$titleTypo['styles'] ?? 'font-size: 22px;' => '',
			'color' => $titleColor
		] );
		$wrpStyles::addStyle( "#wrpRecentProducts-$cId .wrpProduct .productRating .star-rating span", [
			'color' => $ratingColor
		] );
		$wrpStyles::addStyle( "#wrpRecentProducts-$cId .wrpProduct .productPrice", [
			$priceTypo['styles'] ?? 'font-size: 14px; font-weight: 700;' => '',
			'color' => $priceColor
		] );
		$wrpStyles::addStyle( "#wrpRecentProducts-$cId .wrpProduct .productAddToCartArea", [
			'justify-content' => $textAlign
		] );
		$wrpStyles::addStyle( "#wrpRecentProducts-$cId .wrpProduct .productAddToCartArea .button", [
			$addToCartTypo['styles'] ?? 'font-size: 15px; font-weight: 600;' => '',
			$addToCartColors['styles'] ?? 'color: #fff; background: #4527a4;' => ''
		] );
		$wrpStyles::addStyle( "#wrpRecentProducts-$cId .wrpProduct .productOnSale", [
			$onSaleColors['styles'] ?? 'color: #fff; background: #4527a4;' => ''
		] );

		ob_start(); ?>
		<div class='<?php echo esc_attr( $wrpBlockClassName ); ?>' id='wrpRecentProducts-<?php echo esc_attr( $cId ) ?>'>
			<style>
				<?php echo !empty( $titleTypo['googleFontLink'] ) ? "@import url(". esc_url( $titleTypo['googleFontLink'] ) .");" : ''; ?>
				<?php echo !empty( $priceTypo['googleFontLink'] ) ? "@import url(". esc_url( $priceTypo['googleFontLink'] ) .");" : ''; ?>
				<?php echo !empty( $addToCartTypo['googleFontLink'] ) ? "@import url(". esc_url( $addToCartTypo['googleFontLink'] ) .");" : ''; ?>
				<?php echo wp_kses( $wrpStyles::renderStyle(), [] ); ?>
			</style>

			<div class='wrpRecentProducts columns-<?php echo esc_attr( $columns['desktop'] ); ?> columns-tablet-<?php echo esc_attr( $columns['tablet'] ); ?> columns-mobile-<?php echo esc_attr( $columns['mobile'] ); ?>'>
				<?php foreach( $products as $product ) {
					echo $this->singlePostLayout( $attributes, $product );
				} ?>
			</div>
		</div>

		<?php $wrpStyles::$styles = []; // Empty styles
		return ob_get_clean();
	} // Render

	function singlePostLayout( $attributes, $product ){
		extract( $attributes );

		$ID = $product->get_id();

		ob_start(); ?>
		<article class='wrpProduct wrpProduct-<?php echo esc_attr( $ID ); ?>'>
			<?php echo $this->productImage( $product, $attributes ); ?>
			
			<div class='wrpProductDetails'>
				<?php
					echo $this->productTitle( $product, $attributes );
					echo $this->productRating( $product, $attributes );
					echo $this->productPrice( $product, $attributes );
					echo $this->productAddToCartArea( $product, $attributes );
					?>
			</div>

			<?php echo $this->productOnSale( $product, $attributes ); ?>
		</article>
		<?php return ob_get_clean();
	} // Single Post Layout

	function productImage( $product, $attributes ){
		$ID = $product->get_id();
		$link = esc_url( $product->get_permalink() );
		$hasImage = has_post_thumbnail( $ID );
		$imgHTML = get_the_post_thumbnail( $ID );
		$placeImg = wc_placeholder_img_src();

		if( !empty( $attributes['isImage'] ) ){
			ob_start(); ?>
			<a href='<?php echo esc_attr( $link ); ?>'>
				<figure class='wrpProductImg'>
					<?php echo $hasImage ? wp_kses_post( $imgHTML ) : "<img src='". esc_attr( $placeImg ) ."' alt='Placeholder' />"; ?>
				</figure>
			</a>
		<?php return ob_get_clean();
		}else{
			return '';
		}
	} // Product Image

	function productTitle( $product, $attributes ){
		$link = esc_url( $product->get_permalink() );

		if( !empty( $attributes['isTitle'] ) ){
			ob_start(); ?>
			<h3 class='productTitle'>
				<a href='<?php echo esc_attr( $link ); ?>'>
					<?php echo wp_kses_post( $product->get_title() ); ?>
				</a>
			</h3>
		<?php return ob_get_clean();
		}else{
			return '';
		}
	} // Product Title

	function productRating( $product, $attributes ){
		$rating_count	= $product->get_rating_count();
		$average		= $product->get_average_rating();

		if( !empty( $attributes['isRating'] ) ){
			ob_start(); ?>
			<div class='productRating'>
				<?php echo wc_get_rating_html( $average, $rating_count ) ?>
			</div>
		<?php return ob_get_clean();
		}else{
			return '';
		}
	} // Product Rating

	function productPrice( $product, $attributes ){
		if( !empty( $attributes['isPrice'] ) ){
			ob_start(); ?>
			<div class='productPrice'><?php echo $product->get_price_html(); ?></div>
		<?php return ob_get_clean();
		}else{
			return '';
		}
	} // Product Price

	function productAddToCartArea( $product, $attributes ) {
		$attr = [
			'aria-label'		=> $product->add_to_cart_description(),
			'data-quantity'		=> '1',
			'data-product_id'	=> $product->get_id(),
			'data-product_sku'	=> $product->get_sku(),
			'rel'				=> 'nofollow',
			'class'				=> 'button add_to_cart_button',
		];

		if (
			$product->supports( 'ajax_add_to_cart' ) &&
			$product->is_purchasable() &&
			( $product->is_in_stock() || $product->backorders_allowed() )
		) {
			$attr['class'] .= ' ajax_add_to_cart';
		}

		if( !empty( $attributes['isAddToCartBtn'] ) ){
			ob_start(); ?>
			<div class='productAddToCartArea'>
				<a href='<?php echo esc_url( $product->add_to_cart_url() ); ?>' <?php echo wc_implode_html_attributes( $attr ); ?>>
					<?php echo esc_html( $product->add_to_cart_text() ); ?>
				</a>
			</div>
		<?php return ob_get_clean();
		}else{
			return '';
		}
	} // Add To Cart Button

	function productOnSale( $product, $attributes ) {
		if( $product->is_on_sale() ){
			ob_start(); ?>
			<div class='productOnSale'>
				<span aria-hidden='true'>
					<?php echo esc_html__( 'Sale', 'recent-products' ); ?>
				</span>
				<span class='screen-reader-text'>
					<?php echo esc_html__( 'Product on sale', 'recent-products' ); ?>
				</span>
			</div>
		<?php return ob_get_clean();
		}else{
			return '';
		}
	} // Product On Sale
}
new WRPRecentProducts();