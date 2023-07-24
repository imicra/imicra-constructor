<?php
/**
 * Icon Picker class
 *
 * @package imicra
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Class imicra_Icon_Picker
 */
class Imicra_Icon_Picker extends WP_Customize_Control {
        
        /**
	 * Icon container.
	 *
	 * @var string $imicra_icon_container Icon container.
	 */
	private $imicra_icon_container = '';
        
        /**
	 * Class constructor
	 *
	 */
        public function __construct( $manager, $id, $args = array() ) {
            parent::__construct( $manager, $id, $args );
            
                
            if ( file_exists( get_template_directory() . '/inc/customizer-repeater/inc/icons.php' ) ) {
                    $this->imicra_icon_container = 'inc/customizer-repeater/inc/icons';
            }
        }
        
        /**
	 * Enqueue scripts
	 */
	public function enqueue() {}
        
        /**
	 * Render function
	 */
	public function render_content() { ?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="customizer-repeater-general-control-repeater">
			<div class="customizer-repeater-general-control-repeater-container">
                            <div class="customizer-repeater-box-content-hidden" style="display: block;">
                                <div class="social-repeater-general-control-icon">
                                        <span class="customize-control-title">
                                                <?php esc_html_e( 'Icon','imicra' ); ?>
                                        </span>
                                        <span class="description customize-control-description">
                                                <?php
                                                /* translators: %s is link to FontAwesome */
                                                printf( esc_html__( 'Note: Some icons may not be displayed here. You can see the full list of icons at %s', 'imicra' ),
                                        /* translators: %s is link label*/
                                                        sprintf( '<a href="http://fontawesome.io/icons/" target="_blank" rel="nofollow">%s</a>',
                                                                esc_html__( 'FontAwesome', 'imicra' )
                                                        )
                                                ); ?>
                                        </span>
                                        <div class="input-group icp-container">
                                                <input data-placement="bottomRight" class="icp icp-auto" value="<?php echo esc_attr( $this->value() ); ?>" type="text" <?php $this->link(); ?>>
                                                <span class="input-group-addon">
                                                        <i class="fa <?php echo esc_attr( $this->value() ); ?>"></i>
                                                </span>
                                        </div>
                                        <div class="ifamily">
                                            <?php get_template_part( $this->imicra_icon_container ); ?>
                                        </div>
                                </div>
                            </div>       
                        </div>
                </div>
		<?php
	}

}