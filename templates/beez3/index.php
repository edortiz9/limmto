<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript('templates/' .$this->template. '/js/template.js');

// Add Stylesheets
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Add current user information
$user = JFactory::getUser();

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="'. JUri::root() . $this->params->get('logoFile') .'" alt="'. $sitename .'" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="'. $sitename .'">'. htmlspecialchars($this->params->get('sitetitle')) .'</span>';
}
else
{
	$logo = '<span class="site-title" title="'. $sitename .'">'. $sitename .'</span>';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<?php
	// Use of Google Font
	if ($this->params->get('googleFont'))
	{
	?>
		<link href='//fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFontName');?>' rel='stylesheet' type='text/css' />
		<style type="text/css">
			h1,h2,h3,h4,h5,h6,.site-title{
				font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFontName'));?>', sans-serif;
			}
		</style>
	<?php
	}
	?>
	<?php
	// Template color
	if ($this->params->get('templateColor'))
	{
	?>
	<style type="text/css">
		body.site
		{
			border-top: 3px solid <?php echo $this->params->get('templateColor');?>;
			background-color: <?php echo $this->params->get('templateBackgroundColor');?>
		}
		a
		{
			color: <?php echo $this->params->get('templateColor');?>;
		}
		.navbar-inner, .nav-list > .active > a, .nav-list > .active > a:hover, .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover, .nav-pills > .active > a, .nav-pills > .active > a:hover,
		.btn-primary
		{
			background: <?php echo $this->params->get('templateColor');?>;
		}
		.navbar-inner
		{
			-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
		}
	</style>
	<?php
	}
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo $this->baseurl ?>/media/jui/js/html5.js"></script>
	<![endif]-->
    <script>
    window.DOM = { get: function(id) { return document.getElementById(id) } };
    </script>        
</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
?>">
	<!-- Body -->
	<div class="body">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : '');?>">
			<!-- Header -->
			<header class="header" role="banner">
				<div class="header-inner clearfix">
				</div>
			</header>
			<?php if ($this->countModules('position-1')) : ?>
			<nav class="navigation" role="navigation">
				<jdoc:include type="modules" name="position-1" style="none" />
			</nav>
			<?php endif; ?>
                        <jdoc:include type="message" />
			<jdoc:include type="modules" name="banner" style="xhtml" />
			<div class="row-fluid">
                                
				<?php if ($this->countModules('position-8')) : ?>
				<!-- Begin Sidebar -->
				<div id="sidebar" class="span3">
					<div class="sidebar-nav">
						<jdoc:include type="modules" name="position-8" style="xhtml" />
					</div>
				</div>
				<!-- End Sidebar -->
				<?php endif; ?>
				<main id="content" role="main" class="<?php echo $span;?>">
					<!-- Begin Content -->
					<jdoc:include type="modules" name="position-3" style="xhtml" />
					<jdoc:include type="component" />
					<jdoc:include type="modules" name="position-2" style="none" />
					<!-- End Content -->
                                <!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->        
				</main>
				<?php if ($this->countModules('position-7')) : ?>
				<div id="aside" class="span3">
					<!-- Begin Right Sidebar -->
					<jdoc:include type="modules" name="position-7" style="well" />
					<!-- End Right Sidebar -->
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : '');?>">

			<jdoc:include type="modules" name="footer" style="none" />
			<p class="copyright">
				Copyright &copy; <?php echo date('Y');?> Limpieza Metroplolitana S.A. E.S.P LIME
			</p>
		</div>
	</footer>
        <div class="locale-container" id="locale-container"></div>
        <div id="locale-footer" ></div>
	<jdoc:include type="modules" name="debug" style="none" />
<script>
    // Homerolled.   We're not logged in and don't have access to cjt and yui.

        var MESSAGES = {
            "ajax_timeout" : "El tiempo de conexión. Por favor, inténtelo de nuevo.",
            "authenticating" : "Autenticar ...",
            "changed_ip" : "Tu dirección IP ha cambiado. Por favor, acceda de nuevo.",
            "expired_session" : "Su sesión ha caducado. Por favor, acceda de nuevo.",
            "invalid_login" : "El inicio de sesión no es válida.",
            "invalid_session" : "Su cookie de sesión no es válida. Por favor, acceda de nuevo.",
            "invalid_username" : "El nombre de usuario presentado no es válido.",
            "network_error" : "Un error de red al envío de su solicitud de inicio de sesión. Por favor, inténtelo de nuevo. Si el problema persiste, póngase en contacto con su proveedor de servicios de red.",
            "no_username" : "Debe especificar un nombre de usuario para iniciar sesión.",
            "prevented_xfer" : "La sesión no podía ser transferido porque no se accede a este servicio a través de una conexión segura. Por favor, iniciar sesión ahora para continuar.",
            "session_locale" : "The desired locale has been saved to your browser. To change the locale in this browser again, select another locale on this screen.",
            "success" : "Inicio de sesión correcto. Redireccionando ...",
            "token_incorrect" : "El token de seguridad en su solicitud no es válida.",
            "token_missing" : "El token de seguridad se encuentra en su solicitud.",
            "": 0
    };
    delete MESSAGES[""];

    window.IS_LOGOUT = true;
    "use strict";

