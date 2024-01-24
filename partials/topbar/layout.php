<?php
/**
 * Topbar layout
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

// Classes.
$classes = array('clr');

// Add container class if the top bar is not full width.
if (true !== get_theme_mod('ocean_top_bar_full_width', false)) {
	$classes[] = 'container';
}

// If no content.
if (!get_theme_mod('ocean_top_bar_content')) {
	$classes[] = 'has-no-content';
}

// Turn classes into space seperated string.
$classes = implode(' ', $classes);
$content = get_theme_mod('ocean_top_bar_content');

?>

<?php //do_action('ocean_before_top_bar'); ?>

<div class="div">
	<div class="div-2">
		<span class="span">
			<div class="div-3">
				<?php echo $content; ?>
			</div>
			<?php
			$is_link = get_theme_mod("ecstore_top_bar_is_link");
			if ($is_link) {
				$link_content = get_theme_mod('ecstore_top_bar_link_content');
				$link_uri = get_theme_mod('ecstore_top_bar_link_url');
				printf('<a href="%s" class="div-4">%s</a>', $link_uri, $link_content);
			}
			?>
		</span>
		<span class="span-2">
			<div class="div-5">English</div>
			<img loading="lazy"
				src="https://cdn.builder.io/api/v1/image/assets/TEMP/8c458026ddcb4daaaca9291897ab1b8ab8e65bd1233e48db8bbc95eb90ee3e16?"
				class="img" />
		</span>
	</div>
</div>
<style>
	.div {
		justify-content: center;
		align-items: end;
		background-color: var(--Button, #000);
		display: flex;
		flex-direction: column;
		padding: 12px 60px;
	}

	@media (max-width: 991px) {
		.div {
			padding: 0 20px;
		}
	}

	.div-2 {
		display: flex;
		margin-right: 76px;
		width: 859px;
		max-width: 100%;
		justify-content: space-between;
		gap: 20px;
	}

	@media (max-width: 991px) {
		.div-2 {
			margin-right: 10px;
			flex-wrap: wrap;
		}
	}

	.span {
		align-items: center;
		display: flex;
		justify-content: space-between;
		gap: 8px;
	}

	@media (max-width: 991px) {
		.span {
			max-width: 100%;
			flex-wrap: wrap;
		}
	}

	.div-3 {
		color: var(--Text, #fafafa);
		flex-grow: 1;
		margin: auto 0;
		font: 400 14px/150% Poppins, sans-serif;
	}

	@media (max-width: 991px) {
		.div-3 {
			max-width: 100%;
		}
	}

	.div-4 {
		color: var(--Text, #fafafa);
		text-align: center;
		text-decoration-line: underline;
		align-self: stretch;
		white-space: nowrap;
		font: 600 14px/24px Poppins, sans-serif;
	}

	@media (max-width: 991px) {
		.div-4 {
			white-space: initial;
		}
	}

	.span-2 {
		justify-content: space-between;
		align-items: center;
		display: flex;
		gap: 5px;
	}

	.div-5 {
		color: var(--Text, #fafafa);
		flex-grow: 1;
		white-space: nowrap;
		margin: auto 0;
		font: 400 14px/150% Poppins, sans-serif;
	}

	@media (max-width: 991px) {
		.div-5 {
			white-space: initial;
		}
	}

	.img {
		aspect-ratio: 1;
		object-fit: contain;
		object-position: center;
		width: 24px;
		overflow: hidden;
		align-self: stretch;
		max-width: 100%;
	}
</style>