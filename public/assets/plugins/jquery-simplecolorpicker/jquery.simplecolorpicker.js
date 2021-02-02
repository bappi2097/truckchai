/*!
* Very simple jQuery Color Picker
* https://github.com/tkrotoff/jquery-simplecolorpicker
*
* Copyright (C) 2012-2013 Tanguy Krotoff <tkrotoff@gmail.com>
*
* Licensed under the MIT license
*/(function($){'use strict';var SimpleColorPicker=function(select,options){this.init('simplecolorpicker',select,options);};SimpleColorPicker.prototype={constructor:SimpleColorPicker,init:function(type,select,options){var self=this;self.type=type;self.$select=$(select);self.$select.hide();self.options=$.extend({},$.fn.simplecolorpicker.defaults,options);self.$colorList=null;if(self.options.picker===true){var selectText=self.$select.find('> option:selected').text();self.$icon=$('<span class="simplecolorpicker icon"'
+' title="'+selectText+'"'
+' style="background-color: '+self.$select.val()+';"'
+' role="button" tabindex="0">'
+'</span>').insertAfter(self.$select);self.$icon.on('click.'+self.type,$.proxy(self.showPicker,self));self.$picker=$('<span class="simplecolorpicker picker '+self.options.theme+'"></span>').appendTo(document.body);self.$colorList=self.$picker;$(document).on('mousedown.'+self.type,$.proxy(self.hidePicker,self));self.$picker.on('mousedown.'+self.type,$.proxy(self.mousedown,self));}else{self.$inline=$('<span class="simplecolorpicker inline '+self.options.theme+'"></span>').insertAfter(self.$select);self.$colorList=self.$inline;}
self.$select.find('> option').each(function(){var $option=$(this);var color=$option.val();var isSelected=$option.is(':selected');var isDisabled=$option.is(':disabled');var selected='';if(isSelected===true){selected=' data-selected';}
var disabled='';if(isDisabled===true){disabled=' data-disabled';}
var title='';if(isDisabled===false){title=' title="'+$option.text()+'"';}
var role='';if(isDisabled===false){role=' role="button" tabindex="0"';}
var $colorSpan=$('<span class="color"'
+title
+' style="background-color: '+color+';"'
+' data-color="'+color+'"'
+selected
+disabled
+role+'>'
+'</span>');self.$colorList.append($colorSpan);$colorSpan.on('click.'+self.type,$.proxy(self.colorSpanClicked,self));var $next=$option.next();if($next.is('optgroup')===true){self.$colorList.append('<span class="vr"></span>');}});},selectColor:function(color){var self=this;var $colorSpan=self.$colorList.find('> span.color').filter(function(){return $(this).data('color').toLowerCase()===color.toLowerCase();});if($colorSpan.length>0){self.selectColorSpan($colorSpan);}else{console.error("The given color '"+color+"' could not be found");}},showPicker:function(){var pos=this.$icon.offset();this.$picker.css({left:pos.left-6,top:pos.top+this.$icon.outerHeight()});this.$picker.show(this.options.pickerDelay);},hidePicker:function(){this.$picker.hide(this.options.pickerDelay);},selectColorSpan:function($colorSpan){var color=$colorSpan.data('color');var title=$colorSpan.prop('title');$colorSpan.siblings().removeAttr('data-selected');$colorSpan.attr('data-selected','');if(this.options.picker===true){this.$icon.css('background-color',color);this.$icon.prop('title',title);this.hidePicker();}
this.$select.val(color);},colorSpanClicked:function(e){if($(e.target).is('[data-disabled]')===false){this.selectColorSpan($(e.target));this.$select.trigger('change');}},mousedown:function(e){e.stopPropagation();e.preventDefault();},destroy:function(){if(this.options.picker===true){this.$icon.off('.'+this.type);this.$icon.remove();$(document).off('.'+this.type);}
this.$colorList.off('.'+this.type);this.$colorList.remove();this.$select.removeData(this.type);this.$select.show();}};$.fn.simplecolorpicker=function(option){var args=$.makeArray(arguments);args.shift();return this.each(function(){var $this=$(this),data=$this.data('simplecolorpicker'),options=typeof option==='object'&&option;if(data===undefined){$this.data('simplecolorpicker',(data=new SimpleColorPicker(this,options)));}
if(typeof option==='string'){data[option].apply(data,args);}});};$.fn.simplecolorpicker.defaults={theme:'',picker:false,pickerDelay:0};})(jQuery);