function toggle_locales(e){
    while(LOCALE_FADES.length)clearInterval(LOCALE_FADES.shift());
    var t=div_cache[e?"locale-container":"content"];
    set_opacity(t,0);
    if(HAS_CSS_OPACITY)content_cell.replaceChild(t,content_cell.children[0]);
    else{var n=content_cell.children[0];content_cell.insertBefore(t,n),t.style.display="",n.style.display="none"}
    LOCALE_FADES.push(fade_in(t)),LOCALE_FADES.push((e?fade_out:fade_in)("locale-footer"))
}    

function fade_in(e, t, n) {
    e = div_cache[e] || DOM.get(e) || e;
    var r = e.style, i, s = window.getComputedStyle ? getComputedStyle(e, null) : e.currentStyle, o = s.visibility, u;
    if (e.offsetWidth && o !== "hidden") {
        if (window.getComputedStyle)
            u = Number(s.opacity);
        else {
            try {
                u = e.filters.item("DXImageTransform.Microsoft.Alpha").opacity
            } catch (a) {
                try {
                    u = e.filters("alpha").opacity
                } catch (a) {
                    u = 100
                }
            }
            u /= 100
        }
        u || (u = 0)
    } else
        u = 0, set_opacity(e, 0);
    if (n && u < .01) {
        u && set_opacity(e, 0);
        return
    }
    t || (t = FADE_DURATION);
    var f = t * 1e3, l = new Date, c;
    n ? c = f + l.getTime() : r.visibility = "visible";
    var h = function() {
        var t;
        n ? (t = u * (c - new Date) / f, t <= 0 && (t = 0, clearInterval(i), r.visibility = "hidden")) : (t = u + (1 - u) * (new Date - l) / f, t >= 1 && (t = 1, clearInterval(i))), set_opacity(e, t)
    };
    return h(), i = setInterval(h, FADE_DELAY), i
}
function fade_out(e, t) {
    return fade_in(e, t, !0)
}
function ajaxObject(e, t) {
    this._url = e, this._callback = t || function() {
    }
}
function login_results(e) {
    var t;
    try {
        t = JSON.parse(e && e.responseText)
    } catch (n) {
        t = null
    }
    var r = e.status;
    if (r === 200) { 
        show_status(MESSAGES.success,"success"),fade_out("content-container",FADE_DURATION/2);
        if (t) {
            if (/^(?:\/cpsess[^\/]+)\/$/.test(s))
                top.location.href = s;
            else {
                if (t.security_token && top !== window)
                    for (var o = 0; o < top.frames.length; o++)
                        if (top.frames[o] !== window) {
                            var u = top.frames[o].location.href.replace(/\/cpsess[.\d]+/, t.security_token);
                            top.frames[o].location.href = u
                        }
                location.href = s
            }
        } else
            login_form.submit();
        return
    }
    if (parseInt(r / 100, 10) === 4) {
        var a = t && t.message;
        show_status(MESSAGES[a || "invalid_login"] || MESSAGES.invalid_login, "error"), set_status_timeout()
    } else
        show_status(MESSAGES.network_error, "error");
    show_links(document.body), login_button.release();
    return
}
function show_status(e, t) {
    DOM.get("login-status-message")[_text_content] = e;
    var n = DOM.get("login-status"), r = t && level_classes[t] || level_classes.info, i = n.className.replace(levels_regex, r);
    n.className = i, fade_in(n), reset_status_timeout()
}
function reset_status_timeout() {
    clearTimeout(STATUS_TIMEOUT), STATUS_TIMEOUT = null
}
function set_status_timeout(e) {
    STATUS_TIMEOUT = setTimeout(function() {
        fade_out("login-status")
    }, e || 8e3)
}
function do_login() {
    if (LOGIN_SUBMIT_OK) {
        LOGIN_SUBMIT_OK = !1, hide_links(document.body), login_button.suppress(), show_status(MESSAGES.authenticating, "info");
        var e = new ajaxObject(login_form.action, login_results);
        e.update("user=" + encodeURIComponent(login_username_el.value) + "&pass=" + encodeURIComponent(login_password_el.value), "POST")
    }
    return!1
}
function _set_links_style(e, t, n) {
    var r = e.getElementsByTagName("a");
    for (var i = r.length - 1; i >= 0; i--)
        r[i].style[t] = n
}
function hide_links(e) {
    _set_links_style(e, "visibility", "hidden")
}
function show_links(e) {
    _set_links_style(e, "visibility", "")
}
var FADE_DURATION = .45, FADE_DELAY = 20, AJAX_TIMEOUT = 3e4, LOCALE_FADES = [], HAS_CSS_OPACITY = "opacity" in document.body.style, login_form = DOM.get("login_form"), login_username_el = DOM.get("username"), login_password_el = DOM.get("password"), login_submit_el = DOM.get("login_submit"), div_cache = {"login-page": DOM.get("login-page") || !1,  "content-cell": DOM.get("content-container") || !1, invalid: DOM.get("invalid") || !1}, content_cell = div_cache["content-cell"];
div_cache["locale-footer"] && (div_cache["locale-footer"].style.display = "block");
var reset_form = DOM.get("reset_form"), reset_username_el = DOM.get("reset_pass_username"), RESET_FADES = [], show_reset = function() {
    reset_username_el.value || (reset_username_el.value = login_username_el.value);
    while (RESET_FADES.length)
        clearInterval(RESET_FADES.shift());
    RESET_FADES.push(fade_in(reset_form)), RESET_FADES.push(fade_out(login_form)), reset_username_el.focus()
}, hide_reset = function() {
    while (RESET_FADES.length)
        clearInterval(RESET_FADES.shift());
    RESET_FADES.push(fade_in(login_form)), RESET_FADES.push(fade_out(reset_form)), login_username_el.focus()
};
if (HAS_CSS_OPACITY)
    var set_opacity = function(t, n) {
        t.style.opacity = n
    };
