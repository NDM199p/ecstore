<?php
/**
 * Storefront Customizer Class
 *
 * @package  storefront
 * @since    2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('EcStore_Customizer')):

    /**
     * The Storefront Customizer class
     */
    class EcStore_Customizer
    {

        /**
         * Setup class.
         *
         * @since 1.0
         */
        public function __construct()
        {
            add_action('customize_register', array($this, 'custom_controls'));
            add_action('customize_register', array($this, 'controls_helpers'));
            add_action('customize_register', array($this, 'customize_register'));
        }

        public function controls_helpers()
        {
            require_once 'customizer-helpers.php';
            require_once 'sanitization-callbacks.php';
        }

        public function custom_controls($wp_customize)
        {


            // Path
            $dir = 'controls/';

            // Load customize control classes
            require_once($dir . 'dimensions/class-control-dimensions.php');
            require_once($dir . 'dropdown-pages/class-control-dropdown-pages.php');
            require_once($dir . 'heading/class-control-heading.php');
            require_once($dir . 'info/class-control-info.php');
            require_once($dir . 'icon-select/class-control-icon-select.php');
            require_once($dir . 'icon-select-multi/class-control-icon-select-multi.php');
            require_once($dir . 'multiple-select/class-control-multiple-select.php');
            require_once($dir . 'slider/class-control-slider.php');
            require_once($dir . 'sortable/class-control-sortable.php');
            require_once($dir . 'text/class-control-text.php');
            require_once($dir . 'textarea/class-control-textarea.php');
            require_once($dir . 'typo/class-control-typo.php');
            require_once($dir . 'typography/class-control-typography.php');

            // Register JS control types
            $wp_customize->register_control_type('OceanWP_Customizer_Dimensions_Control');
            $wp_customize->register_control_type('OceanWP_Customizer_Dropdown_Pages');
            $wp_customize->register_control_type('OceanWP_Customizer_Heading_Control');
            $wp_customize->register_control_type('OceanWP_Customizer_Info_Control');
            $wp_customize->register_control_type('OceanWP_Customizer_Icon_Select_Control');
            $wp_customize->register_control_type('OceanWP_Customizer_Icon_Select_Multi_Control');
            $wp_customize->register_control_type('OceanWP_Customize_Multiple_Select_Control');
            $wp_customize->register_control_type('OceanWP_Customizer_Slider_Control');
            $wp_customize->register_control_type('OceanWP_Customizer_Sortable_Control');
            $wp_customize->register_control_type('OceanWP_Customizer_Text_Control');
            $wp_customize->register_control_type('OceanWP_Customizer_Textarea_Control');
            $wp_customize->register_control_type('OceanWP_Customizer_Typo_Control');
            $wp_customize->register_control_type('OceanWP_Customizer_Typography_Control');

        }

        public function customize_register($wp_customize)
        {
            require_once 'settings/topbar.php';
        }


        /**
         * Get Customizer css.
         *
         * @see get_storefront_theme_mods()
         * @return array $styles the css
         */
        public function get_css()
        {
            $storefront_theme_mods = $this->get_storefront_theme_mods();
            /**
             * Filters for brightening color value.
             *
             * @param int Numerical value for brighten amount.
             * @package  storefront
             * @since    2.0.0
             */
            $brighten_factor = apply_filters('storefront_brighten_factor', 25);
            /**
             * Filters for darkening color value.
             *
             * @param int Numerical value for darken amount.
             * @package  storefront
             * @since    2.0.0
             */
            $darken_factor = apply_filters('storefront_darken_factor', -25);

            $styles = '
			.main-navigation ul li a,
			.site-title a,
			ul.menu li a,
			.site-branding h1 a,
			button.menu-toggle,
			button.menu-toggle:hover,
			.handheld-navigation .dropdown-toggle {
				color: ' . $storefront_theme_mods['header_link_color'] . ';
			}

			button.menu-toggle,
			button.menu-toggle:hover {
				border-color: ' . $storefront_theme_mods['header_link_color'] . ';
			}

			.main-navigation ul li a:hover,
			.main-navigation ul li:hover > a,
			.site-title a:hover,
			.site-header ul.menu li.current-menu-item > a {
				color: ' . storefront_adjust_color_brightness($storefront_theme_mods['header_link_color'], 65) . ';
			}

			table:not( .has-background ) th {
				background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['background_color'], -7) . ';
			}

			table:not( .has-background ) tbody td {
				background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['background_color'], -2) . ';
			}

			table:not( .has-background ) tbody tr:nth-child(2n) td,
			fieldset,
			fieldset legend {
				background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['background_color'], -4) . ';
			}

			.site-header,
			.secondary-navigation ul ul,
			.main-navigation ul.menu > li.menu-item-has-children:after,
			.secondary-navigation ul.menu ul,
			.storefront-handheld-footer-bar,
			.storefront-handheld-footer-bar ul li > a,
			.storefront-handheld-footer-bar ul li.search .site-search,
			button.menu-toggle,
			button.menu-toggle:hover {
				background-color: ' . $storefront_theme_mods['header_background_color'] . ';
			}

			p.site-description,
			.site-header,
			.storefront-handheld-footer-bar {
				color: ' . $storefront_theme_mods['header_text_color'] . ';
			}

			button.menu-toggle:after,
			button.menu-toggle:before,
			button.menu-toggle span:before {
				background-color: ' . $storefront_theme_mods['header_link_color'] . ';
			}

			h1, h2, h3, h4, h5, h6, .wc-block-grid__product-title {
				color: ' . $storefront_theme_mods['heading_color'] . ';
			}

			.widget h1 {
				border-bottom-color: ' . $storefront_theme_mods['heading_color'] . ';
			}

			body,
			.secondary-navigation a {
				color: ' . $storefront_theme_mods['text_color'] . ';
			}

			.widget-area .widget a,
			.hentry .entry-header .posted-on a,
			.hentry .entry-header .post-author a,
			.hentry .entry-header .post-comments a,
			.hentry .entry-header .byline a {
				color: ' . storefront_adjust_color_brightness($storefront_theme_mods['text_color'], 5) . ';
			}

			a {
				color: ' . $storefront_theme_mods['accent_color'] . ';
			}

			a:focus,
			button:focus,
			.button.alt:focus,
			input:focus,
			textarea:focus,
			input[type="button"]:focus,
			input[type="reset"]:focus,
			input[type="submit"]:focus,
			input[type="email"]:focus,
			input[type="tel"]:focus,
			input[type="url"]:focus,
			input[type="password"]:focus,
			input[type="search"]:focus {
				outline-color: ' . $storefront_theme_mods['accent_color'] . ';
			}

			button, input[type="button"], input[type="reset"], input[type="submit"], .button, .widget a.button {
				background-color: ' . $storefront_theme_mods['button_background_color'] . ';
				border-color: ' . $storefront_theme_mods['button_background_color'] . ';
				color: ' . $storefront_theme_mods['button_text_color'] . ';
			}

			button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .widget a.button:hover {
				background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['button_background_color'], $darken_factor) . ';
				border-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['button_background_color'], $darken_factor) . ';
				color: ' . $storefront_theme_mods['button_text_color'] . ';
			}

			button.alt, input[type="button"].alt, input[type="reset"].alt, input[type="submit"].alt, .button.alt, .widget-area .widget a.button.alt {
				background-color: ' . $storefront_theme_mods['button_alt_background_color'] . ';
				border-color: ' . $storefront_theme_mods['button_alt_background_color'] . ';
				color: ' . $storefront_theme_mods['button_alt_text_color'] . ';
			}

			button.alt:hover, input[type="button"].alt:hover, input[type="reset"].alt:hover, input[type="submit"].alt:hover, .button.alt:hover, .widget-area .widget a.button.alt:hover {
				background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['button_alt_background_color'], $darken_factor) . ';
				border-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['button_alt_background_color'], $darken_factor) . ';
				color: ' . $storefront_theme_mods['button_alt_text_color'] . ';
			}

			.pagination .page-numbers li .page-numbers.current {
				background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['background_color'], $darken_factor) . ';
				color: ' . storefront_adjust_color_brightness($storefront_theme_mods['text_color'], -10) . ';
			}

			#comments .comment-list .comment-content .comment-text {
				background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['background_color'], -7) . ';
			}

			.site-footer {
				background-color: ' . $storefront_theme_mods['footer_background_color'] . ';
				color: ' . $storefront_theme_mods['footer_text_color'] . ';
			}

			.site-footer a:not(.button):not(.components-button) {
				color: ' . $storefront_theme_mods['footer_link_color'] . ';
			}

			.site-footer .storefront-handheld-footer-bar a:not(.button):not(.components-button) {
				color: ' . $storefront_theme_mods['header_link_color'] . ';
			}

			.site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6, .site-footer .widget .widget-title, .site-footer .widget .widgettitle {
				color: ' . $storefront_theme_mods['footer_heading_color'] . ';
			}

			.page-template-template-homepage.has-post-thumbnail .type-page.has-post-thumbnail .entry-title {
				color: ' . $storefront_theme_mods['hero_heading_color'] . ';
			}

			.page-template-template-homepage.has-post-thumbnail .type-page.has-post-thumbnail .entry-content {
				color: ' . $storefront_theme_mods['hero_text_color'] . ';
			}

			@media screen and ( min-width: 768px ) {
				.secondary-navigation ul.menu a:hover {
					color: ' . storefront_adjust_color_brightness($storefront_theme_mods['header_text_color'], $brighten_factor) . ';
				}

				.secondary-navigation ul.menu a {
					color: ' . $storefront_theme_mods['header_text_color'] . ';
				}

				.main-navigation ul.menu ul.sub-menu,
				.main-navigation ul.nav-menu ul.children {
					background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['header_background_color'], -15) . ';
				}

				.site-header {
					border-bottom-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['header_background_color'], -15) . ';
				}
			}';

            /**
             * Filters for Storefront Customizer CSS.
             *
             * @param object Object of CSS rulesets.
             * @package  storefront
             * @since    2.0.0
             */
            return apply_filters('storefront_customizer_css', $styles);
        }

        /**
         * Get Gutenberg Customizer css.
         *
         * @see get_storefront_theme_mods()
         * @return array $styles the css
         */
        public function gutenberg_get_css()
        {
            $storefront_theme_mods = $this->get_storefront_theme_mods();
            /**
             * Filters for darkening color value.
             *
             * @param int Numerical value for darken amount.
             * @package  storefront
             * @since    2.0.0
             */
            $darken_factor = apply_filters('storefront_darken_factor', -25);

            // Gutenberg.
            $styles = '
				.wp-block-button__link:not(.has-text-color) {
					color: ' . $storefront_theme_mods['button_text_color'] . ';
				}

				.wp-block-button__link:not(.has-text-color):hover,
				.wp-block-button__link:not(.has-text-color):focus,
				.wp-block-button__link:not(.has-text-color):active {
					color: ' . $storefront_theme_mods['button_text_color'] . ';
				}

				.wp-block-button__link:not(.has-background) {
					background-color: ' . $storefront_theme_mods['button_background_color'] . ';
				}

				.wp-block-button__link:not(.has-background):hover,
				.wp-block-button__link:not(.has-background):focus,
				.wp-block-button__link:not(.has-background):active {
					border-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['button_background_color'], $darken_factor) . ';
					background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['button_background_color'], $darken_factor) . ';
				}

				.wc-block-grid__products .wc-block-grid__product .wp-block-button__link {
					background-color: ' . $storefront_theme_mods['button_background_color'] . ';
					border-color: ' . $storefront_theme_mods['button_background_color'] . ';
					color: ' . $storefront_theme_mods['button_text_color'] . ';
				}

				.wp-block-quote footer,
				.wp-block-quote cite,
				.wp-block-quote__citation {
					color: ' . $storefront_theme_mods['text_color'] . ';
				}

				.wp-block-pullquote cite,
				.wp-block-pullquote footer,
				.wp-block-pullquote__citation {
					color: ' . $storefront_theme_mods['text_color'] . ';
				}

				.wp-block-image figcaption {
					color: ' . $storefront_theme_mods['text_color'] . ';
				}

				.wp-block-separator.is-style-dots::before {
					color: ' . $storefront_theme_mods['heading_color'] . ';
				}

				.wp-block-file a.wp-block-file__button {
					color: ' . $storefront_theme_mods['button_text_color'] . ';
					background-color: ' . $storefront_theme_mods['button_background_color'] . ';
					border-color: ' . $storefront_theme_mods['button_background_color'] . ';
				}

				.wp-block-file a.wp-block-file__button:hover,
				.wp-block-file a.wp-block-file__button:focus,
				.wp-block-file a.wp-block-file__button:active {
					color: ' . $storefront_theme_mods['button_text_color'] . ';
					background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['button_background_color'], $darken_factor) . ';
				}

				.wp-block-code,
				.wp-block-preformatted pre {
					color: ' . $storefront_theme_mods['text_color'] . ';
				}

				.wp-block-table:not( .has-background ):not( .is-style-stripes ) tbody tr:nth-child(2n) td {
					background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['background_color'], -2) . ';
				}

				.wp-block-cover .wp-block-cover__inner-container h1:not(.has-text-color),
				.wp-block-cover .wp-block-cover__inner-container h2:not(.has-text-color),
				.wp-block-cover .wp-block-cover__inner-container h3:not(.has-text-color),
				.wp-block-cover .wp-block-cover__inner-container h4:not(.has-text-color),
				.wp-block-cover .wp-block-cover__inner-container h5:not(.has-text-color),
				.wp-block-cover .wp-block-cover__inner-container h6:not(.has-text-color) {
					color: ' . $storefront_theme_mods['hero_heading_color'] . ';
				}

				.wc-block-components-price-slider__range-input-progress,
				.rtl .wc-block-components-price-slider__range-input-progress {
					--range-color: ' . $storefront_theme_mods['accent_color'] . ';
				}

				/* Target only IE11 */
				@media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
					.wc-block-components-price-slider__range-input-progress {
						background: ' . $storefront_theme_mods['accent_color'] . ';
					}
				}

				.wc-block-components-button:not(.is-link) {
					background-color: ' . $storefront_theme_mods['button_alt_background_color'] . ';
					color: ' . $storefront_theme_mods['button_alt_text_color'] . ';
				}

				.wc-block-components-button:not(.is-link):hover,
				.wc-block-components-button:not(.is-link):focus,
				.wc-block-components-button:not(.is-link):active {
					background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['button_alt_background_color'], $darken_factor) . ';
					color: ' . $storefront_theme_mods['button_alt_text_color'] . ';
				}

				.wc-block-components-button:not(.is-link):disabled {
					background-color: ' . $storefront_theme_mods['button_alt_background_color'] . ';
					color: ' . $storefront_theme_mods['button_alt_text_color'] . ';
				}

				.wc-block-cart__submit-container {
					background-color: ' . $storefront_theme_mods['background_color'] . ';
				}

				.wc-block-cart__submit-container::before {
					color: ' . storefront_adjust_color_brightness($storefront_theme_mods['background_color'], is_color_light($storefront_theme_mods['background_color']) ? -35 : 70, 0.5) . ';
				}

				.wc-block-components-order-summary-item__quantity {
					background-color: ' . $storefront_theme_mods['background_color'] . ';
					border-color: ' . $storefront_theme_mods['text_color'] . ';
					box-shadow: 0 0 0 2px ' . $storefront_theme_mods['background_color'] . ';
					color: ' . $storefront_theme_mods['text_color'] . ';
				}
			';

            /**
             * Filters for Gutenberg Customizer CSS.
             *
             * @param object Object of CSS rulesets.
             * @package  storefront
             * @since    2.0.0
             */
            return apply_filters('storefront_gutenberg_customizer_css', $styles);
        }

        /**
         * Enqueue dynamic colors to use editor blocks.
         *
         * @since 2.4.0
         */
        public function block_editor_customizer_css()
        {
            $storefront_theme_mods = $this->get_storefront_theme_mods();

            $styles = '';

            if (is_admin()) {
                $styles .= '
				.editor-styles-wrapper {
					background-color: ' . $storefront_theme_mods['background_color'] . ';
				}

				.editor-styles-wrapper table:not( .has-background ) th {
					background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['background_color'], -7) . ';
				}

				.editor-styles-wrapper table:not( .has-background ) tbody td {
					background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['background_color'], -2) . ';
				}

				.editor-styles-wrapper table:not( .has-background ) tbody tr:nth-child(2n) td,
				.editor-styles-wrapper fieldset,
				.editor-styles-wrapper fieldset legend {
					background-color: ' . storefront_adjust_color_brightness($storefront_theme_mods['background_color'], -4) . ';
				}

				.editor-post-title__block .editor-post-title__input,
				.editor-styles-wrapper h1,
				.editor-styles-wrapper h2,
				.editor-styles-wrapper h3,
				.editor-styles-wrapper h4,
				.editor-styles-wrapper h5,
				.editor-styles-wrapper h6 {
					color: ' . $storefront_theme_mods['heading_color'] . ';
				}

				/* WP <=5.3 */
				.editor-styles-wrapper .editor-block-list__block,
				/* WP >=5.4 */
				.editor-styles-wrapper .block-editor-block-list__block:not(:has(div.has-background-dim)) {
					color: ' . $storefront_theme_mods['text_color'] . ';
				}
				/* This following ruleset is a fallback for browsers that do not support the :has() selector. It can be removed once support reaches our requirements. */
				@supports not (selector(:has(*))) {
					.editor-styles-wrapper .block-editor-block-list__block:not(.wp-block-woocommerce-featured-product, .wp-block-woocommerce-featured-category) {
						color: ' . $storefront_theme_mods['text_color'] . ';
					}
				}

				.editor-styles-wrapper a,
				.wp-block-freeform.block-library-rich-text__tinymce a {
					color: ' . $storefront_theme_mods['accent_color'] . ';
				}

				.editor-styles-wrapper a:focus,
				.wp-block-freeform.block-library-rich-text__tinymce a:focus {
					outline-color: ' . $storefront_theme_mods['accent_color'] . ';
				}

				body.post-type-post .editor-post-title__block::after {
					content: "";
				}';
            }

            $styles .= $this->gutenberg_get_css();

            /**
             * Filters for Gutenberg Block Editor Customizer CSS.
             *
             * @param object Object of CSS rulesets.
             * @package  storefront
             * @since    2.0.0
             */
            wp_add_inline_style('storefront-gutenberg-blocks', apply_filters('storefront_gutenberg_block_editor_customizer_css', $styles));
        }

        /**
         * Add CSS in <head> for styles handled by the theme customizer
         *
         * @since 1.0.0
         * @return void
         */
        public function add_customizer_css()
        {
            wp_add_inline_style('storefront-style', $this->get_css());
        }

        /**
         * Layout classes
         * Adds 'right-sidebar' and 'left-sidebar' classes to the body tag
         *
         * @param  array $classes current body classes.
         * @return string[]          modified body classes
         * @since  1.0.0
         */
        public function layout_class($classes)
        {
            $left_or_right = get_theme_mod('storefront_layout');

            $classes[] = $left_or_right . '-sidebar';

            return $classes;
        }

        /**
         * Add CSS for custom controls
         *
         * This function incorporates CSS from the Kirki Customizer Framework
         *
         * The Kirki Customizer Framework, Copyright Aristeides Stathopoulos (@aristath),
         * is licensed under the terms of the GNU GPL, Version 2 (or later)
         *
         * @link https://github.com/reduxframework/kirki/
         * @since  1.5.0
         */
        public function customizer_custom_control_css()
        {
            ?>
            <style>
                .customize-control-radio-image input[type=radio] {
                    display: none;
                }

                .customize-control-radio-image label {
                    display: block;
                    width: 48%;
                    float: left;
                    margin-right: 4%;
                }

                .customize-control-radio-image label:nth-of-type(2n) {
                    margin-right: 0;
                }

                .customize-control-radio-image img {
                    opacity: .5;
                }

                .customize-control-radio-image input[type=radio]:checked+label img,
                .customize-control-radio-image img:hover {
                    opacity: 1;
                }
            </style>
            <?php
        }

        /**
         * Get site logo.
         *
         * @since 2.1.5
         * @return string
         */
        public function get_site_logo()
        {
            return storefront_site_title_or_logo(false);
        }

        /**
         * Get site name.
         *
         * @since 2.1.5
         * @return string
         */
        public function get_site_name()
        {
            return get_bloginfo('name', 'display');
        }

        /**
         * Get site description.
         *
         * @since 2.1.5
         * @return string
         */
        public function get_site_description()
        {
            return get_bloginfo('description', 'display');
        }

        /**
         * Check if current page is using the Homepage template.
         *
         * @since 2.3.0
         * @return bool
         */
        public function is_homepage_template()
        {
            $template = get_post_meta(get_the_ID(), '_wp_page_template', true);

            if (!$template || 'template-homepage.php' !== $template || !has_post_thumbnail(get_the_ID())) {
                return false;
            }

            return true;
        }

    }

endif;

return new EcStore_Customizer();
