<?php
vc_map(array(
    'name'        => 'TheClick Video',
    'base'        => 'ef5_video',
    'icon'        => 'icon-wpb-film-youtube',
    'category'    => esc_html__('TheClick','theclick'),
    'description' => esc_html__('Add a HTML5 Videos', 'theclick'),
    'params'      => array(
        array(
            'type'       => 'img',
            'heading'    => esc_html__('Layout Template','theclick'),
            'param_name' => 'layout_template',
            'value'      =>  array(
                '1' => get_template_directory_uri().'/vc_elements/layouts/video-1.png',
            ),
            'std'         => '1',
            'admin_label' => true,
            'edit_field_class' => 'ef5-select-img-1col'
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Extra class name', 'theclick' ),
            'param_name'  => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'theclick' ),
        ),
        array(
            'type'       => 'el_id',
            'heading'    => esc_html__('Element ID','theclick'),
            'param_name' => 'el_id',
            'settings'   => array(
                'auto_generate' => true,
            ),
            'description'   => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'theclick' ), '//w3schools.com/tags/att_global_id.asp' ),
        ),
        // Small heading
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Small Heading','theclick'),
            'param_name' => 'small_heading',
            'admin_label' => true,
            'group'       => esc_html__('Content','theclick')  
        ),
        // Heading
        array(
            'type'       => 'textarea',
            'heading'    => esc_html__('Heading','theclick'),
            'param_name' => 'title',
            'holder'     => 'h3',
            'group'       => esc_html__('Content','theclick')
        ),
        // Heading Part
        array(
            'type'       => 'textarea',
            'heading'    => esc_html__('Heading Part','theclick'),
            'param_name' => 'title_part',
            'holder'     => 'h3',
            'dependency' => array(
                'element'   => 'layout_template',
                'value'     => '2'
            ),
            'group'       => esc_html__('Content','theclick')
        ),
        // Description
        array(
            'type'       => 'textarea',
            'heading'    => esc_html__('Content','theclick'),
            'param_name' => 'content',
            'group'       => esc_html__('Content','theclick')
        ),
        // Link
        array(
            'type'       => 'vc_link',
            'heading'    => esc_html__('Link','theclick'),
            'description'=> esc_html__('Add a link to another page!','theclick'),
            'param_name' => 'btn_link',
            'group'       => esc_html__('Content','theclick')
        ),
        array(
            'type'       => 'img',
            'heading'    => esc_html__('Play Button','theclick'),
            'param_name' => 'play_btn',
            'value'      =>  array(
                '1'      => get_template_directory_uri().'/assets/images/icons/play-btn-1.png',
                '2'      => get_template_directory_uri().'/assets/images/icons/play-btn-2.png',
                '3'      => get_template_directory_uri().'/assets/images/icons/play-btn-3.png',
                '4'      => get_template_directory_uri().'/assets/images/icons/play-btn-4.png',
                '5'      => get_template_directory_uri().'/assets/images/icons/play-btn-5.png',
                '6'      => get_template_directory_uri().'/assets/images/icons/play-btn-6.png',
                '7'      => get_template_directory_uri().'/assets/images/icons/play-btn-7.png',
                'custom' => get_template_directory_uri().'/vc_elements/layouts/play-btn-custom.png',
            ),
            'std'              => '7',
            'group'            => esc_html__( 'Video','theclick'),
            'edit_field_class' => 'ef5-vc-list-icon'
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Play Effect','theclick'),
            'param_name' => 'play_btn_effect',
            'value'      =>  array(
                'wave1',
                'wave2',
                'wave3',
                'wave4',
            ),
            'std'              => 'wave1',
            'group'            => esc_html__( 'Video','theclick'),
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Play Button Text','theclick'),
            'param_name' => 'play_btn_text',
            'value'      => 'Watch Video',
            'dependency' => array(
                'element' => 'layout_template',
                'value'   => array('2'),
            ),
            'group'      => esc_html__( 'Video','theclick'),
        ),
        array(
            'type'       => 'attach_image',
            'class'      => '',
            'param_name' => 'play_btn_custom',
            'heading'    => esc_html__('Custom Play Button','theclick'),
            'value'      => '',
            'description'      =>esc_html__( 'Upload your play button','theclick'),
            'dependency' => array(
                'element' => 'play_btn',
                'value'   => array('custom'),
            ),
            'group'       =>esc_html__( 'Video','theclick'),
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Video Type','theclick'),
            'param_name' => 'video_type',
            'value'      => array(
                esc_html__('Default','theclick')   => '1',
                esc_html__('Popup','theclick')     => '2',
            ),
            'std'         => '2',
            'group'       =>esc_html__( 'Video','theclick'),
            'admin_label' => true,
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Video Source','theclick'),
            'param_name' => 'video_source',
            'value'      =>   array(
                esc_html__('Online Video','theclick')   => '1',
                esc_html__('Uploaded Video','theclick') => '2',
                esc_html__('Hosted Video','theclick')   => '3', 
                esc_html__('Embed code','theclick')     => '4', 
            ),
            'std'         => '1',
            'group'       =>esc_html__( 'Video','theclick'),
            'admin_label' => true,
        ),
        
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Online Video','theclick'),
            'description' => sprintf( __( 'Enter link to video, EX: //www.youtube.com/watch?v=vI9AxTCSrOU (Note: read more about available formats at WordPress <a href="%s" target="_blank">codex page</a>).', 'theclick' ), '//codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F' ),
            'param_name'  => 'online_video',
            'value'       => '//www.youtube.com/watch?v=vI9AxTCSrOU',
            'std'         => '//www.youtube.com/watch?v=vI9AxTCSrOU',
            'dependency'  => array(
                'element'     => 'video_source',
                'value'       => '1',
            ),
            'holder'      => 'div',
            'group'       => esc_html__( 'Video','theclick'),
        ),
        array(
            'type'        => 'ef5_video',
            'heading'     => esc_html__('Uploaded Video','theclick'),
            'description' => esc_html__('choose your uploaded video','theclick' ),
            'param_name'  => 'uploaded_video',
            'settings'    => array('single'=>true),
            'dependency'  => array(
                'element' => 'video_source',
                'value'   => '2',
            ),
            'holder' => 'div',
            'group'  => esc_html__( 'Video','theclick'),
            
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('MP4','theclick'),
            'description' => esc_html__('Enter your MP4 video file url, ex: //dev.joomexp.com/libs/videos/video-01.mp4','theclick'),
            'param_name'  => 'bg_video_src_mp4',
            'value'       => '',
            'dependency'  => array(
                'element'     => 'video_source',
                'value'       => '3',
            ),
            'holder'      => 'div',
            'group'       =>esc_html__( 'Video','theclick'),
            
        ),
        
        array(
            'type'        => 'textfield',
            'class'       => '',
            'heading'     => esc_html__('OGV','theclick'),
            'description' => esc_html__('Enter your OGV video file url, ex: //dev.joomexp.com/libs/videos/video-03.ogv','theclick'),
            'param_name'  => 'bg_video_src_ogv',
            'value'       => '',
            'dependency'  => array(
                'element'     => 'video_source',
                'value'       => '3',
            ),
            'group'       =>esc_html__( 'Video','theclick'),
            'holder'      => 'div',
        ),
        array(
            'type'        => 'textfield',
            'class'       => '',
            'heading'     => esc_html__('OGG','theclick'),
            'description' => esc_html__('Enter your OGV video file url, ex: //dev.joomexp.com/libs/videos/video-03.ogg','theclick'),
            'param_name'  => 'bg_video_src_ogg',
            'value'       => '',
            'dependency'  => array(
                'element'     => 'video_source',
                'value'       => '3',
            ),
            'group'       =>esc_html__( 'Video','theclick'),
            'holder'      => 'div',
        ),
        array(
            'type'        => 'textfield',
            'class'       => '',
            'heading'     => esc_html__('WEBM','theclick'),
            'description' => esc_html__('Enter your WEBM video file url, ex: //dev.joomexp.com/libs/videos/video-03.webm','theclick'),
            'param_name'  => 'bg_video_src_webm',
            'value'       => '',
            'dependency' => array(
                'element' => 'video_source',
                'value'   => '3',
            ),
            'group'  => esc_html__( 'Video','theclick'),
            'holder' => 'div',
        ),
        array(
            'type'        => 'textarea_raw_html',
            'class'       => '',
            'heading'     => esc_html__('Embed video','theclick'),
            'description' => esc_html__('Enter your embed code.','theclick'),
            'param_name'  => 'embed_video',
            'value'       => '',
            'dependency' => array(
                'element' => 'video_source',
                'value'   => '4',
            ),
            'group'  => esc_html__( 'Video','theclick'),
            'holder' => 'div',
        ),
        array(
            'type'       => 'checkbox',
            'class'      => '',
            'heading'    => esc_html__( 'Loop','theclick'),
            'param_name' => 'loop',
            'std'        => 'false',
            'group'      => esc_html__( 'Video','theclick'),
            'dependency' => array(
                'element' => 'video_source',
                'value'   => '3',
            ),
        ),
        array(
            'type'       => 'checkbox',
            'class'      => '',
            'heading'    => esc_html__( 'Autoplay','theclick'),
            'param_name' => 'autoplay',
            'std'        => 'false',
            'group'      => esc_html__( 'Video','theclick'),
            'dependency' => array(
                'element' => 'video_source',
                'value'   => '3',
            ),
        ),
        array(
            'type'       => 'checkbox',
            'class'      => '',
            'heading'    => esc_html__( 'Muted','theclick'),
            'param_name' => 'muted',
            'std'        => 'false',
            'group'      => esc_html__( 'Video','theclick'),
            'dependency' => array(
                'element' => 'video_source',
                'value'   => '3',
            ),
        ),
        array(
            'type'       => 'checkbox',
            'class'      => '',
            'heading'    => esc_html__( 'Controls','theclick'),
            'param_name' => 'controls',
            'std'        => 'false',
            'group'      =>esc_html__( 'Video','theclick'),
            'dependency' => array(
                'element' => 'video_source',
                'value'   => '3',
            ),
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__( 'Show Button Play','theclick'),
            'param_name' => 'show_btn',
            'std'        => 'true',
            'dependency' => array(
                'element'            => 'autoplay',
                'value_not_equal_to' => 'true',
            ),
            'group'      => esc_html__( 'Video','theclick')
        ),
        array(
            'type'       => 'colorpicker',
            'heading'    => esc_html__( 'Overlay Background color on the video','theclick'),
            'param_name' => 'bg_video_color',
            'dependency' => array(
                'element'    => 'video_source',
                'value'      => '3',
            ),
            'group'      => esc_html__( 'Video','theclick'),
            'std'        => ''
        ),
        array(
            'type'       => 'attach_image',
            'class'      => '',
            'param_name' => 'poster',
            'value'      => '',
            'group'      =>esc_html__( 'Poster','theclick'),
        ),
        array(
            'type'       => 'textfield',
            'param_name' => 'poster_size',
            'value'      => '570x270',
            'std'        => '570x270',
            'description'=> esc_html__('Enter our defined size: "thumbnail", "medium", "large", "post-thumbnail", "full". Or alternatively enter size in pixels (Example: 200x100 (Width x Height)).','theclick'),
            'group'      => esc_html__( 'Poster','theclick'),
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Poster Style','theclick'),
            'param_name' => 'poster_style',
            'value'      =>   array(
                esc_html__('Default','theclick')   => '', 
            ),
            'std'         => '',
            'group'       => esc_html__( 'Poster','theclick'),
            'dependency'  => array(
                'element'   => 'poster',
                'not_empty' => true,
            ),
        ),
    )
));

