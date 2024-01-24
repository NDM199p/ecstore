<?php


/**
 * Returns array of Social Options
 *
 * @since 1.0.0
 */
if (!function_exists('oceanwp_social_options')) {

    function oceanwp_social_options()
    {
        return apply_filters(
            'ocean_social_options',
            array(
                'twitter' => array(
                    'label' => esc_html__('X', 'oceanwp'),
                    'icon_class' => oceanwp_icon('twitter', false),
                ),
                'facebook' => array(
                    'label' => esc_html__('Facebook', 'oceanwp'),
                    'icon_class' => oceanwp_icon('facebook', false),
                ),
                'facebook_group' => array(
                    'label' => esc_html__('Facebook Group', 'oceanwp'),
                    'icon_class' => oceanwp_icon('facebook', false),
                ),
                'slack' => array(
                    'label' => esc_html__('Slack', 'oceanwp'),
                    'icon_class' => oceanwp_icon('slack', false),
                ),
                'threads' => array(
                    'label' => esc_html__('Threads', 'oceanwp'),
                    'icon_class' => oceanwp_icon('threads', false),
                ),
                'pinterest' => array(
                    'label' => esc_html__('Pinterest', 'oceanwp'),
                    'icon_class' => oceanwp_icon('pinterest', false),
                ),
                'dribbble' => array(
                    'label' => esc_html__('Dribbble', 'oceanwp'),
                    'icon_class' => oceanwp_icon('dribbble', false),
                ),
                'vk' => array(
                    'label' => esc_html__('VK', 'oceanwp'),
                    'icon_class' => oceanwp_icon('vk', false),
                ),
                'instagram' => array(
                    'label' => esc_html__('Instagram', 'oceanwp'),
                    'icon_class' => oceanwp_icon('instagram', false),
                ),
                'linkedin' => array(
                    'label' => esc_html__('LinkedIn', 'oceanwp'),
                    'icon_class' => oceanwp_icon('linkedin', false),
                ),
                'tumblr' => array(
                    'label' => esc_html__('Tumblr', 'oceanwp'),
                    'icon_class' => oceanwp_icon('tumblr', false),
                ),
                'github' => array(
                    'label' => esc_html__('Github', 'oceanwp'),
                    'icon_class' => oceanwp_icon('github', false),
                ),
                'flickr' => array(
                    'label' => esc_html__('Flickr', 'oceanwp'),
                    'icon_class' => oceanwp_icon('flickr', false),
                ),
                'skype' => array(
                    'label' => esc_html__('Skype', 'oceanwp'),
                    'icon_class' => oceanwp_icon('skype', false),
                ),
                'youtube' => array(
                    'label' => esc_html__('Youtube', 'oceanwp'),
                    'icon_class' => oceanwp_icon('youtube', false),
                ),
                'vimeo' => array(
                    'label' => esc_html__('Vimeo', 'oceanwp'),
                    'icon_class' => oceanwp_icon('vimeo', false),
                ),
                'vine' => array(
                    'label' => esc_html__('Vine', 'oceanwp'),
                    'icon_class' => oceanwp_icon('vine', false),
                ),
                'xing' => array(
                    'label' => esc_html__('Xing', 'oceanwp'),
                    'icon_class' => oceanwp_icon('xing', false),
                ),
                'yelp' => array(
                    'label' => esc_html__('Yelp', 'oceanwp'),
                    'icon_class' => oceanwp_icon('yelp', false),
                ),
                'rss' => array(
                    'label' => esc_html__('RSS', 'oceanwp'),
                    'icon_class' => oceanwp_icon('rss', false),
                ),
                'email' => array(
                    'label' => esc_html__('Email', 'oceanwp'),
                    'icon_class' => oceanwp_icon('envelope', false),
                ),
                'tiktok' => array(
                    'label' => esc_html__('TikTok', 'oceanwp'),
                    'icon_class' => oceanwp_icon('tiktok', false),
                ),
                'medium' => array(
                    'label' => esc_html__('Medium', 'oceanwp'),
                    'icon_class' => oceanwp_icon('medium', false),
                ),
                'telegram' => array(
                    'label' => esc_html__('Telegram', 'oceanwp'),
                    'icon_class' => oceanwp_icon('telegram', false),
                ),
                'twitch' => array(
                    'label' => esc_html__('Twitch', 'oceanwp'),
                    'icon_class' => oceanwp_icon('twitch', false),
                ),
                'line' => array(
                    'label' => esc_html__('Line', 'oceanwp'),
                    'icon_class' => oceanwp_icon('line', false),
                ),
                'qq' => array(
                    'label' => esc_html__('QQ', 'oceanwp'),
                    'icon_class' => oceanwp_icon('qq', false),
                ),
                'discord' => array(
                    'label' => esc_html__('Discord', 'oceanwp'),
                    'icon_class' => oceanwp_icon('discord', false),
                ),
                'mastodon' => array(
                    'label' => esc_html__('Mastodon', 'oceanwp'),
                    'icon_class' => oceanwp_icon('mastodon', false),
                )
            )
        );
    }
}
