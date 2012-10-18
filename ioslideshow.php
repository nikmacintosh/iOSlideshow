<?php
/*
 * Plugin Name: iOSlideshow
 * Plugin URI: https://github.com/knickmack/iOSlideshow
 * Description: A Wordpress plugin for playing a simple slideshow inside an iPhone mockup.
 * Author: GameCall Social Sports
 * Version: 0.0.1
 * Author URI: http://www.gamecall.me
 */

if ( !class_exists( 'iOSlideshow' ) ) {

class iOSlideshow {
	private function attachments() {
		global $post;
		$args = array(
			'numberposts' => -1,
			'order' => 'ASC',
			'orderby' => 'title',
			'post_parent' => $post->ID,
			'post_status' => null,
			'post_type' => 'attachment'
		);

		return get_posts( $args );
	}

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_shortcode( 'ioslideshow', array( $this, 'render' ) );
	}

	public function enqueue_scripts() {
		wp_register_style( 'ioslideshow', plugins_url( 'css/ioslideshow.css', __FILE__ ), array(), '0.0.1', false );
		wp_enqueue_style( 'ioslideshow' );

		wp_register_script( 'ioslideshow', plugins_url( 'js/ioslideshow.js', __FILE__ ), array( 'jquery' ), '0.0.1', true );
		wp_enqueue_script( 'ioslideshow' );
	}

	public function render() { ?>
		<ul class="ioslideshow">
			<?php if ( $this->attachments() ): foreach( $this->attachments() as $attachment ): ?>
			<li><?php echo wp_get_attachment_image( $attachment->ID, 'full' ) ?></li>
			<?php endforeach; endif; ?>
		</ul>
	<?php }
}

new iOSlideshow();

}