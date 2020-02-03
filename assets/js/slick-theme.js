jQuery(document).ready(function ($) {
    $('.col-thumb.left .thumbnails-slider').slick({
        vertical: true,
        slidesToShow: 4,
        asNavFor: '.bixbang-gallery-slider',
        verticalSwiping: true,
        focusOnSelect: true,
        centerPadding: "10px",
        infinite: true,
        responsive    : [{
            breakpoint: 767,
            settings  : {
                slidesToShow   : 4,
                vertical       : false,
                verticalSwiping: false,
            },
        },],
    });
    $('.col-thumb.bottom .thumbnails-slider').slick({
        vertical: false,
        slidesToShow: 4,
        asNavFor: '.bixbang-gallery-slider',
        focusOnSelect: true,
        centerPadding: "10px",
        infinite: true,
    });
    $('.bixbang-gallery-slider').slick({
        asNavFor: ".thumbnails-slider",
        accessibility: false,
        infinite: true,
    });
    $('.bixbang-gallery2-slider').slick({
        vertical: false,
        slidesToShow: 3,
        focusOnSelect: true,
        centerPadding: "30px",
        infinite: false,
        responsive    : [{
            breakpoint: 991,
            settings  : {
                slidesToShow   : 2,
            },
        },{
            breakpoint: 767,
            settings  : {
                slidesToShow   : 1,
            },
        }],
    });

    $('.thumbnails-slider .thumbnail-slider-item').live('click', function(event) {
        event.preventDefault();
    });
    if ( $( '.pimages-thumb .bixbang-gallery-slider' ).length ) {
        $(".pimages-thumb .bixbang-gallery-slider .slick-current .bixbang-single-img img").elevateZoom({ 
            zoomType: "inner",
            cursor: 'crosshair',
        });  
    }
    $(".bixbang-gallery-slider").on("beforeChange", function(event, slick, currentSlide, nextSlide){  
        $.removeData(currentSlide, "elevateZoom");
        $(".zoomContainer").remove();

        $(".pimages-thumb .bixbang-single-img img").each(function(i) {
            if( $(this).hasClass('replace-src')){
                $(this).attr('src',$(this).attr('data-src'));
                $(this).attr('data-zoom-image',$(this).attr('data-large_image'));
                $(this).parent('.bixbang-single-img').attr('href',$(this).attr('data-large_image'));
                
                
                $('.zoomContainer').remove();
                $(this).removeData('elevateZoom');
                $(this).data('zoom-image', $(this).attr('data-zoom-image')).elevateZoom({ 
                    zoomType: "inner",
                    cursor: 'crosshair'
                }); 
                
                $(this).removeClass('replace-src');
            }
        });
    });
    $(".bixbang-gallery-slider").on("afterChange", function() {
        $(this).removeData('elevateZoom');
        $(".zoomContainer").remove();
        $(".pimages-thumb .slick-current .bixbang-single-img img").elevateZoom({ 
            zoomType: "inner",
            cursor: 'crosshair',
        }); 

    });
    
});