<?php
function theclick_page_options_register($metabox)
{
    
    if (!$metabox->isset_args('page')) {
        $metabox->set_args('page', array(
            'opt_name'     => theclick_get_page_opt_name(),
            'display_name' => esc_html__('Page Settings', 'theclick'),
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    $metabox->add_section('page', array(
        'title'  => esc_html__('General', 'theclick'),
        'desc'   => esc_html__('General settings for the page.', 'theclick'),
        'icon'   => 'el-icon-home',
        'fields' => array_merge(
            array(
                array(
                    'id'          => 'primary_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Primary Color', 'theclick'),
                    'transparent' => false,
                ),
                array(
                    'id'          => 'accent_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Accent Color', 'theclick'),
                    'transparent' => false,
                ),
            ),
            theclick_page_opts(true),
            theclick_general_opts(['default' => true])
        )
    ));
    $metabox->add_section('page', theclick_header_top_opts(['default' => true])); 
    $metabox->add_section('page', array(
        'title'  => esc_html__('Header', 'theclick'),
        'desc'   => esc_html__('Header settings for the page.', 'theclick'),
        'icon'   => 'el-icon-website',
        'fields' => array_merge(
            theclick_header_opts(['default' => true]),
            theclick_header_atts(true)
        )
    ));
    // Logo 
    $metabox->add_section('page', theclick_header_page_logo());
    // Ontop Header
    $metabox->add_section('page', theclick_ontop_header_opts(['default' => true,'subsection' => false]));

    $metabox->add_section('page', array(
        'title'  => esc_html__('Page Title', 'theclick'),
        'desc'   => esc_html__('Settings for page header area.', 'theclick'),
        'icon'   => 'el-icon-map-marker',
        'fields' => theclick_page_title_opts(['default' => true])
    ));

    $metabox->add_section('page', theclick_footer_opts(['default' => true]));

    /* Config Post Options */
    if (!$metabox->isset_args('post')) {
        $metabox->set_args('post', array(
            'opt_name'     => theclick_get_page_opt_name(),
            'display_name' => esc_html__('Post Settings', 'theclick'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default',
            'panels'   => true
        ));
    }

    $metabox->add_section('post', array(
        'title'  => esc_html__('General', 'theclick'),
        'desc'   => esc_html__('General settings for this post.', 'theclick'),
        'icon'   => 'el-icon-home',
        'fields' => array_merge(
            array(
                array(
                    'id'       => 'post_sidebar_pos',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Layouts', 'theclick'),
                    'subtitle' => esc_html__('select a layout for single...', 'theclick'),
                    'options'  => array(
                        '-1'     => esc_html__('Default', 'theclick'),
                        'left'   => esc_html__('Left Widget', 'theclick'),
                        'right'  => esc_html__('Right Widget', 'theclick'),
                        'none'   => esc_html__('No Widget (Full)', 'theclick'),
                        'center' => esc_html__('No Widget (Center)', 'theclick')
                    ),
                    'default'  => '-1'
                )
            )
        )
    ));
     
    $metabox->add_section('post', array(
        'title'  => esc_html__('Post Title', 'theclick'),
        'desc'   => esc_html__('Settings for page header area.', 'theclick'),
        'icon'   => 'el-icon-map-marker',
        'fields' => theclick_page_title_opts(['default' => true])
    ));

    /**
     * Config post format meta options
     *
    */
    if (!$metabox->isset_args('ef5_pf_audio')) {
        $metabox->set_args('ef5_pf_audio', array(
            'opt_name'     => 'post_format_audio',
            'display_name' => esc_html__('Audio', 'theclick'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_link')) {
        $metabox->set_args('ef5_pf_link', array(
            'opt_name'     => 'post_format_link',
            'display_name' => esc_html__('Link', 'theclick'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_quote')) {
        $metabox->set_args('ef5_pf_quote', array(
            'opt_name'     => 'post_format_quote',
            'display_name' => esc_html__('Quote', 'theclick'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_video')) {
        $metabox->set_args('ef5_pf_video', array(
            'opt_name'     => 'post_format_video',
            'display_name' => esc_html__('Video', 'theclick'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_gallery')) {
        $metabox->set_args('ef5_pf_gallery', array(
            'opt_name'     => 'post_format_gallery',
            'display_name' => esc_html__('Gallery', 'theclick'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }
    $metabox->add_section('ef5_pf_video', array(
        'title'  => esc_html__('Video', 'theclick'),
        'fields' => array(
            array(
                'id'    => 'post-video-url',
                'type'  => 'text',
                'title' => esc_html__( 'Video URL', 'theclick' ),
                'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'theclick' )
            ),

            array(
                'id'             => 'post-video-file',
                'type'           => 'media',
                'library_filter' => array('mp4','m4v','wmv','avi','mpg','ogv','3gp','3g2','ogg','mine'),
                'title'          => esc_html__( 'Video Upload', 'theclick' ),
                'desc'           => esc_html__( 'Upload or Choose video file', 'theclick' ), 
                'url'            => true                       
            ),

            array(
                'id'        => 'post-video-html',
                'type'      => 'textarea',
                'title'     => esc_html__( 'Embadded video', 'theclick' ),
                'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'theclick' )
            )
        )
    ));

    $metabox->add_section('ef5_pf_gallery', array(
        'title'  => esc_html__('Gallery', 'theclick'),
        'fields' => array(
            array(
                'id'       => 'post-gallery-lightbox',
                'type'     => 'switch',
                'title'    => esc_html__('Lightbox?', 'theclick'),
                'subtitle' => esc_html__('Enable lightbox for gallery images.', 'theclick'),
                'default'  => true
            ),
            array(
                'id'          => 'post-gallery-images',
                'type'        => 'gallery',
                'title'       => esc_html__('Gallery Images ', 'theclick'),
                'subtitle'    => esc_html__('Upload images or add from media library.', 'theclick')
            )
        )
    ));

    $metabox->add_section('ef5_pf_audio', array(
        'title'  => esc_html__('Audio', 'theclick'),
        'fields' => array(
            array(
                'id'       => 'post-audio-url',
                'type'     => 'text',
                'title'    => esc_html__('Audio URL', 'theclick'),
                'description' => esc_html__('Audio file URL in format: mp3, ogg, wav.','theclick'),
                'validate' => 'url',
                'msg'      => 'Url error!'
            ),
            array(
                'id'             => 'post-audio-file',
                'type'           => 'media',
                'library_filter' => array('mp3','m4a','ogg','wav'),
                'title'          => esc_html__( 'Add a audio', 'theclick' ),
                'desc'           => esc_html__( 'Upload or Choose audio file', 'theclick' ),                        
            ),
        )
    ));

    $metabox->add_section('ef5_pf_link', array(
        'title'  => esc_html__('Link', 'theclick'),
        'fields' => array(
            array(
                'id'       => 'post-link-title',
                'type'     => 'text',
                'title'    => esc_html__('Title', 'theclick'),
            ),
            array(
                'id'       => 'post-link-url',
                'type'     => 'text',
                'title'    => esc_html__('URL', 'theclick'),
                'validate' => 'url',
                'msg'      => 'Url error!'
            )
        )
    ));

    $metabox->add_section('ef5_pf_quote', array(
        'title'  => esc_html__('Quote', 'theclick'),
        'fields' => array(
            array(
                'id'       => 'post-quote-text',
                'type'     => 'textarea',
                'title'    => esc_html__('Quote Text', 'theclick')
            ),
            array(
                'id'       => 'post-quote-cite',
                'type'     => 'text',
                'title'    => esc_html__('Cite', 'theclick')
            )
        )
    ));

    if (!$metabox->isset_args('product')) {
        $metabox->set_args('product', array(
            'opt_name'     => theclick_get_page_opt_name(),
            'display_name' => esc_html__('Post Settings', 'theclick'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default',
            'panels'   => true
        ));
    }
    $metabox->add_section('product', array(
        'title'  => esc_html__('Video', 'theclick'),
        'icon'   => 'el-icon-home',
        'fields' => array(
            array(
                'id'       => 'video_type',
                'type'     => 'select',
                'title'    => esc_html__('Select Video Type', 'theclick'),
                'options'  => array(
                    'url'    => esc_html__('Video URL', 'theclick'),
                    'file'    => esc_html__('Media', 'theclick'),
                    'embed'    => esc_html__('Embed Video', 'theclick'),
                ),
                'default'      => 'file'
            ),
            array(
                'id'    => 'product-video-url',
                'type'  => 'text',
                'title' => esc_html__( 'Video URL', 'theclick' ),
                'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'theclick' ),
                'required' => array(
                    array('video_type', '=', 'url')
                )
            ),

            array(
                'id'             => 'product-video-file',
                'type'           => 'media',
                'library_filter' => array('mp4','m4v','wmv','avi','mpg','ogv','3gp','3g2','ogg','mine'),
                'title'          => esc_html__( 'Video Upload', 'theclick' ),
                'desc'           => esc_html__( 'Upload or Choose video file', 'theclick' ), 
                'url'            => true,     
                'required' => array(
                    array('video_type', '=', 'file')
                )                 
            ),

            array(
                'id'        => 'product-video-html',
                'type'      => 'textarea',
                'title'     => esc_html__( 'Embed video', 'theclick' ),
                'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'theclick' ),
                'required' => array(
                    array('video_type', '=', 'embed')
                ) 
            )
        )
    ));
   
}
add_action('ef5_post_metabox_register', 'theclick_page_options_register');