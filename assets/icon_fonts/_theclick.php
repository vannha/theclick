<?php
function theclick_iconpicker_theclick_icons(){
	// add your icon here
	// struct ['icon-class-name' => 'icon name']
	$default_icons = [
		['flaticon-add-button' => esc_html('flaticon add button')],
		['flaticon-chandelier'                          => esc_html('flaticon chandelier')],
		['flaticon-call-answer'                         => esc_html('flaticon call answer')],
		['flaticon-angle-pointing-to-left'              => esc_html('flaticon angle pointing to left')],
		['flaticon-angle-arrow-pointing-to-right'       => esc_html('flaticon angle arrow pointing to right')],
		['flaticon-headphone-symbol'                    => esc_html('flaticon headphone symbol')],
		['flaticon-plus-sign'                           => esc_html('flaticon plus sign')],
		['flaticon-minus-straight-horizontal-line-sign' => esc_html('flaticon minus straight horizontal line sign')],
		['flaticon-world'                               => esc_html('flaticon world')],
		['flaticon-cloud-download'                      => esc_html('flaticon cloud download')],
		['flaticon-shopping-cart'                       => esc_html('flaticon shopping cart')],
		['flaticon-go-back-left-arrow'                  => esc_html('flaticon go back left arrow')],
		['flaticon-right-arrow-forward'                 => esc_html('flaticon right arrow forward')],
		['flaticon-calendar'                            => esc_html('flaticon calendar')],
		['flaticon-left-arrow'                          => esc_html('flaticon left arrow')],
		['flaticon-user-silhouette'                     => esc_html('flaticon user silhouette')],
		['flaticon-christian-church'                    => esc_html('flaticon christian church')],
		['flaticon-arrow-pointing-to-right'             => esc_html('flaticon arrow pointing to right')],
		['flaticon-upload'                              => esc_html('flaticon upload')],
		['flaticon-religion'                            => esc_html('flaticon religion')],
		['flaticon-faith'                               => esc_html('flaticon faith')],
		['flaticon-play-button'                         => esc_html('flaticon play button')],
		['flaticon-coin'                                => esc_html('flaticon coin')],
		['flaticon-magnifying-glass'                    => esc_html('flaticon magnifying glass')],
		['flaticon-placeholder'                         => esc_html('flaticon placeholder')],
		['flaticon-upload-1'                            => esc_html('flaticon upload 1')],
		['flaticon-upload-2'                            => esc_html('flaticon upload 2')],
		['flaticon-share'                               => esc_html('flaticon share')],
		['flaticon-groceries'                           => esc_html('flaticon groceries')],
		['flaticon-cross'                               => esc_html('flaticon cross')],
		['flaticon-cloud-computing'                     => esc_html('flaticon cloud computing')],
		['flaticon-like'                                => esc_html('flaticon like')],
		['flaticon-placeholder-1'                       => esc_html('flaticon placeholder 1')],
		['flaticon-play-button-1'                       => esc_html('flaticon play button 1')],
		['flaticon-share-1'                             => esc_html('flaticon share 1')],
		['flaticon-close'                               => esc_html('flaticon close')],
		['flaticon-open-book'                           => esc_html('flaticon open book')],
		['flaticon-donation'                            => esc_html('flaticon donation')],
		['flaticon-donation-1'                          => esc_html('flaticon donation 1')],
		['flaticon-charity'                             => esc_html('flaticon charity')],
		['flaticon-pdf'                                 => esc_html('flaticon pdf')],
		['flaticon-coin-1'                              => esc_html('flaticon coin 1')],
		['flaticon-care'                                => esc_html('flaticon care')],
		['flaticon-maps-and-flags'                      => esc_html('flaticon maps and flags')],
		['flaticon-team'                                => esc_html('flaticon team')],
		['flaticon-pdf-1'                               => esc_html('flaticon pdf 1')],
		['flaticon-charity-1'                           => esc_html('flaticon charity 1')],
		['flaticon-heart'                               => esc_html('flaticon heart')],
		['flaticon-church'                              => esc_html('flaticon church')],
		['flaticon-calendar-1'                          => esc_html('flaticon calendar 1')],
		['flaticon-church-1'                            => esc_html('flaticon church 1')],
		['flaticon-heart-1'                             => esc_html('flaticon heart 1')],
		['flaticon-water-bottle'                        => esc_html('flaticon water bottle')],
		['flaticon-planet-earth'                        => esc_html('flaticon planet earth')],
		['flaticon-download'                            => esc_html('flaticon download')],
		['flaticon-headphones'                          => esc_html('flaticon headphones')],
		['flaticon-holy-star-1'                         => esc_html('flaticon holy star 1')],
		['flaticon-holy-star-2'                         => esc_html('flaticon holy star 2')],
		['flaticon-heart-2'                             => esc_html('flaticon heart 2')],
		['flaticon-candlestick'                         => esc_html('flaticon candlestick')],
		['flaticon-shopping-cart-1'                     => esc_html('flaticon shopping cart 1')],
		['flaticon-candlestick-1'                       => esc_html('flaticon candlestick 1')],
		['flaticon-heart-3'                             => esc_html('flaticon heart 3')],
		['flaticon-add-button-1'                        => esc_html('flaticon add button 1')],
		['flaticon-remove'                              => esc_html('flaticon remove')],
		['flaticon-remove-1'                            => esc_html('flaticon remove 1')],
	];
	return array_merge($default_icons, apply_filters('theclick_iconpicker_theclick_icons', []));
}
add_filter( 'vc_iconpicker-type-theclick', 'theclick_vc_iconpicker_type_theclick_icons' );
function theclick_vc_iconpicker_type_theclick_icons( $icons ) {
	$theclick_icons = theclick_iconpicker_theclick_icons();
	return array_merge( $icons, $theclick_icons );
}