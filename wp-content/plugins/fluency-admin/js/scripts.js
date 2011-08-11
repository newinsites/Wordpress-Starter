/* ---------------------------------------------------- */
/* ----  Menu - Based on core scripts - common.js  ---- */
/* ---------------------------------------------------- */

var fluencyAdminMenu;
var fluencyKeys;

(function($){

	// Zebra striping for form-table
	$('table.form-table tr:nth-child(2n-1),.form-wrap form div.form-field:nth-child(2n-1)').addClass('even');
	$('table.form-table tr:nth-child(2n),.form-wrap form div.form-field:nth-child(2n)').addClass('odd');

	// Only needed on Fluency Admin settgins page
	$('#fluency_admin_drop_down_off,#fluency_admin_drop_down_single,#fluency_admin_drop_down_multiple').change(function(){
		if($(this).val()==0) {
			$('#fluency_hide_menu_off').attr('checked','checked').attr('disabled','true');
			$('#fluency_hide_menu_on').attr('disabled','true');
		} else {
			$('#fluency_hide_menu_off,#fluency_hide_menu_on').removeAttr('disabled');
		}
	});

	// Fixes Akismet iFrame size when accessed from Comments menu.
	$('body.comments_page_akismet-stats-display #akismet-stats-frame').load(function(){
		var height = document.documentElement.clientHeight;
		height -= document.getElementById('akismet-stats-frame').offsetTop;
		height += 100; // magic padding
		document.getElementById('akismet-stats-frame').style.height = height +"px";
	});

	$('#wp-admin-bar-wp-fluency-unhide-menu a').click(function(event){
		event.preventDefault();
		if($(this).parent().hasClass('unhidden')) {
			$('body').addClass('admin_menu_hidden');
			$(this).text('Unhide Menu').parent().removeClass('unhidden');
		} else {
			$('body').removeClass('admin_menu_hidden');
			$(this).text('Hide Menu').parent().addClass('unhidden');
		}
	});

	// sidebar admin menu
	fluencyAdminMenu = {
		init : function() {
			var menu = $('#adminmenu');

			this.favorites();

			$('#collapse-menu', menu).click(function(){
				if ( $('body').hasClass('folded') ) {
					fluencyAdminMenu.fold(1);
					deleteUserSetting( 'mfold' );
				} else {
					fluencyAdminMenu.fold();
					setUserSetting( 'mfold', 'f' );
				}
				return false;
			});

			// Force closed any expanded menus
			$('li.wp-has-submenu', '#adminmenu').each(function(i, e) {
				setUserSetting( 'm'+i, 'c' );
				$(this).removeClass('wp-menu-open').children('a').removeClass('wp-menu-open');
			});
			// Hover menus
			$('#adminmenu li.wp-has-submenu').hoverIntent({
				over: function(e){
					var m, b, h, o, f;
					m = $(this).find('.wp-submenu');
					b = $(this).offset().top + m.height() + 1; // Bottom offset of the menu
					h = $('#wpwrap').height(); // Height of the entire page
					o = 60 + b - h;
					f = $(window).height() + $(window).scrollTop() - 15; // The fold
					if ( f < (b - o) ) {
						o = b - f;
					}
					if ( o > 1 ) {
						m.css({'marginTop':'-'+o+'px'});
					} else if ( m.css('marginTop') ) {
						m.css({'marginTop':''});
					}
					m.addClass('sub-open').addClass('fly-out');
					$(this).addClass('hovered');
				},
				out: function(){
					$(this).find('.wp-submenu').removeClass('sub-open').css({'marginTop':''}).removeClass('fly-out');
					$(this).removeClass('hovered');
				},
				timeout: 220,
				sensitivity: 8,
				interval: 100
			});
			// End hover menus

			if ( $('body').hasClass('folded') )
				this.fold();
		},

		restoreMenuState : function() {
			// (perhaps) needed for back-compat
		},

		toggle : function(el) {
			el.slideToggle(150, function() {
				var id = el.removeAttr('style').parent().toggleClass( 'wp-menu-open' ).attr('id');
				if ( id ) {
					$('li.wp-has-submenu', '#adminmenu').each(function(i, e) {
						if ( id == e.id ) {
							var v = $(e).hasClass('wp-menu-open') ? 'o' : 'c';
							setUserSetting( 'm'+i, v );
						}
					});
				}
			});

			return false;
		},

		fold : function(off) {
			if (off) {
				$('body').removeClass('folded');
			} else {
				$('body').addClass('folded');
			}
		},

		favorites : function() {
			$('#favorite-inside').width( $('#favorite-actions').width() - 4 );
			$('#favorite-toggle, #favorite-inside').bind('mouseenter', function() {
				$('#favorite-inside').removeClass('slideUp').addClass('slideDown');
				setTimeout(function() {
					if ( $('#favorite-inside').hasClass('slideDown') ) {
						$('#favorite-inside').slideDown(100);
						$('#favorite-first').addClass('slide-down');
					}
				}, 200);
			}).bind('mouseleave', function() {
				$('#favorite-inside').removeClass('slideDown').addClass('slideUp');
				setTimeout(function() {
					if ( $('#favorite-inside').hasClass('slideUp') ) {
						$('#favorite-inside').slideUp(100, function() {
							$('#favorite-first').removeClass('slide-down');
						});
					}
				}, 300);
			});
		}
	};

	var farbtastic;

	fluencyFarbtastic = {

		init:function() {

			$(document).ready(function() {

				$('#fluency_custom_color').click(function() {
					$('#fluency_colorPickerDiv').show();
					return false;
				});

				$('#fluency_resetcolor').click(function(event) {
					event.preventDefault();
					$('#fluency_custom_color').val('#');
					$('#fluency_color_sample').css('background-color','#262626');
					return false;
				});

				$('#fluency_custom_color').keyup(function() {
					var _hex = $('#fluency_custom_color').val(), hex = _hex;
					if ( hex.charAt(0) != '#' )
						hex = '#' + hex;
					hex = hex.replace(/[^#a-fA-F0-9]+/, '');
					if ( hex != _hex )
						$('#fluency_custom_color').val(hex);
					if ( hex.length == 4 || hex.length == 7 )
						fluencyFarbtastic.pickColor( hex );
				});

				farbtastic = jQuery.farbtastic('#fluency_colorPickerDiv', function(color) {
					fluencyFarbtastic.pickColor(color);
				});
				fluencyFarbtastic.pickColor($('#fluency_custom_color').val());

				$(document).mousedown(function(){
					$('#fluency_colorPickerDiv').each(function(){
						var display = $(this).css('display');
						if ( display == 'block' )
							$(this).fadeOut(2);
					});
				});
			});

		},

		pickColor:function(color) {
			farbtastic.setColor(color);
			$('#fluency_custom_color').val(color);
			$('#fluency_color_sample').css('background-color',color);
		}

	};

	fluencyKeys = {

		init:function() {

			var menu_items = new Array();
			menu_items['menu-dashboard'] = 'D';
			menu_items['menu-posts'] = 'P';
			menu_items['menu-media'] = 'M';
			menu_items['menu-links'] = 'L';
			menu_items['menu-pages'] = 'g';
			menu_items['menu-comments'] = 'C';
			menu_items['menu-appearance'] = 'A';
			menu_items['menu-plugins'] = 'n';
			menu_items['menu-users'] = 'U';
			menu_items['menu-tools'] = 'T';
			menu_items['menu-settings'] = 'S';

			$("#adminmenu li a.wp-has-submenu").each(function(){
				var match_this = menu_items[$(this).parent().attr('id')];
				var chars = $(this).html().split('');
				for(x=0; x<chars.length; x++) {
					if(chars[x]==match_this) {
						chars[x] = '<u>'+chars[x]+'</u>';
						break;
					}
				}
				$(this).html(chars.join(''));
			});

			var cc = new Array();
			cc[0] = $('li#menu-dashboard div.wp-submenu ul li'); // d
			cc[1] = $('li#menu-posts div.wp-submenu ul li'); // p
			cc[2] = $('li#menu-pages div.wp-submenu ul li'); // g
			cc[3] = $('li#menu-media div.wp-submenu ul li'); // m
			cc[4] = $('li#menu-links div.wp-submenu ul li'); // l
			cc[5] = $('li#menu-comments div.wp-submenu ul li'); // c
			cc[6] = $('li#menu-appearance div.wp-submenu ul li'); // a
			cc[7] = $('li#menu-plugins div.wp-submenu ul li'); // n
			cc[8] = $('li#menu-users div.wp-submenu ul li'); // u
			cc[9] = $('li#menu-tools div.wp-submenu ul li'); // t
			cc[10] = $('li#menu-settings div.wp-submenu ul li'); // s

			var keyArray = new Array('1','2','3','4','5','6','7','8','9','B','E','F','H','I','J','K','O','Q','R','V','W','X','Y','Z');

			for(yy=0;yy<cc.length;yy++){
				var xx = 0;
				$(cc[yy]).each(function(){
					if(keyArray[xx]){
						$(this).children('a').append("<u>"+keyArray[xx]+"</u>");
					}
					xx = xx+1;
				});
			}

			var ik = "";
			var i = "";
			var gk = '';

			$(document).keydown(function(event) {

				if(event.shiftKey || event.metaKey || event.ctrlKey || event.altKey) { return true; }

				var el = event.target.tagName;
				var ek = event.which;
				switch(ek){
					case 68: i = $('li#menu-dashboard'); ik = "d"; break; // d
					case 80: i = $('li#menu-posts'); ik = "p"; break; // p
					case 71: i = $('li#menu-pages'); ik = "g"; break; // g
					case 77: i = $('li#menu-media'); ik = "m"; break; // m
					case 76: i = $('li#menu-links'); ik = "l"; break; // l
					case 67: i = $('li#menu-comments'); ik = "c"; break; // c
					case 65: i = $('li#menu-appearance'); ik = "a"; break; // a
					case 78: i = $('li#menu-plugins'); ik = "n"; break; // n
					case 85: i = $('li#menu-users'); ik = "u"; break; // u
					case 84: i = $('li#menu-tools'); ik = "t"; break; // t
					case 83: i = $('li#menu-settings'); ik = "s"; break; // s
				}
				var fk = ek-49;
				if( el == 'INPUT' || el == 'TEXTAREA' ){
					return true;
				} else if(fk>=0 && fk<42) {
					if(fk>15){
						switch(fk){
							case 17: gk = 9; break; // B
							case 20: gk = 10; break; // E
							case 21: gk = 11; break; // F
							case 23: gk = 12; break; // H
							case 24: gk = 13; break; // I
							case 25: gk = 14; break; // J
							case 26: gk = 15; break; // K
							case 30: gk = 16; break; // O
							case 32: gk = 17; break; // Q
							case 33: gk = 18; break; // R
							case 37: gk = 19; break; // V
							case 38: gk = 20; break; // W
							case 39: gk = 21; break; // X
							case 40: gk = 22; break; // Y
							case 41: gk = 23; break; // Z
						}
					} else {
						gk = fk;
					}
					switch(ik){
						case "d": var d = $('li#menu-dashboard div.wp-submenu ul li a'); break;
						case "p": var d = $('li#menu-posts div.wp-submenu ul li a'); break;
						case "g": var d = $('li#menu-pages div.wp-submenu ul li a'); break;
						case "m": var d = $('li#menu-media div.wp-submenu ul li a'); break;
						case "l": var d = $('li#menu-links div.wp-submenu ul li a'); break;
						case "c": var d = $('li#menu-comments div.wp-submenu ul li a'); break;
						case "a": var d = $('li#menu-appearance div.wp-submenu ul li a'); break;
						case "n": var d = $('li#menu-plugins div.wp-submenu ul li a'); break;
						case "u": var d = $('li#menu-users div.wp-submenu ul li a'); break;
						case "t": var d = $('li#menu-tools div.wp-submenu ul li a'); break;
						case "s": var d = $('li#menu-settings div.wp-submenu ul li a'); break;
					}
					if(dd=$(d[gk]).get(0)){ window.location=dd.href; }
				}

				if( el == 'INPUT' || el == 'TEXTAREA' || el == 'SELECT' ){
					return true;
				} else if(i) {
					if($('body').hasClass('fluency-hover-menus')) {
						if(i.children('div.wp-submenu').hasClass('sub-open')) {
							var ul = i.children('div.wp-submenu').removeClass('sub-open').removeClass('fly-out');
						} else if(i.children('div.wp-submenu').length != 0) {
							$('#adminmenu li.wp-has-submenu.hovered').removeClass('hovered').children('div.wp-submenu').removeClass('sub-open').removeClass('fly-out');
							var ul = i.children('div.wp-submenu').addClass('sub-open').addClass('fly-out');
						} else {
							if(dd=i.children('a').attr('href')){ window.location=dd; }
						}
						i.toggleClass('hovered');
					} else {
						// if(i.hasClass('wp-menu-open')) {
						// 	var ul = i.children('div.wp-submenu').removeClass('sub-open').removeClass('fly-out');
						// } else if(i.children('div.wp-submenu').length != 0) {
						// 	$('#adminmenu li.wp-has-submenu.hovered').removeClass('hovered').children('div.wp-submenu').removeClass('sub-open').removeClass('fly-out');
						// 	var ul = i.children('div.wp-submenu').addClass('sub-open').addClass('fly-out');
						// } else {
						// 	if(dd=i.children('a').attr('href')){ window.location=dd; }
						// }
						i.toggleClass('wp-menu-open');
					}
					return false;
				} else {
					return true;
				}

			});

		}

	};

})(jQuery);