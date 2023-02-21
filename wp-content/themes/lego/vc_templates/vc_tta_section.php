<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Section
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->resetVariables( $atts, $content );
WPBakeryShortCode_VC_Tta_Section::$self_count ++;
WPBakeryShortCode_VC_Tta_Section::$section_info[] = $atts;
$isPageEditable = vc_is_page_editable();

$output = '';
$new_class=str_replace('active','',$this->getElementClasses());
$output .= '<div class="' . esc_attr( $new_class ) . '"'; 
$output .= ' data-vc-content=".vc_tta-panel-body">';
$output .= '<div class="vc_tta-panel-heading"  id="' . esc_attr( $this->getTemplateVariable( 'tab_id' ) ) . '">';
$output .= $this->getTemplateVariable( 'heading' );
$output .= '</div>';
$output .= '<div class="vc_tta-panel-body"  id="show_' . esc_attr( $this->getTemplateVariable( 'tab_id' ) ) . '">';
if ( $isPageEditable ) {
	$output .= '<div data-js-panel-body>'; // fix for fe - shortcodes container, not required in b.e.
}
$output .= $this->getTemplateVariable( 'content' );
if ( $isPageEditable ) {
	$output .= '</div>';
}
$output .= '</div>';
$output .= '</div>';

echo $output;
