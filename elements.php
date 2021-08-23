<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Widget_Lan_Hero_Page_Slider extends Widget_Base {

	public function get_name() {
		return 'landscape-mm-slider';
	}

	public function get_title() {
		return esc_html__( 'M Slider', 'landscape-core' );
	}

	public function get_script_depends() {
        return [
            'landscape-public'
        ];
    }

	public function get_icon() {
		return 'fa fa-header';
	}

    public function get_categories() {
		return [ 'landscape-for-elementor' ];
	}

	
	protected function _register_controls() {
        /**
         * Content Settings
         */
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content Settings', 'victusglobal-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();



		$repeater->add_control(
			'main_title', [
				'label' => __( 'Main Title', 'victusglobal-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Enter Main Title Here' , 'victusglobal-core' ),
				'label_block' => true,
			]
		);





		$repeater->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'victusglobal-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'cta_name', [
				'label' => __( 'Button Text', 'victusglobal-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Learn More' , 'victusglobal-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'cta_link', [
				'label' => __( 'Button Link', 'victusglobal-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'victusglobal-core' ),
				'show_external' => false,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => true,
				],
			]
		);		



		$this->add_control(
			'hero_slides',
			[
				'label' => __( 'Victus Global Image Text Slides', 'victusglobal-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'main_title' => __( 'Carousel Title', 'victusglobal-core' ),
					],
				],
				'title_field' => '{{{ main_title }}}',
			]
		);

		$this->end_controls_section();
		
		
		
		

		/**
		 * Style Tab
		 */
		$this->style_tab();

    }
	private function style_tab() {}
	protected function render() {
	$victusglobal = $this->get_settings_for_display();
	    $this->add_render_attribute(
			'victusglobal_page_heading_options',
			[
				'id' => 'victusglobal-slider-lightbox-'.$this->get_id(),
			]
		);
    ?>
<!-- Add Markup Starts -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js" integrity="sha512-G3hBdkIeUYJc1flNDPOYlCBoDkllX5f3wyk2BW8vNU9gAobQ8mnOpNC2t3kWxkWSz6aSCJUSqZn/C7Mb9yTbTg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css" rel="stylesheet"> -->

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet"> -->


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" /><div class="aligner">
	<div class="container">
		<div class="owl-carousel owl-theme">
			<?php foreach( $victusglobal['hero_slides'] as $slide ) : 
				$target = $slide['cta_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $slide['cta_link']['nofollow'] ? ' rel="nofollow"' : '';
			?>
			<div class="item">

				<a  class="example-image-link" href="<?php echo esc_url($slide['image']['url']) ?>" data-lightbox="gallery" data-title="<?php echo $slide['main_title']; ?> <a href='http://google.com'>Link to google</a>. More text."">
					<h3 class="slider-main-title"><?php echo $slide['main_title']; ?></h3>
					<img src="<?php echo esc_url($slide['image']['url']) ?>" alt="">
					<div class="slider-text-btn"><a href="<?php echo esc_url($slide['cta_link']['url']); ?>"<?php echo $target; ?> <?php echo $nofollow; ?>><?php echo $slide['cta_name']; ?></a></div>
				</a>

			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<script>
lightbox.option({
	'resizeDuration': 200,
	'wrapAround': true,
	'showImageNumberLabel': true,
	'albumLabel': "Pic %1 of %2"
})
</script>
<!-- Add Markup Starts -->
	<?php
	}
	protected function content_template() {}
}



Plugin::instance()->widgets_manager->register_widget_type( new Widget_Lan_Hero_Page_Slider() );
