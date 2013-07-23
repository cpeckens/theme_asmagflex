/* 
 *  PhotoMosaic starts around line ~#40 
 */


/*
      mustache.js — Logic-less templates in JavaScript
      See http://mustache.github.com/ for more info.
*/
(function(window){var Mustache=function(){var Renderer=function(){};Renderer.prototype={otag:"{{",ctag:"}}",pragmas:{},buffer:[],pragmas_implemented:{"IMPLICIT-ITERATOR":true},context:{},render:function(template,context,partials,in_recursion){if(!in_recursion){this.context=context;this.buffer=[];}
if(!this.includes("",template)){if(in_recursion){return template;}else{this.send(template);return;}}
template=this.render_pragmas(template);var html=this.render_section(template,context,partials);if(in_recursion){return this.render_tags(html,context,partials,in_recursion);}
this.render_tags(html,context,partials,in_recursion);},send:function(line){if(line!=""){this.buffer.push(line);}},render_pragmas:function(template){if(!this.includes("%",template)){return template;}
var that=this;var regex=new RegExp(this.otag+"%([\\w-]+) ?([\\w]+=[\\w]+)?"+
this.ctag);return template.replace(regex,function(match,pragma,options){if(!that.pragmas_implemented[pragma]){throw({message:"This implementation of mustache doesn't understand the '"+
pragma+"' pragma"});}
that.pragmas[pragma]={};if(options){var opts=options.split("=");that.pragmas[pragma][opts[0]]=opts[1];}
return"";});},render_partial:function(name,context,partials){name=this.trim(name);if(!partials||partials[name]===undefined){throw({message:"unknown_partial '"+name+"'"});}
if(typeof(context[name])!="object"){return this.render(partials[name],context,partials,true);}
return this.render(partials[name],context[name],partials,true);},render_section:function(template,context,partials){if(!this.includes("#",template)&&!this.includes("^",template)){return template;}
var that=this;var regex=new RegExp(this.otag+"(\\^|\\#)\\s*(.+)\\s*"+this.ctag+"\n*([\\s\\S]+?)"+this.otag+"\\/\\s*\\2\\s*"+this.ctag+"\\s*","mg");return template.replace(regex,function(match,type,name,content){var value=that.find(name,context);if(type=="^"){if(!value||that.is_array(value)&&value.length===0){return that.render(content,context,partials,true);}else{return"";}}else if(type=="#"){if(that.is_array(value)){return that.map(value,function(row){return that.render(content,that.create_context(row),partials,true);}).join("");}else if(that.is_object(value)){return that.render(content,that.create_context(value),partials,true);}else if(typeof value==="function"){return value.call(context,content,function(text){return that.render(text,context,partials,true);});}else if(value){return that.render(content,context,partials,true);}else{return"";}}});},render_tags:function(template,context,partials,in_recursion){var that=this;var new_regex=function(){return new RegExp(that.otag+"(=|!|>|\\{|%)?([^\\/#\\^]+?)\\1?"+
that.ctag+"+","g");};var regex=new_regex();var tag_replace_callback=function(match,operator,name){switch(operator){case"!":return"";case"=":that.set_delimiters(name);regex=new_regex();return"";case">":return that.render_partial(name,context,partials);case"{":return that.find(name,context);default:return that.escape(that.find(name,context));}};var lines=template.split("\n");for(var i=0;i<lines.length;i++){lines[i]=lines[i].replace(regex,tag_replace_callback,this);if(!in_recursion){this.send(lines[i]);}}
if(in_recursion){return lines.join("\n");}},set_delimiters:function(delimiters){var dels=delimiters.split(" ");this.otag=this.escape_regex(dels[0]);this.ctag=this.escape_regex(dels[1]);},escape_regex:function(text){if(!arguments.callee.sRE){var specials=['/','.','*','+','?','|','(',')','[',']','{','}','\\'];arguments.callee.sRE=new RegExp('(\\'+specials.join('|\\')+')','g');}
return text.replace(arguments.callee.sRE,'\\$1');},find:function(name,context){name=this.trim(name);function is_kinda_truthy(bool){return bool===false||bool===0||bool;}
var value;if(is_kinda_truthy(context[name])){value=context[name];}else if(is_kinda_truthy(this.context[name])){value=this.context[name];}
if(typeof value==="function"){return value.apply(context);}
if(value!==undefined){return value;}
return"";},includes:function(needle,haystack){return haystack.indexOf(this.otag+needle)!=-1;},escape:function(s){s=String(s===null?"":s);return s.replace(/&(?!\w+;)|["'<>\\]/g,function(s){switch(s){case "&": return "&amp;";case "\\": return "\\\\";case '"': return '&quot;';case "'": return '&#39;';case "<": return "&lt;";case ">": return "&gt;";default: return s;
}});},create_context:function(_context){if(this.is_object(_context)){return _context;}else{var iterator=".";if(this.pragmas["IMPLICIT-ITERATOR"]){iterator=this.pragmas["IMPLICIT-ITERATOR"].iterator;}
var ctx={};ctx[iterator]=_context;return ctx;}},is_object:function(a){return a&&typeof a=="object";},is_array:function(a){return Object.prototype.toString.call(a)==='[object Array]';},trim:function(s){return s.replace(/^\s*|\s*$/g,"");},map:function(array,fn){if(typeof array.map=="function"){return array.map(fn);}else{var r=[];var l=array.length;for(var i=0;i<l;i++){r.push(fn(array[i]));}
return r;}}};return({name:"mustache.js",version:"0.3.1-dev",to_html:function(template,view,partials,send_fun){var renderer=new Renderer();if(send_fun){renderer.send=send_fun;}
renderer.render(template,view,partials);if(!send_fun){return renderer.buffer.join("\n");}}});}();
window['PhotoMosaic']={};
window['PhotoMosaic'].Mustache=Mustache;
})(window);

/*
    jQuery photoMosaic v1.7.4
    requires jQuery 1.5+ & Mustache (included above)
*/

