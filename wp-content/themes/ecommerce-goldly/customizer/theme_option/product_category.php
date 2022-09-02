<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package goldly
 */

$terms_id = get_theme_mod( 'ecommerce_goldly_category','0');
$product_args = array ( 
	'post_type' => 'product',	
	'tax_query' => array(
      	array(
	        'taxonomy' => 'product_cat',
	        'field'     => 'term_id',
            'terms'     =>  array($terms_id),
	        'operator' => 'IN',
	        )
       	),
);	
$args = new WP_Query( $product_args );
if(get_theme_mod( 'ecommerce_product_checkbox','true')=='true'){
?>

<div class="ecommerce_product_section">
	<div class="eco_goldly_section goldly_title_underline">
		<h2 class="product_cat_title"><?php echo esc_attr(get_theme_mod( 'ecommerce_product_title','Collections')); ?></h2>
		<div class="product_section">
			<?php
			while( $args->have_posts() ) : $args->the_post();
				global $product;
				?>
					<div class="product_category_section">
						<div class="product_cat_info">
							<div class="product_info_img">
								<?php
								echo esc_attr(the_post_thumbnail( 'medium' ));  
								?>
							</div>
							<div class="product_title product_contain">
								<h3>
									<?php echo esc_attr(get_the_title());?>
								</h3>
							</div>
							<div class="product_price product_contain">
								<?php
									echo $product->get_price_html(get_the_ID()); 
								?>
							</div>
							<div class="product_btn product_contain">
								<a class="buttons" href="<?php echo esc_attr(get_the_permalink()); ?>"><?php echo esc_attr(get_theme_mod( 'ecommerce_product_btn_lable','View Product')); ?></a>
							</div>
						</div>
					</div>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</div>
<?php } ?>