// contains zoom.js and smoothscroll.js
/*
  Epic Image Zoom v1.01
  (c) 2011. Web factory Ltd
  http://www.webfactoryltd.com/
  Sold exclusively on CodeCanyon
**/
var $z = jQuery.noConflict();
(function($z) {
  $z.fn.epicZoom = function(options) {
    // cache body DOM element
    var body_el = $z('body');

    // let's try not to clutter the $z.fn namespace
    var methods = {
      isInBounds: function(event, offset, size, padding) {
        if (event.pageX < (offset.left + padding.left) || event.pageX > (offset.left + size.width + padding.left) ||
            event.pageY < (offset.top + padding.top) || event.pageY > (offset.top + size.height + padding.top)) {
          return false;
        } else {
          return true;
        }
      }, // isInBounds
      isDebug: function() {
        if (options.debug && typeof console !== 'undefined') {
          return true;
        } else {
          return false;
        }
      } // isDebug
    };

    // default options
    var defaults = {
      'size'          : 150,
      'border'        : '1px solid white',
      'largeImage'    : '',
      'magnification' : 1.0,
      'hideCursor'    : true,
      'blankCursor'   : 'http://magazine.krieger.dev/wp-content/themes/asmagflex/assets/js/blank.png',
      'debug'         : false
    };
    options = $z.extend(defaults, options);

    // debug
    options.debug = Boolean(options.debug);
    if (methods.isDebug()) {
      console.warn('Epic Image Zoom debugging is enabled.');
    }

    // size
    options.size = parseInt(options.size, 10);

    // magnification
    options.magnification = parseFloat(options.magnification);

    // hideCursor
    options.hideCursor = Boolean(options.hideCursor);

    // largeImage
    options.largeImage = $z.trim(options.largeImage);

    // blankCursor
    options.blankCursor = $z.trim(options.blankCursor);

    if (methods.isDebug()) {
      console.log('EIZ; options: ', options);
    }

    // process images
    return this.each(function() {
      var img = $z(this);

      // plugin only works on images
      if (!img.is('img')) {
        if (methods.isDebug()) {
          console.error('EIZ works only on img elements.');
        }
        return this;
      }

      var preloadImg = $z('<img />');
      if (options.largeImage) {
        preloadImg.attr('src', options.largeImage);
      } else {
        preloadImg.attr('src', img.attr('src'));
      }

      // wait for image to load
      preloadImg.load(function() {
        if (preloadImg.hasInit) {
          return false;
        }
        preloadImg.hasInit = true;

      // global counter
      if (typeof body_el.data('epicZoom-nb') === 'undefined') {
         body_el.data('epicZoom-nb', 0);
      }
      body_el.data('epicZoom-nb', body_el.data('epicZoom-nb') + 1);
      var eiz_nb = body_el.data('epicZoom-nb');

      if (methods.isDebug()) {
        console.log('EIZ; #', eiz_nb);
      }

      img.wrap('<span id="eiz-' + eiz_nb + '" class="eiz-container"></span>');
      var container = $z('#eiz-' + eiz_nb).css('margin', 0)
                                         .css('padding', 0)
                                         .css('border', 0);

      container.append('<span class="eiz-magnifier"></span>');
      var magnifier = $z('.eiz-magnifier', container).css('position', 'absolute')
                                                    .css('margin', 0)
                                                    .css('padding', 0)
                                                    .css('border', options.border)
                                                    .css('-moz-box-shadow', '0 0 5px #777, 0 0 10px #aaa inset')
                                                    .css('-webkit-box-shadow', '0 0 5px #777')
                                                    .css('box-shadow', '0 0 5px #777, 0 0 10px #aaa inset')
                                                    .css('overflow', 'hidden')
                                                    .css('z-index', 20)
                                                    .css('width', options.size + 'px')
                                                    .css('height', options.size + 'px');
      magnifier.append('<div><img alt="" title="" /></div>');
      var magnifierImg2 = $z('img', magnifier).css('margin', 0)
                                             .css('padding', 0)
                                             .css('border', 0);
      if (options.largeImage) {
        magnifierImg2.attr('src', options.largeImage);
      } else {
        magnifierImg2.attr('src', img.attr('src'));
      }

      if (options.hideCursor) {
        magnifierImg2.css('cursor', 'none')
                     .css('cursor', 'url(' + options.blankCursor + '),none !important;');
      }

      var magnifierImg = $z('div', magnifier).css('position', 'absolute')
                                            .css('margin', 0)
                                            .css('padding', 0)
                                            .css('border', 0)
                                            .css('z-index', 1)
                                            .css('overflow', 'hidden');

      // calculate positions and sizes
      magnifierImg2.width(magnifierImg2.width() * options.magnification);
      var ratio = magnifierImg2.width() / img.width();
      var offset = { left: img.offset().left, top: img.offset().top };
      var size = { width: img.width(), height: img.height() };
      var padding = { top: parseInt(img.css('padding-top'), 10), right: parseInt(img.css('padding-right'), 10),
                      bottom: parseInt(img.css('padding-bottom'), 10), left: parseInt(img.css('padding-left'), 10)};
      magnifier.hide();

      // recalculate positions on window resize
      $z(window).resize(function() {
        offset = { left: img.offset().left, top: img.offset().top };
        size = { width: img.width(), height: img.height() };

        if (methods.isDebug()) {
          console.log('EIZ #' + eiz_nb + ': window resized, vars recalculated');
        }
      });

      container.mousemove(function(event){
        if (!methods.isInBounds(event, offset, size, padding)) {
         if (!magnifier.is(':animated')) {
              if (methods.isDebug()) {
                console.log('EIZ #' + eiz_nb + ': out of bounds');
              }
              container.trigger('mouseleave');
            }
            return false;
        }

        if(magnifier.is(':not(:animated):hidden')){
          container.trigger('mouseenter');
        }

        // move the magnifier and image with cursor
        magnifier.css('left', event.pageX - options.size/2);
        magnifier.css('top', event.pageY - options.size/2);
        magnifierImg.css('left', -1 * (event.pageX - offset.left - padding.left) * ratio + options.size/2);
        magnifierImg.css('top', -1 * (event.pageY - offset.top - padding.top) * ratio + options.size/2);
      }).mouseleave(function(){
          magnifier.stop(true, true).hide();
      }).mouseenter(function(event){
          if (methods.isDebug()) {
            console.log('EIZ #' + eiz_nb + ': mouse enter container');
          }
          if (!methods.isInBounds(event, offset, size, padding)) {
            return false;
          }
          magnifier.stop(true, true).show();
      });
    }); // load

      // if image is loaded force load function to exec
      if (preloadImg.complete || preloadImg.naturalWidth > 0) {
        preloadImg.trigger('load');
      }
    }); // each
  }; // fn.epicZoom
} (jQuery));

