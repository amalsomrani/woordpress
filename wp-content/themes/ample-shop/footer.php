<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ample_Shop
 */

?>


<footer>
   <?php if( is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') ) {?>

	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-3 col-xs-12 col-lg-4 collapsed-block">
                <?php dynamic_sidebar('footer-1'); ?>

            </div>
			<div class="col-sm-6 col-md-3 col-xs-12 col-lg-4 collapsed-block">
                <?php dynamic_sidebar('footer-2'); ?>
            </div>
			<div class="col-sm-6 col-md-2 col-xs-12 col-lg-4 collapsed-block">
				               <?php dynamic_sidebar('footer-3'); ?>

            </div>

		</div>
	</div>
    <?php } ?>
	<div class="footer-coppyright">
		<div class="container">
			<div class="row">
                <?php
                $copyright = ample_shop_get_option('ample_shop_copyright');
                ?>
				<div class="col-sm-12 col-xs-12 coppyright"> <?php if(!empty($copyright)){ echo esc_html( $copyright ); }  if(!empty($copyright)){ ?> | <?php } ?> <a href="<?php echo esc_url( __( 'https://amplethemes.com/', 'ample-shop' ) ); ?>"> <?php
                        /* translators: %s: CMS name, i.e. WordPress. */
                        printf( esc_html__( 'Design And Develop by %s', 'ample-shop' ), 'Ample Themes' );
                        ?> </a> </div>
			</div>
		</div>
	</div>
</footer>


</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