(function($) {

    if(typeof console === "undefined") {
        console = {
            log: function(msg) {
                console.errors.push(msg);
            },
            errors: []
        };
    }

    var photoMosaic = function() { };

    $.extend(photoMosaic.prototype, {

        init: function(el, options, i){
            var defaults = {
                input : 'json', // json, html, xml
                gallery : 'PMalbum', // json object, xml file path
                padding : 2,
                columns : 3,
                width : 'auto', // auto (str) or (int) 
                height : 'auto', // auto (str) or (int)
                links : true,
                external_links: false,
                random : false,
                force_order : false,
                auto_columns : false,
                ideal_column_width : 100,
                show_loading : false,
                modal_name : null,
                modal_group : true,
                modal_ready_callback : null
            };
            
            this.opts = $.extend({}, defaults, options);
            this.obj = $(el);
            this.id = (Date.parse(new Date()) + Math.round(Math.random() * 10000));

            this.preload = 'PM_preloadify' + this.id;

            this.images = [];
            this.columns = [];

            this.template = ' ' +
                '<div id="photoMosaic_' + this.id + '" class="photoMosaic">' +
                    '{{#columns}}' +
                        '<ol style="float:left; margin:0 {{^last}}{{padding}}px 0 0{{/last}}">' +
                            '{{#images}}' +
                                '<li style="width:{{#width}}{{constraint}}{{/width}}px; height:{{#height}}{{constraint}}{{/height}}px; margin:0 {{^last}}0 {{padding}}px 0{{/last}}">' +
                                    '{{#link}}<a href="{{path}}" class="popup" {{#external}}target="_blank"{{/external}} {{#modal}}rel="{{modal}}"{{/modal}} {{#caption}}title="{{caption}}"{{/caption}}>{{/link}}' +
                                        '<img src="{{src}}" style="' +
                                                'width:{{#width}}{{adjusted}}{{/width}}px; ' +
                                                'height:{{#height}}{{adjusted}}{{/height}}px; ' +
                                                '{{#adjustment}}{{type}}:-{{value}}px;{{/adjustment}}" ' +
                                            'title="{{caption}}"/>' +
                                    '{{#link}}</a>{{/link}}' +
                                '</li>' +
                            '{{/images}}' +
                        '</ol>' +
                    '{{/columns}}' +
                '</div>';

            this.loading_template = ' ' +
                '<div id="photoMosaic_' + this.id + '" class="photoMosaic">' +
                    '<div class="photoMosaicLoading">loading gallery...</div>' +
                '</div>';

            if(this.opts.width === 'auto') {
                this.opts.width = this.obj.width();
            }

            // Error Checks
            if ( this.opts.input === 'xml' && this.opts.gallery === '' ) {
                console.log("PhotoMosaic: ERROR: No XML file path specified.");
                return;
            }
            if ( this.opts.input ==='xml' && this.opts.gallery === 'PMalbum' ) {
                console.log('PhotoMosaic: ERROR: No XML file path specified.');
                return;
            }
            if ( this.opts.input === 'json' && this.opts.gallery === '' ) {
                console.log("PhotoMosaic: ERROR: No JSON object defined.");
                return;
            }
            if ( this.opts.input ==='json' && this.opts.gallery === 'PMalbum' ) {
                if ( typeof(PMalbum) !== 'undefined' ) {
                    this.opts.gallery = PMalbum;
                } else {
                    console.log('PhotoMosaic: ERROR: The JSON object "PMalbum" can not be found.');
                    return;
                }
            }
            if ( this.opts.gallery.length - 1 < this.current_album ) {
                console.log('PhotoMosaic: ERROR: "start_album" uses a 0-index (0 = the first album).'
                     + 'No album was found at the specified index ('+ this.current_album +')');
                return;
            }

            var self = this;

            // loading message
            if ( this.opts.show_loading ) {
                this.obj.html( PhotoMosaic.Mustache.to_html(this.loading_template, {}) );
            }
            
            // html -- construct json -- preload -- mosaic -- write
            if ( this.opts.input === 'html' ) {
                this.opts.gallery = this.constructGalleryFromHTML();
                this.autoCols();
                $.when(self.preloadify()).then(function() {
                    self.obj.html( self.makeMosaic() );
                    self.modalCallback();
                });
            }

            // xml -- construct json -- preload -- mosaic -- write
            if ( this.opts.input === 'xml' ){
                $.get(this.opts.gallery, function(data){
                    if ( $(data).find('photos').length > 0 ) {
                        self.opts.gallery = $(data).find('photos');
                        self.opts.gallery = self.constructGalleryFromXML();
                        self.autoCols();
                        $.when(self.preloadify()).then(function() {
                            self.obj.html( self.makeMosaic() );
                            self.modalCallback();
                        });
                    } else {
                        console.log('PhotoMosaic: ERROR: The XML either couldn\'t be found or was malformed.');
                        return;
                    }
                });
                
            }

            // json -- preload -- mosaic -- write
            if ( this.opts.input === 'json' ) {
                this.autoCols();
                $.when(this.preloadify()).then(function() {
                    self.obj.html( self.makeMosaic() );
                    self.modalCallback();
                });
            }
        },

        makeMosaic: function() {
            var self = this,
                $preload = $('#' + this.preload),
                i,
                j;

            // get image sizes, set modalhook, & get link paths
            $.each(this.opts.gallery, function(i) {
                var image = {},
                    $img = $preload.find('img[src="'+ this.src +'"]'),
                    modal_text;
                    
                // image sizes
                image.src = this.src;
                image.width = {};
                image.height = {};
                image.padding = self.opts.padding;
                image.caption = this.caption;

                image.width.original = $img.width();
                image.height.original = $img.height();
                image.width.adjusted = self.col_width;
                image.height.adjusted = Math.floor((image.height.original * image.width.adjusted) / image.width.original);

                // modal hooks
                if (self.opts.modal_name) {
                    if (self.opts.modal_group) {
                        modal_text = self.opts.modal_name + '[' + self.id + ']';    
                    } else {
                        modal_text = self.opts.modal_name;
                    }
                    image.modal = modal_text;
                }
                
                // link paths
                if (self.opts.links && this.url) {
                    image.link = true;
                    image.path = this.url;
                    image.external = self.opts.external_links;
                    delete image.modal;
                } else if (self.opts.links) {
                    image.link = true;
                    image.path = this.src;
                    image.external = self.opts.external_links;
                } else {
                    image.link = false;
                }

                self.images.push(image);
            });

            // ERROR CHECK: remove any images that failed to load
            this.images = this.errorCheck(this.images);

            // alt sort images by height (tall, short, tall, short)
            if (!this.opts.force_order) {
                this.images.sort(function(a,b) {
                    if (self.opts.random) {
                        return (0.5 - Math.random());
                    } else {
                        return (a.height.original - b.height.original);
                    }
                });
                this.images.reverse();
            }
            
            var order = [],
                bool = true;
            
            if (!this.opts.force_order) {
                while (this.images.length > 0) {
                    if (bool) {
                        order.push(this.images.shift());
                    } else {
                        order.push(this.images.pop());
                    }
                    bool = !bool;
                }
                this.images = order;
            }

            // deal into columns
            var current_col = 0;

            for (i = 0; i < this.images.length; i++) {
                if (current_col === this.opts.columns) {
                    current_col = 0;
                }

                if (!this.columns[current_col]) {
                    this.columns[current_col] = [];
                }
                this.columns[current_col].push(this.images[i]);

                current_col++;
            }
            
            // unfortunate special-case "force order"
            if (this.opts.force_order) {
                var forced_cols = [];
                for (i = 0; i < this.columns.length; i++) {
                    for (j = 0; j < this.columns[i].length; j++) {
                        if (!forced_cols[i]) {
                            forced_cols[i] = [];
                        }
                        forced_cols[i].push(this.images[0]);
                        this.images.shift();
                    }
                }
                this.columns = forced_cols;
            }
            
            // construct template object &
            // get column heights (img height adjusted for col width)
            var json = {columns:[]},
                col_heights = [];
            
            for (i = 0; i < this.columns.length; i++) {
                var col_height = 0;

                for (j = 0; j < this.columns[i].length; j++) {
                    col_height = col_height + this.columns[i][j].height.adjusted;
                }
                col_height = col_height + (this.columns[i].length - 1) * this.opts.padding;
                col_heights.push(col_height);
                
                json.columns[i] = {};
                json.columns[i].images = this.columns[i];
                json.columns[i].height = col_height;
                json.columns[i].padding = this.opts.padding;
            }
            
            // normalize column heights
            var shortest_col = this.getSmallest(col_heights),
                tallest_col = this.getBiggest(col_heights),
                average_col_height = Math.floor((shortest_col + tallest_col) / 2);

            if (this.opts.height === 'auto') {
                json = this.adjustHeights(json, average_col_height);
            } else {
                json = this.adjustHeights(json, this.opts.height);
            }

            return PhotoMosaic.Mustache.to_html(this.template, json);
        },
        
        adjustHeights: function(json, target_height) {
            json = this.markLastColumn(json);
            
            for (i = 0; i < json.columns.length; i++) {
                json = this.markLastImageInColumn(json, i);
                    
                if(json.columns[i].height > target_height) {
                    json.columns[i] = this.scaleColumnDown(json.columns[i], target_height);
                } else {
                    json.columns[i] = this.scaleColumnUp(json.columns[i], target_height);
                }
            }
            
            return json;
        },
        
        autoCols: function(){
            var max_width = this.opts.width,
                ideal_width = this.opts.ideal_column_width,
                num_images = eval(this.opts.gallery).length,
                cols = 0,
                ratio = {w:4, h:3},
                i = 0;

            if(this.opts.auto_columns) {
                while(cols === 0) {
                    if(num_images <= ((i + ratio.w) * (i + ratio.h))) {
                        cols = i + ratio.w;
                    } else {
                        ++i;
                    }
                }
                this.opts.width = ((cols * ideal_width) >= max_width) ? max_width : cols * ideal_width;
                this.opts.columns = cols;
            }
            
            this.col_mod = (this.opts.width - (this.opts.padding * (this.opts.columns - 1))) % this.opts.columns;
            this.col_width = ((this.opts.width - this.col_mod) - (this.opts.padding * (this.opts.columns - 1))) / this.opts.columns;            
        },
        
        scaleColumnDown: function(col, height) {
            var count = col.images.length,
                diff = col.height - height,
                mod = diff % count,
                divy = Math.floor(diff / count),
                divy_mod = divy + mod,
                offset = Math.floor(divy / 2),
                offset_mod = Math.floor((divy + mod) / 2),
                largest_image = this.findLargestImage(col.images),
                i;

            for (i = 0; i < count; i++) {
                if(i === largest_image.index) {
                    col.images[i].height.constraint = col.images[i].height.adjusted - divy_mod;
                } else {
                    col.images[i].height.constraint = col.images[i].height.adjusted - divy;
                }
                col.images[i].width.constraint = col.images[i].width.adjusted;
                col.images[i].adjustment = {
                    type : 'top',
                    value : Math.floor((col.images[i].height.adjusted - col.images[i].height.constraint) / 2)
                };
            }
            
            return col;
        },
        
        scaleColumnUp: function(col, height) {
            var count = col.images.length,
                diff = height - col.height,
                mod = diff % count,
                divy = Math.floor(diff / count),
                divy_mod = divy + mod,
                offset = Math.floor(divy / 2),
                offset_mod = Math.floor((divy + mod) / 2),
                smallest_image = this.findSmallestImage(col.images),
                i;
 
            for (i = 0; i < count; i++) {
                if(i === smallest_image.index) {
                    col.images[i].height.constraint = col.images[i].height.adjusted + divy_mod;
                } else {
                    col.images[i].height.constraint = col.images[i].height.adjusted + divy;
                }
                col.images[i].width.constraint = col.images[i].width.adjusted;
                col.images[i].width.adjusted = Math.floor((col.images[i].width.adjusted * col.images[i].height.constraint) / col.images[i].height.adjusted);
                col.images[i].height.adjusted = col.images[i].height.constraint;

                col.images[i].adjustment = {
                    type : 'left',
                    value : Math.floor((col.images[i].width.adjusted - col.images[i].width.constraint) / 2)
                };
            }

            return col;
        },
        
        getSmallest: function(list) {
            var smallest = 0,
                i;
                
            for (i = 0; i < list.length; i++) {
                if (smallest === 0) {
                    smallest = list[i];
                } else if (list[i] < smallest) {
                    smallest = list[i];    
                }
            }

            return smallest;
        },
        
        getBiggest: function(list) {
            var biggest = 0,
                i;

            for (i = 0; i < list.length; i++) {
                if (list[i] > biggest) {
                    biggest = list[i];
                }
            }

            return biggest;
        },

        findSmallestImage: function(images) {
            var smallest_height = 0,
                index_of_smallest = 0,
                i;
                
            for (i = 0; i < images.length; i++) {
                if(smallest_height === 0) {
                    smallest_height = images[i].height.adjusted;
                } else if(images[i].height.adjusted < smallest_height) {
                    smallest_height = images[i].height.adjusted;
                    index_of_smallest = i;
                }
            }
            
            return { 
                height : smallest_height,
                index : index_of_smallest
            };
        },

        findLargestImage: function(images) {
            var largest_height = 0,
                index_of_largest = 0,
                i;
                
            for (i = 0; i < images.length; i++) {
                if(images[i].height.adjusted > largest_height) {
                    largest_height = images[i].height.adjusted;
                    index_of_largest = i;
                }
            }
            
            return { 
                height : largest_height,
                index : index_of_largest
            };
        },
        
        markLastColumn: function(json) {
            json.columns[json.columns.length - 1].last = true;
            return json;
        },
        
        markLastImageInColumn: function(json, i) {
            json.columns[i].images[json.columns[i].images.length - 1].last = true;
            return json;
        },
        
        errorCheck: function(images){
            var to_delete = [],
                i;

            $.each(images, function(i) {
                if(isNaN(this.height.adjusted)){
                    to_delete.push(i);
                }
            });

            for (i = to_delete.length - 1; i >= 0; --i) {
                console.log('PhotoMosaic: ERROR: The following image failed to load and was skipped.\n' + images[to_delete[i]].src);
                var rest = images.slice( to_delete[i] + 1 );
                images.length = to_delete[i];
                images.push.apply(images, rest);
            };

            return images;
        },
        
        preloadify: function(){
            var deferred = $.Deferred(),
                promises = [],
                $images = $('<div>').attr({
                    'id': this.preload,
                    'class' : 'PM_preloadify'
                });

            $.each(this.opts.gallery, function(i) {
                var dfd = $.Deferred(),
                    $item = $('<img>').error(dfd.resolve).load(dfd.resolve).attr({src : this.src});
                $images.append($item);
                promises.push(dfd);
            });
            
            $.when.apply(null, promises).done(deferred.resolve, $('body').append($images));
            
            return deferred.promise(); 
        },
        
        constructGalleryFromHTML: function(){
            var gallery = [],
                $images = this.obj.find('img'),
                i;

            for (i = 0; i < $images.length; i++) {
                var image = {};

                image.src = ($images.eq(i).parent('a').length > 0 && this.opts.links) ? $images.eq(i).parent('a').attr('href') : $images.eq(i).attr('src');
                image.caption = $images.eq(i).attr('title');

                gallery.push(image);
            } 

            return gallery;
        },

        constructGalleryFromXML: function(){
            var gallery = [];
            
            this.opts.gallery.find('photo').each(function(i){
                var photo = {},
                    data = $(this);
                
                photo.caption = data.children('title').text();
                photo.src = data.children('src').text();
                photo.url = data.children('url').text();
                
                gallery.push(photo);
            });
            
            return gallery;
        },
        
        modalCallback: function() {
            var $node = this.obj.children().eq(0)[0];
            if($.isFunction(this.opts.modal_ready_callback)){
                this.opts.modal_ready_callback.apply(this, [$node]);
            }
        }

    });

    $.fn.photoMosaic = function(options) {
        this.each(function(i) {
            if (!this.photoMosaic) {
                this.photoMosaic = new photoMosaic();
                this.photoMosaic.init(this, options, i);
            }
        });
        return this;
    };
})(jQuery);


