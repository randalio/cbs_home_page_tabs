<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Elementor_Tabbed_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'tabbed_slider';
    }

    public function get_title() {
        return __( 'CBS Tabbed Slider', 'elementor-tabbed-slider' );
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_keywords() {
        return [ 'tabs', 'slider', 'carousel', 'tabbed' ];
    }

    public function get_script_depends() {
        return [ 'elementor-tabbed-slider' ];
    }

    public function get_style_depends() {
        return [ 'elementor-tabbed-slider' ];
    }

    protected function register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Slides', 'elementor-tabbed-slider' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'slider_title',
            [
                'label' => __( 'Slider Title', 'elementor-tabbed-slider' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Slider Title', 'elementor-tabbed-slider' ),
                'label_block' => true,
            ]
        );


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'slide_name',
            [
                'label' => __( 'Tab Name', 'elementor-tabbed-slider' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Slide Title', 'elementor-tabbed-slider' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slide_eyebrow',
            [
                'label' => __( 'Slide Eyebrow Text', 'elementor-tabbed-slider' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Slide Eyebrow Text', 'elementor-tabbed-slider' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slide_text',
            [
                'label' => __( 'Slide Text', 'elementor-tabbed-slider' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'elementor-tabbed-slider' ),
                'rows' => 5,
            ]
        );

        $repeater->add_control(
            'slide_background_image',
            [
                'label' => __( 'Slide Background Image', 'elementor-tabbed-slider' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'slide_link',
            [
                'label' => __( 'Slide Link', 'elementor-tabbed-slider' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'elementor-tabbed-slider' ),
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => __( 'Slides', 'elementor-tabbed-slider' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_name' => __( 'Slide #1', 'elementor-tabbed-slider' ),
                        'slide_text' => __( 'Click edit button to change this text.', 'elementor-tabbed-slider' ),
                    ],
                    [
                        'slide_name' => __( 'Slide #2', 'elementor-tabbed-slider' ),
                        'slide_text' => __( 'Click edit button to change this text.', 'elementor-tabbed-slider' ),
                    ],
                ],
                'title_field' => '{{{ slide_name }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if ( empty( $settings['slides'] ) ) {
            return;
        }

        $this->add_render_attribute( 'wrapper', 'class', 'elementor-tabbed-slider-wrapper' );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            
            
            <div class="tabbed-slider-container">
                <div class="tabbed-slider-wrapper-inner">
                    <?php foreach ( $settings['slides'] as $index => $slide ) : 
                        $has_link = ! empty( $slide['slide_link']['url'] );
                        $link_attrs = '';
                        
                        if ( $has_link ) {
                            $this->add_link_attributes( 'slide-link-' . $index, $slide['slide_link'] );
                            $link_attrs = $this->get_render_attribute_string( 'slide-link-' . $index );
                        }
                    ?>
                        <div class="tabbed-slider-slide <?php echo $index === 0 ? 'active' : ''; ?>" 
                             style="background-image: url(<?php echo esc_url( $slide['slide_background_image']['url'] ); ?>);">
                            <div class="slide-overlay"></div>
                            <div class="slide-content">
                                <p class="slide-title"><?php echo esc_html( $slide['slide_eyebrow'] ); ?></p>
                                <h2 class="slide-text"><?php echo esc_html( $slide['slide_text'] ); ?></h2>
                                <?php if ( $has_link ) : ?>
                                    <a <?php echo $link_attrs; ?> class="slide-link-button">
                                        <?php _e( 'Read More', 'elementor-tabbed-slider' ); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
                                            <circle cx="25" cy="25" r="24" stroke="white" stroke-width="2"/>
                                            <path d="M15 15H35M35 15V35M35 15L15 35" stroke="white" stroke-width="2"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

           
            <div class="slider-footer">

                <div class="slider-title">
                    <h1>CBS Management Consulting Firm</h1>
                </div>

                <div class="tabbed-slider-tabs">
                    <?php foreach ( $settings['slides'] as $index => $slide ) : ?>
                        <button class="tabbed-slider-tab <?php echo $index === 0 ? 'active' : ''; ?>" data-slide="<?php echo $index; ?>">
                            <?php echo esc_html( $slide['slide_name'] ); ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="scroll-down">
                    <a href="#scrolldown">
                        <span class="scroll-text"><?php _e( 'Scroll', 'elementor-tabbed-slider' ); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52" fill="none">
                            <path d="M11.4597 21.3824L25.8281 35.7509L40.1965 21.3824" stroke="white" stroke-width="2"/>
                            <circle cx="26" cy="26" r="25" stroke="white" stroke-width="2"/>
                        </svg>
                    </a>
                </div>

            </div>


            

        </div>

        <div id="scrolldown"></div>
        <?php
    }

    protected function content_template() {
        ?>
        <# if ( settings.slides.length ) { #>
            <div class="elementor-tabbed-slider-wrapper">
                <div class="tabbed-slider-tabs">
                    <# _.each( settings.slides, function( slide, index ) { #>
                        <button class="tabbed-slider-tab {{ index === 0 ? 'active' : '' }}" data-slide="{{ index }}">
                            {{{ slide.slide_name }}}
                        </button>
                    <# }); #>
                </div>
                
                <div class="tabbed-slider-container">
                    <div class="tabbed-slider-wrapper-inner">
                        <# _.each( settings.slides, function( slide, index ) { #>
                            <div class="tabbed-slider-slide {{ index === 0 ? 'active' : '' }}" 
                                 style="background-image: url({{ slide.slide_background_image.url }});">
                                <div class="slide-overlay"></div>
                                <div class="slide-content">
                                    <h3 class="slide-title">{{{ slide.slide_name }}}</h3>
                                    <p class="slide-text">{{{ slide.slide_text }}}</p>
                                    <# if ( slide.slide_link.url ) { #>
                                        <a href="{{ slide.slide_link.url }}" class="slide-link-button">
                                            Learn More
                                        </a>
                                    <# } #>
                                </div>
                            </div>
                        <# }); #>
                    </div>
                
                </div>
            </div>
        <# } #>
        <?php
    }
}