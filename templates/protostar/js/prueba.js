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
            var i = DOM.get("dest_uri").value, s;
            i && !i.match(/^\/login\/?/) ? s = t.security_token + i : s = t.redirect;
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
var FADE_DURATION = .45, FADE_DELAY = 20, AJAX_TIMEOUT = 3e4, LOCALE_FADES = [], HAS_CSS_OPACITY = "opacity"in document.body.style, login_form = DOM.get("login_form"), login_username_el = DOM.get("user"), login_password_el = DOM.get("pass"), login_submit_el = DOM.get("login_submit"), div_cache = {"login-page": DOM.get("login-page") || !1, "locale-container": DOM.get("locale-container") || !1, "login-container": DOM.get("login-container") || !1, "locale-footer": DOM.get("locale-footer") || !1, "content-cell": DOM.get("content-container") || !1, invalid: DOM.get("invalid") || !1}, content_cell = div_cache["content-cell"];
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
    }, new_script.src = "/unprotected/json-minified.js", document.getElementsByTagName("head")[0].appendChild(new_script)
}
try {
    login_form.onsubmit = do_login, set_opacity(DOM.get("login-wrapper"), 0), LOCALE_FADES.push(fade_in("login-wrapper"));
    var preload = document.createElement("div");
    preload.id = "preload_images", document.body.insertBefore(preload, document.body.firstChild), window.IS_LOGOUT ? set_status_timeout(1e4) : /(?:\?|&)locale=[^&]/.test(location.search) && show_status(MESSAGES.session_locale), setTimeout(function() {
        login_username_el.focus()
    }, 100)
} catch (e) {
    window.console && console.warn(e)
}
;