/*!
 * fancyBox - jQuery Plugin
 * version: 2.1.0 (Mon, 20 Aug 2012)
 * @requires jQuery v1.6 or later
 *
 * Examples at http://fancyapps.com/fancybox/
 * License: www.fancyapps.com/fancybox/#license
 *
 * Copyright 2012 Janis Skarnelis - janis@fancyapps.com
 *
 */

(function (window, document, $, undefined) {
	"use strict";

	var W = $(window),
		D = $(document),
		F = $.fancybox = function () {
			F.open.apply( this, arguments );
		},
		didUpdate = null,
		isTouch	  = document.createTouch !== undefined,

		isQuery	= function(obj) {
			return obj && obj.hasOwnProperty && obj instanceof $;
		},
		isString = function(str) {
			return str && $.type(str) === "string";
		},
		isPercentage = function(str) {
			return isString(str) && str.indexOf('%') > 0;
		},
		isScrollable = function(el) {
			return (el && !(el.style.overflow && el.style.overflow === 'hidden') && ((el.clientWidth && el.scrollWidth > el.clientWidth) || (el.clientHeight && el.scrollHeight > el.clientHeight)));
		},
		getScalar = function(value, dim) {
			var value_ = parseInt(value, 10);

			if (dim && isPercentage(value)) {
				value_ = F.getViewport()[ dim ] / 100 * value_;
			}

			return Math.ceil(value_);
		},
		getValue = function(value, dim) {
			return getScalar(value, dim) + 'px';
		};

	$.extend(F, {
		// The current version of fancyBox
		version: '2.1.0',

		defaults: {
			padding : 15,
			margin  : 20,

			width     : 800,
			height    : 600,
			minWidth  : 100,
			minHeight : 100,
			maxWidth  : 9999,
			maxHeight : 9999,

			autoSize   : true,
			autoHeight : false,
			autoWidth  : false,

			autoResize  : !isTouch,
			autoCenter  : !isTouch,
			fitToView   : true,
			aspectRatio : false,
			topRatio    : 0.5,
			leftRatio   : 0.5,

			scrolling : 'auto', // 'auto', 'yes' or 'no'
			wrapCSS   : '',

			arrows     : true,
			closeBtn   : true,
			closeClick : false,
			nextClick  : false,
			mouseWheel : true,
			autoPlay   : false,
			playSpeed  : 3000,
			preload    : 3,
			modal      : false,
			loop       : true,

			ajax  : {
				dataType : 'html',
				headers  : { 'X-fancyBox': true }
			},
			iframe : {
				scrolling : 'auto',
				preload   : true
			},
			swf : {
				wmode: 'transparent',
				allowfullscreen   : 'true',
				allowscriptaccess : 'always'
			},

			keys  : {
				next : {
					13 : 'left', // enter
					34 : 'up',   // page down
					39 : 'left', // right arrow
					40 : 'up'    // down arrow
				},
				prev : {
					8  : 'right',  // backspace
					33 : 'down',   // page up
					37 : 'right',  // left arrow
					38 : 'down'    // up arrow
				},
				close  : [27], // escape key
				play   : [32], // space - start/stop slideshow
				toggle : [70]  // letter "f" - toggle fullscreen
			},

			direction : {
				next : 'left',
				prev : 'right'
			},

			scrollOutside  : true,

			// Override some properties
			index   : 0,
			type    : null,
			href    : null,
			content : null,
			title   : null,

			// HTML templates
			tpl: {
				wrap     : '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
				image    : '<img class="fancybox-image" src="{href}" alt="" />',
				iframe   : '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0"' + ($.browser.msie ? ' allowtransparency="true"' : '') + '></iframe>',
				error    : '<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',
				closeBtn : '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;"></a>',
				next     : '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
				prev     : '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
			},

			// Properties for each animation type
			// Opening fancyBox
			openEffect  : 'fade', // 'elastic', 'fade' or 'none'
			openSpeed   : 250,
			openEasing  : 'swing',
			openOpacity : true,
			openMethod  : 'zoomIn',

			// Closing fancyBox
			closeEffect  : 'fade', // 'elastic', 'fade' or 'none'
			closeSpeed   : 250,
			closeEasing  : 'swing',
			closeOpacity : true,
			closeMethod  : 'zoomOut',

			// Changing next gallery item
			nextEffect : 'elastic', // 'elastic', 'fade' or 'none'
			nextSpeed  : 250,
			nextEasing : 'swing',
			nextMethod : 'changeIn',

			// Changing previous gallery item
			prevEffect : 'elastic', // 'elastic', 'fade' or 'none'
			prevSpeed  : 250,
			prevEasing : 'swing',
			prevMethod : 'changeOut',

			// Enabled helpers
			helpers : {
				overlay : {
					closeClick : true,
					speedOut   : 200,
					showEarly  : true,
					css        : {}
				},
				title : {
					type : 'float' // 'float', 'inside', 'outside' or 'over'
				}
			},

			// Callbacks
			onCancel     : $.noop, // If canceling
			beforeLoad   : $.noop, // Before loading
			afterLoad    : $.noop, // After loading
			beforeShow   : $.noop, // Before changing in current item
			afterShow    : $.noop, // After opening
			beforeChange : $.noop, // Before changing gallery item
			beforeClose  : $.noop, // Before closing
			afterClose   : $.noop  // After closing
		},

		//Current state
		group    : {}, // Selected group
		opts     : {}, // Group options
		previous : null,  // Previous element
		coming   : null,  // Element being loaded
		current  : null,  // Currently loaded element
		isActive : false, // Is activated
		isOpen   : false, // Is currently open
		isOpened : false, // Have been fully opened at least once

		wrap  : null,
		skin  : null,
		outer : null,
		inner : null,

		player : {
			timer    : null,
			isActive : false
		},

		// Loaders
		ajaxLoad   : null,
		imgPreload : null,

		// Some collections
		transitions : {},
		helpers     : {},

		/*
		 *	Static methods
		 */

		open: function (group, opts) {
			if (!group) {
				return;
			}

			if (!$.isPlainObject(opts)) {
				opts = {};
			}

			// Close if already active
			if (false === F.close(true)) {
				return;
			}

			// Normalize group
			if (!$.isArray(group)) {
				group = isQuery(group) ? $(group).get() : [group];
			}

			// Recheck if the type of each element is `object` and set content type (image, ajax, etc)
			$.each(group, function(i, element) {
				var obj = {},
					href,
					title,
					content,
					type,
					rez,
					hrefParts,
					selector;

				if ($.type(element) === "object") {
					// Check if is DOM element
					if (element.nodeType) {
						element = $(element);
					}

					if (isQuery(element)) {
						obj = {
							href    : element.attr('href'),
							title   : element.attr('title'),
							isDom   : true,
							element : element
						};

						if ($.metadata) {
							$.extend(true, obj, element.metadata());
						}

					} else {
						obj = element;
					}
				}

				href  = opts.href  || obj.href || (isString(element) ? element : null);
				title = opts.title !== undefined ? opts.title : obj.title || '';

				content = opts.content || obj.content;
				type    = content ? 'html' : (opts.type  || obj.type);

				if (!type && obj.isDom) {
					type = element.data('fancybox-type');

					if (!type) {
						rez  = element.prop('class').match(/fancybox\.(\w+)/);
						type = rez ? rez[1] : null;
					}
				}

				if (isString(href)) {
					// Try to guess the content type
					if (!type) {
						if (F.isImage(href)) {
							type = 'image';

						} else if (F.isSWF(href)) {
							type = 'swf';

						} else if (href.charAt(0) === '#') {
							type = 'inline';

						} else if (isString(element)) {
							type    = 'html';
							content = element;
						}
					}

					// Split url into two pieces with source url and content selector, e.g,
					// "/mypage.html #my_id" will load "/mypage.html" and display element having id "my_id"
					if (type === 'ajax') {
						hrefParts = href.split(/\s+/, 2);
						href      = hrefParts.shift();
						selector  = hrefParts.shift();
					}
				}

				if (!content) {
					if (type === 'inline') {
						if (href) {
							content = $( isString(href) ? href.replace(/.*(?=#[^\s]+$)/, '') : href ); //strip for ie7

						} else if (obj.isDom) {
							content = element;
						}

					} else if (type === 'html') {
						content = href;

					} else if (!type && !href && obj.isDom) {
						type    = 'inline';
						content = element;
					}
				}

				$.extend(obj, {
					href     : href,
					type     : type,
					content  : content,
					title    : title,
					selector : selector
				});

				group[ i ] = obj;
			});

			// Extend the defaults
			F.opts = $.extend(true, {}, F.defaults, opts);

			// All options are merged recursive except keys
			if (opts.keys !== undefined) {
				F.opts.keys = opts.keys ? $.extend({}, F.defaults.keys, opts.keys) : false;
			}

			F.group = group;

			return F._start(F.opts.index);
		},

		// Cancel image loading or abort ajax request
		cancel: function () {
			var coming = F.coming;

			if (!coming || false === F.trigger('onCancel')) {
				return;
			}

			F.hideLoading();

			if (F.ajaxLoad) {
				F.ajaxLoad.abort();
			}

			F.ajaxLoad = null;

			if (F.imgPreload) {
				F.imgPreload.onload = F.imgPreload.onerror = null;
			}

			// If the first item has been canceled, then clear everything
			if (coming.wrap) {
				coming.wrap.stop(true).trigger('onReset').remove();
			}

			if (!F.current) {
				F.trigger('afterClose');
			}

			F.coming = null;
		},

		// Start closing animation if is open; remove immediately if opening/closing
		close: function (immediately) {
			F.cancel();

			if (false === F.trigger('beforeClose')) {
				return;
			}

			F.unbindEvents();

			if (!F.isOpen || immediately === true) {
				$('.fancybox-wrap').stop(true).trigger('onReset').remove();

				F._afterZoomOut();

			} else {
				F.isOpen = F.isOpened = false;
				F.isClosing = true;

				$('.fancybox-item, .fancybox-nav').remove();

				F.wrap.stop(true, true).removeClass('fancybox-opened');

				if (F.wrap.css('position') === 'fixed') {
					F.wrap.css(F._getPosition( true ));
				}

				F.transitions[ F.current.closeMethod ]();
			}
		},

		// Manage slideshow:
		//   $.fancybox.play(); - toggle slideshow
		//   $.fancybox.play( true ); - start
		//   $.fancybox.play( false ); - stop
		play: function ( action ) {
			var clear = function () {
					clearTimeout(F.player.timer);
				},
				set = function () {
					clear();

					if (F.current && F.player.isActive) {
						F.player.timer = setTimeout(F.next, F.current.playSpeed);
					}
				},
				stop = function () {
					clear();

					$('body').unbind('.player');

					F.player.isActive = false;

					F.trigger('onPlayEnd');
				},
				start = function () {
					if (F.current && (F.current.loop || F.current.index < F.group.length - 1)) {
						F.player.isActive = true;

						$('body').bind({
							'afterShow.player onUpdate.player'   : set,
							'onCancel.player beforeClose.player' : stop,
							'beforeLoad.player' : clear
						});

						set();

						F.trigger('onPlayStart');
					}
				};

			if (action === true || (!F.player.isActive && action !== false)) {
				start();
			} else {
				stop();
			}
		},

		// Navigate to next gallery item
		next: function ( direction ) {
			var current = F.current;

			if (current) {
				if (!isString(direction)) {
					direction = current.direction.next;
				}

				F.jumpto(current.index + 1, direction, 'next');
			}
		},

		// Navigate to previous gallery item
		prev: function ( direction ) {
			var current = F.current;

			if (current) {
				if (!isString(direction)) {
					direction = current.direction.prev;
				}

				F.jumpto(current.index - 1, direction, 'prev');
			}
		},

		// Navigate to gallery item by index
		jumpto: function ( index, direction, router ) {
			var current = F.current;

			if (!current) {
				return;
			}

			index = getScalar(index);

			F.direction = direction || current.direction[ (index >= current.index ? 'next' : 'prev') ];
			F.router    = router || 'jumpto';

			if (current.loop) {
				if (index < 0) {
					index = current.group.length + (index % current.group.length);
				}

				index = index % current.group.length;
			}

			if (current.group[ index ] !== undefined) {
				F.cancel();

				F._start(index);
			}
		},

		// Center inside viewport and toggle position type to fixed or absolute if needed
		reposition: function (e, onlyAbsolute) {
			var pos;

			if (F.isOpen) {
				pos = F._getPosition(onlyAbsolute);

				if (e && e.type === 'scroll') {
					delete pos.position;

					F.wrap.stop(true, true).animate(pos, 200);

				} else {
					F.wrap.css(pos);
				}
			}
		},

		update: function (e) {
			var type = (e && e.type),
				anyway = !type || type === 'orientationchange';

			if (anyway) {
				clearTimeout(didUpdate);

				didUpdate = null;
			}

			if (!F.isOpen || didUpdate) {
				return;
			}

			// Help browser to restore document dimensions
			if (anyway || isTouch) {
				F.wrap.removeAttr('style').addClass('fancybox-tmp');

				F.trigger('onUpdate');
			}

			didUpdate = setTimeout(function() {
				var current = F.current;

				if (!current) {
					return;
				}

				F.wrap.removeClass('fancybox-tmp');

				if (type !== 'scroll') {
					F._setDimension();
				}

				if (!(type === 'scroll' && current.canShrink)) {
					F.reposition(e);
				}

				F.trigger('onUpdate');

				didUpdate = null;

			}, (isTouch ? 500 : (anyway ? 20 : 300)));
		},

		// Shrink content to fit inside viewport or restore if resized
		toggle: function ( action ) {
			if (F.isOpen) {
				F.current.fitToView = $.type(action) === "boolean" ? action : !F.current.fitToView;

				F.update();
			}
		},

		hideLoading: function () {
			D.unbind('keypress.fb');

			$('#fancybox-loading').remove();
		},

		showLoading: function () {
			var el, viewport;

			F.hideLoading();

			// If user will press the escape-button, the request will be canceled
			D.bind('keypress.fb', function(e) {
				if ((e.which || e.keyCode) === 27) {
					e.preventDefault();
					F.cancel();
				}
			});

			el = $('<div id="fancybox-loading"><div></div></div>').click(F.cancel).appendTo('body');

			if (!F.defaults.fixed) {
				viewport = F.getViewport();

				el.css({
					position : 'absolute',
					top  : (viewport.h * 0.5) + viewport.y,
					left : (viewport.w * 0.5) + viewport.x
				});
			}
		},

		getViewport: function () {
			var lock = F.current ? F.current.locked : false,
				rez  = {
					x: W.scrollLeft(),
					y: W.scrollTop()
				};

			if (lock) {
				rez.w = lock[0].clientWidth;
				rez.h = lock[0].clientHeight;

			} else {
				// See http://bugs.jquery.com/ticket/6724
				rez.w = isTouch && window.innerWidth  ? window.innerWidth  : W.width();
				rez.h = isTouch && window.innerHeight ? window.innerHeight : W.height();
			}

			return rez;
		},

		// Unbind the keyboard / clicking actions
		unbindEvents: function () {
			if (F.wrap && isQuery(F.wrap)) {
				F.wrap.unbind('.fb');
			}

			D.unbind('.fb');
			W.unbind('.fb');
		},

		bindEvents: function () {
			var current = F.current,
				keys;

			if (!current) {
				return;
			}

			// Changing document height on iOS devices triggers a 'resize' event,
			// that can change document height... repeating infinitely
			W.bind('orientationchange.fb' + (isTouch ? '' : ' resize.fb' ) + (current.autoCenter && !current.locked ? ' scroll.fb' : ''), F.update);

			keys = current.keys;

			if (keys) {
				D.bind('keydown.fb', function (e) {
					var code   = e.which || e.keyCode,
						target = e.target || e.srcElement;

					// Ignore key combinations and key events within form elements
					if (!e.ctrlKey && !e.altKey && !e.shiftKey && !e.metaKey && !(target && (target.type || $(target).is('[contenteditable]')))) {
						$.each(keys, function(i, val) {
							if (current.group.length > 1 && val[ code ] !== undefined) {
								F[ i ]( val[ code ] );

								e.preventDefault();
								return false;
							}

							if ($.inArray(code, val) > -1) {
								F[ i ] ();

								e.preventDefault();
								return false;
							}
						});
					}
				});
			}

			if ($.fn.mousewheel && current.mouseWheel) {
				F.wrap.bind('mousewheel.fb', function (e, delta, deltaX, deltaY) {
					var target = e.target || null,
						parent = $(target),
						canScroll = false;

					while (parent.length) {
						if (canScroll || parent.is('.fancybox-skin') || parent.is('.fancybox-wrap')) {
							break;
						}

						canScroll = isScrollable( parent[0] );
						parent    = $(parent).parent();
					}

					if (delta !== 0 && !canScroll) {
						if (F.group.length > 1 && !current.canShrink) {
							if (deltaY > 0 || deltaX > 0) {
								F.prev( deltaY > 0 ? 'down' : 'left' );

							} else if (deltaY < 0 || deltaX < 0) {
								F.next( deltaY < 0 ? 'up' : 'right' );
							}

							e.preventDefault();
						}
					}
				});
			}
		},

		trigger: function (event, o) {
			var ret, obj = o || F.coming || F.current;

			if (!obj) {
				return;
			}

			if ($.isFunction( obj[event] )) {
				ret = obj[event].apply(obj, Array.prototype.slice.call(arguments, 1));
			}

			if (ret === false) {
				return false;
			}

			if (event === 'onCancel' && !F.isOpened) {
				F.isActive = false;
			}

			if (obj.helpers) {
				$.each(obj.helpers, function (helper, opts) {
					if (opts && F.helpers[helper] && $.isFunction(F.helpers[helper][event])) {
						F.helpers[helper][event](opts, obj);
					}
				});
			}

			$.event.trigger(event + '.fb');
		},

		isImage: function (str) {
			return isString(str) && str.match(/\.(jp(e|g|eg)|gif|png|bmp|webp)((\?|#).*)?$/i);
		},

		isSWF: function (str) {
			return isString(str) && str.match(/\.(swf)((\?|#).*)?$/i);
		},

		_start: function (index) {
			var coming = {},
				obj,
				href,
				type,
				margin,
				padding;

			index = getScalar( index );
			obj   = F.group[ index ] || null;

			if (!obj) {
				return false;
			}

			coming = $.extend(true, {}, F.opts, obj);

			// Convert margin and padding properties to array - top, right, bottom, left
			margin  = coming.margin;
			padding = coming.padding;

			if ($.type(margin) === 'number') {
				coming.margin = [margin, margin, margin, margin];
			}

			if ($.type(padding) === 'number') {
				coming.padding = [padding, padding, padding, padding];
			}

			// 'modal' propery is just a shortcut
			if (coming.modal) {
				$.extend(true, coming, {
					closeBtn   : false,
					closeClick : false,
					nextClick  : false,
					arrows     : false,
					mouseWheel : false,
					keys       : null,
					helpers: {
						overlay : {
							closeClick : false
						}
					}
				});
			}

			// 'autoSize' property is a shortcut, too
			if (coming.autoSize) {
				coming.autoWidth = coming.autoHeight = true;
			}

			if (coming.width === 'auto') {
				coming.autoWidth = true;
			}

			if (coming.height === 'auto') {
				coming.autoHeight = true;
			}

			/*
			 * Add reference to the group, so it`s possible to access from callbacks, example:
			 * afterLoad : function() {
			 *     this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
			 * }
			 */

			coming.group  = F.group;
			coming.index  = index;

			// Give a chance for callback or helpers to update coming item (type, title, etc)
			F.coming = coming;

			if (false === F.trigger('beforeLoad')) {
				F.coming = null;

				return;
			}

			type = coming.type;
			href = coming.href;

			if (!type) {
				F.coming = null;

				//If we can not determine content type then drop silently or display next/prev item if looping through gallery
				if (F.current && F.router && F.router !== 'jumpto') {
					F.current.index = index;

					return F[ F.router ]( F.direction );
				}

				return false;
			}

			F.isActive = true;

			if (type === 'image' || type === 'swf') {
				coming.autoHeight = coming.autoWidth = false;
				coming.scrolling  = 'visible';
			}

			if (type === 'image') {
				coming.aspectRatio = true;
			}

			if (type === 'iframe' && isTouch) {
				coming.scrolling = 'scroll';
			}

			// Build the neccessary markup
			coming.wrap = $(coming.tpl.wrap).addClass('fancybox-' + (isTouch ? 'mobile' : 'desktop') + ' fancybox-type-' + type + ' fancybox-tmp ' + coming.wrapCSS).appendTo( coming.parent );

			$.extend(coming, {
				skin  : $('.fancybox-skin',  coming.wrap),
				outer : $('.fancybox-outer', coming.wrap),
				inner : $('.fancybox-inner', coming.wrap)
			});

			$.each(["Top", "Right", "Bottom", "Left"], function(i, v) {
				coming.skin.css('padding' + v, getValue(coming.padding[ i ]));
			});

			F.trigger('onReady');

			// Check before try to load; 'inline' and 'html' types need content, others - href
			if (type === 'inline' || type === 'html') {
				if (!coming.content || !coming.content.length) {
					return F._error( 'content' );
				}

			} else if (!href) {
				return F._error( 'href' );
			}

			if (type === 'image') {
				F._loadImage();

			} else if (type === 'ajax') {
				F._loadAjax();

			} else if (type === 'iframe') {
				F._loadIframe();

			} else {
				F._afterLoad();
			}
		},

		_error: function ( type ) {
			$.extend(F.coming, {
				type       : 'html',
				autoWidth  : true,
				autoHeight : true,
				minWidth   : 0,
				minHeight  : 0,
				scrolling  : 'no',
				hasError   : type,
				content    : F.coming.tpl.error
			});

			F._afterLoad();
		},

		_loadImage: function () {
			// Reset preload image so it is later possible to check "complete" property
			var img = F.imgPreload = new Image();

			img.onload = function () {
				this.onload = this.onerror = null;

				F.coming.width  = this.width;
				F.coming.height = this.height;

				F._afterLoad();
			};

			img.onerror = function () {
				this.onload = this.onerror = null;

				F._error( 'image' );
			};

			img.src = F.coming.href;

			if (img.complete === undefined || !img.complete) {
				F.showLoading();
			}
		},

		_loadAjax: function () {
			var coming = F.coming;

			F.showLoading();

			F.ajaxLoad = $.ajax($.extend({}, coming.ajax, {
				url: coming.href,
				error: function (jqXHR, textStatus) {
					if (F.coming && textStatus !== 'abort') {
						F._error( 'ajax', jqXHR );

					} else {
						F.hideLoading();
					}
				},
				success: function (data, textStatus) {
					if (textStatus === 'success') {
						coming.content = data;

						F._afterLoad();
					}
				}
			}));
		},

		_loadIframe: function() {
			var coming = F.coming,
				iframe = $(coming.tpl.iframe.replace(/\{rnd\}/g, new Date().getTime()))
					.attr('scrolling', isTouch ? 'auto' : coming.iframe.scrolling)
					.attr('src', coming.href);

			// This helps IE
			$(coming.wrap).bind('onReset', function () {
				try {
					$(this).find('iframe').hide().attr('src', '//about:blank').end().empty();
				} catch (e) {}
			});

			if (coming.iframe.preload) {
				F.showLoading();

				iframe.one('load', function() {
					$(this).data('ready', 1);

					// iOS will lose scrolling if we resize
					if (!isTouch) {
						$(this).bind('load.fb', F.update);
					}

					// Without this trick:
					//   - iframe won't scroll on iOS devices
					//   - IE7 sometimes displays empty iframe
					$(this).parents('.fancybox-wrap').width('100%').removeClass('fancybox-tmp').show();

					F._afterLoad();
				});
			}

			coming.content = iframe.appendTo( coming.inner );

			if (!coming.iframe.preload) {
				F._afterLoad();
			}
		},

		_preloadImages: function() {
			var group   = F.group,
				current = F.current,
				len     = group.length,
				cnt     = current.preload ? Math.min(current.preload, len - 1) : 0,
				item,
				i;

			for (i = 1; i <= cnt; i += 1) {
				item = group[ (current.index + i ) % len ];

				if (item.type === 'image' && item.href) {
					new Image().src = item.href;
				}
			}
		},

		_afterLoad: function () {
			var coming   = F.coming,
				previous = F.current,
				placeholder = 'fancybox-placeholder',
				current,
				content,
				type,
				scrolling,
				href,
				embed;

			F.hideLoading();

			if (!coming || F.isActive === false) {
				return;
			}

			if (false === F.trigger('afterLoad', coming, previous)) {
				coming.wrap.stop(true).trigger('onReset').remove();

				F.coming = null;

				return;
			}

			if (previous) {
				F.trigger('beforeChange', previous);

				previous.wrap.stop(true).removeClass('fancybox-opened')
					.find('.fancybox-item, .fancybox-nav')
					.remove();

				if (previous.wrap.css('position') === 'fixed') {
					previous.wrap.css(F._getPosition( true ));
				}
			}

			F.unbindEvents();

			current   = coming;
			content   = coming.content;
			type      = coming.type;
			scrolling = coming.scrolling;

			$.extend(F, {
				wrap  : current.wrap,
				skin  : current.skin,
				outer : current.outer,
				inner : current.inner,
				current  : current,
				previous : previous
			});

			href = current.href;

			switch (type) {
				case 'inline':
				case 'ajax':
				case 'html':
					if (current.selector) {
						content = $('<div>').html(content).find(current.selector);

					} else if (isQuery(content)) {
						if (!content.data(placeholder)) {
							content.data(placeholder, $('<div class="' + placeholder + '"></div>').insertAfter( content ).hide() );
						}

						content = content.show().detach();

						current.wrap.bind('onReset', function () {
							if ($(this).find(content).length) {
								content.hide().replaceAll( content.data(placeholder) ).data(placeholder, false);
							}
						});
					}
				break;

				case 'image':
					content = current.tpl.image.replace('{href}', href);
				break;

				case 'swf':
					content = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="movie" value="' + href + '"></param>';
					embed   = '';

					$.each(current.swf, function(name, val) {
						content += '<param name="' + name + '" value="' + val + '"></param>';
						embed   += ' ' + name + '="' + val + '"';
					});

					content += '<embed src="' + href + '" type="application/x-shockwave-flash" width="100%" height="100%"' + embed + '></embed></object>';
				break;
			}

			if (!(isQuery(content) && content.parent().is(current.inner))) {
				current.inner.append( content );
			}

			// Give a chance for helpers or callbacks to update elements
			F.trigger('beforeShow');

			// Set scrolling before calculating dimensions
			current.inner.css('overflow', scrolling === 'yes' ? 'scroll' : (scrolling === 'no' ? 'hidden' : scrolling));

			// Set initial dimensions and start position
			F._setDimension();

			current.wrap.removeClass('fancybox-tmp');

			current.pos = $.extend({}, current.dim, F._getPosition( true ));

			F.isOpen = false;
			F.coming = null;

			F.bindEvents();

			if (!F.isOpened) {
				$('.fancybox-wrap').not( current.wrap ).stop(true).trigger('onReset').remove();

			} else if (previous.prevMethod) {
				F.transitions[ previous.prevMethod ]();
			}

			F.transitions[ F.isOpened ? current.nextMethod : current.openMethod ]();

			F._preloadImages();
		},

		_setDimension: function () {
			var viewport   = F.getViewport(),
				steps      = 0,
				canShrink  = false,
				canExpand  = false,
				wrap       = F.wrap,
				skin       = F.skin,
				inner      = F.inner,
				current    = F.current,
				width      = current.width,
				height     = current.height,
				minWidth   = current.minWidth,
				minHeight  = current.minHeight,
				maxWidth   = current.maxWidth,
				maxHeight  = current.maxHeight,
				scrolling  = current.scrolling,
				scrollOut  = current.scrollOutside ? current.scrollbarWidth : 0,
				margin     = current.margin,
				wMargin    = margin[1] + margin[3],
				hMargin    = margin[0] + margin[2],
				wPadding,
				hPadding,
				wSpace,
				hSpace,
				origWidth,
				origHeight,
				origMaxWidth,
				origMaxHeight,
				ratio,
				width_,
				height_,
				maxWidth_,
				maxHeight_,
				iframe,
				body;

			// Reset dimensions so we could re-check actual size
			wrap.add(skin).add(inner).width('auto').height('auto');

			wPadding = skin.outerWidth(true)  - skin.width();
			hPadding = skin.outerHeight(true) - skin.height();

			// Any space between content and viewport (margin, padding, border, title)
			wSpace = wMargin + wPadding;
			hSpace = hMargin + hPadding;

			origWidth  = isPercentage(width)  ? (viewport.w - wSpace) * getScalar(width)  / 100 : width;
			origHeight = isPercentage(height) ? (viewport.h - hSpace) * getScalar(height) / 100 : height;

			if (current.type === 'iframe') {
				iframe = current.content;

				if (current.autoHeight && iframe.data('ready') === 1) {
					try {
						if (iframe[0].contentWindow.document.location) {
							inner.width( origWidth ).height(9999);

							body = iframe.contents().find('body');

							if (scrollOut) {
								body.css('overflow-x', 'hidden');
							}

							origHeight = body.height();
						}

					} catch (e) {}
				}

			} else if (current.autoWidth || current.autoHeight) {
				inner.addClass( 'fancybox-tmp' );

				// Set width or height in case we need to calculate only one dimension
				if (!current.autoWidth) {
					inner.width( origWidth );
				}

				if (!current.autoHeight) {
					inner.height( origHeight );
				}

				if (current.autoWidth) {
					origWidth = inner.width();
				}

				if (current.autoHeight) {
					origHeight = inner.height();
				}

				inner.removeClass( 'fancybox-tmp' );
			}

			width  = getScalar( origWidth );
			height = getScalar( origHeight );

			ratio  = origWidth / origHeight;

			// Calculations for the content
			minWidth  = getScalar(isPercentage(minWidth) ? getScalar(minWidth, 'w') - wSpace : minWidth);
			maxWidth  = getScalar(isPercentage(maxWidth) ? getScalar(maxWidth, 'w') - wSpace : maxWidth);

			minHeight = getScalar(isPercentage(minHeight) ? getScalar(minHeight, 'h') - hSpace : minHeight);
			maxHeight = getScalar(isPercentage(maxHeight) ? getScalar(maxHeight, 'h') - hSpace : maxHeight);

			// These will be used to determine if wrap can fit in the viewport
			origMaxWidth  = maxWidth;
			origMaxHeight = maxHeight;

			maxWidth_  = viewport.w - wMargin;
			maxHeight_ = viewport.h - hMargin;

			if (current.aspectRatio) {
				if (width > maxWidth) {
					width  = maxWidth;
					height = width / ratio;
				}

				if (height > maxHeight) {
					height = maxHeight;
					width  = height * ratio;
				}

				if (width < minWidth) {
					width  = minWidth;
					height = width / ratio;
				}

				if (height < minHeight) {
					height = minHeight;
					width  = height * ratio;
				}

			} else {
				width  = Math.max(minWidth,  Math.min(width,  maxWidth));
				height = Math.max(minHeight, Math.min(height, maxHeight));
			}

			// Try to fit inside viewport (including the title)
			if (current.fitToView) {
				maxWidth  = Math.min(viewport.w - wSpace, maxWidth);
				maxHeight = Math.min(viewport.h - hSpace, maxHeight);

				inner.width( getScalar( width ) ).height( getScalar( height ) );

				wrap.width( getScalar( width + wPadding ) );

				// Real wrap dimensions
				width_  = wrap.width();
				height_ = wrap.height();

				if (current.aspectRatio) {
					while ((width_ > maxWidth_ || height_ > maxHeight_) && width > minWidth && height > minHeight) {
						if (steps++ > 19) {
							break;
						}

						height = Math.max(minHeight, Math.min(maxHeight, height - 10));
						width  = height * ratio;

						if (width < minWidth) {
							width  = minWidth;
							height = width / ratio;
						}

						if (width > maxWidth) {
							width  = maxWidth;
							height = width / ratio;
						}

						inner.width( getScalar( width ) ).height( getScalar( height ) );

						wrap.width( getScalar( width + wPadding ) );

						width_  = wrap.width();
						height_ = wrap.height();
					}

				} else {
					width  = Math.max(minWidth,  Math.min(width,  width  - (width_  - maxWidth_)));
					height = Math.max(minHeight, Math.min(height, height - (height_ - maxHeight_)));
				}
			}

			if (scrollOut && scrolling === 'auto' && height < origHeight && (width + wPadding + scrollOut) < maxWidth_) {
				width += scrollOut;
			}

			inner.width( getScalar( width ) ).height( getScalar( height ) );

			wrap.width( getScalar( width + wPadding ) );

			width_  = wrap.width();
			height_ = wrap.height();

			canShrink = (width_ > maxWidth_ || height_ > maxHeight_) && width > minWidth && height > minHeight;
			canExpand = current.aspectRatio ? (width < origMaxWidth && height < origMaxHeight && width < origWidth && height < origHeight) : ((width < origMaxWidth || height < origMaxHeight) && (width < origWidth || height < origHeight));

			$.extend(current, {
				dim : {
					width	: getValue( width_ ),
					height	: getValue( height_ )
				},
				origWidth  : origWidth,
				origHeight : origHeight,
				canShrink  : canShrink,
				canExpand  : canExpand,
				wPadding   : wPadding,
				hPadding   : hPadding,
				wrapSpace  : height_ - skin.outerHeight(true),
				skinSpace  : skin.height() - height
			});

			if (!iframe && current.autoHeight && height > minHeight && height < maxHeight && !canExpand) {
				inner.height('auto');
			}
		},

		_getPosition: function (onlyAbsolute) {
			var current  = F.current,
				viewport = F.getViewport(),
				margin   = current.margin,
				width    = F.wrap.width()  + margin[1] + margin[3],
				height   = F.wrap.height() + margin[0] + margin[2],
				rez      = {
					position: 'absolute',
					top  : margin[0],
					left : margin[3]
				};

			if (current.autoCenter && current.fixed && !onlyAbsolute && height <= viewport.h && width <= viewport.w) {
				rez.position = 'fixed';

			} else if (!current.locked) {
				rez.top  += viewport.y;
				rez.left += viewport.x;
			}

			rez.top  = getValue(Math.max(rez.top,  rez.top  + ((viewport.h - height) * current.topRatio)));
			rez.left = getValue(Math.max(rez.left, rez.left + ((viewport.w - width)  * current.leftRatio)));

			return rez;
		},

		_afterZoomIn: function () {
			var current = F.current;

			if (!current) {
				return;
			}

			F.isOpen = F.isOpened = true;

			F.wrap.addClass('fancybox-opened').css('overflow', 'visible');

			F.reposition();

			// Assign a click event
			if (current.closeClick || current.nextClick) {
				F.inner.css('cursor', 'pointer').bind('click.fb', function(e) {
					if (!$(e.target).is('a') && !$(e.target).parent().is('a')) {
						F[ current.closeClick ? 'close' : 'next' ]();
					}
				});
			}

			// Create a close button
			if (current.closeBtn) {
				$(current.tpl.closeBtn).appendTo(F.skin).bind('click.fb', F.close);
			}

			// Create navigation arrows
			if (current.arrows && F.group.length > 1) {
				if (current.loop || current.index > 0) {
					$(current.tpl.prev).appendTo(F.outer).bind('click.fb', F.prev);
				}

				if (current.loop || current.index < F.group.length - 1) {
					$(current.tpl.next).appendTo(F.outer).bind('click.fb', F.next);
				}
			}

			F.trigger('afterShow');

			// Stop the slideshow if this is the last item
			if (!current.loop && current.index === current.group.length - 1) {
				F.play( false );

			} else if (F.opts.autoPlay && !F.player.isActive) {
				F.opts.autoPlay = false;

				F.play();
			}
		},

		_afterZoomOut: function () {
			var current = F.current;

			$('.fancybox-wrap').stop(true).trigger('onReset').remove();

			$.extend(F, {
				group  : {},
				opts   : {},
				router : false,
				current   : null,
				isActive  : false,
				isOpened  : false,
				isOpen    : false,
				isClosing : false,
				wrap   : null,
				skin   : null,
				outer  : null,
				inner  : null
			});

			F.trigger('afterClose', current);
		}
	});

	/*
	 *	Default transitions
	 */

	F.transitions = {
		getOrigPosition: function () {
			var current  = F.current,
				element  = current.element,
				orig     = current.orig,
				pos      = {},
				width    = 50,
				height   = 50,
				hPadding = current.hPadding,
				wPadding = current.wPadding,
				viewport = F.getViewport();

			if (!orig && current.isDom && element.is(':visible')) {
				orig = element.find('img:first');

				if (!orig.length) {
					orig = element;
				}
			}

			if (isQuery(orig)) {
				pos = orig.offset();

				if (orig.is('img')) {
					width  = orig.outerWidth();
					height = orig.outerHeight();
				}

			} else {
				pos.top  = viewport.y + (viewport.h - height) * current.topRatio;
				pos.left = viewport.x + (viewport.w - width)  * current.leftRatio;
			}

			if (current.locked) {
				pos.top  -= viewport.y;
				pos.left -= viewport.x;
			}

			pos = {
				top     : getValue(pos.top  - hPadding * current.topRatio),
				left    : getValue(pos.left - wPadding * current.leftRatio),
				width   : getValue(width  + wPadding),
				height  : getValue(height + hPadding)
			};

			return pos;
		},

		step: function (now, fx) {
			var ratio,
				padding,
				value,
				prop       = fx.prop,
				current    = F.current,
				wrapSpace  = current.wrapSpace,
				skinSpace  = current.skinSpace;

			if (prop === 'width' || prop === 'height') {
				ratio = fx.end === fx.start ? 1 : (now - fx.start) / (fx.end - fx.start);

				if (F.isClosing) {
					ratio = 1 - ratio;
				}

				padding = prop === 'width' ? current.wPadding : current.hPadding;
				value   = now - padding;

				F.skin[ prop ](  getScalar( prop === 'width' ?  value : value - (wrapSpace * ratio) ) );
				F.inner[ prop ]( getScalar( prop === 'width' ?  value : value - (wrapSpace * ratio) - (skinSpace * ratio) ) );
			}
		},

		zoomIn: function () {
			var current  = F.current,
				startPos = current.pos,
				effect   = current.openEffect,
				elastic  = effect === 'elastic',
				endPos   = $.extend({opacity : 1}, startPos);

			// Remove "position" property that breaks older IE
			delete endPos.position;

			if (elastic) {
				startPos = this.getOrigPosition();

				if (current.openOpacity) {
					startPos.opacity = 0.1;
				}

			} else if (effect === 'fade') {
				startPos.opacity = 0.1;
			}

			F.wrap.css(startPos).animate(endPos, {
				duration : effect === 'none' ? 0 : current.openSpeed,
				easing   : current.openEasing,
				step     : elastic ? this.step : null,
				complete : F._afterZoomIn
			});
		},

		zoomOut: function () {
			var current  = F.current,
				effect   = current.closeEffect,
				elastic  = effect === 'elastic',
				endPos   = {opacity : 0.1};

			if (elastic) {
				endPos = this.getOrigPosition();

				if (current.closeOpacity) {
					endPos.opacity = 0.1;
				}
			}

			F.wrap.animate(endPos, {
				duration : effect === 'none' ? 0 : current.closeSpeed,
				easing   : current.closeEasing,
				step     : elastic ? this.step : null,
				complete : F._afterZoomOut
			});
		},

		changeIn: function () {
			var current   = F.current,
				effect    = current.nextEffect,
				startPos  = current.pos,
				endPos    = { opacity : 1 },
				direction = F.direction,
				distance  = 200,
				field;

			startPos.opacity = 0.1;

			if (effect === 'elastic') {
				field = direction === 'down' || direction === 'up' ? 'top' : 'left';

				if (direction === 'down' || direction === 'right') {
					startPos[ field ] = getValue(getScalar(startPos[ field ]) - distance);
					endPos[ field ]   = '+=' + distance + 'px';

				} else {
					startPos[ field ] = getValue(getScalar(startPos[ field ]) + distance);
					endPos[ field ]   = '-=' + distance + 'px';
				}
			}

			// Workaround for http://bugs.jquery.com/ticket/12273
			if (effect === 'none') {
				F._afterZoomIn();

			} else {
				F.wrap.css(startPos).animate(endPos, {
					duration : current.nextSpeed,
					easing   : current.nextEasing,
					complete : F._afterZoomIn
				});
			}
		},

		changeOut: function () {
			var previous  = F.previous,
				effect    = previous.prevEffect,
				endPos    = { opacity : 0.1 },
				direction = F.direction,
				distance  = 200;

			if (effect === 'elastic') {
				endPos[ direction === 'down' || direction === 'up' ? 'top' : 'left' ] = ( direction === 'up' || direction === 'left' ? '-' : '+' ) + '=' + distance + 'px';
			}

			previous.wrap.animate(endPos, {
				duration : effect === 'none' ? 0 : previous.prevSpeed,
				easing   : previous.prevEasing,
				complete : function () {
					$(this).trigger('onReset').remove();
				}
			});
		}
	};

	/*
	 *	Overlay helper
	 */

	F.helpers.overlay = {
		overlay: null,

		update: function () {
			var width = '100%', offsetWidth;

			// Reset width/height so it will not mess
			this.overlay.width(width).height('100%');

			// jQuery does not return reliable result for IE
			if ($.browser.msie) {
				offsetWidth = Math.max(document.documentElement.offsetWidth, document.body.offsetWidth);

				if (D.width() > offsetWidth) {
					width = D.width();
				}

			} else if (D.width() > W.width()) {
				width = D.width();
			}

			this.overlay.width(width).height(D.height());
		},

		// This is where we can manipulate DOM, because later it would cause iframes to reload
		onReady: function (opts, obj) {
			$('.fancybox-overlay').stop(true, true);

			if (!this.overlay) {
				$.extend(this, {
					overlay : $('<div class="fancybox-overlay"></div>').appendTo( obj.parent ),
					margin  : D.height() > W.height() || $('body').css('overflow-y') === 'scroll' ? $('body').css('margin-right') : false,
					el : document.all && !document.querySelector ? $('html') : $('body')
				});
			}

			if (obj.fixed && !isTouch) {
				this.overlay.addClass('fancybox-overlay-fixed');

				if (obj.autoCenter) {
					this.overlay.append( obj.wrap );

					obj.locked = this.overlay;
				}
			}

			if (opts.showEarly === true) {
				this.beforeShow.apply(this, arguments);
			}
		},

		beforeShow : function(opts, obj) {
			var overlay = this.overlay.unbind('.fb').width('auto').height('auto').css( opts.css );

			if (opts.closeClick) {
				overlay.bind('click.fb', function(e) {
					if ($(e.target).hasClass('fancybox-overlay')) {
						F.close();
					}
				});
			}

			if (obj.fixed && !isTouch) {
				if (obj.locked) {
					this.el.addClass('fancybox-lock');

					if (this.margin !== false) {
						$('body').css('margin-right', getScalar( this.margin ) + obj.scrollbarWidth);
					}
				}

			} else {
				this.update();
			}

			overlay.show();
		},

		onUpdate : function(opts, obj) {
			if (!obj.fixed || isTouch) {
				this.update();
			}
		},

		afterClose: function (opts) {
			var that  = this,
				speed = opts.speedOut || 0;

			// Remove overlay if exists and fancyBox is not opening
			// (e.g., it is not being open using afterClose callback)
			if (that.overlay && !F.isActive) {
				that.overlay.fadeOut(speed || 0, function () {
					$('body').css('margin-right', that.margin);

					that.el.removeClass('fancybox-lock');

					that.overlay.remove();

					that.overlay = null;
				});
			}
		}
	};

	/*
	 *	Title helper
	 */

	F.helpers.title = {
		beforeShow: function (opts) {
			var text = F.current.title,
				type = opts.type,
				title,
				target;

			if (!isString(text) || $.trim(text) === '') {
				return;
			}

			title = $('<div class="fancybox-title fancybox-title-' + type + '-wrap">' + text + '</div>');

			switch (type) {
				case 'inside':
					target = F.skin;
				break;

				case 'outside':
					target = F.wrap;
				break;

				case 'over':
					target = F.inner;
				break;

				default: // 'float'
					target = F.skin;

					title
						.appendTo('body')
						.width(title.width()) //This helps for some browsers
						.wrapInner('<span class="child"></span>');

						//Increase bottom margin so this title will also fit into viewport
						F.current.margin[2] += Math.abs( getScalar(title.css('margin-bottom')) );
				break;
			}

			if (opts.position === 'top') {
				title.prependTo(target);

			} else {
				title.appendTo(target);
			}
		}
	};

	// jQuery plugin initialization
	$.fn.fancybox = function (options) {
		var index,
			that     = $(this),
			selector = this.selector || '',
			run      = function(e) {
				var what = $(this).blur(), idx = index, relType, relVal;

				if (!(e.ctrlKey || e.altKey || e.shiftKey || e.metaKey) && !what.is('.fancybox-wrap')) {
					relType = options.groupAttr || 'data-fancybox-group';
					relVal  = what.attr(relType);

					if (!relVal) {
						relType = 'rel';
						relVal  = what.get(0)[ relType ];
					}

					if (relVal && relVal !== '' && relVal !== 'nofollow') {
						what = selector.length ? $(selector) : that;
						what = what.filter('[' + relType + '="' + relVal + '"]');
						idx  = what.index(this);
					}

					options.index = idx;

					// Stop an event from bubbling if everything is fine
					if (F.open(what, options) !== false) {
						e.preventDefault();
					}
				}
			};

		options = options || {};
		index   = options.index || 0;

		if (!selector || options.live === false) {
			that.unbind('click.fb-start').bind('click.fb-start', run);
		} else {
			D.undelegate(selector, 'click.fb-start').delegate(selector + ":not('.fancybox-item, .fancybox-nav')", 'click.fb-start', run);
		}

		return this;
	};

	// Tests that need a body at doc ready
	D.ready(function() {
		if ( $.scrollbarWidth === undefined ) {
			// http://benalman.com/projects/jquery-misc-plugins/#scrollbarwidth
			$.scrollbarWidth = function() {
				var parent = $('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo('body'),
					child  = parent.children(),
					width  = child.innerWidth() - child.height( 99 ).innerWidth();

				parent.remove();

				return width;
			};
		}

		if ( $.support.fixedPosition === undefined ) {
			$.support.fixedPosition = (function() {
				var elem  = $('<div style="position:fixed;top:20px;"></div>').appendTo('body'),
					fixed = ( elem[0].offsetTop === 20 || elem[0].offsetTop === 15 );

				elem.remove();

				return fixed;
			}());
		}

		$.extend(F.defaults, {
			scrollbarWidth : $.scrollbarWidth(),
			fixed  : $.support.fixedPosition,
			parent : $('body')
		});
	});

}(window, document, jQuery));