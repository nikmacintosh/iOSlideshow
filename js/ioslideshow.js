(function( $, undefined ) {
'use strict';

$.fn.iOSlideshow = function( options ) {
  var settings = $.extend({ interval: 5000 }, options );

  return this.each(function() {
    // Kudos to Chris Coyier at css-tricks.com
    // http://css-tricks.com/snippets/jquery/simple-auto-playing-slideshow/

    var $this = $(this),
        $lastChildren = $this.children('li:gt(0)');

    function transition() {
      var $firstChild = $this.children('li:first');

      $firstChild
        .fadeOut( 1000 )
        .next()
        .fadeIn( 1000 )
        .end()
        .appendTo( $this );
    }

    $lastChildren.hide();
    window.setInterval( transition, settings.interval );
  });
};

$(function() { $('.ioslideshow').iOSlideshow(); });

})( jQuery );