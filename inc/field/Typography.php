<?php

namespace ctoolkit\field;

/**
 * Class Typography Control
 *
 * @class     Typography
 * @package   ctoolkit\field
 * @category  Class
 * @author    vutuansw
 * @license   GPLv3
 * @version   1.0
 */

/**
 * Typography Class
 */
class Typography extends \WP_Customize_Control {

	/**
	 * @var string Field type
	 */
	public $type = 'ctoolkit_typography';

	/**
	 * @var array Typography default options
	 */
	public $default;

	/**
	 * Constructor.
	 * Supplied `$args` override class property defaults.
	 * If `$args['settings']` is not defined, use the $id as the setting ID.
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    {@see WP_Customize_Control::__construct}.
	 */
	public function __construct( $manager, $id, $args = array() ) {

		parent::__construct( $manager, $id, $args );

		if ( !empty( $args['value'] ) && is_array( $args['value'] ) ) {
			$this->default = $args['value'];
		} else {
			$this->default = array();
		}
	}

	/**
	 * Render control
	 * @access public
	 */
	public function render_content() {

		echo '<span class="customize-control-title">' . esc_attr( $this->label ) . '</span>';

		$args = array(
			'type' => $this->type,
			'customize_link' => $this->get_link(),
			'default' => $this->default
		);

		if ( !empty( $this->description ) ) {
			printf( '<span class="description customize-control-description">%s</span>', $this->description );
		}

		$this->field( $args, $this->value() );
	}

	private function field( $settings, $value ) {

		$attrs = array();

		if ( !empty( $settings['name'] ) ) {
			$attrs[] = 'name="' . $settings['name'] . '"';
		}

		if ( !empty( $settings['id'] ) ) {
			$attrs[] = 'id="' . $settings['id'] . '"';
		}

		if ( !empty( $settings['customize_link'] ) ) {
			$attrs[] = $settings['customize_link'];
		}

		$data = array();

		/**
		 * Using the $subfields to decided which fields are appear
		 */
		$subfields = isset( $settings['default'] ) ? $settings['default'] : array();

		if ( !empty( $value ) && is_string( $value ) ) {
			$data = json_decode( urldecode( $value ), true );
		} else if ( is_array( $value ) ) {
			if ( !empty( $value['variants'] ) ) {
				$value['variants'] = implode( ',', $value['variants'] );
			}
			if ( !empty( $value['subsets'] ) ) {
				$value['subsets'] = implode( ',', $value['subsets'] );
			}

			$value = urlencode( json_encode( $value ) );
		}

		$attrs[] = 'data-type="typography"';

		$output = '';
		$output .= sprintf( '<div class="ctoolkit-field ctoolkit-typography" data-id="%s" data-value="%s">', uniqid(), $value );
		$output .= sprintf( '<input type="hidden" class="ctoolkit_value" %s/>', implode( $attrs ) );

		$output .= '<div class="font_family">';
		$output .= sprintf( '<label>%s</label>', __( 'Font Family', 'ctoolkit' ) );
		$output .= '<select></select>';
		$output .= '</div>';

		$output .= '<div class="variants">';
		$output .= sprintf( '<label>%s</label>', __( 'Variants', 'ctoolkit' ) );
		$output .= sprintf( '<select placeholder="%s" multiple>%s</select>', __( 'Select Variants...', 'ctoolkit' ), '' );
		$output .= '</div>';

		$output .= '<div class="subsets">';
		$output .= sprintf( '<label>%s</label>', __( 'Subsets', 'ctoolkit' ) );
		$output .= sprintf( '<select placeholder="%s" multiple>%s</select>', __( 'Select Subsets...', 'ctoolkit' ), '' );
		$output .= '</div>';

		$output .= '<div class="subrow">';

		if ( isset( $subfields['line-height'] ) ) {
			$output .= '<div class="line_height">';
			$output .= sprintf( '<label>%s</label>', __( 'Light Height', 'ctoolkit' ) );
			$line_height = isset( $data['line-height'] ) ? $data['line-height'] : '';
			$output .= sprintf( '<input type="text" value="%s" data-key="line-height"/>', $line_height );
			$output .= '</div>';
		}

		if ( isset( $subfields['font-size'] ) ) {

			$output .= '<div class="font_size">';
			$output .= sprintf( '<label>%s</label>', __( 'Font Size', 'ctoolkit' ) );
			$font_size = isset( $data['font-size'] ) ? $data['font-size'] : '';
			$output .= sprintf( '<input type="text" value="%s" data-key="font-size"/>', $font_size );
			$output .= '</div>';
		}

		if ( isset( $subfields['letter-spacing'] ) ) {
			$output .= '<div class="letter_spacing">';
			$output .= sprintf( '<label>%s</label>', __( 'Letter Spacing', 'ctoolkit' ) );
			$letter_spacing = isset( $data['letter-spacing'] ) ? $data['letter-spacing'] : '';
			$output .= sprintf( '<input type="text" value="%s" data-key="letter-spacing"/>', $letter_spacing );
			$output .= '</div>';
		}

		if ( isset( $subfields['text-transform'] ) ) {
			$output .= '<div class="text_transform">';
			$output .= sprintf( '<label>%s</label>', __( 'Text Transform', 'ctoolkit' ) );
			$text_transform = isset( $data['text-transform'] ) ? $data['text-transform'] : '';

			$text_transform_opts = array(
				'none' => esc_attr__( 'None', 'ctoolkit' ),
				'capitalize' => esc_attr__( 'Capitalize', 'ctoolkit' ),
				'uppercase' => esc_attr__( 'Uppercase', 'ctoolkit' ),
				'lowercase' => esc_attr__( 'Lowercase', 'ctoolkit' ),
				'initial' => esc_attr__( 'Initial', 'ctoolkit' )
			);

			$output .= '<select data-key="text-transform">';
			foreach ( $text_transform_opts as $key => $value ) {
				$output .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $text_transform, $key, false ), $value );
			}

			$output .= '</select>';
		}

		$output .= '</div>';

		$output .= '</div>';
		$output .= '</div>';

		echo $output;
	}

}