class WPBakeryShortCode_ef5_video extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
    protected function theclick_ef5_video_poster($atts, $args = []){
        $args = wp_parse_args($args,[]);
        extract($atts);
        theclick_image_by_size([
            'id'    => $poster,
            'size'  => $poster_size,
            'class' => 'video-poster '.$poster_style
        ]);
    }
    protected function theclick_ef5_video_play_button($atts, $args=[])
    {
        global $wp_embed;
        extract($atts);
        if($video_type !== '2') return;
        $args = wp_parse_args($args,[
            'anim'          => $play_btn_effect,
            'class'         => '',
            'size'          => '',
            'hover_overlay' => false
        ]);
        
        $play_btn_url = get_template_directory_uri().'/assets/images/icons/play-btn-'.$play_btn.'.png';
        if($play_btn === 'custom') $play_btn_url = theclick_get_image_url_by_size([
            'id'            => $play_btn_custom,
            'size'          => '80',
            'default_thumb' => true,
            'class'         => 'circle'
        ]);

        $play_css_class = [$args['class'], 'd-flex align-items-center', $this->getCSSAnimation('fadeIn')];
        if(!empty($poster)) $play_css_class[] = 'has-poster';
        $play_css_class = theclick_optimize_css_class(implode(' ', $play_css_class));

        $ef5_waves = theclick_html_animation(['anim' => $args['anim']]);
        $play_btn_text = '<span class="play-btn-text">'.$play_btn_text.'</span>';

        if($args['hover_overlay']) echo '<div class="overlay"><div class="overlay-inner center-align">';
        switch ($video_source) {
            case '1':
                if ( is_object( $wp_embed ) ) {
                    echo '<a href="'.esc_attr($online_video).'" class="ef5-popupvideo-iframe '.$play_css_class.'"><span class="ef5-anim-wave loop"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</span>'.$play_btn_text.'</a>';
                }
                break;
            case '2':
                if(!empty($uploaded_video)) {
                    echo '<a href="#'.esc_attr($el_id).'" class="ef5-popupvideo '.$play_css_class.'"><span class="ef5-anim-wave loop"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</span>'.$play_btn_text.'</a>';
                }
                break;
            case '3':
                echo '<a href="#'.esc_attr($el_id).'" class="ef5-popupvideo '.$play_css_class.'"><span class="ef5-anim-wave loop"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</span>'.$play_btn_text.'</a>';
                break;
            case '4':
                echo '<a href="#'.esc_attr($el_id).'" class="ef5-popupvideo '.$play_css_class.'"><span class="ef5-anim-wave loop"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</span>'.$play_btn_text.'</a>';
                break;  
        }
        if($args['hover_overlay']) echo '</div></div>';
    }
    protected function theclick_ef5_video_popup($atts, $args=[]){
        global $wp_embed;
        extract($atts);
        if($video_type !== '2') return;
        $args = wp_parse_args($args,[
            'anim'  => $play_btn_effect,
            'class' => '',
            'overlay' => false
        ]);
        $preload  = '';
        $play_btn_url = get_template_directory_uri().'/assets/images/icons/play-btn-'.$play_btn.'.png';


        if($play_btn === 'custom') $play_btn_url = theclick_get_image_url_by_size([
            'id'            => $play_btn_custom,
            'size'          => '80',
            'default_thumb' => true,
            'class'         => 'circle'
        ]);

        wp_enqueue_script( 'magnific-popup' );
        wp_enqueue_style( 'magnific-popup' );
        wp_enqueue_script( 'ef5-video' );
        $play_css_class = ['ef5-playvideo', 'ef5-popupvideo', 'ef5-anim-wave', 'loop', $this->getCSSAnimation('fadeIn')];

        if(!empty($poster)) $play_css_class[] = 'has-poster';

        switch ($layout_template) {
            case '1':
                $ef5_waves = theclick_html_animation(['anim' => $args['anim'], 'size' => '2']);
                break;
            
            default:
                $ef5_waves = theclick_html_animation(['anim' => $args['anim']]);
                break;
        }
        
        if($args['overlay']) echo '<div class="overlay ef5-bg-overlay"><div class="overlay-inner center-align">';
        switch ($video_source) {
            case '1':
                $play_css_class[] = 'ef5-popupvideo-iframe';
                $video_w = 500;
                $video_h = $video_w / 1.61; //1.61 golden ratio
                if ( is_object( $wp_embed ) ) {
                    echo '<a href="'.esc_attr($online_video).'" class="'.implode(' ',$play_css_class).'"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</a>';
                    echo '<div class="d-none"><div id="'.esc_attr($el_id).'" class="ef5-video-popup">'.apply_filters('the_content', $online_video).'</div></div>';
                }
                break;

            case '2':
                $play_css_class[] = 'ef5-popupvideo';
                if(!empty($uploaded_video)) {
                    $video_type = wp_check_filetype(wp_get_attachment_url($uploaded_video), wp_get_mime_types());
                    echo '<a href="#'.esc_attr($el_id).'" class="'.implode(' ',$play_css_class).'"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</a>';
                    if(is_numeric($uploaded_video))
                        $uploaded_video = wp_get_attachment_url($uploaded_video);
                    switch ($video_type['type']) {
                        case 'audio/mpeg':
                            echo '<div class="d-none"><div id="'.esc_attr($el_id).'" class="ef5-video-popup">'.apply_filters('the_content', '[audio mp3="'.esc_url($uploaded_video).'" autoplay="true"][/audio]').'</div></div>';
                            break;
                        
                        default:
                            echo '<div class="d-none"><div id="'.esc_attr($el_id).'" class="ef5-video-popup" >'.apply_filters('the_content', '[video poster="'.wp_get_attachment_url($poster).'" '.$video_type['ext'].'="'.esc_url($uploaded_video).'" src="'.esc_url($uploaded_video).'" autoplay="true"][/video]').'</div></div>';
                            break;
                    }
                }
                break;
            case '4':
                $play_css_class[] = 'ef5-popupvideo';
                echo '<a href="#'.esc_attr($el_id).'" class="'.implode(' ',$play_css_class).'"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</a>';
                $iframe_string = rawurldecode( base64_ef5_decode( strip_tags( $embed_video ) ) );
                preg_match('/src="([^"]+)"/', $iframe_string, $match);
                $url = isset($match[1]) ? $match[1] : $iframe_string;
                echo '<div class="d-none"><div id="'.esc_attr($el_id).'" class="ef5-video-popup">'.$iframe_string.'</div></div>';
                break;
            default:
                $play_css_class[] = 'ef5-popupvideo';
                /* Video */
                if(is_numeric($poster)) {
                    $image_src = wp_get_attachment_url( $poster );
                } else {
                    $image_src = $poster;
                }
                $bg_video_args = array();
                if (!empty($bg_video_src_mp4) ) $bg_video_args['mp4']  = $bg_video_src_mp4;
                if (!empty($bg_video_src_ogv) ) $bg_video_args['ogv']  = $bg_video_src_ogv;
                if (!empty($bg_video_src_ogg) ) $bg_video_args['ogg']  = $bg_video_src_ogg;
                if (!empty($bg_video_src_webm)) $bg_video_args['webm'] = $bg_video_src_webm;
                
                if (!empty($bg_video_args)) {
                    $attr_strings = array(
                        'id="'.$el_id.'"',
                        'data-id="'.$el_id.'"',
                    );
                    if (!empty($image_src)) {
                        $attr_strings[] = 'poster="'.$image_src.'"';
                    }
                    if ($autoplay == true) {
                        $attr_strings[] = 'autoplay';
                    }
                    if ($muted == true) {
                        $attr_strings[] = 'muted';
                    }
                    if ($loop == true) {
                        $attr_strings[] = 'loop';
                    }
                    $attr_strings[] = 'controls'; // need it for fix show video on popup
                    if ($preload) {
                        $attr_strings[] = 'preload="'.$preload.'"';
                    }
                    $source_html = null;
                    $source = '<source type="%s" src="%s" />';
                    foreach ($bg_video_args as $video_type => $video_src) {
                        $video_type = wp_check_filetype($video_src, wp_get_mime_types());
                        $source_html .= sprintf($source, $video_type['type'], esc_url($video_src));
                    }
                }
                echo '<a href="#'.esc_attr($el_id).'" class="'.implode(' ',$play_css_class).'"><img src="'.esc_url($play_btn_url).'" alt="'.esc_html($title).'" />'.$ef5_waves.'</a>';
            ?>
            <div class="d-none"> 
                <div id="<?php echo esc_attr($el_id);?>" class="ef5-video-shortcode ef5-video-popup">
                    <video class="ef5-video" <?php echo join(' ', $attr_strings); ?>>
                        <?php echo ''.$source_html;?>
                    </video>
                </div>
            </div>
        <?php        
            break;
        }
        if($args['overlay']) echo '</div></div>';   
    }

    protected function theclick_ef5_video_plain($atts, $args = []){
        global $wp_embed;
        extract($atts);
        if($video_type !== '1') return;
        $args = wp_parse_args($args,[
            'wave'  => true,
            'class' => ''
        ]);
        $preload  = '';
        switch ($video_source) {
            case '1':
                $video_w = 500;
                $video_h = $video_w / 1.61; //1.61 golden ratio
                if ( is_object( $wp_embed ) ) {
                    echo theclick_html( $wp_embed->run_shortcode( '[embed width="'.$video_w.'" height="'.$video_h.'"]' . $online_video . '[/embed]' ) );
                }
                break;

            case '2':
                if(!empty($uploaded_video)) {
                    $video_type = wp_check_filetype(wp_get_attachment_url($uploaded_video), wp_get_mime_types());
                    if(is_numeric($uploaded_video))
                        $uploaded_video = wp_get_attachment_url($uploaded_video);
                    switch ($video_type['type']) {
                        case 'audio/mpeg':
                            echo apply_filters('the_content', '[audio mp3="'.esc_url($uploaded_video).'"][/audio]');
                            break;
                        
                        default:
                            echo apply_filters('the_content', '[video poster="'.wp_get_attachment_url($poster).'" '.$video_type['ext'].'="'.esc_url($uploaded_video).'" src="'.esc_url($uploaded_video).'"][/video]');
                            break;
                    }
                }
                break;
            case '4':
                echo rawurldecode( base64_ef5_decode( strip_tags( $embed_video ) ) );
                break;
            default:
                /* js for video html5 */
                wp_enqueue_script( 'ef5-video' );
                /* Video */
                if(is_numeric($poster)) {
                    $image_src = wp_get_attachment_url( $poster );
                } else {
                    $image_src = $poster;
                }
                $bg_video_args = array();
                if (!empty($bg_video_src_mp4) ) $bg_video_args['mp4']  = $bg_video_src_mp4;
                if (!empty($bg_video_src_ogv) ) $bg_video_args['ogv']  = $bg_video_src_ogv;
                if (!empty($bg_video_src_ogg) ) $bg_video_args['ogg']  = $bg_video_src_ogg;
                if (!empty($bg_video_src_webm)) $bg_video_args['webm'] = $bg_video_src_webm;
                if (!empty($bg_video_args)) {
                    $attr_strings = array(
                        'id="'.$el_id.'"',
                        'data-id="'.$el_id.'"',
                    );
                    if (!empty($image_src)) {
                        $attr_strings[] = 'poster="'.$image_src.'"';
                    }
                    if ($autoplay == true) {
                        $attr_strings[] = 'autoplay';
                    }
                    if ($muted == true) {
                        $attr_strings[] = 'muted';
                    }
                    if ($loop == true) {
                        $attr_strings[] = 'loop';
                    }
                    if ($controls == true) {
                        $attr_strings[] = 'controls';
                    }
                    if ($preload) {
                        $attr_strings[] = 'preload="'.$preload.'"';
                    }
                    $source_html = null;
                    $source = '<source type="%s" src="%s" />';
                    foreach ($bg_video_args as $video_type => $video_src) {
                        $video_type = wp_check_filetype($video_src, wp_get_mime_types());
                        $source_html .= sprintf($source, $video_type['type'], esc_url($video_src));
                    }
                }
            ?>  
            <div class="ef5-video-shortcode">
                <video class="ef5-video" <?php echo join(' ', $attr_strings); ?>>
                    <?php echo ''.$source_html;?>
                </video>
                <div class="mejs-overlay play-video" style="width: 100%; height: 100%; background-color:<?php echo esc_attr($bg_video_color);?>;">
                    <?php if(!$autoplay && $show_btn) { ?>
                    <div class="mejs-overlay-button"></div>
                    <?php } ?>
                </div>
            </div>
        <?php        
            break;
        }
    }

    protected function theclick_ef5_video_link($atts, $args = []){
        extract($atts);
        $args = wp_parse_args($args, []);
        /* parse button link */
        $use_link = false;
        if(!empty($btn_link)){
            $button_link = vc_build_link( $btn_link );
            $button_link = ( $button_link == '||' ) ? '' : $button_link;
            if ( strlen( $button_link['url'] ) > 0 ) {
                $use_link = true; 
                $a_href = $button_link['url'];
                $a_title = strlen($button_link['title']) > 0 ? $button_link['title'] : esc_html__('Read more','theclick') ;
                $a_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';
            }
        }
        if($use_link) { ?>
            <a class="ef5-btn ef5-btn-xlg accent fill <?php echo esc_attr($this->getCSSAnimation('fadeIn'));?>" href="<?php echo esc_url( $a_href ); ?>" title="<?php echo esc_attr( $a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>"><span><?php echo esc_attr( $a_title ); ?></span></a>
        <?php }
    }

    protected function theclick_ef5_video_small_heading($atts, $args = []){
        extract($atts);
        if(empty($small_heading)) return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $classes = [
            'small-heading',
            $args['class'],
            $this->getCSSAnimation('fadeIn')
        ];
    ?>
        <div class="<?php echo trim(implode(' ', $classes));?>"><?php echo esc_html($small_heading);?></div>
    <?php 
    }

    protected function theclick_ef5_video_heading($atts, $args = []){
        extract($atts);
        if(empty($title)) return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $title_attrs = [];
        $title_border_style = [];

        // Heading
        $title_css_classes = [
            'large-heading',
            $args['class'],
            $this->getCSSAnimation('fadeIn')
        ];
        $title_attrs[] = 'class="'.trim(implode(' ', $title_css_classes)).'"';
        // Heading Part
        $title_part_css_classes = ['title-part'];
        $title_part_attrs[] = 'class="'.trim(implode(' ', $title_part_css_classes)).'"';
        $title_part = '<span '.implode(' ', $title_part_attrs).'>'.$title_part.'</span>';
    ?>
        <div <?php echo trim(implode(' ', $title_attrs));?>><?php echo implode(' ', [$title, $title_part]);?></div>
    <?php 
    }

    protected function theclick_ef5_video_desc($atts, $args = []){
        extract($atts);
        if(empty($content)) return;
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $classes = [
            'ef5-video-desc',
            $args['class'],
            $this->getCSSAnimation('fadeIn'),
            'clearfix'
        ];
        $desc_attrs = ['class="'.trim(implode(' ', $classes)).'"'];
    ?>
        <div <?php echo trim(implode(' ', $desc_attrs));?>>
            <?php echo theclick_html($content);?>
        </div>
    <?php 
    }
}