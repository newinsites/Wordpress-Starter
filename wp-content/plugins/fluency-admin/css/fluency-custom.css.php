<?php header('Content-type: text/css'); ?>
<?php $custom_color = strip_tags($_GET['color']); ?>

/* ---------------------------------------- */
/* ----  Custom colour specfic styles  ---- */
/* ---------------------------------------- */

/* ---- Admin Menu ---- */
#adminmenuback, #adminmenuwrap {
	background-color: #<?php echo $custom_color; ?>;
	border-color: rgba(0,0,0,0.25);
}
#adminmenu a {
	color: #EEE;
	text-shadow: 0 -1px 0 rgba(0,0,0,0.25);
}
#adminmenu a.menu-top, .folded #adminmenu li.menu-top, #adminmenu .wp-submenu .wp-submenu-head {
	border-bottom-color: rgba(0,0,0,0.25);
	border-top-color: rgba(255,255,255,0.25);
}
#adminmenu li.wp-menu-open {
	border-color: rgba(0,0,0,0.25);
}
.fluency-hover-menus #adminmenu .wp-submenu {
	-moz-box-shadow: 2px 2px 2px rgba(0,0,0,0.25);
	-webkit-box-shadow: 2px 2px 2px rgba(0,0,0,0.25);
	box-shadow: 2px 2px 2px rgba(0,0,0,0.25);
}
#adminmenu .wp-submenu ul {
	background-color: #<?php echo $custom_color; ?>;
	background-image: -moz-linear-gradient(center top , rgba(0,0,0,0.1) 5px, rgba(0,0,0,0.25) 30px);
	background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0.1,rgba(0,0,0,0.1)),color-stop(0.3,rgba(0,0,0,0.25)));
}

#adminmenu .wp-submenu ul li a {
	border-bottom-color: rgba(255,255,255,0.25);
	border-top-color: rgba(0,0,0,0.25);
}
#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, .folded #adminmenu li.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, #adminmenu .wp-menu-arrow, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head,
#adminmenu li.wp-has-submenu:hover a.wp-has-submenu, #adminmenu li:hover a.menu-top, .folded #adminmenu li.wp-has-submenu:hover, .folded #adminmenu li.menu-top:hover, #adminmenu li:hover .wp-menu-arrow, #adminmenu .wp-has-submenu:hover .wp-submenu .wp-submenu-head,
#adminmenu li.wp-has-submenu.hovered a.wp-has-submenu, #adminmenu li.hovered a.menu-top, .folded #adminmenu li.wp-has-submenu.hovered, .folded #adminmenu li.menu-top.hovered, #adminmenu li.hovered .wp-menu-arrow, #adminmenu .wp-has-submenu.hovered .wp-submenu .wp-submenu-head {
	background-color: #<?php echo $custom_color; ?>;
	background-image: -moz-linear-gradient(center top , rgba(0,0,0,0.1), rgba(0,0,0,0.25));
	background-image: -webkit-gradient(linear,left top,left bottom,from(rgba(0,0,0,0.1)),to(rgba(0,0,0,0.25)));
}
#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top, #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head,
#adminmenu li.wp-has-submenu:hover a.wp-has-submenu, #adminmenu li:hover a.menu-top, #adminmenu .wp-has-submenu:hover .wp-submenu .wp-submenu-head,
#adminmenu li.wp-has-submenu.hovered a.wp-has-submenu, #adminmenu li.hovered a.menu-top, #adminmenu .wp-has-submenu.hovered .wp-submenu .wp-submenu-head {
	border-bottom-color: rgba(0,0,0,0.25);
  border-top-color: rgba(255,255,255,0.25);
}
.fluency-hover-menus #adminmenu .wp-has-submenu:hover .wp-menu-toggle, .fluency-hover-menus #adminmenu .wp-menu-open .wp-menu-toggle,
.fluency-hover-menus #adminmenu li.wp-has-current-submenu.wp-menu-open .wp-menu-toggle, .fluency-hover-menus #adminmenu li.wp-has-current-submenu:hover .wp-menu-toggle {
	background: none;
}
#adminmenu a:hover, #adminmenu .wp-submenu li.current, #adminmenu .wp-submenu li.current a, #adminmenu .wp-submenu li.current a:hover {
	color: #FFF;
}
#adminmenu .wp-submenu a:hover {
	background-color: rgba(0,0,0,0.25) !important;
	color: #FFF !important;
	text-shadow: 0 0 5px #06C;
}
#adminmenu .wp-menu-arrow div {
	background: url("../img/menu-arrow-frame.png") no-repeat scroll right top transparent;
}
#adminmenu li.hovered .wp-menu-arrow div {
	background: url("../img/menu-arrow-frame-hover.png") no-repeat scroll right top transparent;
}
.folded #adminmenu .wp-submenu-wrap {
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	box-shadow: none;
}
.folded #adminmenu .wp-submenu-wrap, .folded #adminmenu .wp-submenu ul, .js.folded #adminmenu .wp-submenu-wrap, .js.folded #adminmenu .wp-submenu ul {
	border:0 none;
}
.js.folded #adminmenu li.wp-has-current-submenu, .js.folded #adminmenu li.current.menu-top, .js.folded #adminmenu li.hovered.menu-top {
	border-top-color: transparent;
}
#adminmenu .awaiting-mod, #adminmenu span.update-plugins, #sidemenu li a span.update-plugins {
	background: #C00;
	border:1px solid #FFF;
	-moz-box-shadow: 0 1px 2px #000;
	-webkit-box-shadow: 0 1px 2px #000;
	box-shadow: 0 1px 2px #000;
	text-shadow: 0 -1px 0 #900;
}
#collapse-menu { /* not required in fresh/classic */
	color: rgba(255,255,255,0.5);
}
#collapse-menu:hover { /* not required in fresh/classic */
	color: rgba(255,255,255,0.8);
}
#collapse-button {
	border-color: rgba(0,0,0,0.25);
	background-color: #<?php echo $custom_color; ?>; /* Fallback */
	background-image: -ms-linear-gradient(bottom, rgba(0,0,0,0.25), rgba(0,0,0,0.1)); /* IE10 */
	background-image: -moz-linear-gradient(bottom, rgba(0,0,0,0.25), rgba(0,0,0,0.1)); /* Firefox */
	background-image: -o-linear-gradient(bottom, rgba(0,0,0,0.25), rgba(0,0,0,0.1)); /* Opera */
	background-image: -webkit-gradient(linear, left bottom, left top, from(rgba(0,0,0,0.25)), to(rgba(0,0,0,0.1))); /* old Webkit */
	background-image: -webkit-linear-gradient(bottom, rgba(0,0,0,0.25), rgba(0,0,0,0.1)); /* new Webkit */
	background-image: linear-gradient(bottom, rgba(0,0,0,0.25), rgba(0,0,0,0.1)); /* proposed W3C Markup */
}
#collapse-menu:hover #collapse-button {
	border-color: rgba(0,0,0,0.5);
}

