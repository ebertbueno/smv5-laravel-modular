$(document).ready(function(){
	$('.form-horizontal input:not(.btn), .form-inline input:not(.btn)').addClass('form-control');
	$('.form-horizontal select:not(.btn), .form-inline select:not(.btn)').addClass('form-control');
	$('.form-horizontal label, .form-inline label').addClass('col-md-4 control-label');
	//$('.form-horizontal .btn, .form-inline .btn').wrap( $('<div/>').addClass('col-md-offset-4 col-md-4') );
});
if( typeof $app == "undefined" || $app == null )
{
    $app = angular.module('app',[]);
}
/**
 * jquery.mask.js
 * @version: v1.6.4
 * @author: Igor Escobar
 *
 * Created by Igor Escobar on 2012-03-10. Please report any bug at http://blog.igorescobar.com
 *
 * Copyright (c) 2012 Igor Escobar http://blog.igorescobar.com
 *
 * The MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 */
/*jshint laxbreak: true */
/* global define */

// UMD (Universal Module Definition) patterns for JavaScript modules that work everywhere.
// https://github.com/umdjs/umd/blob/master/jqueryPlugin.js
(function (factory) {
    if (typeof define === "function" && define.amd) {
        // AMD. Register as an anonymous module.
        define(["jquery"], factory);
    } else {
        // Browser globals
        factory(window.jQuery || window.Zepto);
    }
}(function ($) {
    "use strict";
	//
	// JQUERY MASK
	//
	
    var Mask = function (el, mask, options) {
        var jMask = this, old_value, regexMask;
        el = $(el);

        mask = typeof mask === "function" ? mask(el.val(), undefined, el,  options) : mask;

        jMask.init = function() {
            options = options || {};

            jMask.byPassKeys = [9, 16, 17, 18, 36, 37, 38, 39, 40, 91];
            jMask.translation = {
                '0': {pattern: /\d/},
                '9': {pattern: /\d/, optional: true},
                '#': {pattern: /\d/, recursive: true},
                'A': {pattern: /[a-zA-Z0-9]/},
                'S': {pattern: /[a-zA-Z]/}
            };

            jMask.translation = $.extend({}, jMask.translation, options.translation);
            jMask = $.extend(true, {}, jMask, options);

            regexMask = p.getRegexMask();

            el.each(function() {
                if (options.maxlength !== false) {
                    el.attr('maxlength', mask.length);
                }

                if (options.placeholder) {
                    el.attr('placeholder' , options.placeholder);
                }
                
                el.attr('autocomplete', 'off');
                p.destroyEvents();
                p.events();
                
                var caret = p.getCaret();

                p.val(p.getMasked());
                p.setCaret(caret + p.getMaskCharactersBeforeCount(caret, true));
            });


        };

        var p = {
            getCaret: function () {
                var sel,
                    pos = 0,
                    ctrl = el.get(0),
                    dSel = document.selection,
                    cSelStart = ctrl.selectionStart;

                // IE Support
                if (dSel && !~navigator.appVersion.indexOf("MSIE 10")) {
                    sel = dSel.createRange();
                    sel.moveStart('character', el.is("input") ? -el.val().length : -el.text().length);
                    pos = sel.text.length;
                }
                // Firefox support
                else if (cSelStart || cSelStart === '0') {
                    pos = cSelStart;
                }
                
                return pos;
            },
            setCaret: function(pos) {
                if (el.is(":focus")) {
                    var range, ctrl = el.get(0);

                    if (ctrl.setSelectionRange) {
                        ctrl.setSelectionRange(pos,pos);
                    } else if (ctrl.createTextRange) {
                        range = ctrl.createTextRange();
                        range.collapse(true);
                        range.moveEnd('character', pos);
                        range.moveStart('character', pos);
                        range.select();
                    }
                }
            },
            events: function() {
                el.on('keydown.mask', function() {
                    old_value = p.val();
                });
                el.on('keyup.mask', p.behaviour);
                el.on("paste.mask drop.mask", function() {
                    setTimeout(function() {
                        el.keydown().keyup();
                    }, 100);
                });
                el.on("change.mask", function() {
                    el.data("changeCalled", true);
                });
                el.on("blur.mask", function(e){
                    var el = $(e.target);
                    if (el.prop("defaultValue") !== el.val()) {
                        el.prop("defaultValue", el.val());
                        if (!el.data("changeCalled")) {
                            el.trigger("change");
                        }
                    }
                    el.data("changeCalled", false);
                });

                // clear the value if it not complete the mask
                el.on("focusout.mask", function() {
                    if (options.clearIfNotMatch && !regexMask.test(p.val())) {
                       p.val('');
                   }
                });
            },
            getRegexMask: function() {
                var maskChunks = [], translation, pattern, optional, recursive, oRecursive, r;

                for (var i in mask) {
                    translation = jMask.translation[mask[i]];

                    if (translation) {
                        
                        pattern = translation.pattern.toString().replace(/.{1}$|^.{1}/g, "");
                        optional = translation.optional;
                        recursive = translation.recursive;
                        
                        if (recursive) {
                            maskChunks.push(mask[i]);
                            oRecursive = {digit: mask[i], pattern: pattern};
                        } else {
                            maskChunks.push((!optional && !recursive) ? pattern : (pattern + "?"));
                        }

                    } else {
                        maskChunks.push("\\" + mask[i]);
                    }
                }
                
                r = maskChunks.join("");
                
                if (oRecursive) {
                    r = r.replace(new RegExp("(" + oRecursive.digit + "(.*" + oRecursive.digit + ")?)"), "(\$1)?")
                         .replace(new RegExp(oRecursive.digit, "g"), oRecursive.pattern);
                }

                return new RegExp(r);
            },
            destroyEvents: function() {
                el.off('keydown.mask keyup.mask paste.mask drop.mask change.mask blur.mask focusout.mask').removeData("changeCalled");
            },
            val: function(v) {
                var isInput = el.is('input');
                return arguments.length > 0 
                    ? (isInput ? el.val(v) : el.text(v)) 
                    : (isInput ? el.val() : el.text());
            },
            getMaskCharactersBeforeCount: function(index, onCleanVal) {
                for (var count = 0, i = 0, maskL = mask.length; i < maskL && i < index; i++) {
                    if (!jMask.translation[mask.charAt(i)]) {
                        index = onCleanVal ? index + 1 : index;
                        count++;
                    }
                }
                return count;
            },
            determineCaretPos: function (originalCaretPos, oldLength, newLength, maskDif) {
                var translation = jMask.translation[mask.charAt(Math.min(originalCaretPos - 1, mask.length - 1))];

                return !translation ? p.determineCaretPos(originalCaretPos + 1, oldLength, newLength, maskDif)
                                    : Math.min(originalCaretPos + newLength - oldLength - maskDif, newLength);
            },
            behaviour: function(e) {
                e = e || window.event;
                var keyCode = e.keyCode || e.which;

                if ($.inArray(keyCode, jMask.byPassKeys) === -1) {

                    var caretPos = p.getCaret(),
                        currVal = p.val(),
                        currValL = currVal.length,
                        changeCaret = caretPos < currValL,
                        newVal = p.getMasked(),
                        newValL = newVal.length,
                        maskDif = p.getMaskCharactersBeforeCount(newValL - 1) - p.getMaskCharactersBeforeCount(currValL - 1);
                   
                    if (newVal !== currVal) {
                        p.val(newVal);
                    }

                    // change caret but avoid CTRL+A
                    if (changeCaret && !(keyCode === 65 && e.ctrlKey)) {
                        // Avoid adjusting caret on backspace or delete
                        if (!(keyCode === 8 || keyCode === 46)) {
                            caretPos = p.determineCaretPos(caretPos, currValL, newValL, maskDif);
                        }
                        p.setCaret(caretPos);
                    }

                    return p.callbacks(e);
                }
            },
            getMasked: function (skipMaskChars) {
                var buf = [],
                    value = p.val(),
                    m = 0, maskLen = mask.length,
                    v = 0, valLen = value.length,
                    offset = 1, addMethod = "push",
                    resetPos = -1,
                    lastMaskChar,
                    check;

                if (options.reverse) {
                    addMethod = "unshift";
                    offset = -1;
                    lastMaskChar = 0;
                    m = maskLen - 1;
                    v = valLen - 1;
                    check = function () {
                        return m > -1 && v > -1;
                    };
                } else {
                    lastMaskChar = maskLen - 1;
                    check = function () {
                        return m < maskLen && v < valLen;
                    };
                }

                while (check()) {
                    var maskDigit = mask.charAt(m),
                        valDigit = value.charAt(v),
                        translation = jMask.translation[maskDigit];

                    if (translation) {
                        if (valDigit.match(translation.pattern)) {
                            buf[addMethod](valDigit);
                             if (translation.recursive) {
                                if (resetPos === -1) {
                                    resetPos = m;
                                } else if (m === lastMaskChar) {
                                    m = resetPos - offset;
                                }

                                if (lastMaskChar === resetPos) {
                                    m -= offset;
                                }
                            }
                            m += offset;
                        } else if (translation.optional) {
                            m += offset;
                            v -= offset;
                        }
                        v += offset;
                    } else {
                        if (!skipMaskChars) {
                            buf[addMethod](maskDigit);
                        }
                        
                        if (valDigit === maskDigit) {
                            v += offset;
                        }

                        m += offset;
                    }
                }
                
                var lastMaskCharDigit = mask.charAt(lastMaskChar);
                if (maskLen === valLen + 1 && !jMask.translation[lastMaskCharDigit]) {
                    buf.push(lastMaskCharDigit);
                }
                
                return buf.join("");
            },
            callbacks: function (e) {
                var val = p.val(),
                    changed = p.val() !== old_value;
                if (changed === true) {
                    if (typeof options.onChange === "function") {
                        options.onChange(val, e, el, options);
                    }
                }

                if (changed === true && typeof options.onKeyPress === "function") {
                    options.onKeyPress(val, e, el, options);
                }

                if (typeof options.onComplete === "function" && val.length === mask.length) {
                    options.onComplete(val, e, el, options);
                }
            }
        };

        // public methods
        jMask.remove = function() {
            var caret = p.getCaret(),
                maskedCharacterCountBefore = p.getMaskCharactersBeforeCount(caret);

            p.destroyEvents();
            p.val(jMask.getCleanVal()).removeAttr('maxlength');
            p.setCaret(caret - maskedCharacterCountBefore);
        };

        // get value without mask
        jMask.getCleanVal = function() {
           return p.getMasked(true);
        };

        jMask.init();
    };

    $.fn.mask = function(mask, options) {
        this.unmask();
        return this.each(function() {
            $(this).data('mask', new Mask(this, mask, options));
        });
    };

    $.fn.unmask = function() {
        return this.each(function() {
            try {
                $(this).data('mask').remove();
            } catch (e) {}
        });
    };

    $.fn.cleanVal = function() {
        return $(this).data('mask').getCleanVal();
    };

    // looking for inputs with data-mask attribute
    $('*[data-mask]').each(function() {
        var input = $(this),
            options = {},
            prefix = "data-mask-";

        if (input.attr(prefix + 'reverse') === 'true') {
            options.reverse = true;
        }

        if (input.attr(prefix + 'maxlength') === 'false') {
            options.maxlength = false;
        }

        if (input.attr(prefix + 'clearifnotmatch') === 'true') {
            options.clearIfNotMatch = true;
        }

        input.mask(input.attr('data-mask'), options);
    });

}));
//
// MOMENT.JS
//
//! moment.js
//! version : 2.7.0
//! authors : Tim Wood, Iskren Chernev, Moment.js contributors
//! license : MIT
//! momentjs.com
(function(a){function b(a,b,c){switch(arguments.length){case 2:return null!=a?a:b;case 3:return null!=a?a:null!=b?b:c;default:throw new Error("Implement me")}}function c(){return{empty:!1,unusedTokens:[],unusedInput:[],overflow:-2,charsLeftOver:0,nullInput:!1,invalidMonth:null,invalidFormat:!1,userInvalidated:!1,iso:!1}}function d(a,b){function c(){mb.suppressDeprecationWarnings===!1&&"undefined"!=typeof console&&console.warn&&console.warn("Deprecation warning: "+a)}var d=!0;return j(function(){return d&&(c(),d=!1),b.apply(this,arguments)},b)}function e(a,b){return function(c){return m(a.call(this,c),b)}}function f(a,b){return function(c){return this.lang().ordinal(a.call(this,c),b)}}function g(){}function h(a){z(a),j(this,a)}function i(a){var b=s(a),c=b.year||0,d=b.quarter||0,e=b.month||0,f=b.week||0,g=b.day||0,h=b.hour||0,i=b.minute||0,j=b.second||0,k=b.millisecond||0;this._milliseconds=+k+1e3*j+6e4*i+36e5*h,this._days=+g+7*f,this._months=+e+3*d+12*c,this._data={},this._bubble()}function j(a,b){for(var c in b)b.hasOwnProperty(c)&&(a[c]=b[c]);return b.hasOwnProperty("toString")&&(a.toString=b.toString),b.hasOwnProperty("valueOf")&&(a.valueOf=b.valueOf),a}function k(a){var b,c={};for(b in a)a.hasOwnProperty(b)&&Ab.hasOwnProperty(b)&&(c[b]=a[b]);return c}function l(a){return 0>a?Math.ceil(a):Math.floor(a)}function m(a,b,c){for(var d=""+Math.abs(a),e=a>=0;d.length<b;)d="0"+d;return(e?c?"+":"":"-")+d}function n(a,b,c,d){var e=b._milliseconds,f=b._days,g=b._months;d=null==d?!0:d,e&&a._d.setTime(+a._d+e*c),f&&hb(a,"Date",gb(a,"Date")+f*c),g&&fb(a,gb(a,"Month")+g*c),d&&mb.updateOffset(a,f||g)}function o(a){return"[object Array]"===Object.prototype.toString.call(a)}function p(a){return"[object Date]"===Object.prototype.toString.call(a)||a instanceof Date}function q(a,b,c){var d,e=Math.min(a.length,b.length),f=Math.abs(a.length-b.length),g=0;for(d=0;e>d;d++)(c&&a[d]!==b[d]||!c&&u(a[d])!==u(b[d]))&&g++;return g+f}function r(a){if(a){var b=a.toLowerCase().replace(/(.)s$/,"$1");a=bc[a]||cc[b]||b}return a}function s(a){var b,c,d={};for(c in a)a.hasOwnProperty(c)&&(b=r(c),b&&(d[b]=a[c]));return d}function t(b){var c,d;if(0===b.indexOf("week"))c=7,d="day";else{if(0!==b.indexOf("month"))return;c=12,d="month"}mb[b]=function(e,f){var g,h,i=mb.fn._lang[b],j=[];if("number"==typeof e&&(f=e,e=a),h=function(a){var b=mb().utc().set(d,a);return i.call(mb.fn._lang,b,e||"")},null!=f)return h(f);for(g=0;c>g;g++)j.push(h(g));return j}}function u(a){var b=+a,c=0;return 0!==b&&isFinite(b)&&(c=b>=0?Math.floor(b):Math.ceil(b)),c}function v(a,b){return new Date(Date.UTC(a,b+1,0)).getUTCDate()}function w(a,b,c){return bb(mb([a,11,31+b-c]),b,c).week}function x(a){return y(a)?366:365}function y(a){return a%4===0&&a%100!==0||a%400===0}function z(a){var b;a._a&&-2===a._pf.overflow&&(b=a._a[tb]<0||a._a[tb]>11?tb:a._a[ub]<1||a._a[ub]>v(a._a[sb],a._a[tb])?ub:a._a[vb]<0||a._a[vb]>23?vb:a._a[wb]<0||a._a[wb]>59?wb:a._a[xb]<0||a._a[xb]>59?xb:a._a[yb]<0||a._a[yb]>999?yb:-1,a._pf._overflowDayOfYear&&(sb>b||b>ub)&&(b=ub),a._pf.overflow=b)}function A(a){return null==a._isValid&&(a._isValid=!isNaN(a._d.getTime())&&a._pf.overflow<0&&!a._pf.empty&&!a._pf.invalidMonth&&!a._pf.nullInput&&!a._pf.invalidFormat&&!a._pf.userInvalidated,a._strict&&(a._isValid=a._isValid&&0===a._pf.charsLeftOver&&0===a._pf.unusedTokens.length)),a._isValid}function B(a){return a?a.toLowerCase().replace("_","-"):a}function C(a,b){return b._isUTC?mb(a).zone(b._offset||0):mb(a).local()}function D(a,b){return b.abbr=a,zb[a]||(zb[a]=new g),zb[a].set(b),zb[a]}function E(a){delete zb[a]}function F(a){var b,c,d,e,f=0,g=function(a){if(!zb[a]&&Bb)try{require("./lang/"+a)}catch(b){}return zb[a]};if(!a)return mb.fn._lang;if(!o(a)){if(c=g(a))return c;a=[a]}for(;f<a.length;){for(e=B(a[f]).split("-"),b=e.length,d=B(a[f+1]),d=d?d.split("-"):null;b>0;){if(c=g(e.slice(0,b).join("-")))return c;if(d&&d.length>=b&&q(e,d,!0)>=b-1)break;b--}f++}return mb.fn._lang}function G(a){return a.match(/\[[\s\S]/)?a.replace(/^\[|\]$/g,""):a.replace(/\\/g,"")}function H(a){var b,c,d=a.match(Fb);for(b=0,c=d.length;c>b;b++)d[b]=hc[d[b]]?hc[d[b]]:G(d[b]);return function(e){var f="";for(b=0;c>b;b++)f+=d[b]instanceof Function?d[b].call(e,a):d[b];return f}}function I(a,b){return a.isValid()?(b=J(b,a.lang()),dc[b]||(dc[b]=H(b)),dc[b](a)):a.lang().invalidDate()}function J(a,b){function c(a){return b.longDateFormat(a)||a}var d=5;for(Gb.lastIndex=0;d>=0&&Gb.test(a);)a=a.replace(Gb,c),Gb.lastIndex=0,d-=1;return a}function K(a,b){var c,d=b._strict;switch(a){case"Q":return Rb;case"DDDD":return Tb;case"YYYY":case"GGGG":case"gggg":return d?Ub:Jb;case"Y":case"G":case"g":return Wb;case"YYYYYY":case"YYYYY":case"GGGGG":case"ggggg":return d?Vb:Kb;case"S":if(d)return Rb;case"SS":if(d)return Sb;case"SSS":if(d)return Tb;case"DDD":return Ib;case"MMM":case"MMMM":case"dd":case"ddd":case"dddd":return Mb;case"a":case"A":return F(b._l)._meridiemParse;case"X":return Pb;case"Z":case"ZZ":return Nb;case"T":return Ob;case"SSSS":return Lb;case"MM":case"DD":case"YY":case"GG":case"gg":case"HH":case"hh":case"mm":case"ss":case"ww":case"WW":return d?Sb:Hb;case"M":case"D":case"d":case"H":case"h":case"m":case"s":case"w":case"W":case"e":case"E":return Hb;case"Do":return Qb;default:return c=new RegExp(T(S(a.replace("\\","")),"i"))}}function L(a){a=a||"";var b=a.match(Nb)||[],c=b[b.length-1]||[],d=(c+"").match(_b)||["-",0,0],e=+(60*d[1])+u(d[2]);return"+"===d[0]?-e:e}function M(a,b,c){var d,e=c._a;switch(a){case"Q":null!=b&&(e[tb]=3*(u(b)-1));break;case"M":case"MM":null!=b&&(e[tb]=u(b)-1);break;case"MMM":case"MMMM":d=F(c._l).monthsParse(b),null!=d?e[tb]=d:c._pf.invalidMonth=b;break;case"D":case"DD":null!=b&&(e[ub]=u(b));break;case"Do":null!=b&&(e[ub]=u(parseInt(b,10)));break;case"DDD":case"DDDD":null!=b&&(c._dayOfYear=u(b));break;case"YY":e[sb]=mb.parseTwoDigitYear(b);break;case"YYYY":case"YYYYY":case"YYYYYY":e[sb]=u(b);break;case"a":case"A":c._isPm=F(c._l).isPM(b);break;case"H":case"HH":case"h":case"hh":e[vb]=u(b);break;case"m":case"mm":e[wb]=u(b);break;case"s":case"ss":e[xb]=u(b);break;case"S":case"SS":case"SSS":case"SSSS":e[yb]=u(1e3*("0."+b));break;case"X":c._d=new Date(1e3*parseFloat(b));break;case"Z":case"ZZ":c._useUTC=!0,c._tzm=L(b);break;case"dd":case"ddd":case"dddd":d=F(c._l).weekdaysParse(b),null!=d?(c._w=c._w||{},c._w.d=d):c._pf.invalidWeekday=b;break;case"w":case"ww":case"W":case"WW":case"d":case"e":case"E":a=a.substr(0,1);case"gggg":case"GGGG":case"GGGGG":a=a.substr(0,2),b&&(c._w=c._w||{},c._w[a]=u(b));break;case"gg":case"GG":c._w=c._w||{},c._w[a]=mb.parseTwoDigitYear(b)}}function N(a){var c,d,e,f,g,h,i,j;c=a._w,null!=c.GG||null!=c.W||null!=c.E?(g=1,h=4,d=b(c.GG,a._a[sb],bb(mb(),1,4).year),e=b(c.W,1),f=b(c.E,1)):(j=F(a._l),g=j._week.dow,h=j._week.doy,d=b(c.gg,a._a[sb],bb(mb(),g,h).year),e=b(c.w,1),null!=c.d?(f=c.d,g>f&&++e):f=null!=c.e?c.e+g:g),i=cb(d,e,f,h,g),a._a[sb]=i.year,a._dayOfYear=i.dayOfYear}function O(a){var c,d,e,f,g=[];if(!a._d){for(e=Q(a),a._w&&null==a._a[ub]&&null==a._a[tb]&&N(a),a._dayOfYear&&(f=b(a._a[sb],e[sb]),a._dayOfYear>x(f)&&(a._pf._overflowDayOfYear=!0),d=Z(f,0,a._dayOfYear),a._a[tb]=d.getUTCMonth(),a._a[ub]=d.getUTCDate()),c=0;3>c&&null==a._a[c];++c)a._a[c]=g[c]=e[c];for(;7>c;c++)a._a[c]=g[c]=null==a._a[c]?2===c?1:0:a._a[c];a._d=(a._useUTC?Z:Y).apply(null,g),null!=a._tzm&&a._d.setUTCMinutes(a._d.getUTCMinutes()+a._tzm)}}function P(a){var b;a._d||(b=s(a._i),a._a=[b.year,b.month,b.day,b.hour,b.minute,b.second,b.millisecond],O(a))}function Q(a){var b=new Date;return a._useUTC?[b.getUTCFullYear(),b.getUTCMonth(),b.getUTCDate()]:[b.getFullYear(),b.getMonth(),b.getDate()]}function R(a){if(a._f===mb.ISO_8601)return void V(a);a._a=[],a._pf.empty=!0;var b,c,d,e,f,g=F(a._l),h=""+a._i,i=h.length,j=0;for(d=J(a._f,g).match(Fb)||[],b=0;b<d.length;b++)e=d[b],c=(h.match(K(e,a))||[])[0],c&&(f=h.substr(0,h.indexOf(c)),f.length>0&&a._pf.unusedInput.push(f),h=h.slice(h.indexOf(c)+c.length),j+=c.length),hc[e]?(c?a._pf.empty=!1:a._pf.unusedTokens.push(e),M(e,c,a)):a._strict&&!c&&a._pf.unusedTokens.push(e);a._pf.charsLeftOver=i-j,h.length>0&&a._pf.unusedInput.push(h),a._isPm&&a._a[vb]<12&&(a._a[vb]+=12),a._isPm===!1&&12===a._a[vb]&&(a._a[vb]=0),O(a),z(a)}function S(a){return a.replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g,function(a,b,c,d,e){return b||c||d||e})}function T(a){return a.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&")}function U(a){var b,d,e,f,g;if(0===a._f.length)return a._pf.invalidFormat=!0,void(a._d=new Date(0/0));for(f=0;f<a._f.length;f++)g=0,b=j({},a),b._pf=c(),b._f=a._f[f],R(b),A(b)&&(g+=b._pf.charsLeftOver,g+=10*b._pf.unusedTokens.length,b._pf.score=g,(null==e||e>g)&&(e=g,d=b));j(a,d||b)}function V(a){var b,c,d=a._i,e=Xb.exec(d);if(e){for(a._pf.iso=!0,b=0,c=Zb.length;c>b;b++)if(Zb[b][1].exec(d)){a._f=Zb[b][0]+(e[6]||" ");break}for(b=0,c=$b.length;c>b;b++)if($b[b][1].exec(d)){a._f+=$b[b][0];break}d.match(Nb)&&(a._f+="Z"),R(a)}else a._isValid=!1}function W(a){V(a),a._isValid===!1&&(delete a._isValid,mb.createFromInputFallback(a))}function X(b){var c=b._i,d=Cb.exec(c);c===a?b._d=new Date:d?b._d=new Date(+d[1]):"string"==typeof c?W(b):o(c)?(b._a=c.slice(0),O(b)):p(c)?b._d=new Date(+c):"object"==typeof c?P(b):"number"==typeof c?b._d=new Date(c):mb.createFromInputFallback(b)}function Y(a,b,c,d,e,f,g){var h=new Date(a,b,c,d,e,f,g);return 1970>a&&h.setFullYear(a),h}function Z(a){var b=new Date(Date.UTC.apply(null,arguments));return 1970>a&&b.setUTCFullYear(a),b}function $(a,b){if("string"==typeof a)if(isNaN(a)){if(a=b.weekdaysParse(a),"number"!=typeof a)return null}else a=parseInt(a,10);return a}function _(a,b,c,d,e){return e.relativeTime(b||1,!!c,a,d)}function ab(a,b,c){var d=rb(Math.abs(a)/1e3),e=rb(d/60),f=rb(e/60),g=rb(f/24),h=rb(g/365),i=d<ec.s&&["s",d]||1===e&&["m"]||e<ec.m&&["mm",e]||1===f&&["h"]||f<ec.h&&["hh",f]||1===g&&["d"]||g<=ec.dd&&["dd",g]||g<=ec.dm&&["M"]||g<ec.dy&&["MM",rb(g/30)]||1===h&&["y"]||["yy",h];return i[2]=b,i[3]=a>0,i[4]=c,_.apply({},i)}function bb(a,b,c){var d,e=c-b,f=c-a.day();return f>e&&(f-=7),e-7>f&&(f+=7),d=mb(a).add("d",f),{week:Math.ceil(d.dayOfYear()/7),year:d.year()}}function cb(a,b,c,d,e){var f,g,h=Z(a,0,1).getUTCDay();return h=0===h?7:h,c=null!=c?c:e,f=e-h+(h>d?7:0)-(e>h?7:0),g=7*(b-1)+(c-e)+f+1,{year:g>0?a:a-1,dayOfYear:g>0?g:x(a-1)+g}}function db(b){var c=b._i,d=b._f;return null===c||d===a&&""===c?mb.invalid({nullInput:!0}):("string"==typeof c&&(b._i=c=F().preparse(c)),mb.isMoment(c)?(b=k(c),b._d=new Date(+c._d)):d?o(d)?U(b):R(b):X(b),new h(b))}function eb(a,b){var c,d;if(1===b.length&&o(b[0])&&(b=b[0]),!b.length)return mb();for(c=b[0],d=1;d<b.length;++d)b[d][a](c)&&(c=b[d]);return c}function fb(a,b){var c;return"string"==typeof b&&(b=a.lang().monthsParse(b),"number"!=typeof b)?a:(c=Math.min(a.date(),v(a.year(),b)),a._d["set"+(a._isUTC?"UTC":"")+"Month"](b,c),a)}function gb(a,b){return a._d["get"+(a._isUTC?"UTC":"")+b]()}function hb(a,b,c){return"Month"===b?fb(a,c):a._d["set"+(a._isUTC?"UTC":"")+b](c)}function ib(a,b){return function(c){return null!=c?(hb(this,a,c),mb.updateOffset(this,b),this):gb(this,a)}}function jb(a){mb.duration.fn[a]=function(){return this._data[a]}}function kb(a,b){mb.duration.fn["as"+a]=function(){return+this/b}}function lb(a){"undefined"==typeof ender&&(nb=qb.moment,qb.moment=a?d("Accessing Moment through the global scope is deprecated, and will be removed in an upcoming release.",mb):mb)}for(var mb,nb,ob,pb="2.7.0",qb="undefined"!=typeof global?global:this,rb=Math.round,sb=0,tb=1,ub=2,vb=3,wb=4,xb=5,yb=6,zb={},Ab={_isAMomentObject:null,_i:null,_f:null,_l:null,_strict:null,_tzm:null,_isUTC:null,_offset:null,_pf:null,_lang:null},Bb="undefined"!=typeof module&&module.exports,Cb=/^\/?Date\((\-?\d+)/i,Db=/(\-)?(?:(\d*)\.)?(\d+)\:(\d+)(?:\:(\d+)\.?(\d{3})?)?/,Eb=/^(-)?P(?:(?:([0-9,.]*)Y)?(?:([0-9,.]*)M)?(?:([0-9,.]*)D)?(?:T(?:([0-9,.]*)H)?(?:([0-9,.]*)M)?(?:([0-9,.]*)S)?)?|([0-9,.]*)W)$/,Fb=/(\[[^\[]*\])|(\\)?(Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Q|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|mm?|ss?|S{1,4}|X|zz?|ZZ?|.)/g,Gb=/(\[[^\[]*\])|(\\)?(LT|LL?L?L?|l{1,4})/g,Hb=/\d\d?/,Ib=/\d{1,3}/,Jb=/\d{1,4}/,Kb=/[+\-]?\d{1,6}/,Lb=/\d+/,Mb=/[0-9]*['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+|[\u0600-\u06FF\/]+(\s*?[\u0600-\u06FF]+){1,2}/i,Nb=/Z|[\+\-]\d\d:?\d\d/gi,Ob=/T/i,Pb=/[\+\-]?\d+(\.\d{1,3})?/,Qb=/\d{1,2}/,Rb=/\d/,Sb=/\d\d/,Tb=/\d{3}/,Ub=/\d{4}/,Vb=/[+-]?\d{6}/,Wb=/[+-]?\d+/,Xb=/^\s*(?:[+-]\d{6}|\d{4})-(?:(\d\d-\d\d)|(W\d\d$)|(W\d\d-\d)|(\d\d\d))((T| )(\d\d(:\d\d(:\d\d(\.\d+)?)?)?)?([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,Yb="YYYY-MM-DDTHH:mm:ssZ",Zb=[["YYYYYY-MM-DD",/[+-]\d{6}-\d{2}-\d{2}/],["YYYY-MM-DD",/\d{4}-\d{2}-\d{2}/],["GGGG-[W]WW-E",/\d{4}-W\d{2}-\d/],["GGGG-[W]WW",/\d{4}-W\d{2}/],["YYYY-DDD",/\d{4}-\d{3}/]],$b=[["HH:mm:ss.SSSS",/(T| )\d\d:\d\d:\d\d\.\d+/],["HH:mm:ss",/(T| )\d\d:\d\d:\d\d/],["HH:mm",/(T| )\d\d:\d\d/],["HH",/(T| )\d\d/]],_b=/([\+\-]|\d\d)/gi,ac=("Date|Hours|Minutes|Seconds|Milliseconds".split("|"),{Milliseconds:1,Seconds:1e3,Minutes:6e4,Hours:36e5,Days:864e5,Months:2592e6,Years:31536e6}),bc={ms:"millisecond",s:"second",m:"minute",h:"hour",d:"day",D:"date",w:"week",W:"isoWeek",M:"month",Q:"quarter",y:"year",DDD:"dayOfYear",e:"weekday",E:"isoWeekday",gg:"weekYear",GG:"isoWeekYear"},cc={dayofyear:"dayOfYear",isoweekday:"isoWeekday",isoweek:"isoWeek",weekyear:"weekYear",isoweekyear:"isoWeekYear"},dc={},ec={s:45,m:45,h:22,dd:25,dm:45,dy:345},fc="DDD w W M D d".split(" "),gc="M D H h m s w W".split(" "),hc={M:function(){return this.month()+1},MMM:function(a){return this.lang().monthsShort(this,a)},MMMM:function(a){return this.lang().months(this,a)},D:function(){return this.date()},DDD:function(){return this.dayOfYear()},d:function(){return this.day()},dd:function(a){return this.lang().weekdaysMin(this,a)},ddd:function(a){return this.lang().weekdaysShort(this,a)},dddd:function(a){return this.lang().weekdays(this,a)},w:function(){return this.week()},W:function(){return this.isoWeek()},YY:function(){return m(this.year()%100,2)},YYYY:function(){return m(this.year(),4)},YYYYY:function(){return m(this.year(),5)},YYYYYY:function(){var a=this.year(),b=a>=0?"+":"-";return b+m(Math.abs(a),6)},gg:function(){return m(this.weekYear()%100,2)},gggg:function(){return m(this.weekYear(),4)},ggggg:function(){return m(this.weekYear(),5)},GG:function(){return m(this.isoWeekYear()%100,2)},GGGG:function(){return m(this.isoWeekYear(),4)},GGGGG:function(){return m(this.isoWeekYear(),5)},e:function(){return this.weekday()},E:function(){return this.isoWeekday()},a:function(){return this.lang().meridiem(this.hours(),this.minutes(),!0)},A:function(){return this.lang().meridiem(this.hours(),this.minutes(),!1)},H:function(){return this.hours()},h:function(){return this.hours()%12||12},m:function(){return this.minutes()},s:function(){return this.seconds()},S:function(){return u(this.milliseconds()/100)},SS:function(){return m(u(this.milliseconds()/10),2)},SSS:function(){return m(this.milliseconds(),3)},SSSS:function(){return m(this.milliseconds(),3)},Z:function(){var a=-this.zone(),b="+";return 0>a&&(a=-a,b="-"),b+m(u(a/60),2)+":"+m(u(a)%60,2)},ZZ:function(){var a=-this.zone(),b="+";return 0>a&&(a=-a,b="-"),b+m(u(a/60),2)+m(u(a)%60,2)},z:function(){return this.zoneAbbr()},zz:function(){return this.zoneName()},X:function(){return this.unix()},Q:function(){return this.quarter()}},ic=["months","monthsShort","weekdays","weekdaysShort","weekdaysMin"];fc.length;)ob=fc.pop(),hc[ob+"o"]=f(hc[ob],ob);for(;gc.length;)ob=gc.pop(),hc[ob+ob]=e(hc[ob],2);for(hc.DDDD=e(hc.DDD,3),j(g.prototype,{set:function(a){var b,c;for(c in a)b=a[c],"function"==typeof b?this[c]=b:this["_"+c]=b},_months:"January_February_March_April_May_June_July_August_September_October_November_December".split("_"),months:function(a){return this._months[a.month()]},_monthsShort:"Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),monthsShort:function(a){return this._monthsShort[a.month()]},monthsParse:function(a){var b,c,d;for(this._monthsParse||(this._monthsParse=[]),b=0;12>b;b++)if(this._monthsParse[b]||(c=mb.utc([2e3,b]),d="^"+this.months(c,"")+"|^"+this.monthsShort(c,""),this._monthsParse[b]=new RegExp(d.replace(".",""),"i")),this._monthsParse[b].test(a))return b},_weekdays:"Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),weekdays:function(a){return this._weekdays[a.day()]},_weekdaysShort:"Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),weekdaysShort:function(a){return this._weekdaysShort[a.day()]},_weekdaysMin:"Su_Mo_Tu_We_Th_Fr_Sa".split("_"),weekdaysMin:function(a){return this._weekdaysMin[a.day()]},weekdaysParse:function(a){var b,c,d;for(this._weekdaysParse||(this._weekdaysParse=[]),b=0;7>b;b++)if(this._weekdaysParse[b]||(c=mb([2e3,1]).day(b),d="^"+this.weekdays(c,"")+"|^"+this.weekdaysShort(c,"")+"|^"+this.weekdaysMin(c,""),this._weekdaysParse[b]=new RegExp(d.replace(".",""),"i")),this._weekdaysParse[b].test(a))return b},_longDateFormat:{LT:"h:mm A",L:"MM/DD/YYYY",LL:"MMMM D YYYY",LLL:"MMMM D YYYY LT",LLLL:"dddd, MMMM D YYYY LT"},longDateFormat:function(a){var b=this._longDateFormat[a];return!b&&this._longDateFormat[a.toUpperCase()]&&(b=this._longDateFormat[a.toUpperCase()].replace(/MMMM|MM|DD|dddd/g,function(a){return a.slice(1)}),this._longDateFormat[a]=b),b},isPM:function(a){return"p"===(a+"").toLowerCase().charAt(0)},_meridiemParse:/[ap]\.?m?\.?/i,meridiem:function(a,b,c){return a>11?c?"pm":"PM":c?"am":"AM"},_calendar:{sameDay:"[Today at] LT",nextDay:"[Tomorrow at] LT",nextWeek:"dddd [at] LT",lastDay:"[Yesterday at] LT",lastWeek:"[Last] dddd [at] LT",sameElse:"L"},calendar:function(a,b){var c=this._calendar[a];return"function"==typeof c?c.apply(b):c},_relativeTime:{future:"in %s",past:"%s ago",s:"a few seconds",m:"a minute",mm:"%d minutes",h:"an hour",hh:"%d hours",d:"a day",dd:"%d days",M:"a month",MM:"%d months",y:"a year",yy:"%d years"},relativeTime:function(a,b,c,d){var e=this._relativeTime[c];return"function"==typeof e?e(a,b,c,d):e.replace(/%d/i,a)},pastFuture:function(a,b){var c=this._relativeTime[a>0?"future":"past"];return"function"==typeof c?c(b):c.replace(/%s/i,b)},ordinal:function(a){return this._ordinal.replace("%d",a)},_ordinal:"%d",preparse:function(a){return a},postformat:function(a){return a},week:function(a){return bb(a,this._week.dow,this._week.doy).week},_week:{dow:0,doy:6},_invalidDate:"Invalid date",invalidDate:function(){return this._invalidDate}}),mb=function(b,d,e,f){var g;return"boolean"==typeof e&&(f=e,e=a),g={},g._isAMomentObject=!0,g._i=b,g._f=d,g._l=e,g._strict=f,g._isUTC=!1,g._pf=c(),db(g)},mb.suppressDeprecationWarnings=!1,mb.createFromInputFallback=d("moment construction falls back to js Date. This is discouraged and will be removed in upcoming major release. Please refer to https://github.com/moment/moment/issues/1407 for more info.",function(a){a._d=new Date(a._i)}),mb.min=function(){var a=[].slice.call(arguments,0);return eb("isBefore",a)},mb.max=function(){var a=[].slice.call(arguments,0);return eb("isAfter",a)},mb.utc=function(b,d,e,f){var g;return"boolean"==typeof e&&(f=e,e=a),g={},g._isAMomentObject=!0,g._useUTC=!0,g._isUTC=!0,g._l=e,g._i=b,g._f=d,g._strict=f,g._pf=c(),db(g).utc()},mb.unix=function(a){return mb(1e3*a)},mb.duration=function(a,b){var c,d,e,f=a,g=null;return mb.isDuration(a)?f={ms:a._milliseconds,d:a._days,M:a._months}:"number"==typeof a?(f={},b?f[b]=a:f.milliseconds=a):(g=Db.exec(a))?(c="-"===g[1]?-1:1,f={y:0,d:u(g[ub])*c,h:u(g[vb])*c,m:u(g[wb])*c,s:u(g[xb])*c,ms:u(g[yb])*c}):(g=Eb.exec(a))&&(c="-"===g[1]?-1:1,e=function(a){var b=a&&parseFloat(a.replace(",","."));return(isNaN(b)?0:b)*c},f={y:e(g[2]),M:e(g[3]),d:e(g[4]),h:e(g[5]),m:e(g[6]),s:e(g[7]),w:e(g[8])}),d=new i(f),mb.isDuration(a)&&a.hasOwnProperty("_lang")&&(d._lang=a._lang),d},mb.version=pb,mb.defaultFormat=Yb,mb.ISO_8601=function(){},mb.momentProperties=Ab,mb.updateOffset=function(){},mb.relativeTimeThreshold=function(b,c){return ec[b]===a?!1:(ec[b]=c,!0)},mb.lang=function(a,b){var c;return a?(b?D(B(a),b):null===b?(E(a),a="en"):zb[a]||F(a),c=mb.duration.fn._lang=mb.fn._lang=F(a),c._abbr):mb.fn._lang._abbr},mb.langData=function(a){return a&&a._lang&&a._lang._abbr&&(a=a._lang._abbr),F(a)},mb.isMoment=function(a){return a instanceof h||null!=a&&a.hasOwnProperty("_isAMomentObject")},mb.isDuration=function(a){return a instanceof i},ob=ic.length-1;ob>=0;--ob)t(ic[ob]);mb.normalizeUnits=function(a){return r(a)},mb.invalid=function(a){var b=mb.utc(0/0);return null!=a?j(b._pf,a):b._pf.userInvalidated=!0,b},mb.parseZone=function(){return mb.apply(null,arguments).parseZone()},mb.parseTwoDigitYear=function(a){return u(a)+(u(a)>68?1900:2e3)},j(mb.fn=h.prototype,{clone:function(){return mb(this)},valueOf:function(){return+this._d+6e4*(this._offset||0)},unix:function(){return Math.floor(+this/1e3)},toString:function(){return this.clone().lang("en").format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ")},toDate:function(){return this._offset?new Date(+this):this._d},toISOString:function(){var a=mb(this).utc();return 0<a.year()&&a.year()<=9999?I(a,"YYYY-MM-DD[T]HH:mm:ss.SSS[Z]"):I(a,"YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]")},toArray:function(){var a=this;return[a.year(),a.month(),a.date(),a.hours(),a.minutes(),a.seconds(),a.milliseconds()]},isValid:function(){return A(this)},isDSTShifted:function(){return this._a?this.isValid()&&q(this._a,(this._isUTC?mb.utc(this._a):mb(this._a)).toArray())>0:!1},parsingFlags:function(){return j({},this._pf)},invalidAt:function(){return this._pf.overflow},utc:function(){return this.zone(0)},local:function(){return this.zone(0),this._isUTC=!1,this},format:function(a){var b=I(this,a||mb.defaultFormat);return this.lang().postformat(b)},add:function(a,b){var c;return c="string"==typeof a&&"string"==typeof b?mb.duration(isNaN(+b)?+a:+b,isNaN(+b)?b:a):"string"==typeof a?mb.duration(+b,a):mb.duration(a,b),n(this,c,1),this},subtract:function(a,b){var c;return c="string"==typeof a&&"string"==typeof b?mb.duration(isNaN(+b)?+a:+b,isNaN(+b)?b:a):"string"==typeof a?mb.duration(+b,a):mb.duration(a,b),n(this,c,-1),this},diff:function(a,b,c){var d,e,f=C(a,this),g=6e4*(this.zone()-f.zone());return b=r(b),"year"===b||"month"===b?(d=432e5*(this.daysInMonth()+f.daysInMonth()),e=12*(this.year()-f.year())+(this.month()-f.month()),e+=(this-mb(this).startOf("month")-(f-mb(f).startOf("month")))/d,e-=6e4*(this.zone()-mb(this).startOf("month").zone()-(f.zone()-mb(f).startOf("month").zone()))/d,"year"===b&&(e/=12)):(d=this-f,e="second"===b?d/1e3:"minute"===b?d/6e4:"hour"===b?d/36e5:"day"===b?(d-g)/864e5:"week"===b?(d-g)/6048e5:d),c?e:l(e)},from:function(a,b){return mb.duration(this.diff(a)).lang(this.lang()._abbr).humanize(!b)},fromNow:function(a){return this.from(mb(),a)},calendar:function(a){var b=a||mb(),c=C(b,this).startOf("day"),d=this.diff(c,"days",!0),e=-6>d?"sameElse":-1>d?"lastWeek":0>d?"lastDay":1>d?"sameDay":2>d?"nextDay":7>d?"nextWeek":"sameElse";return this.format(this.lang().calendar(e,this))},isLeapYear:function(){return y(this.year())},isDST:function(){return this.zone()<this.clone().month(0).zone()||this.zone()<this.clone().month(5).zone()},day:function(a){var b=this._isUTC?this._d.getUTCDay():this._d.getDay();return null!=a?(a=$(a,this.lang()),this.add({d:a-b})):b},month:ib("Month",!0),startOf:function(a){switch(a=r(a)){case"year":this.month(0);case"quarter":case"month":this.date(1);case"week":case"isoWeek":case"day":this.hours(0);case"hour":this.minutes(0);case"minute":this.seconds(0);case"second":this.milliseconds(0)}return"week"===a?this.weekday(0):"isoWeek"===a&&this.isoWeekday(1),"quarter"===a&&this.month(3*Math.floor(this.month()/3)),this},endOf:function(a){return a=r(a),this.startOf(a).add("isoWeek"===a?"week":a,1).subtract("ms",1)},isAfter:function(a,b){return b="undefined"!=typeof b?b:"millisecond",+this.clone().startOf(b)>+mb(a).startOf(b)},isBefore:function(a,b){return b="undefined"!=typeof b?b:"millisecond",+this.clone().startOf(b)<+mb(a).startOf(b)},isSame:function(a,b){return b=b||"ms",+this.clone().startOf(b)===+C(a,this).startOf(b)},min:d("moment().min is deprecated, use moment.min instead. https://github.com/moment/moment/issues/1548",function(a){return a=mb.apply(null,arguments),this>a?this:a}),max:d("moment().max is deprecated, use moment.max instead. https://github.com/moment/moment/issues/1548",function(a){return a=mb.apply(null,arguments),a>this?this:a}),zone:function(a,b){var c=this._offset||0;return null==a?this._isUTC?c:this._d.getTimezoneOffset():("string"==typeof a&&(a=L(a)),Math.abs(a)<16&&(a=60*a),this._offset=a,this._isUTC=!0,c!==a&&(!b||this._changeInProgress?n(this,mb.duration(c-a,"m"),1,!1):this._changeInProgress||(this._changeInProgress=!0,mb.updateOffset(this,!0),this._changeInProgress=null)),this)},zoneAbbr:function(){return this._isUTC?"UTC":""},zoneName:function(){return this._isUTC?"Coordinated Universal Time":""},parseZone:function(){return this._tzm?this.zone(this._tzm):"string"==typeof this._i&&this.zone(this._i),this},hasAlignedHourOffset:function(a){return a=a?mb(a).zone():0,(this.zone()-a)%60===0},daysInMonth:function(){return v(this.year(),this.month())},dayOfYear:function(a){var b=rb((mb(this).startOf("day")-mb(this).startOf("year"))/864e5)+1;return null==a?b:this.add("d",a-b)},quarter:function(a){return null==a?Math.ceil((this.month()+1)/3):this.month(3*(a-1)+this.month()%3)},weekYear:function(a){var b=bb(this,this.lang()._week.dow,this.lang()._week.doy).year;return null==a?b:this.add("y",a-b)},isoWeekYear:function(a){var b=bb(this,1,4).year;return null==a?b:this.add("y",a-b)},week:function(a){var b=this.lang().week(this);return null==a?b:this.add("d",7*(a-b))},isoWeek:function(a){var b=bb(this,1,4).week;return null==a?b:this.add("d",7*(a-b))},weekday:function(a){var b=(this.day()+7-this.lang()._week.dow)%7;return null==a?b:this.add("d",a-b)},isoWeekday:function(a){return null==a?this.day()||7:this.day(this.day()%7?a:a-7)},isoWeeksInYear:function(){return w(this.year(),1,4)},weeksInYear:function(){var a=this._lang._week;return w(this.year(),a.dow,a.doy)},get:function(a){return a=r(a),this[a]()},set:function(a,b){return a=r(a),"function"==typeof this[a]&&this[a](b),this},lang:function(b){return b===a?this._lang:(this._lang=F(b),this)}}),mb.fn.millisecond=mb.fn.milliseconds=ib("Milliseconds",!1),mb.fn.second=mb.fn.seconds=ib("Seconds",!1),mb.fn.minute=mb.fn.minutes=ib("Minutes",!1),mb.fn.hour=mb.fn.hours=ib("Hours",!0),mb.fn.date=ib("Date",!0),mb.fn.dates=d("dates accessor is deprecated. Use date instead.",ib("Date",!0)),mb.fn.year=ib("FullYear",!0),mb.fn.years=d("years accessor is deprecated. Use year instead.",ib("FullYear",!0)),mb.fn.days=mb.fn.day,mb.fn.months=mb.fn.month,mb.fn.weeks=mb.fn.week,mb.fn.isoWeeks=mb.fn.isoWeek,mb.fn.quarters=mb.fn.quarter,mb.fn.toJSON=mb.fn.toISOString,j(mb.duration.fn=i.prototype,{_bubble:function(){var a,b,c,d,e=this._milliseconds,f=this._days,g=this._months,h=this._data;h.milliseconds=e%1e3,a=l(e/1e3),h.seconds=a%60,b=l(a/60),h.minutes=b%60,c=l(b/60),h.hours=c%24,f+=l(c/24),h.days=f%30,g+=l(f/30),h.months=g%12,d=l(g/12),h.years=d},weeks:function(){return l(this.days()/7)},valueOf:function(){return this._milliseconds+864e5*this._days+this._months%12*2592e6+31536e6*u(this._months/12)},humanize:function(a){var b=+this,c=ab(b,!a,this.lang());return a&&(c=this.lang().pastFuture(b,c)),this.lang().postformat(c)},add:function(a,b){var c=mb.duration(a,b);return this._milliseconds+=c._milliseconds,this._days+=c._days,this._months+=c._months,this._bubble(),this},subtract:function(a,b){var c=mb.duration(a,b);return this._milliseconds-=c._milliseconds,this._days-=c._days,this._months-=c._months,this._bubble(),this},get:function(a){return a=r(a),this[a.toLowerCase()+"s"]()},as:function(a){return a=r(a),this["as"+a.charAt(0).toUpperCase()+a.slice(1)+"s"]()},lang:mb.fn.lang,toIsoString:function(){var a=Math.abs(this.years()),b=Math.abs(this.months()),c=Math.abs(this.days()),d=Math.abs(this.hours()),e=Math.abs(this.minutes()),f=Math.abs(this.seconds()+this.milliseconds()/1e3);return this.asSeconds()?(this.asSeconds()<0?"-":"")+"P"+(a?a+"Y":"")+(b?b+"M":"")+(c?c+"D":"")+(d||e||f?"T":"")+(d?d+"H":"")+(e?e+"M":"")+(f?f+"S":""):"P0D"}});for(ob in ac)ac.hasOwnProperty(ob)&&(kb(ob,ac[ob]),jb(ob.toLowerCase()));kb("Weeks",6048e5),mb.duration.fn.asMonths=function(){return(+this-31536e6*this.years())/2592e6+12*this.years()},mb.lang("en",{ordinal:function(a){var b=a%10,c=1===u(a%100/10)?"th":1===b?"st":2===b?"nd":3===b?"rd":"th";return a+c}}),Bb?module.exports=mb:"function"==typeof define&&define.amd?(define("moment",function(a,b,c){return c.config&&c.config()&&c.config().noGlobal===!0&&(qb.moment=nb),mb}),lb(!0)):lb()}).call(this);
//
// DATETIMEPICKER
//
(function(factory){if(typeof define==="function"&&define.amd){define(["jquery","moment"],factory)}else{if(!jQuery){throw"bootstrap-datetimepicker requires jQuery to be loaded first"}else if(!moment){throw"bootstrap-datetimepicker requires moment.js to be loaded first"}else{factory(jQuery,moment)}}})(function($,moment){if(typeof moment==="undefined"){alert("momentjs is required");throw new Error("momentjs is required")}var dpgId=0,pMoment=moment,DateTimePicker=function(element,options){var defaults=$.fn.datetimepicker.defaults,icons={time:"glyphicon glyphicon-time",date:"glyphicon glyphicon-calendar",up:"glyphicon glyphicon-chevron-up",down:"glyphicon glyphicon-chevron-down"},picker=this,init=function(){var icon=false,i,dDate,longDateFormat;picker.options=$.extend({},defaults,options);picker.options.icons=$.extend({},icons,picker.options.icons);picker.element=$(element);dataToOptions();if(!(picker.options.pickTime||picker.options.pickDate))throw new Error("Must choose at least one picker");picker.id=dpgId++;pMoment.locale(picker.options.language);picker.date=pMoment();picker.unset=false;picker.isInput=picker.element.is("input");picker.component=false;if(picker.element.hasClass("input-group")){if(picker.element.find(".datepickerbutton").size()==0){picker.component=picker.element.find("[class^='input-group-']")}else{picker.component=picker.element.find(".datepickerbutton")}}picker.format=picker.options.format;longDateFormat=pMoment().localeData().longDateFormat;if(!picker.format){picker.format=picker.options.pickDate?longDateFormat("L"):"";if(picker.options.pickDate&&picker.options.pickTime)picker.format+=" ";picker.format+=picker.options.pickTime?longDateFormat("LT"):"";if(picker.options.useSeconds){if(~longDateFormat("LT").indexOf(" A")){picker.format=picker.format.split(" A")[0]+":ss A"}else{picker.format+=":ss"}}}picker.use24hours=picker.format.toLowerCase().indexOf("a")<1;if(picker.component)icon=picker.component.find("span");if(picker.options.pickTime){if(icon)icon.addClass(picker.options.icons.time)}if(picker.options.pickDate){if(icon){icon.removeClass(picker.options.icons.time);icon.addClass(picker.options.icons.date)}}picker.options.widgetParent=typeof picker.options.widgetParent=="string"&&picker.options.widgetParent||picker.element.parents().filter(function(){return"scroll"==$(this).css("overflow-y")}).get(0)||"body";picker.widget=$(getTemplate()).appendTo(picker.options.widgetParent);if(picker.options.useSeconds&&!picker.use24hours){picker.widget.width(300)}picker.minViewMode=picker.options.minViewMode||0;if(typeof picker.minViewMode==="string"){switch(picker.minViewMode){case"months":picker.minViewMode=1;break;case"years":picker.minViewMode=2;break;default:picker.minViewMode=0;break}}picker.viewMode=picker.options.viewMode||0;if(typeof picker.viewMode==="string"){switch(picker.viewMode){case"months":picker.viewMode=1;break;case"years":picker.viewMode=2;break;default:picker.viewMode=0;break}}picker.options.disabledDates=indexGivenDates(picker.options.disabledDates);picker.options.enabledDates=indexGivenDates(picker.options.enabledDates);picker.startViewMode=picker.viewMode;picker.setMinDate(picker.options.minDate);picker.setMaxDate(picker.options.maxDate);fillDow();fillMonths();fillHours();fillMinutes();fillSeconds();update();showMode();attachDatePickerEvents();if(picker.options.defaultDate!==""&&getPickerInput().val()=="")picker.setValue(picker.options.defaultDate);if(picker.options.minuteStepping!==1){var rInterval=picker.options.minuteStepping;picker.date.minutes(Math.round(picker.date.minutes()/rInterval)*rInterval%60).seconds(0)}},getPickerInput=function(){var input;if(picker.isInput){return picker.element}else{input=picker.element.find(".datepickerinput");if(input.size()===0){input=picker.element.find("input")}else if(!input.is("input")){throw new Error('CSS class "datepickerinput" cannot be applied to non input element')}return input}},dataToOptions=function(){var eData;if(picker.element.is("input")){eData=picker.element.data()}else{eData=picker.element.find("input").data()}if(eData.dateFormat!==undefined)picker.options.format=eData.dateFormat;if(eData.datePickdate!==undefined)picker.options.pickDate=eData.datePickdate;if(eData.datePicktime!==undefined)picker.options.pickTime=eData.datePicktime;if(eData.dateUseminutes!==undefined)picker.options.useMinutes=eData.dateUseminutes;if(eData.dateUseseconds!==undefined)picker.options.useSeconds=eData.dateUseseconds;if(eData.dateUsecurrent!==undefined)picker.options.useCurrent=eData.dateUsecurrent;if(eData.dateMinutestepping!==undefined)picker.options.minuteStepping=eData.dateMinutestepping;if(eData.dateMindate!==undefined)picker.options.minDate=eData.dateMindate;if(eData.dateMaxdate!==undefined)picker.options.maxDate=eData.dateMaxdate;if(eData.dateShowtoday!==undefined)picker.options.showToday=eData.dateShowtoday;if(eData.dateCollapse!==undefined)picker.options.collapse=eData.dateCollapse;if(eData.dateLanguage!==undefined)picker.options.language=eData.dateLanguage;if(eData.dateDefaultdate!==undefined)picker.options.defaultDate=eData.dateDefaultdate;if(eData.dateDisableddates!==undefined)picker.options.disabledDates=eData.dateDisableddates;if(eData.dateEnableddates!==undefined)picker.options.enabledDates=eData.dateEnableddates;if(eData.dateIcons!==undefined)picker.options.icons=eData.dateIcons;if(eData.dateUsestrict!==undefined)picker.options.useStrict=eData.dateUsestrict;if(eData.dateDirection!==undefined)picker.options.direction=eData.dateDirection;if(eData.dateSidebyside!==undefined)picker.options.sideBySide=eData.dateSidebyside},place=function(){var position="absolute",offset=picker.component?picker.component.offset():picker.element.offset(),$window=$(window);picker.width=picker.component?picker.component.outerWidth():picker.element.outerWidth();offset.top=offset.top+picker.element.outerHeight();var placePosition;if(picker.options.direction==="up"){placePosition="top"}else if(picker.options.direction==="bottom"){placePosition="bottom"}else if(picker.options.direction==="auto"){if(offset.top+picker.widget.height()>$window.height()+$window.scrollTop()&&picker.widget.height()+picker.element.outerHeight()<offset.top){placePosition="top"}else{placePosition="bottom"}}if(placePosition==="top"){offset.top-=picker.widget.height()+picker.element.outerHeight()+15;picker.widget.addClass("top").removeClass("bottom")}else{offset.top+=1;picker.widget.addClass("bottom").removeClass("top")}if(picker.options.width!==undefined){picker.widget.width(picker.options.width)}if(picker.options.orientation==="left"){picker.widget.addClass("left-oriented");offset.left=offset.left-picker.widget.width()+20}if(isInFixed()){position="fixed";offset.top-=$window.scrollTop();offset.left-=$window.scrollLeft()}if($window.width()<offset.left+picker.widget.outerWidth()){offset.right=$window.width()-offset.left-picker.width;offset.left="auto";picker.widget.addClass("pull-right")}else{offset.right="auto";picker.widget.removeClass("pull-right")}picker.widget.css({position:position,top:offset.top,left:offset.left,right:offset.right})},notifyChange=function(oldDate,eventType){if(pMoment(picker.date).isSame(pMoment(oldDate)))return;picker.element.trigger({type:"dp.change",date:pMoment(picker.date),oldDate:pMoment(oldDate)});if(eventType!=="change")picker.element.change()},notifyError=function(date){picker.element.trigger({type:"dp.error",date:pMoment(date)})},update=function(newDate){pMoment.locale(picker.options.language);var dateStr=newDate;if(!dateStr){dateStr=getPickerInput().val();if(dateStr)picker.date=pMoment(dateStr,picker.format,picker.options.useStrict);if(!picker.date)picker.date=pMoment()}picker.viewDate=pMoment(picker.date).startOf("month");fillDate();fillTime()},fillDow=function(){pMoment.locale(picker.options.language);var html=$("<tr>"),weekdaysMin=pMoment.weekdaysMin(),i;if(pMoment().localeData()._week.dow==0){for(i=0;i<7;i++){html.append('<th class="dow">'+weekdaysMin[i]+"</th>")}}else{for(i=1;i<8;i++){if(i==7){html.append('<th class="dow">'+weekdaysMin[0]+"</th>")}else{html.append('<th class="dow">'+weekdaysMin[i]+"</th>")}}}picker.widget.find(".datepicker-days thead").append(html)},fillMonths=function(){pMoment.locale(picker.options.language);var html="",i=0,monthsShort=pMoment.monthsShort();while(i<12){html+='<span class="month">'+monthsShort[i++]+"</span>"}picker.widget.find(".datepicker-months td").append(html)},fillDate=function(){if(!picker.options.pickDate)return;pMoment.locale(picker.options.language);var year=picker.viewDate.year(),month=picker.viewDate.month(),startYear=picker.options.minDate.year(),startMonth=picker.options.minDate.month(),endYear=picker.options.maxDate.year(),endMonth=picker.options.maxDate.month(),currentDate,prevMonth,nextMonth,html=[],row,clsName,i,days,yearCont,currentYear,months=pMoment.months();picker.widget.find(".datepicker-days").find(".disabled").removeClass("disabled");picker.widget.find(".datepicker-months").find(".disabled").removeClass("disabled");picker.widget.find(".datepicker-years").find(".disabled").removeClass("disabled");picker.widget.find(".datepicker-days th:eq(1)").text(months[month]+" "+year);prevMonth=pMoment.utc(picker.viewDate).subtract(1,"months");days=prevMonth.daysInMonth();prevMonth.date(days).startOf("week");if(year==startYear&&month<=startMonth||year<startYear){picker.widget.find(".datepicker-days th:eq(0)").addClass("disabled")}if(year==endYear&&month>=endMonth||year>endYear){picker.widget.find(".datepicker-days th:eq(2)").addClass("disabled")}nextMonth=pMoment.utc(prevMonth).add(42,"d");while(prevMonth.isBefore(nextMonth)){if(prevMonth.weekday()===pMoment.utc().startOf("week").weekday()){row=$("<tr>");html.push(row)}clsName="";if(prevMonth.year()<year||prevMonth.year()==year&&prevMonth.month()<month){clsName+=" old"}else if(prevMonth.year()>year||prevMonth.year()==year&&prevMonth.month()>month){clsName+=" new"}if(prevMonth.isSame(pMoment.utc({y:picker.date.year(),M:picker.date.month(),d:picker.date.date()}))){clsName+=" active"}if(isInDisableDates(prevMonth,"day")||!isInEnableDates(prevMonth)){clsName+=" disabled"}if(picker.options.showToday===true){if(prevMonth.isSame(pMoment.utc(),"day")){clsName+=" today"}}if(picker.options.daysOfWeekDisabled){for(i in picker.options.daysOfWeekDisabled){if(prevMonth.day()==picker.options.daysOfWeekDisabled[i]){clsName+=" disabled";break}}}row.append('<td class="day'+clsName+'">'+prevMonth.date()+"</td>");currentDate=prevMonth.date();prevMonth.add(1,"d");if(currentDate==prevMonth.date()){prevMonth.add(1,"d")}}picker.widget.find(".datepicker-days tbody").empty().append(html);currentYear=picker.date.year(),months=picker.widget.find(".datepicker-months").find("th:eq(1)").text(year).end().find("span").removeClass("active");if(currentYear===year){months.eq(picker.date.month()).addClass("active")}if(currentYear-1<startYear){picker.widget.find(".datepicker-months th:eq(0)").addClass("disabled")}if(currentYear+1>endYear){picker.widget.find(".datepicker-months th:eq(2)").addClass("disabled")}for(i=0;i<12;i++){if(year==startYear&&startMonth>i||year<startYear){$(months[i]).addClass("disabled")}else if(year==endYear&&endMonth<i||year>endYear){$(months[i]).addClass("disabled")}}html="";year=parseInt(year/10,10)*10;yearCont=picker.widget.find(".datepicker-years").find("th:eq(1)").text(year+"-"+(year+9)).end().find("td");picker.widget.find(".datepicker-years").find("th").removeClass("disabled");if(startYear>year){picker.widget.find(".datepicker-years").find("th:eq(0)").addClass("disabled")}if(endYear<year+9){picker.widget.find(".datepicker-years").find("th:eq(2)").addClass("disabled")}year-=1;for(i=-1;i<11;i++){html+='<span class="year'+(i===-1||i===10?" old":"")+(currentYear===year?" active":"")+(year<startYear||year>endYear?" disabled":"")+'">'+year+"</span>";year+=1}yearCont.html(html)},fillHours=function(){pMoment.locale(picker.options.language);var table=picker.widget.find(".timepicker .timepicker-hours table"),html="",current,i,j;table.parent().hide();if(picker.use24hours){current=0;for(i=0;i<6;i+=1){html+="<tr>";for(j=0;j<4;j+=1){html+='<td class="hour">'+padLeft(current.toString())+"</td>";current++}html+="</tr>"}}else{current=1;for(i=0;i<3;i+=1){html+="<tr>";for(j=0;j<4;j+=1){html+='<td class="hour">'+padLeft(current.toString())+"</td>";current++}html+="</tr>"}}table.html(html)},fillMinutes=function(){var table=picker.widget.find(".timepicker .timepicker-minutes table"),html="",current=0,i,j,step=picker.options.minuteStepping;table.parent().hide();if(step==1)step=5;for(i=0;i<Math.ceil(60/step/4);i++){html+="<tr>";for(j=0;j<4;j+=1){if(current<60){html+='<td class="minute">'+padLeft(current.toString())+"</td>";current+=step}else{html+="<td></td>"}}html+="</tr>"}table.html(html)},fillSeconds=function(){var table=picker.widget.find(".timepicker .timepicker-seconds table"),html="",current=0,i,j;table.parent().hide();for(i=0;i<3;i++){html+="<tr>";for(j=0;j<4;j+=1){html+='<td class="second">'+padLeft(current.toString())+"</td>";current+=5}html+="</tr>"}table.html(html)},fillTime=function(){if(!picker.date)return;var timeComponents=picker.widget.find(".timepicker span[data-time-component]"),hour=picker.date.hours(),period="AM";if(!picker.use24hours){if(hour>=12)period="PM";if(hour===0)hour=12;else if(hour!=12)hour=hour%12;picker.widget.find(".timepicker [data-action=togglePeriod]").text(period)}timeComponents.filter("[data-time-component=hours]").text(padLeft(hour));timeComponents.filter("[data-time-component=minutes]").text(padLeft(picker.date.minutes()));timeComponents.filter("[data-time-component=seconds]").text(padLeft(picker.date.second()))},click=function(e){e.stopPropagation();e.preventDefault();picker.unset=false;var target=$(e.target).closest("span, td, th"),month,year,step,day,oldDate=pMoment(picker.date);if(target.length===1){if(!target.is(".disabled")){switch(target[0].nodeName.toLowerCase()){case"th":switch(target[0].className){case"switch":showMode(1);break;case"prev":case"next":step=dpGlobal.modes[picker.viewMode].navStep;if(target[0].className==="prev")step=step*-1;picker.viewDate.add(step,dpGlobal.modes[picker.viewMode].navFnc);fillDate();break}break;case"span":if(target.is(".month")){month=target.parent().find("span").index(target);picker.viewDate.month(month)}else{year=parseInt(target.text(),10)||0;picker.viewDate.year(year)}if(picker.viewMode===picker.minViewMode){picker.date=pMoment({y:picker.viewDate.year(),M:picker.viewDate.month(),d:picker.viewDate.date(),h:picker.date.hours(),m:picker.date.minutes(),s:picker.date.seconds()});notifyChange(oldDate,e.type);set()}showMode(-1);fillDate();break;case"td":if(target.is(".day")){day=parseInt(target.text(),10)||1;month=picker.viewDate.month();year=picker.viewDate.year();if(target.is(".old")){if(month===0){month=11;year-=1}else{month-=1}}else if(target.is(".new")){if(month==11){month=0;year+=1}else{month+=1}}picker.date=pMoment({y:year,M:month,d:day,h:picker.date.hours(),m:picker.date.minutes(),s:picker.date.seconds()});picker.viewDate=pMoment({y:year,M:month,d:Math.min(28,day)});fillDate();set();notifyChange(oldDate,e.type)}break}}}},actions={incrementHours:function(){checkDate("add","hours",1)},incrementMinutes:function(){checkDate("add","minutes",picker.options.minuteStepping)},incrementSeconds:function(){checkDate("add","seconds",1)},decrementHours:function(){checkDate("subtract","hours",1)},decrementMinutes:function(){checkDate("subtract","minutes",picker.options.minuteStepping)},decrementSeconds:function(){checkDate("subtract","seconds",1)},togglePeriod:function(){var hour=picker.date.hours();if(hour>=12)hour-=12;else hour+=12;picker.date.hours(hour)},showPicker:function(){picker.widget.find(".timepicker > div:not(.timepicker-picker)").hide();picker.widget.find(".timepicker .timepicker-picker").show()},showHours:function(){picker.widget.find(".timepicker .timepicker-picker").hide();picker.widget.find(".timepicker .timepicker-hours").show()},showMinutes:function(){picker.widget.find(".timepicker .timepicker-picker").hide();picker.widget.find(".timepicker .timepicker-minutes").show()},showSeconds:function(){picker.widget.find(".timepicker .timepicker-picker").hide();picker.widget.find(".timepicker .timepicker-seconds").show()},selectHour:function(e){var period=picker.widget.find(".timepicker [data-action=togglePeriod]").text(),hour=parseInt($(e.target).text(),10);if(period=="PM")hour+=12;picker.date.hours(hour);actions.showPicker.call(picker)},selectMinute:function(e){picker.date.minutes(parseInt($(e.target).text(),10));actions.showPicker.call(picker)},selectSecond:function(e){picker.date.seconds(parseInt($(e.target).text(),10));actions.showPicker.call(picker)}},doAction=function(e){var oldDate=pMoment(picker.date),action=$(e.currentTarget).data("action"),rv=actions[action].apply(picker,arguments);stopEvent(e);if(!picker.date)picker.date=pMoment({y:1970});set();fillTime();notifyChange(oldDate,e.type);return rv},stopEvent=function(e){e.stopPropagation();e.preventDefault()},keydown=function(e){if(e.keyCode===27)picker.hide()},change=function(e){pMoment.locale(picker.options.language);var input=$(e.target),oldDate=pMoment(picker.date),newDate=pMoment(input.val(),picker.format,picker.options.useStrict);if(newDate.isValid()&&!isInDisableDates(newDate)&&isInEnableDates(newDate)){update();picker.setValue(newDate);notifyChange(oldDate,e.type);set()}else{picker.viewDate=oldDate;picker.unset=true;notifyChange(oldDate,e.type);notifyError(newDate)}},showMode=function(dir){if(dir){picker.viewMode=Math.max(picker.minViewMode,Math.min(2,picker.viewMode+dir))}var f=dpGlobal.modes[picker.viewMode].clsName;picker.widget.find(".datepicker > div").hide().filter(".datepicker-"+dpGlobal.modes[picker.viewMode].clsName).show()},attachDatePickerEvents=function(){var $this,$parent,expanded,closed,collapseData;picker.widget.on("click",".datepicker *",$.proxy(click,this));picker.widget.on("click","[data-action]",$.proxy(doAction,this));picker.widget.on("mousedown",$.proxy(stopEvent,this));picker.element.on("keydown",$.proxy(keydown,this));if(picker.options.pickDate&&picker.options.pickTime){picker.widget.on("click.togglePicker",".accordion-toggle",function(e){e.stopPropagation();$this=$(this);$parent=$this.closest("ul");expanded=$parent.find(".in");closed=$parent.find(".collapse:not(.in)");if(expanded&&expanded.length){collapseData=expanded.data("collapse");if(collapseData&&collapseData.transitioning)return;expanded.collapse("hide");closed.collapse("show");$this.find("span").toggleClass(picker.options.icons.time+" "+picker.options.icons.date);picker.element.find("[class^='input-group-'] span").toggleClass(picker.options.icons.time+" "+picker.options.icons.date)}})}if(picker.isInput){picker.element.on({focus:$.proxy(picker.show,this),change:$.proxy(change,this),blur:$.proxy(picker.hide,this)})}else{picker.element.on({change:$.proxy(change,this)},"input");if(picker.component){picker.component.on("click",$.proxy(picker.show,this))}else{picker.element.on("click",$.proxy(picker.show,this))}}},attachDatePickerGlobalEvents=function(){$(window).on("resize.datetimepicker"+picker.id,$.proxy(place,this));if(!picker.isInput){$(document).on("mousedown.datetimepicker"+picker.id,$.proxy(picker.hide,this))}},detachDatePickerEvents=function(){picker.widget.off("click",".datepicker *",picker.click);picker.widget.off("click","[data-action]");picker.widget.off("mousedown",picker.stopEvent);if(picker.options.pickDate&&picker.options.pickTime){picker.widget.off("click.togglePicker")}if(picker.isInput){picker.element.off({focus:picker.show,change:picker.change})}else{picker.element.off({change:picker.change},"input");if(picker.component){picker.component.off("click",picker.show)}else{picker.element.off("click",picker.show)}}},detachDatePickerGlobalEvents=function(){$(window).off("resize.datetimepicker"+picker.id);if(!picker.isInput){$(document).off("mousedown.datetimepicker"+picker.id)}},isInFixed=function(){if(picker.element){var parents=picker.element.parents(),inFixed=false,i;for(i=0;i<parents.length;i++){if($(parents[i]).css("position")=="fixed"){inFixed=true;break}}return inFixed}else{return false}},set=function(){pMoment.locale(picker.options.language);var formatted="",input;if(!picker.unset)formatted=pMoment(picker.date).format(picker.format);getPickerInput().val(formatted);picker.element.data("date",formatted);if(!picker.options.pickTime)picker.hide()},checkDate=function(direction,unit,amount){pMoment.locale(picker.options.language);var newDate;if(direction=="add"){newDate=pMoment(picker.date);if(newDate.hours()==23)newDate.add(amount,unit);newDate.add(amount,unit)}else{newDate=pMoment(picker.date).subtract(amount,unit)}if(isInDisableDates(pMoment(newDate.subtract(amount,unit)))||isInDisableDates(newDate)){notifyError(newDate.format(picker.format));return}if(direction=="add"){picker.date.add(amount,unit)}else{picker.date.subtract(amount,unit)}picker.unset=false},isInDisableDates=function(date,timeUnit){pMoment.locale(picker.options.language);var maxDate=picker.options.maxDate;var minDate=picker.options.minDate;if(timeUnit){maxDate=pMoment(maxDate).endOf(timeUnit);minDate=pMoment(minDate).startOf(timeUnit)}if(date.isAfter(maxDate)||date.isBefore(minDate))return true;if(picker.options.disabledDates===false){return false}return picker.options.disabledDates[pMoment(date).format("YYYY-MM-DD")]===true},isInEnableDates=function(date){pMoment.locale(picker.options.language);if(picker.options.enabledDates===false){return true}return picker.options.enabledDates[pMoment(date).format("YYYY-MM-DD")]===true},indexGivenDates=function(givenDatesArray){var givenDatesIndexed={},givenDatesCount=0,i;for(i=0;i<givenDatesArray.length;i++){dDate=pMoment(givenDatesArray[i]);if(dDate.isValid()){givenDatesIndexed[dDate.format("YYYY-MM-DD")]=true;givenDatesCount++}}if(givenDatesCount>0){return givenDatesIndexed}return false},padLeft=function(string){string=string.toString();if(string.length>=2)return string;else return"0"+string},getTemplate=function(){if(picker.options.pickDate&&picker.options.pickTime){var ret="";ret='<div class="bootstrap-datetimepicker-widget'+(picker.options.sideBySide?" timepicker-sbs":"")+' dropdown-menu" style="z-index:9999 !important;">';if(picker.options.sideBySide){ret+='<div class="row">'+'<div class="col-sm-6 datepicker">'+dpGlobal.template+"</div>"+'<div class="col-sm-6 timepicker">'+tpGlobal.getTemplate()+"</div>"+"</div>"}else{ret+='<ul class="list-unstyled">'+"<li"+(picker.options.collapse?' class="collapse in"':"")+">"+'<div class="datepicker">'+dpGlobal.template+"</div>"+"</li>"+'<li class="picker-switch accordion-toggle"><a class="btn" style="width:100%"><span class="'+picker.options.icons.time+'"></span></a></li>'+"<li"+(picker.options.collapse?' class="collapse"':"")+">"+'<div class="timepicker">'+tpGlobal.getTemplate()+"</div>"+"</li>"+"</ul>"}ret+="</div>";return ret}else if(picker.options.pickTime){return'<div class="bootstrap-datetimepicker-widget dropdown-menu">'+'<div class="timepicker">'+tpGlobal.getTemplate()+"</div>"+"</div>"}else{return'<div class="bootstrap-datetimepicker-widget dropdown-menu">'+'<div class="datepicker">'+dpGlobal.template+"</div>"+"</div>"}},dpGlobal={modes:[{clsName:"days",navFnc:"month",navStep:1},{clsName:"months",navFnc:"year",navStep:1},{clsName:"years",navFnc:"year",navStep:10}],headTemplate:"<thead>"+"<tr>"+'<th class="prev">&lsaquo;</th><th colspan="5" class="switch"></th><th class="next">&rsaquo;</th>'+"</tr>"+"</thead>",contTemplate:'<tbody><tr><td colspan="7"></td></tr></tbody>'},tpGlobal={hourTemplate:'<span data-action="showHours"   data-time-component="hours"   class="timepicker-hour"></span>',minuteTemplate:'<span data-action="showMinutes" data-time-component="minutes" class="timepicker-minute"></span>',secondTemplate:'<span data-action="showSeconds"  data-time-component="seconds" class="timepicker-second"></span>'};dpGlobal.template='<div class="datepicker-days">'+'<table class="table-condensed">'+dpGlobal.headTemplate+"<tbody></tbody></table>"+"</div>"+'<div class="datepicker-months">'+'<table class="table-condensed">'+dpGlobal.headTemplate+dpGlobal.contTemplate+"</table>"+"</div>"+'<div class="datepicker-years">'+'<table class="table-condensed">'+dpGlobal.headTemplate+dpGlobal.contTemplate+"</table>"+"</div>";tpGlobal.getTemplate=function(){return'<div class="timepicker-picker">'+'<table class="table-condensed">'+"<tr>"+'<td><a href="#" class="btn" data-action="incrementHours"><span class="'+picker.options.icons.up+'"></span></a></td>'+'<td class="separator"></td>'+"<td>"+(picker.options.useMinutes?'<a href="#" class="btn" data-action="incrementMinutes"><span class="'+picker.options.icons.up+'"></span></a>':"")+"</td>"+(picker.options.useSeconds?'<td class="separator"></td><td><a href="#" class="btn" data-action="incrementSeconds"><span class="'+picker.options.icons.up+'"></span></a></td>':"")+(picker.use24hours?"":'<td class="separator"></td>')+"</tr>"+"<tr>"+"<td>"+tpGlobal.hourTemplate+"</td> "+'<td class="separator">:</td>'+"<td>"+(picker.options.useMinutes?tpGlobal.minuteTemplate:'<span class="timepicker-minute">00</span>')+"</td> "+(picker.options.useSeconds?'<td class="separator">:</td><td>'+tpGlobal.secondTemplate+"</td>":"")+(picker.use24hours?"":'<td class="separator"></td>'+'<td><button type="button" class="btn btn-primary" data-action="togglePeriod"></button></td>')+"</tr>"+"<tr>"+'<td><a href="#" class="btn" data-action="decrementHours"><span class="'+picker.options.icons.down+'"></span></a></td>'+'<td class="separator"></td>'+"<td>"+(picker.options.useMinutes?'<a href="#" class="btn" data-action="decrementMinutes"><span class="'+picker.options.icons.down+'"></span></a>':"")+"</td>"+(picker.options.useSeconds?'<td class="separator"></td><td><a href="#" class="btn" data-action="decrementSeconds"><span class="'+picker.options.icons.down+'"></span></a></td>':"")+(picker.use24hours?"":'<td class="separator"></td>')+"</tr>"+"</table>"+"</div>"+'<div class="timepicker-hours" data-action="selectHour">'+'<table class="table-condensed"></table>'+"</div>"+'<div class="timepicker-minutes" data-action="selectMinute">'+'<table class="table-condensed"></table>'+"</div>"+(picker.options.useSeconds?'<div class="timepicker-seconds" data-action="selectSecond"><table class="table-condensed"></table></div>':"")};picker.destroy=function(){detachDatePickerEvents();detachDatePickerGlobalEvents();picker.widget.remove();picker.element.removeData("DateTimePicker");if(picker.component)picker.component.removeData("DateTimePicker")};picker.show=function(e){if(picker.options.useCurrent){if(getPickerInput().val()==""){if(picker.options.minuteStepping!==1){var mDate=pMoment(),rInterval=picker.options.minuteStepping;mDate.minutes(Math.round(mDate.minutes()/rInterval)*rInterval%60).seconds(0);picker.setValue(mDate.format(picker.format))}else{picker.setValue(pMoment().format(picker.format))}notifyChange("",e.type)}}if(picker.widget.hasClass("picker-open")){picker.widget.hide();picker.widget.removeClass("picker-open")}else{picker.widget.show();picker.widget.addClass("picker-open")}picker.height=picker.component?picker.component.outerHeight():picker.element.outerHeight();place();picker.element.trigger({type:"dp.show",date:pMoment(picker.date)});attachDatePickerGlobalEvents();if(e){stopEvent(e)}},picker.disable=function(){var input=picker.element.find("input");if(input.prop("disabled"))return;input.prop("disabled",true);detachDatePickerEvents()},picker.enable=function(){var input=picker.element.find("input");if(!input.prop("disabled"))return;input.prop("disabled",false);attachDatePickerEvents()},picker.hide=function(event){if(event&&$(event.target).is("#"+picker.element.attr("id")))return;var collapse=picker.widget.find(".collapse"),i,collapseData;for(i=0;i<collapse.length;i++){collapseData=collapse.eq(i).data("collapse");if(collapseData&&collapseData.transitioning)return}picker.widget.hide();picker.widget.removeClass("picker-open");picker.viewMode=picker.startViewMode;showMode();picker.element.trigger({type:"dp.hide",date:pMoment(picker.date)});detachDatePickerGlobalEvents()},picker.setValue=function(newDate){pMoment.locale(picker.options.language);if(!newDate){picker.unset=true;set()}else{picker.unset=false}if(!pMoment.isMoment(newDate))newDate=newDate instanceof Date?pMoment(newDate):pMoment(newDate,picker.format);if(newDate.isValid()){picker.date=newDate;set();picker.viewDate=pMoment({y:picker.date.year(),M:picker.date.month()});fillDate();fillTime()}else{notifyError(newDate)}},picker.getDate=function(){if(picker.unset)return null;return pMoment(picker.date)},picker.setDate=function(date){var oldDate=pMoment(picker.date);if(!date){picker.setValue(null)}else{picker.setValue(date)}notifyChange(oldDate,"function")},picker.setDisabledDates=function(dates){picker.options.disabledDates=indexGivenDates(dates);if(picker.viewDate)update()},picker.setEnabledDates=function(dates){picker.options.enabledDates=indexGivenDates(dates);if(picker.viewDate)update()},picker.setMaxDate=function(date){if(date==undefined)return;picker.options.maxDate=pMoment(date);if(picker.viewDate)update()},picker.setMinDate=function(date){if(date==undefined)return;picker.options.minDate=pMoment(date);if(picker.viewDate)update()};init()};$.fn.datetimepicker=function(options){return this.each(function(){var $this=$(this),data=$this.data("DateTimePicker");if(!data)$this.data("DateTimePicker",new DateTimePicker(this,options))})};$.fn.datetimepicker.defaults={pickDate:true,pickTime:true,useMinutes:true,useSeconds:false,useCurrent:true,minuteStepping:1,minDate:new pMoment({y:1900}),maxDate:(new pMoment).add(100,"y"),showToday:true,collapse:true,language:"en",defaultDate:"",disabledDates:false,enabledDates:false,icons:{},useStrict:false,direction:"auto",sideBySide:false,daysOfWeekDisabled:false,widgetParent:false}});