//*************************Smooth Scroll**************************//

(function($) {

var version = '1.4.4',
    defaults = {
      exclude: [],
      excludeWithin:[],
      offset: 0,
      direction: 'top', // one of 'top' or 'left'
      scrollElement: null, // jQuery set of elements you wish to scroll (for $.smoothScroll).
                          //  if null (default), $('html, body').firstScrollable() is used.
      scrollTarget: null, // only use if you want to override default behavior
      beforeScroll: function() {},  // fn(opts) function to be called before scrolling occurs. "this" is the element(s) being scrolled
      afterScroll: function() {},   // fn(opts) function to be called after scrolling occurs. "this" is the triggering element
      easing: 'swing',
      speed: 400,
      autoCoefficent: 2 // coefficient for "auto" speed
    },

    getScrollable = function(opts) {
      var scrollable = [],
          scrolled = false,
          dir = opts.dir && opts.dir == 'left' ? 'scrollLeft' : 'scrollTop';

      this.each(function() {

        if (this == document || this == window) { return; }
        var el = $(this);
        if ( el[dir]() > 0 ) {
          scrollable.push(this);
          return;
        }

        el[dir](1);
        scrolled  = el[dir]() > 0;
        el[dir](0);
        if ( scrolled ) {
          scrollable.push(this);
          return;
        }

      });

      if ( opts.el === 'first' && scrollable.length ) {
        scrollable = [ scrollable.shift() ];
      }

      return scrollable;
    },
    isTouch = 'ontouchend' in document;

$.fn.extend({
  scrollable: function(dir) {
    var scrl = getScrollable.call(this, {dir: dir});
    return this.pushStack(scrl);
  },
  firstScrollable: function(dir) {
    var scrl = getScrollable.call(this, {el: 'first', dir: dir});
    return this.pushStack(scrl);
  },

  smoothScroll: function(options) {
    options = options || {};
    var opts = $.extend({}, $.fn.smoothScroll.defaults, options),
        locationPath = $.smoothScroll.filterPath(location.pathname);

    this.die('click.smoothscroll').live('click.smoothscroll', function(event) {

      var clickOpts = {}, link = this, $link = $(this),
          hostMatch = ((location.hostname === link.hostname) || !link.hostname),
          pathMatch = opts.scrollTarget || ( $.smoothScroll.filterPath(link.pathname) || locationPath ) === locationPath,
          thisHash = escapeSelector(link.hash),
          include = true;

      if ( !opts.scrollTarget && (!hostMatch || !pathMatch || !thisHash) ) {
        include = false;
      } else {
        var exclude = opts.exclude, elCounter = 0, el = exclude.length;
        while (include && elCounter < el) {
          if ($link.is(escapeSelector(exclude[elCounter++]))) {
            include = false;
          }
        }

        var excludeWithin = opts.excludeWithin, ewlCounter = 0, ewl = excludeWithin.length;
        while ( include && ewlCounter < ewl ) {
          if ($link.closest(excludeWithin[ewlCounter++]).length) {
            include = false;
          }
        }
      }

      if ( include ) {
        event.preventDefault();

        $.extend( clickOpts, opts, {
          scrollTarget: opts.scrollTarget || thisHash,
          link: link
        });

        $.smoothScroll( clickOpts );
      }
    });

    return this;

  }
});

$.smoothScroll = function(options, px) {
  var opts, $scroller, scrollTargetOffset, speed,
      scrollerOffset = 0,
      offPos = 'offset',
      scrollDir = 'scrollTop',
      aniprops = {},
      useScrollTo = false,
      scrollprops = [];

  if ( typeof options === 'number') {
    opts = $.fn.smoothScroll.defaults;
    scrollTargetOffset = options;
  } else {
    opts = $.extend({}, $.fn.smoothScroll.defaults, options || {});
    if (opts.scrollElement) {
      offPos = 'position';
      if (opts.scrollElement.css('position') == 'static') {
        opts.scrollElement.css('position', 'relative');
      }
    }

    scrollTargetOffset = px ||
                        ( $(opts.scrollTarget)[offPos]() &&
                        $(opts.scrollTarget)[offPos]()[opts.direction] ) ||
                        0;
  }
  opts = $.extend({link: null}, opts);
  scrollDir = opts.direction == 'left' ? 'scrollLeft' : scrollDir;

  if ( opts.scrollElement ) {
    $scroller = opts.scrollElement;
    scrollerOffset = $scroller[scrollDir]();
  } else {
    $scroller = $('html, body').firstScrollable();
    useScrollTo = isTouch && 'scrollTo' in window;
  }

  aniprops[scrollDir] = scrollTargetOffset + scrollerOffset + opts.offset;

  opts.beforeScroll.call($scroller, opts);

  if ( useScrollTo ) {
    scrollprops = (opts.direction == 'left') ? [aniprops[scrollDir], 0] : [0, aniprops[scrollDir]];
    window.scrollTo.apply(window, scrollprops);
    opts.afterScroll.call(opts.link, opts);

  } else {
    speed = opts.speed;

    // automatically calculate the speed of the scroll based on distance / coefficient
    if (speed === 'auto') {
      // if aniprops[scrollDir] == 0 then we'll use scrollTop() value instead
      speed = aniprops[scrollDir] || $scroller.scrollTop();
      // divide the speed by the coefficient
      speed = speed / opts.autoCoefficent;
    }

    $scroller.animate(aniprops,
    {
      duration: speed,
      easing: opts.easing,
      complete: function() {
        opts.afterScroll.call(opts.link, opts);
      }
    });
  }

};

$.smoothScroll.version = version;
$.smoothScroll.filterPath = function(string) {
  return string
    .replace(/^\//,'')
    .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
    .replace(/\/$/,'');
};

// default options
$.fn.smoothScroll.defaults = defaults;

function escapeSelector (str) {
  return str.replace(/(:|\.)/g,'\\$1');
}

})(jQuery);
var $p = jQuery.noConflict();
$p('a').smoothScroll({excludeWithin: ['.comments', '.dropdown']});

//**************************Read More/Read Less Function*****************************//
var $j = jQuery.noConflict();
$j(document).ready(function() {
					$j(".wysiwyg-read-more-link").toggle(function() {
					$j(this).text("Read Less").stop();
					$j(this).css({'background-position' : '0px 0px'});
					$j(this).parents(".wysiwyg-more-less").find(".wysiwyg-more-less-toggle").show();
				}, function() {
					$j(this).text("Read More").stop();
					$j(this).css({'background-position' : '0px -25px'});
					$j(this).parents(".wysiwyg-more-less").find(".wysiwyg-more-less-toggle").hide();
				});

});

