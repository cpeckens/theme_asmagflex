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

var $h = jQuery.noConflict();
$h(document).ready(function() {
  function filterPath(string) {
  return string
    .replace(/^\//,'')
    .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
    .replace(/\/$/,'');
  }
  var locationPath = filterPath(location.pathname);
  var scrollElem = scrollableElement('html', 'body');

  $h('a[href*=#]').each(function() {
    var thisPath = filterPath(this.pathname) || locationPath;
    if (  locationPath == thisPath
    && (location.hostname == this.hostname || !this.hostname)
    && this.hash.replace(/#/,'') ) {
      var $target = $h(this.hash), target = this.hash;
      if (target) {
        var targetOffset = $target.offset().top;
        $h(this).click(function(event) {
          event.preventDefault();
          $h(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
            location.hash = target;
          });
        });
      }
    }
  });

  // use the first element that is "scrollable"
  function scrollableElement(els) {
    for (var i = 0, argLength = arguments.length; i <argLength; i++) {
      var el = arguments[i],
          $scrollElement = $h(el);
      if ($scrollElement.scrollTop()> 0) {
        return el;
      } else {
        $scrollElement.scrollTop(1);
        var isScrollable = $scrollElement.scrollTop()> 0;
        $scrollElement.scrollTop(0);
        if (isScrollable) {
          return el;
        }
      }
    }
    return [];
  }

});