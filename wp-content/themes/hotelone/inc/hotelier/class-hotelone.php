<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Hotelone_Hotelier' ) ) :

/**
 * Hotelone_Hotelier Class
 */
class Hotelone_Hotelier {

	/**
	 * Constructor.
	 */
	public function __construct() {

		// Remove default wrappers
		remove_action( 'hotelier_before_main_content', 'hotelier_output_content_wrapper', 10 );
		remove_action( 'hotelier_after_main_content', 'hotelier_output_content_wrapper_end', 10 );

		// Add custom wrappers
		add_action( 'hotelier_before_main_content', array( $this, 'open_content_wrapper' ), 10 );
		add_action( 'hotelier_after_main_content', array( $this, 'close_content_wrapper_end' ), 10 );
		add_action( 'hotelier_sidebar', array( $this, 'close_page_wrapper' ), 50 );

		// Enqueue custom style
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

		// Added a new currency 
		add_filter( 'hotelier_currencies', array( $this, 'hotelier_add_currency' ) );
		add_filter( 'hotelier_currency', array( $this, 'hotelier_get_currency' ) );
		add_filter( 'hotelier_currency_symbol', array( $this, 'hotelier_get_currency_symbol' ), 10, 2 );
	}

	/**
	 * Open the Hotelone content wrapper.
	 */
	public function open_content_wrapper() {

		$layout = hotelone_get_layout();
		$col = (is_active_sidebar( 'sidebar-1' )?'8':'12');
		if($layout=='none'){
			$col = '12';
		}
		?>
		<div id="site-content" class="site-content">
			<div class="container">
				<div class="row">

				<?php 
				if ( $layout != 'none' && $layout=='left' ) {
					get_sidebar();
				}
				?>

				<div class="col-md-<?php echo esc_attr( $col ); ?> primary">
		<?php
	}

	/**
	 * Close the Hotelone content wrapper.
	 */
	public function close_content_wrapper_end() {
		?>
		</div><!-- .col-md-x -->
		<?php
	}

	/**
	 * Close the Hotelone element wrapper after the sidebar.
	 */
	public function close_page_wrapper() {
		?>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .site-content -->
		<?php
	}

	/**
	 * Enqueue styles
	 */
	public function enqueue_styles() {
		$theme = wp_get_theme( 'hotelone' );
    	$version = $theme->get( 'Version' );
		wp_enqueue_style( 'hotelone-hotelier', get_template_directory_uri() .'/css/hotelier.css', array(), $version );
	}

	// New currency
	public function hotelier_add_currency( $currencies ) {
		$currencies[ 'ZAR' ] = 'South Africa Rand (R)';
    	return $currencies;
	}
	
	public function hotelier_get_currency( $currency ) {
    	return $currency;
	}

	public function hotelier_get_currency_symbol( $currency_symbol = '', $currency = 'USD' ){
		if($currency=='ZAR'){
			return $currency_symbol = 'R';
		}else{
			return $currency_symbol;
		}
	}
}

endif;

new Hotelone_Hotelier();