else
    var filter_regex = /(DXImageTransform\.Microsoft\.Alpha\()[^)]*\)/, set_opacity = function(t, n) {
    var r = t.currentStyle.filter;
    if (!r)
        t.style.filter = "progid:DXImageTransform.Microsoft.Alpha(enabled=true)";
    else if (!filter_regex.test(r))
        t.style.filter += " progid:DXImageTransform.Microsoft.Alpha(enabled=true)";
    else {
        var i = r.replace(filter_regex, "$1enabled=true)");
        i !== r && (t.style.filter = i)
    }
    try {
        t.filters.item("DXImageTransform.Microsoft.Alpha").opacity = n * 100
    } catch (s) {
        try {
            t.filters.item("alpha").opacity = n * 100
        } catch (s) {
        }
    }
};
ajaxObject.prototype.updating = !1, ajaxObject.prototype.abort = function() {
    this.updating && (this.AJAX.abort(), delete this.AJAX)
}, ajaxObject.prototype.update = function(e, t) {
    if (this.AJAX)
        return!1;
    var n = null;
    if (window.XMLHttpRequest)
        n = new XMLHttpRequest;
    else {
        if (!window.ActiveXObject)
            return!1;
        n = new ActiveXObject("Microsoft.XMLHTTP")
    }
    var r, i = this;
    n.onreadystatechange = function() {
        n.readyState == 4 && (clearTimeout(r), i.updating = !1, i._callback(n), delete i.AJAX)
    };
    try {
        var s;
        r = setTimeout(function() {
            i.abort(), show_status(MESSAGES.ajax_timeout, "error")
        }, AJAX_TIMEOUT), /post/i.test(t) ? (s = this._url + "?login_only=1", n.open("POST", s, !0), n.setRequestHeader("Content-type", "application/x-www-form-urlencoded"), n.send(e)) : (s = this._url + "?" + e + "&timestamp=" + (new Date).getTime(), n.open("GET", s, !0), n.send(null)), this.AJAX = n, this.updating = !0
    } catch (o) {
        login_form.submit()
    }
    return!0
};
var _text_content = "textContent"in document.body ? "textContent" : "innerText", level_classes = {info: "info-notice", error: "error-notice", success: "success-notice", warn: "warn-notice"}, levels_regex = "";
for (var lv in level_classes)
    levels_regex += "|" + level_classes[lv];
levels_regex = new RegExp("\\b(?:" + levels_regex.slice(1) + ")\\b");
var STATUS_TIMEOUT = null, LOGIN_SUBMIT_OK = !0;
document.body.onkeyup = function() {
    LOGIN_SUBMIT_OK = !0
}, document.body.onmousedown = function() {
    LOGIN_SUBMIT_OK = !0
};
var login_button = {button: login_submit_el, _suppressed_disabled: null, suppress: function() {
        this._suppressed_disabled === null && (this._suppressed_disabled = this.button.disabled, this.button.disabled = !0)
    }, release: function() {
        this._suppressed_disabled !== null && (this.button.disabled = this._suppressed_disabled, this._suppressed_disabled = null)
    }, queue_disabled: function(e) {
        this._suppressed_disabled === null ? this.button.disabled = e : this._suppressed_disabled = e
    }};
if (!window.JSON) {
    login_button.suppress();
    var new_script = document.createElement("script");
    new_script.onreadystatechange = function() {
        if (this.readyState === "loaded" || this.readyState === "complete")
            this.onreadystatechange = null, window.JSON = {parse: window.jsonParse}, window.jsonParse = undefined, login_button.release()
    }, new_script.src = "/json-minified.js", document.getElementsByTagName("head")[0].appendChild(new_script)
}
try {
    login_form.onsubmit = do_login, set_opacity(DOM.get("body"), 0), 
    LOCALE_FADES.push(fade_in("body"));
    var preload = document.createElement("div");
    preload.id = "preload_images", document.body.insertBefore(preload, document.body.firstChild), window.IS_LOGOUT ? set_status_timeout(1e4) : /(?:\?|&)locale=[^&]/.test(location.search) && show_status(MESSAGES.session_locale), setTimeout(function() {
        login_username_el.focus()
    }, 100)
} catch (e) {
    window.console && console.warn(e)
}
;
</script>
</body>
</html>