/* Tables */
.widefat tr.status-draft {
	background-color: #FFF9F0;
}
.widefat tr.status-draft a {
	color: #999;
}
.widefat th a {
	color: #464646;
}
.widefat th a:hover {
	color: #06C;
}
.fixed td.column-date {
	color: #999;
}
.fixed td.column-date abbr {
	color: #555;
}
table.form-table tr.even {
	background: #F6F6F6;
}

/* Row Actions */
.row-actions span a {
	border-color: #DDD;
	background-image: -moz-linear-gradient(center top , #FFF, #EEE);
	background-image: -webkit-gradient(linear,left top,left bottom,from(#FFF),to(#EEE));
}
.row-actions span a:hover {
	background: #06C;
	color: #FFF;
}
.row-actions span.approve a:hover {
	background: #006505;
}
.row-actions span.unapprove a:hover {
	background: #D98500;
}
.row-actions span.spam a:hover, .row-actions span.trash a:hover {
	background: #C00;
	color: #FFF;
}
#the-comment-list .comment .row-actions span a:hover {
	color: #FFF;
}

/* SubSubSub */
.subsubsub li {
	color: transparent;
}
.subsubsub li a {
	border-color: #DDD;
	background-image: -moz-linear-gradient(center top , #FFF, #EEE);
	background-image: -webkit-gradient(linear,left top,left bottom,from(#FFF),to(#EEE));
}
.subsubsub li a.current {
	border-color: #999;
	background-image: -moz-linear-gradient(center top , #EEE, #CCC);
	background-image: -webkit-gradient(linear,left top,left bottom,from(#EEE),to(#CCC));
}
.subsubsub li a:hover, .subsubsub li a.current:hover {
	background: #06C;
	color: #FFF;
}
.subsubsub li.spam a:hover, .subsubsub li.trash a:hover {
	background: #C00;
	color: #FFF;
}
.subsubsub li a .count {
	background: #FFF;
	background-image: -moz-linear-gradient(center top , #EEE, #FFF);
	background-image: -webkit-gradient(linear,left top,left bottom,from(#EEE),to(#FFF));
	color: #333;
}
.subsubsub li a.current .count {
	background: #EEE;
	background-image: -moz-linear-gradient(center top , #CCC, #EEE);
	background-image: -webkit-gradient(linear,left top,left bottom,from(#CCC),to(#EEE));
	color: #333;
}
.subsubsub li a:hover .count {
	background: #FFF;
	color: #06C;
}
.subsubsub li.spam a:hover .count, .subsubsub li.trash a:hover .count {
	background: #FFF;
	color: #C00;
}
#dashboard_recent_comments .delete a:hover, #dashboard_recent_comments .trash a:hover, #dashboard_recent_comments .spam a:hover {
	color: #FFF;
}
#dashboard_recent_comments .subsubsub {
	border-color: #DDD;
	background-image: -moz-linear-gradient(center top, #ECECEC, #F9F9F9);
	background-image: -webkit-gradient(linear,left top,left bottom,from(#ECECEC),to(#F9F9F9));
}

/* ---- Forms ---- */
.form-wrap form div.form-field.even {
	background: #F6F6F6;
}
textarea:hover, input[type="text"]:hover, input[type="password"]:hover, input[type="file"]:hover, select:hover,
#titlediv #title:hover, #postcustomstuff table input:hover, #postcustomstuff table textarea:hover {
	border-color: #9BF;
}
textarea:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="file"]:focus, select:focus,
#titlediv #title:focus, #postcustomstuff table input:focus, #postcustomstuff table textarea:focus {
	border-color: #06C;
	-moz-box-shadow: 0 0 6px rgba(0,100,200,0.25);
	-webkit-box-shadow: 0 0 6px rgba(0,100,200,0.25);
	box-shadow: 0 0 6px rgba(0,100,200,0.25);
}
#wp-fullscreen-wrap input:focus, #wp-fullscreen-wrap textarea:focus {
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	box-shadow: none;
}