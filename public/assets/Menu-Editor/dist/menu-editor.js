/**!
 * MenuEditor 1.1.0
 * 
 * if you need to show edit button go 1328 no line 
 * 
 * @author  David Tomas Ticona Saravia
 * @license MIT
 */
var Xe = Object.defineProperty;
var He = (i, t, e) => t in i ? Xe(i, t, { enumerable: !0, configurable: !0, writable: !0, value: e }) : i[t] = e;
var D = (i, t, e) => (He(i, typeof t != "symbol" ? t + "" : t, e), e);
/**!
 * Sortable 1.15.0
 * @author	RubaXa   <trash@rubaxa.org>
 * @author	owenm    <owen23355@gmail.com>
 * @license MIT
 */
function he(i, t) {
  var e = Object.keys(i);
  if (Object.getOwnPropertySymbols) {
    var n = Object.getOwnPropertySymbols(i);
    t && (n = n.filter(function(o) {
      return Object.getOwnPropertyDescriptor(i, o).enumerable;
    })), e.push.apply(e, n);
  }
  return e;
}
function W(i) {
  for (var t = 1; t < arguments.length; t++) {
    var e = arguments[t] != null ? arguments[t] : {};
    t % 2 ? he(Object(e), !0).forEach(function(n) {
      Ye(i, n, e[n]);
    }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(i, Object.getOwnPropertyDescriptors(e)) : he(Object(e)).forEach(function(n) {
      Object.defineProperty(i, n, Object.getOwnPropertyDescriptor(e, n));
    });
  }
  return i;
}
function Mt(i) {
  "@babel/helpers - typeof";
  return typeof Symbol == "function" && typeof Symbol.iterator == "symbol" ? Mt = function(t) {
    return typeof t;
  } : Mt = function(t) {
    return t && typeof Symbol == "function" && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t;
  }, Mt(i);
}
function Ye(i, t, e) {
  return t in i ? Object.defineProperty(i, t, {
    value: e,
    enumerable: !0,
    configurable: !0,
    writable: !0
  }) : i[t] = e, i;
}
function Z() {
  return Z = Object.assign || function(i) {
    for (var t = 1; t < arguments.length; t++) {
      var e = arguments[t];
      for (var n in e)
        Object.prototype.hasOwnProperty.call(e, n) && (i[n] = e[n]);
    }
    return i;
  }, Z.apply(this, arguments);
}
function Ge(i, t) {
  if (i == null)
    return {};
  var e = {}, n = Object.keys(i), o, r;
  for (r = 0; r < n.length; r++)
    o = n[r], !(t.indexOf(o) >= 0) && (e[o] = i[o]);
  return e;
}
function Re(i, t) {
  if (i == null)
    return {};
  var e = Ge(i, t), n, o;
  if (Object.getOwnPropertySymbols) {
    var r = Object.getOwnPropertySymbols(i);
    for (o = 0; o < r.length; o++)
      n = r[o], !(t.indexOf(n) >= 0) && Object.prototype.propertyIsEnumerable.call(i, n) && (e[n] = i[n]);
  }
  return e;
}
var ze = "1.15.0";
function U(i) {
  if (typeof window < "u" && window.navigator)
    return !!/* @__PURE__ */ navigator.userAgent.match(i);
}
var $ = U(/(?:Trident.*rv[ :]?11\.|msie|iemobile|Windows Phone)/i), It = U(/Edge/i), fe = U(/firefox/i), Dt = U(/safari/i) && !U(/chrome/i) && !U(/android/i), De = U(/iP(ad|od|hone)/i), _e = U(/chrome/i) && U(/android/i), Se = {
  capture: !1,
  passive: !1
};
function E(i, t, e) {
  i.addEventListener(t, e, !$ && Se);
}
function b(i, t, e) {
  i.removeEventListener(t, e, !$ && Se);
}
function Gt(i, t) {
  if (t) {
    if (t[0] === ">" && (t = t.substring(1)), i)
      try {
        if (i.matches)
          return i.matches(t);
        if (i.msMatchesSelector)
          return i.msMatchesSelector(t);
        if (i.webkitMatchesSelector)
          return i.webkitMatchesSelector(t);
      } catch {
        return !1;
      }
    return !1;
  }
}
function je(i) {
  return i.host && i !== document && i.host.nodeType ? i.host : i.parentNode;
}
function z(i, t, e, n) {
  if (i) {
    e = e || document;
    do {
      if (t != null && (t[0] === ">" ? i.parentNode === e && Gt(i, t) : Gt(i, t)) || n && i === e)
        return i;
      if (i === e)
        break;
    } while (i = je(i));
  }
  return null;
}
var pe = /\s+/g;
function B(i, t, e) {
  if (i && t)
    if (i.classList)
      i.classList[e ? "add" : "remove"](t);
    else {
      var n = (" " + i.className + " ").replace(pe, " ").replace(" " + t + " ", " ");
      i.className = (n + (e ? " " + t : "")).replace(pe, " ");
    }
}
function p(i, t, e) {
  var n = i && i.style;
  if (n) {
    if (e === void 0)
      return document.defaultView && document.defaultView.getComputedStyle ? e = document.defaultView.getComputedStyle(i, "") : i.currentStyle && (e = i.currentStyle), t === void 0 ? e : e[t];
    !(t in n) && t.indexOf("webkit") === -1 && (t = "-webkit-" + t), n[t] = e + (typeof e == "string" ? "" : "px");
  }
}
function ht(i, t) {
  var e = "";
  if (typeof i == "string")
    e = i;
  else
    do {
      var n = p(i, "transform");
      n && n !== "none" && (e = n + " " + e);
    } while (!t && (i = i.parentNode));
  var o = window.DOMMatrix || window.WebKitCSSMatrix || window.CSSMatrix || window.MSCSSMatrix;
  return o && new o(e);
}
function Ce(i, t, e) {
  if (i) {
    var n = i.getElementsByTagName(t), o = 0, r = n.length;
    if (e)
      for (; o < r; o++)
        e(n[o], o);
    return n;
  }
  return [];
}
function j() {
  var i = document.scrollingElement;
  return i || document.documentElement;
}
function I(i, t, e, n, o) {
  if (!(!i.getBoundingClientRect && i !== window)) {
    var r, a, l, s, u, h, d;
    if (i !== window && i.parentNode && i !== j() ? (r = i.getBoundingClientRect(), a = r.top, l = r.left, s = r.bottom, u = r.right, h = r.height, d = r.width) : (a = 0, l = 0, s = window.innerHeight, u = window.innerWidth, h = window.innerHeight, d = window.innerWidth), (t || e) && i !== window && (o = o || i.parentNode, !$))
      do
        if (o && o.getBoundingClientRect && (p(o, "transform") !== "none" || e && p(o, "position") !== "static")) {
          var g = o.getBoundingClientRect();
          a -= g.top + parseInt(p(o, "border-top-width")), l -= g.left + parseInt(p(o, "border-left-width")), s = a + r.height, u = l + r.width;
          break;
        }
      while (o = o.parentNode);
    if (n && i !== window) {
      var y = ht(o || i), v = y && y.a, w = y && y.d;
      y && (a /= w, l /= v, d /= v, h /= w, s = a + h, u = l + d);
    }
    return {
      top: a,
      left: l,
      bottom: s,
      right: u,
      width: d,
      height: h
    };
  }
}
function me(i, t, e) {
  for (var n = et(i, !0), o = I(i)[t]; n; ) {
    var r = I(n)[e], a = void 0;
    if (e === "top" || e === "left" ? a = o >= r : a = o <= r, !a)
      return n;
    if (n === j())
      break;
    n = et(n, !1);
  }
  return !1;
}
function ft(i, t, e, n) {
  for (var o = 0, r = 0, a = i.children; r < a.length; ) {
    if (a[r].style.display !== "none" && a[r] !== f.ghost && (n || a[r] !== f.dragged) && z(a[r], e.draggable, i, !1)) {
      if (o === t)
        return a[r];
      o++;
    }
    r++;
  }
  return null;
}
function se(i, t) {
  for (var e = i.lastElementChild; e && (e === f.ghost || p(e, "display") === "none" || t && !Gt(e, t)); )
    e = e.previousElementSibling;
  return e || null;
}
function X(i, t) {
  var e = 0;
  if (!i || !i.parentNode)
    return -1;
  for (; i = i.previousElementSibling; )
    i.nodeName.toUpperCase() !== "TEMPLATE" && i !== f.clone && (!t || Gt(i, t)) && e++;
  return e;
}
function ge(i) {
  var t = 0, e = 0, n = j();
  if (i)
    do {
      var o = ht(i), r = o.a, a = o.d;
      t += i.scrollLeft * r, e += i.scrollTop * a;
    } while (i !== n && (i = i.parentNode));
  return [t, e];
}
function We(i, t) {
  for (var e in i)
    if (i.hasOwnProperty(e)) {
      for (var n in t)
        if (t.hasOwnProperty(n) && t[n] === i[e][n])
          return Number(e);
    }
  return -1;
}
function et(i, t) {
  if (!i || !i.getBoundingClientRect)
    return j();
  var e = i, n = !1;
  do
    if (e.clientWidth < e.scrollWidth || e.clientHeight < e.scrollHeight) {
      var o = p(e);
      if (e.clientWidth < e.scrollWidth && (o.overflowX == "auto" || o.overflowX == "scroll") || e.clientHeight < e.scrollHeight && (o.overflowY == "auto" || o.overflowY == "scroll")) {
        if (!e.getBoundingClientRect || e === document.body)
          return j();
        if (n || t)
          return e;
        n = !0;
      }
    }
  while (e = e.parentNode);
  return j();
}
function Ve(i, t) {
  if (i && t)
    for (var e in t)
      t.hasOwnProperty(e) && (i[e] = t[e]);
  return i;
}
function Ut(i, t) {
  return Math.round(i.top) === Math.round(t.top) && Math.round(i.left) === Math.round(t.left) && Math.round(i.height) === Math.round(t.height) && Math.round(i.width) === Math.round(t.width);
}
var _t;
function Te(i, t) {
  return function() {
    if (!_t) {
      var e = arguments, n = this;
      e.length === 1 ? i.call(n, e[0]) : i.apply(n, e), _t = setTimeout(function() {
        _t = void 0;
      }, t);
    }
  };
}
function qe() {
  clearTimeout(_t), _t = void 0;
}
function Ie(i, t, e) {
  i.scrollLeft += t, i.scrollTop += e;
}
function Oe(i) {
  var t = window.Polymer, e = window.jQuery || window.Zepto;
  return t && t.dom ? t.dom(i).cloneNode(!0) : e ? e(i).clone(!0)[0] : i.cloneNode(!0);
}
var F = "Sortable" + (/* @__PURE__ */ new Date()).getTime();
function Ue() {
  var i = [], t;
  return {
    captureAnimationState: function() {
      if (i = [], !!this.options.animation) {
        var n = [].slice.call(this.el.children);
        n.forEach(function(o) {
          if (!(p(o, "display") === "none" || o === f.ghost)) {
            i.push({
              target: o,
              rect: I(o)
            });
            var r = W({}, i[i.length - 1].rect);
            if (o.thisAnimationDuration) {
              var a = ht(o, !0);
              a && (r.top -= a.f, r.left -= a.e);
            }
            o.fromRect = r;
          }
        });
      }
    },
    addAnimationState: function(n) {
      i.push(n);
    },
    removeAnimationState: function(n) {
      i.splice(We(i, {
        target: n
      }), 1);
    },
    animateAll: function(n) {
      var o = this;
      if (!this.options.animation) {
        clearTimeout(t), typeof n == "function" && n();
        return;
      }
      var r = !1, a = 0;
      i.forEach(function(l) {
        var s = 0, u = l.target, h = u.fromRect, d = I(u), g = u.prevFromRect, y = u.prevToRect, v = l.rect, w = ht(u, !0);
        w && (d.top -= w.f, d.left -= w.e), u.toRect = d, u.thisAnimationDuration && Ut(g, d) && !Ut(h, d) && // Make sure animatingRect is on line between toRect & fromRect
        (v.top - d.top) / (v.left - d.left) === (h.top - d.top) / (h.left - d.left) && (s = $e(v, g, y, o.options)), Ut(d, h) || (u.prevFromRect = h, u.prevToRect = d, s || (s = o.options.animation), o.animate(u, v, d, s)), s && (r = !0, a = Math.max(a, s), clearTimeout(u.animationResetTimer), u.animationResetTimer = setTimeout(function() {
          u.animationTime = 0, u.prevFromRect = null, u.fromRect = null, u.prevToRect = null, u.thisAnimationDuration = null;
        }, s), u.thisAnimationDuration = s);
      }), clearTimeout(t), r ? t = setTimeout(function() {
        typeof n == "function" && n();
      }, a) : typeof n == "function" && n(), i = [];
    },
    animate: function(n, o, r, a) {
      if (a) {
        p(n, "transition", ""), p(n, "transform", "");
        var l = ht(this.el), s = l && l.a, u = l && l.d, h = (o.left - r.left) / (s || 1), d = (o.top - r.top) / (u || 1);
        n.animatingX = !!h, n.animatingY = !!d, p(n, "transform", "translate3d(" + h + "px," + d + "px,0)"), this.forRepaintDummy = Ze(n), p(n, "transition", "transform " + a + "ms" + (this.options.easing ? " " + this.options.easing : "")), p(n, "transform", "translate3d(0,0,0)"), typeof n.animated == "number" && clearTimeout(n.animated), n.animated = setTimeout(function() {
          p(n, "transition", ""), p(n, "transform", ""), n.animated = !1, n.animatingX = !1, n.animatingY = !1;
        }, a);
      }
    }
  };
}
function Ze(i) {
  return i.offsetWidth;
}
function $e(i, t, e, n) {
  return Math.sqrt(Math.pow(t.top - i.top, 2) + Math.pow(t.left - i.left, 2)) / Math.sqrt(Math.pow(t.top - e.top, 2) + Math.pow(t.left - e.left, 2)) * n.animation;
}
var st = [], Zt = {
  initializeByDefault: !0
}, Ot = {
  mount: function(t) {
    for (var e in Zt)
      Zt.hasOwnProperty(e) && !(e in t) && (t[e] = Zt[e]);
    st.forEach(function(n) {
      if (n.pluginName === t.pluginName)
        throw "Sortable: Cannot mount plugin ".concat(t.pluginName, " more than once");
    }), st.push(t);
  },
  pluginEvent: function(t, e, n) {
    var o = this;
    this.eventCanceled = !1, n.cancel = function() {
      o.eventCanceled = !0;
    };
    var r = t + "Global";
    st.forEach(function(a) {
      e[a.pluginName] && (e[a.pluginName][r] && e[a.pluginName][r](W({
        sortable: e
      }, n)), e.options[a.pluginName] && e[a.pluginName][t] && e[a.pluginName][t](W({
        sortable: e
      }, n)));
    });
  },
  initializePlugins: function(t, e, n, o) {
    st.forEach(function(l) {
      var s = l.pluginName;
      if (!(!t.options[s] && !l.initializeByDefault)) {
        var u = new l(t, e, t.options);
        u.sortable = t, u.options = t.options, t[s] = u, Z(n, u.defaults);
      }
    });
    for (var r in t.options)
      if (t.options.hasOwnProperty(r)) {
        var a = this.modifyOption(t, r, t.options[r]);
        typeof a < "u" && (t.options[r] = a);
      }
  },
  getEventProperties: function(t, e) {
    var n = {};
    return st.forEach(function(o) {
      typeof o.eventProperties == "function" && Z(n, o.eventProperties.call(e[o.pluginName], t));
    }), n;
  },
  modifyOption: function(t, e, n) {
    var o;
    return st.forEach(function(r) {
      t[r.pluginName] && r.optionListeners && typeof r.optionListeners[e] == "function" && (o = r.optionListeners[e].call(t[r.pluginName], n));
    }), o;
  }
};
function Je(i) {
  var t = i.sortable, e = i.rootEl, n = i.name, o = i.targetEl, r = i.cloneEl, a = i.toEl, l = i.fromEl, s = i.oldIndex, u = i.newIndex, h = i.oldDraggableIndex, d = i.newDraggableIndex, g = i.originalEvent, y = i.putSortable, v = i.extraEventProperties;
  if (t = t || e && e[F], !!t) {
    var w, H = t.options, V = "on" + n.charAt(0).toUpperCase() + n.substr(1);
    window.CustomEvent && !$ && !It ? w = new CustomEvent(n, {
      bubbles: !0,
      cancelable: !0
    }) : (w = document.createEvent("Event"), w.initEvent(n, !0, !0)), w.to = a || e, w.from = l || e, w.item = o || e, w.clone = r, w.oldIndex = s, w.newIndex = u, w.oldDraggableIndex = h, w.newDraggableIndex = d, w.originalEvent = g, w.pullMode = y ? y.lastPutMode : void 0;
    var A = W(W({}, v), Ot.getEventProperties(n, t));
    for (var Y in A)
      w[Y] = A[Y];
    e && e.dispatchEvent(w), H[V] && H[V].call(t, w);
  }
}
var Ke = ["evt"], P = function(t, e) {
  var n = arguments.length > 2 && arguments[2] !== void 0 ? arguments[2] : {}, o = n.evt, r = Re(n, Ke);
  Ot.pluginEvent.bind(f)(t, e, W({
    dragEl: c,
    parentEl: C,
    ghostEl: m,
    rootEl: _,
    nextEl: lt,
    lastDownEl: Bt,
    cloneEl: S,
    cloneHidden: tt,
    dragStarted: Et,
    putSortable: O,
    activeSortable: f.active,
    originalEvent: o,
    oldIndex: dt,
    oldDraggableIndex: St,
    newIndex: k,
    newDraggableIndex: Q,
    hideGhostForTarget: Pe,
    unhideGhostForTarget: Le,
    cloneNowHidden: function() {
      tt = !0;
    },
    cloneNowShown: function() {
      tt = !1;
    },
    dispatchSortableEvent: function(l) {
      N({
        sortable: e,
        name: l,
        originalEvent: o
      });
    }
  }, r));
};
function N(i) {
  Je(W({
    putSortable: O,
    cloneEl: S,
    targetEl: c,
    rootEl: _,
    oldIndex: dt,
    oldDraggableIndex: St,
    newIndex: k,
    newDraggableIndex: Q
  }, i));
}
var c, C, m, _, lt, Bt, S, tt, dt, k, St, Q, At, O, ct = !1, Rt = !1, zt = [], rt, G, $t, Jt, ve, be, Et, ut, Ct, Tt = !1, Nt = !1, kt, x, Kt = [], ie = !1, jt = [], qt = typeof document < "u", Pt = De, Ee = It || $ ? "cssFloat" : "float", Qe = qt && !_e && !De && "draggable" in document.createElement("div"), xe = function() {
  if (qt) {
    if ($)
      return !1;
    var i = document.createElement("x");
    return i.style.cssText = "pointer-events:auto", i.style.pointerEvents === "auto";
  }
}(), Ae = function(t, e) {
  var n = p(t), o = parseInt(n.width) - parseInt(n.paddingLeft) - parseInt(n.paddingRight) - parseInt(n.borderLeftWidth) - parseInt(n.borderRightWidth), r = ft(t, 0, e), a = ft(t, 1, e), l = r && p(r), s = a && p(a), u = l && parseInt(l.marginLeft) + parseInt(l.marginRight) + I(r).width, h = s && parseInt(s.marginLeft) + parseInt(s.marginRight) + I(a).width;
  if (n.display === "flex")
    return n.flexDirection === "column" || n.flexDirection === "column-reverse" ? "vertical" : "horizontal";
  if (n.display === "grid")
    return n.gridTemplateColumns.split(" ").length <= 1 ? "vertical" : "horizontal";
  if (r && l.float && l.float !== "none") {
    var d = l.float === "left" ? "left" : "right";
    return a && (s.clear === "both" || s.clear === d) ? "vertical" : "horizontal";
  }
  return r && (l.display === "block" || l.display === "flex" || l.display === "table" || l.display === "grid" || u >= o && n[Ee] === "none" || a && n[Ee] === "none" && u + h > o) ? "vertical" : "horizontal";
}, tn = function(t, e, n) {
  var o = n ? t.left : t.top, r = n ? t.right : t.bottom, a = n ? t.width : t.height, l = n ? e.left : e.top, s = n ? e.right : e.bottom, u = n ? e.width : e.height;
  return o === l || r === s || o + a / 2 === l + u / 2;
}, en = function(t, e) {
  var n;
  return zt.some(function(o) {
    var r = o[F].options.emptyInsertThreshold;
    if (!(!r || se(o))) {
      var a = I(o), l = t >= a.left - r && t <= a.right + r, s = e >= a.top - r && e <= a.bottom + r;
      if (l && s)
        return n = o;
    }
  }), n;
}, Ne = function(t) {
  function e(r, a) {
    return function(l, s, u, h) {
      var d = l.options.group.name && s.options.group.name && l.options.group.name === s.options.group.name;
      if (r == null && (a || d))
        return !0;
      if (r == null || r === !1)
        return !1;
      if (a && r === "clone")
        return r;
      if (typeof r == "function")
        return e(r(l, s, u, h), a)(l, s, u, h);
      var g = (a ? l : s).options.group.name;
      return r === !0 || typeof r == "string" && r === g || r.join && r.indexOf(g) > -1;
    };
  }
  var n = {}, o = t.group;
  (!o || Mt(o) != "object") && (o = {
    name: o
  }), n.name = o.name, n.checkPull = e(o.pull, !0), n.checkPut = e(o.put), n.revertClone = o.revertClone, t.group = n;
}, Pe = function() {
  !xe && m && p(m, "display", "none");
}, Le = function() {
  !xe && m && p(m, "display", "");
};
qt && !_e && document.addEventListener("click", function(i) {
  if (Rt)
    return i.preventDefault(), i.stopPropagation && i.stopPropagation(), i.stopImmediatePropagation && i.stopImmediatePropagation(), Rt = !1, !1;
}, !0);
var at = function(t) {
  if (c) {
    t = t.touches ? t.touches[0] : t;
    var e = en(t.clientX, t.clientY);
    if (e) {
      var n = {};
      for (var o in t)
        t.hasOwnProperty(o) && (n[o] = t[o]);
      n.target = n.rootEl = e, n.preventDefault = void 0, n.stopPropagation = void 0, e[F]._onDragOver(n);
    }
  }
}, nn = function(t) {
  c && c.parentNode[F]._isOutsideThisEl(t.target);
};
function f(i, t) {
  if (!(i && i.nodeType && i.nodeType === 1))
    throw "Sortable: `el` must be an HTMLElement, not ".concat({}.toString.call(i));
  this.el = i, this.options = t = Z({}, t), i[F] = this;
  var e = {
    group: null,
    sort: !0,
    disabled: !1,
    store: null,
    handle: null,
    draggable: /^[uo]l$/i.test(i.nodeName) ? ">li" : ">*",
    swapThreshold: 1,
    // percentage; 0 <= x <= 1
    invertSwap: !1,
    // invert always
    invertedSwapThreshold: null,
    // will be set to same as swapThreshold if default
    removeCloneOnHide: !0,
    direction: function() {
      return Ae(i, this.options);
    },
    ghostClass: "sortable-ghost",
    chosenClass: "sortable-chosen",
    dragClass: "sortable-drag",
    ignore: "a, img",
    filter: null,
    preventOnFilter: !0,
    animation: 0,
    easing: null,
    setData: function(a, l) {
      a.setData("Text", l.textContent);
    },
    dropBubble: !1,
    dragoverBubble: !1,
    dataIdAttr: "data-id",
    delay: 0,
    delayOnTouchOnly: !1,
    touchStartThreshold: (Number.parseInt ? Number : window).parseInt(window.devicePixelRatio, 10) || 1,
    forceFallback: !1,
    fallbackClass: "sortable-fallback",
    fallbackOnBody: !1,
    fallbackTolerance: 0,
    fallbackOffset: {
      x: 0,
      y: 0
    },
    supportPointer: f.supportPointer !== !1 && "PointerEvent" in window && !Dt,
    emptyInsertThreshold: 5
  };
  Ot.initializePlugins(this, i, e);
  for (var n in e)
    !(n in t) && (t[n] = e[n]);
  Ne(t);
  for (var o in this)
    o.charAt(0) === "_" && typeof this[o] == "function" && (this[o] = this[o].bind(this));
  this.nativeDraggable = t.forceFallback ? !1 : Qe, this.nativeDraggable && (this.options.touchStartThreshold = 1), t.supportPointer ? E(i, "pointerdown", this._onTapStart) : (E(i, "mousedown", this._onTapStart), E(i, "touchstart", this._onTapStart)), this.nativeDraggable && (E(i, "dragover", this), E(i, "dragenter", this)), zt.push(this.el), t.store && t.store.get && this.sort(t.store.get(this) || []), Z(this, Ue());
}
f.prototype = /** @lends Sortable.prototype */
{
  constructor: f,
  _isOutsideThisEl: function(t) {
    !this.el.contains(t) && t !== this.el && (ut = null);
  },
  _getDirection: function(t, e) {
    return typeof this.options.direction == "function" ? this.options.direction.call(this, t, e, c) : this.options.direction;
  },
  _onTapStart: function(t) {
    if (t.cancelable) {
      var e = this, n = this.el, o = this.options, r = o.preventOnFilter, a = t.type, l = t.touches && t.touches[0] || t.pointerType && t.pointerType === "touch" && t, s = (l || t).target, u = t.target.shadowRoot && (t.path && t.path[0] || t.composedPath && t.composedPath()[0]) || s, h = o.filter;
      if (dn(n), !c && !(/mousedown|pointerdown/.test(a) && t.button !== 0 || o.disabled) && !u.isContentEditable && !(!this.nativeDraggable && Dt && s && s.tagName.toUpperCase() === "SELECT") && (s = z(s, o.draggable, n, !1), !(s && s.animated) && Bt !== s)) {
        if (dt = X(s), St = X(s, o.draggable), typeof h == "function") {
          if (h.call(this, t, s, this)) {
            N({
              sortable: e,
              rootEl: u,
              name: "filter",
              targetEl: s,
              toEl: n,
              fromEl: n
            }), P("filter", e, {
              evt: t
            }), r && t.cancelable && t.preventDefault();
            return;
          }
        } else if (h && (h = h.split(",").some(function(d) {
          if (d = z(u, d.trim(), n, !1), d)
            return N({
              sortable: e,
              rootEl: d,
              name: "filter",
              targetEl: s,
              fromEl: n,
              toEl: n
            }), P("filter", e, {
              evt: t
            }), !0;
        }), h)) {
          r && t.cancelable && t.preventDefault();
          return;
        }
        o.handle && !z(u, o.handle, n, !1) || this._prepareDragStart(t, l, s);
      }
    }
  },
  _prepareDragStart: function(t, e, n) {
    var o = this, r = o.el, a = o.options, l = r.ownerDocument, s;
    if (n && !c && n.parentNode === r) {
      var u = I(n);
      if (_ = r, c = n, C = c.parentNode, lt = c.nextSibling, Bt = n, At = a.group, f.dragged = c, rt = {
        target: c,
        clientX: (e || t).clientX,
        clientY: (e || t).clientY
      }, ve = rt.clientX - u.left, be = rt.clientY - u.top, this._lastX = (e || t).clientX, this._lastY = (e || t).clientY, c.style["will-change"] = "all", s = function() {
        if (P("delayEnded", o, {
          evt: t
        }), f.eventCanceled) {
          o._onDrop();
          return;
        }
        o._disableDelayedDragEvents(), !fe && o.nativeDraggable && (c.draggable = !0), o._triggerDragStart(t, e), N({
          sortable: o,
          name: "choose",
          originalEvent: t
        }), B(c, a.chosenClass, !0);
      }, a.ignore.split(",").forEach(function(h) {
        Ce(c, h.trim(), Qt);
      }), E(l, "dragover", at), E(l, "mousemove", at), E(l, "touchmove", at), E(l, "mouseup", o._onDrop), E(l, "touchend", o._onDrop), E(l, "touchcancel", o._onDrop), fe && this.nativeDraggable && (this.options.touchStartThreshold = 4, c.draggable = !0), P("delayStart", this, {
        evt: t
      }), a.delay && (!a.delayOnTouchOnly || e) && (!this.nativeDraggable || !(It || $))) {
        if (f.eventCanceled) {
          this._onDrop();
          return;
        }
        E(l, "mouseup", o._disableDelayedDrag), E(l, "touchend", o._disableDelayedDrag), E(l, "touchcancel", o._disableDelayedDrag), E(l, "mousemove", o._delayedDragTouchMoveHandler), E(l, "touchmove", o._delayedDragTouchMoveHandler), a.supportPointer && E(l, "pointermove", o._delayedDragTouchMoveHandler), o._dragStartTimer = setTimeout(s, a.delay);
      } else
        s();
    }
  },
  _delayedDragTouchMoveHandler: function(t) {
    var e = t.touches ? t.touches[0] : t;
    Math.max(Math.abs(e.clientX - this._lastX), Math.abs(e.clientY - this._lastY)) >= Math.floor(this.options.touchStartThreshold / (this.nativeDraggable && window.devicePixelRatio || 1)) && this._disableDelayedDrag();
  },
  _disableDelayedDrag: function() {
    c && Qt(c), clearTimeout(this._dragStartTimer), this._disableDelayedDragEvents();
  },
  _disableDelayedDragEvents: function() {
    var t = this.el.ownerDocument;
    b(t, "mouseup", this._disableDelayedDrag), b(t, "touchend", this._disableDelayedDrag), b(t, "touchcancel", this._disableDelayedDrag), b(t, "mousemove", this._delayedDragTouchMoveHandler), b(t, "touchmove", this._delayedDragTouchMoveHandler), b(t, "pointermove", this._delayedDragTouchMoveHandler);
  },
  _triggerDragStart: function(t, e) {
    e = e || t.pointerType == "touch" && t, !this.nativeDraggable || e ? this.options.supportPointer ? E(document, "pointermove", this._onTouchMove) : e ? E(document, "touchmove", this._onTouchMove) : E(document, "mousemove", this._onTouchMove) : (E(c, "dragend", this), E(_, "dragstart", this._onDragStart));
    try {
      document.selection ? Ft(function() {
        document.selection.empty();
      }) : window.getSelection().removeAllRanges();
    } catch {
    }
  },
  _dragStarted: function(t, e) {
    if (ct = !1, _ && c) {
      P("dragStarted", this, {
        evt: e
      }), this.nativeDraggable && E(document, "dragover", nn);
      var n = this.options;
      !t && B(c, n.dragClass, !1), B(c, n.ghostClass, !0), f.active = this, t && this._appendGhost(), N({
        sortable: this,
        name: "start",
        originalEvent: e
      });
    } else
      this._nulling();
  },
  _emulateDragOver: function() {
    if (G) {
      this._lastX = G.clientX, this._lastY = G.clientY, Pe();
      for (var t = document.elementFromPoint(G.clientX, G.clientY), e = t; t && t.shadowRoot && (t = t.shadowRoot.elementFromPoint(G.clientX, G.clientY), t !== e); )
        e = t;
      if (c.parentNode[F]._isOutsideThisEl(t), e)
        do {
          if (e[F]) {
            var n = void 0;
            if (n = e[F]._onDragOver({
              clientX: G.clientX,
              clientY: G.clientY,
              target: t,
              rootEl: e
            }), n && !this.options.dragoverBubble)
              break;
          }
          t = e;
        } while (e = e.parentNode);
      Le();
    }
  },
  _onTouchMove: function(t) {
    if (rt) {
      var e = this.options, n = e.fallbackTolerance, o = e.fallbackOffset, r = t.touches ? t.touches[0] : t, a = m && ht(m, !0), l = m && a && a.a, s = m && a && a.d, u = Pt && x && ge(x), h = (r.clientX - rt.clientX + o.x) / (l || 1) + (u ? u[0] - Kt[0] : 0) / (l || 1), d = (r.clientY - rt.clientY + o.y) / (s || 1) + (u ? u[1] - Kt[1] : 0) / (s || 1);
      if (!f.active && !ct) {
        if (n && Math.max(Math.abs(r.clientX - this._lastX), Math.abs(r.clientY - this._lastY)) < n)
          return;
        this._onDragStart(t, !0);
      }
      if (m) {
        a ? (a.e += h - ($t || 0), a.f += d - (Jt || 0)) : a = {
          a: 1,
          b: 0,
          c: 0,
          d: 1,
          e: h,
          f: d
        };
        var g = "matrix(".concat(a.a, ",").concat(a.b, ",").concat(a.c, ",").concat(a.d, ",").concat(a.e, ",").concat(a.f, ")");
        p(m, "webkitTransform", g), p(m, "mozTransform", g), p(m, "msTransform", g), p(m, "transform", g), $t = h, Jt = d, G = r;
      }
      t.cancelable && t.preventDefault();
    }
  },
  _appendGhost: function() {
    if (!m) {
      var t = this.options.fallbackOnBody ? document.body : _, e = I(c, !0, Pt, !0, t), n = this.options;
      if (Pt) {
        for (x = t; p(x, "position") === "static" && p(x, "transform") === "none" && x !== document; )
          x = x.parentNode;
        x !== document.body && x !== document.documentElement ? (x === document && (x = j()), e.top += x.scrollTop, e.left += x.scrollLeft) : x = j(), Kt = ge(x);
      }
      m = c.cloneNode(!0), B(m, n.ghostClass, !1), B(m, n.fallbackClass, !0), B(m, n.dragClass, !0), p(m, "transition", ""), p(m, "transform", ""), p(m, "box-sizing", "border-box"), p(m, "margin", 0), p(m, "top", e.top), p(m, "left", e.left), p(m, "width", e.width), p(m, "height", e.height), p(m, "opacity", "0.8"), p(m, "position", Pt ? "absolute" : "fixed"), p(m, "zIndex", "100000"), p(m, "pointerEvents", "none"), f.ghost = m, t.appendChild(m), p(m, "transform-origin", ve / parseInt(m.style.width) * 100 + "% " + be / parseInt(m.style.height) * 100 + "%");
    }
  },
  _onDragStart: function(t, e) {
    var n = this, o = t.dataTransfer, r = n.options;
    if (P("dragStart", this, {
      evt: t
    }), f.eventCanceled) {
      this._onDrop();
      return;
    }
    P("setupClone", this), f.eventCanceled || (S = Oe(c), S.removeAttribute("id"), S.draggable = !1, S.style["will-change"] = "", this._hideClone(), B(S, this.options.chosenClass, !1), f.clone = S), n.cloneId = Ft(function() {
      P("clone", n), !f.eventCanceled && (n.options.removeCloneOnHide || _.insertBefore(S, c), n._hideClone(), N({
        sortable: n,
        name: "clone"
      }));
    }), !e && B(c, r.dragClass, !0), e ? (Rt = !0, n._loopId = setInterval(n._emulateDragOver, 50)) : (b(document, "mouseup", n._onDrop), b(document, "touchend", n._onDrop), b(document, "touchcancel", n._onDrop), o && (o.effectAllowed = "move", r.setData && r.setData.call(n, o, c)), E(document, "drop", n), p(c, "transform", "translateZ(0)")), ct = !0, n._dragStartId = Ft(n._dragStarted.bind(n, e, t)), E(document, "selectstart", n), Et = !0, Dt && p(document.body, "user-select", "none");
  },
  // Returns true - if no further action is needed (either inserted or another condition)
  _onDragOver: function(t) {
    var e = this.el, n = t.target, o, r, a, l = this.options, s = l.group, u = f.active, h = At === s, d = l.sort, g = O || u, y, v = this, w = !1;
    if (ie)
      return;
    function H(bt, ke) {
      P(bt, v, W({
        evt: t,
        isOwner: h,
        axis: y ? "vertical" : "horizontal",
        revert: a,
        dragRect: o,
        targetRect: r,
        canSort: d,
        fromSortable: g,
        target: n,
        completed: A,
        onMove: function(de, Fe) {
          return Lt(_, e, c, o, de, I(de), t, Fe);
        },
        changed: Y
      }, ke));
    }
    function V() {
      H("dragOverAnimationCapture"), v.captureAnimationState(), v !== g && g.captureAnimationState();
    }
    function A(bt) {
      return H("dragOverCompleted", {
        insertion: bt
      }), bt && (h ? u._hideClone() : u._showClone(v), v !== g && (B(c, O ? O.options.ghostClass : u.options.ghostClass, !1), B(c, l.ghostClass, !0)), O !== v && v !== f.active ? O = v : v === f.active && O && (O = null), g === v && (v._ignoreWhileAnimating = n), v.animateAll(function() {
        H("dragOverAnimationComplete"), v._ignoreWhileAnimating = null;
      }), v !== g && (g.animateAll(), g._ignoreWhileAnimating = null)), (n === c && !c.animated || n === e && !n.animated) && (ut = null), !l.dragoverBubble && !t.rootEl && n !== document && (c.parentNode[F]._isOutsideThisEl(t.target), !bt && at(t)), !l.dragoverBubble && t.stopPropagation && t.stopPropagation(), w = !0;
    }
    function Y() {
      k = X(c), Q = X(c, l.draggable), N({
        sortable: v,
        name: "change",
        toEl: e,
        newIndex: k,
        newDraggableIndex: Q,
        originalEvent: t
      });
    }
    if (t.preventDefault !== void 0 && t.cancelable && t.preventDefault(), n = z(n, l.draggable, e, !0), H("dragOver"), f.eventCanceled)
      return w;
    if (c.contains(t.target) || n.animated && n.animatingX && n.animatingY || v._ignoreWhileAnimating === n)
      return A(!1);
    if (Rt = !1, u && !l.disabled && (h ? d || (a = C !== _) : O === this || (this.lastPutMode = At.checkPull(this, u, c, t)) && s.checkPut(this, u, c, t))) {
      if (y = this._getDirection(t, n) === "vertical", o = I(c), H("dragOverValid"), f.eventCanceled)
        return w;
      if (a)
        return C = _, V(), this._hideClone(), H("revert"), f.eventCanceled || (lt ? _.insertBefore(c, lt) : _.appendChild(c)), A(!0);
      var L = se(e, l.draggable);
      if (!L || ln(t, y, this) && !L.animated) {
        if (L === c)
          return A(!1);
        if (L && e === t.target && (n = L), n && (r = I(n)), Lt(_, e, c, o, n, r, t, !!n) !== !1)
          return V(), L && L.nextSibling ? e.insertBefore(c, L.nextSibling) : e.appendChild(c), C = e, Y(), A(!0);
      } else if (L && an(t, y, this)) {
        var nt = ft(e, 0, l, !0);
        if (nt === c)
          return A(!1);
        if (n = nt, r = I(n), Lt(_, e, c, o, n, r, t, !1) !== !1)
          return V(), e.insertBefore(c, nt), C = e, Y(), A(!0);
      } else if (n.parentNode === e) {
        r = I(n);
        var R = 0, it, pt = c.parentNode !== e, M = !tn(c.animated && c.toRect || o, n.animated && n.toRect || r, y), mt = y ? "top" : "left", J = me(n, "top", "top") || me(c, "top", "top"), gt = J ? J.scrollTop : void 0;
        ut !== n && (it = r[mt], Tt = !1, Nt = !M && l.invertSwap || pt), R = sn(t, n, r, y, M ? 1 : l.swapThreshold, l.invertedSwapThreshold == null ? l.swapThreshold : l.invertedSwapThreshold, Nt, ut === n);
        var q;
        if (R !== 0) {
          var ot = X(c);
          do
            ot -= R, q = C.children[ot];
          while (q && (p(q, "display") === "none" || q === m));
        }
        if (R === 0 || q === n)
          return A(!1);
        ut = n, Ct = R;
        var vt = n.nextElementSibling, K = !1;
        K = R === 1;
        var xt = Lt(_, e, c, o, n, r, t, K);
        if (xt !== !1)
          return (xt === 1 || xt === -1) && (K = xt === 1), ie = !0, setTimeout(rn, 30), V(), K && !vt ? e.appendChild(c) : n.parentNode.insertBefore(c, K ? vt : n), J && Ie(J, 0, gt - J.scrollTop), C = c.parentNode, it !== void 0 && !Nt && (kt = Math.abs(it - I(n)[mt])), Y(), A(!0);
      }
      if (e.contains(c))
        return A(!1);
    }
    return !1;
  },
  _ignoreWhileAnimating: null,
  _offMoveEvents: function() {
    b(document, "mousemove", this._onTouchMove), b(document, "touchmove", this._onTouchMove), b(document, "pointermove", this._onTouchMove), b(document, "dragover", at), b(document, "mousemove", at), b(document, "touchmove", at);
  },
  _offUpEvents: function() {
    var t = this.el.ownerDocument;
    b(t, "mouseup", this._onDrop), b(t, "touchend", this._onDrop), b(t, "pointerup", this._onDrop), b(t, "touchcancel", this._onDrop), b(document, "selectstart", this);
  },
  _onDrop: function(t) {
    var e = this.el, n = this.options;
    if (k = X(c), Q = X(c, n.draggable), P("drop", this, {
      evt: t
    }), C = c && c.parentNode, k = X(c), Q = X(c, n.draggable), f.eventCanceled) {
      this._nulling();
      return;
    }
    ct = !1, Nt = !1, Tt = !1, clearInterval(this._loopId), clearTimeout(this._dragStartTimer), oe(this.cloneId), oe(this._dragStartId), this.nativeDraggable && (b(document, "drop", this), b(e, "dragstart", this._onDragStart)), this._offMoveEvents(), this._offUpEvents(), Dt && p(document.body, "user-select", ""), p(c, "transform", ""), t && (Et && (t.cancelable && t.preventDefault(), !n.dropBubble && t.stopPropagation()), m && m.parentNode && m.parentNode.removeChild(m), (_ === C || O && O.lastPutMode !== "clone") && S && S.parentNode && S.parentNode.removeChild(S), c && (this.nativeDraggable && b(c, "dragend", this), Qt(c), c.style["will-change"] = "", Et && !ct && B(c, O ? O.options.ghostClass : this.options.ghostClass, !1), B(c, this.options.chosenClass, !1), N({
      sortable: this,
      name: "unchoose",
      toEl: C,
      newIndex: null,
      newDraggableIndex: null,
      originalEvent: t
    }), _ !== C ? (k >= 0 && (N({
      rootEl: C,
      name: "add",
      toEl: C,
      fromEl: _,
      originalEvent: t
    }), N({
      sortable: this,
      name: "remove",
      toEl: C,
      originalEvent: t
    }), N({
      rootEl: C,
      name: "sort",
      toEl: C,
      fromEl: _,
      originalEvent: t
    }), N({
      sortable: this,
      name: "sort",
      toEl: C,
      originalEvent: t
    })), O && O.save()) : k !== dt && k >= 0 && (N({
      sortable: this,
      name: "update",
      toEl: C,
      originalEvent: t
    }), N({
      sortable: this,
      name: "sort",
      toEl: C,
      originalEvent: t
    })), f.active && ((k == null || k === -1) && (k = dt, Q = St), N({
      sortable: this,
      name: "end",
      toEl: C,
      originalEvent: t
    }), this.save()))), this._nulling();
  },
  _nulling: function() {
    P("nulling", this), _ = c = C = m = lt = S = Bt = tt = rt = G = Et = k = Q = dt = St = ut = Ct = O = At = f.dragged = f.ghost = f.clone = f.active = null, jt.forEach(function(t) {
      t.checked = !0;
    }), jt.length = $t = Jt = 0;
  },
  handleEvent: function(t) {
    switch (t.type) {
      case "drop":
      case "dragend":
        this._onDrop(t);
        break;
      case "dragenter":
      case "dragover":
        c && (this._onDragOver(t), on(t));
        break;
      case "selectstart":
        t.preventDefault();
        break;
    }
  },
  /**
   * Serializes the item into an array of string.
   * @returns {String[]}
   */
  toArray: function() {
    for (var t = [], e, n = this.el.children, o = 0, r = n.length, a = this.options; o < r; o++)
      e = n[o], z(e, a.draggable, this.el, !1) && t.push(e.getAttribute(a.dataIdAttr) || cn(e));
    return t;
  },
  /**
   * Sorts the elements according to the array.
   * @param  {String[]}  order  order of the items
   */
  sort: function(t, e) {
    var n = {}, o = this.el;
    this.toArray().forEach(function(r, a) {
      var l = o.children[a];
      z(l, this.options.draggable, o, !1) && (n[r] = l);
    }, this), e && this.captureAnimationState(), t.forEach(function(r) {
      n[r] && (o.removeChild(n[r]), o.appendChild(n[r]));
    }), e && this.animateAll();
  },
  /**
   * Save the current sorting
   */
  save: function() {
    var t = this.options.store;
    t && t.set && t.set(this);
  },
  /**
   * For each element in the set, get the first element that matches the selector by testing the element itself and traversing up through its ancestors in the DOM tree.
   * @param   {HTMLElement}  el
   * @param   {String}       [selector]  default: `options.draggable`
   * @returns {HTMLElement|null}
   */
  closest: function(t, e) {
    return z(t, e || this.options.draggable, this.el, !1);
  },
  /**
   * Set/get option
   * @param   {string} name
   * @param   {*}      [value]
   * @returns {*}
   */
  option: function(t, e) {
    var n = this.options;
    if (e === void 0)
      return n[t];
    var o = Ot.modifyOption(this, t, e);
    typeof o < "u" ? n[t] = o : n[t] = e, t === "group" && Ne(n);
  },
  /**
   * Destroy
   */
  destroy: function() {
    P("destroy", this);
    var t = this.el;
    t[F] = null, b(t, "mousedown", this._onTapStart), b(t, "touchstart", this._onTapStart), b(t, "pointerdown", this._onTapStart), this.nativeDraggable && (b(t, "dragover", this), b(t, "dragenter", this)), Array.prototype.forEach.call(t.querySelectorAll("[draggable]"), function(e) {
      e.removeAttribute("draggable");
    }), this._onDrop(), this._disableDelayedDragEvents(), zt.splice(zt.indexOf(this.el), 1), this.el = t = null;
  },
  _hideClone: function() {
    if (!tt) {
      if (P("hideClone", this), f.eventCanceled)
        return;
      p(S, "display", "none"), this.options.removeCloneOnHide && S.parentNode && S.parentNode.removeChild(S), tt = !0;
    }
  },
  _showClone: function(t) {
    if (t.lastPutMode !== "clone") {
      this._hideClone();
      return;
    }
    if (tt) {
      if (P("showClone", this), f.eventCanceled)
        return;
      c.parentNode == _ && !this.options.group.revertClone ? _.insertBefore(S, c) : lt ? _.insertBefore(S, lt) : _.appendChild(S), this.options.group.revertClone && this.animate(c, S), p(S, "display", ""), tt = !1;
    }
  }
};
function on(i) {
  i.dataTransfer && (i.dataTransfer.dropEffect = "move"), i.cancelable && i.preventDefault();
}
function Lt(i, t, e, n, o, r, a, l) {
  var s, u = i[F], h = u.options.onMove, d;
  return window.CustomEvent && !$ && !It ? s = new CustomEvent("move", {
    bubbles: !0,
    cancelable: !0
  }) : (s = document.createEvent("Event"), s.initEvent("move", !0, !0)), s.to = t, s.from = i, s.dragged = e, s.draggedRect = n, s.related = o || t, s.relatedRect = r || I(t), s.willInsertAfter = l, s.originalEvent = a, i.dispatchEvent(s), h && (d = h.call(u, s, a)), d;
}
function Qt(i) {
  i.draggable = !1;
}
function rn() {
  ie = !1;
}
function an(i, t, e) {
  var n = I(ft(e.el, 0, e.options, !0)), o = 10;
  return t ? i.clientX < n.left - o || i.clientY < n.top && i.clientX < n.right : i.clientY < n.top - o || i.clientY < n.bottom && i.clientX < n.left;
}
function ln(i, t, e) {
  var n = I(se(e.el, e.options.draggable)), o = 10;
  return t ? i.clientX > n.right + o || i.clientX <= n.right && i.clientY > n.bottom && i.clientX >= n.left : i.clientX > n.right && i.clientY > n.top || i.clientX <= n.right && i.clientY > n.bottom + o;
}
function sn(i, t, e, n, o, r, a, l) {
  var s = n ? i.clientY : i.clientX, u = n ? e.height : e.width, h = n ? e.top : e.left, d = n ? e.bottom : e.right, g = !1;
  if (!a) {
    if (l && kt < u * o) {
      if (!Tt && (Ct === 1 ? s > h + u * r / 2 : s < d - u * r / 2) && (Tt = !0), Tt)
        g = !0;
      else if (Ct === 1 ? s < h + kt : s > d - kt)
        return -Ct;
    } else if (s > h + u * (1 - o) / 2 && s < d - u * (1 - o) / 2)
      return un(t);
  }
  return g = g || a, g && (s < h + u * r / 2 || s > d - u * r / 2) ? s > h + u / 2 ? 1 : -1 : 0;
}
function un(i) {
  return X(c) < X(i) ? 1 : -1;
}
function cn(i) {
  for (var t = i.tagName + i.className + i.src + i.href + i.textContent, e = t.length, n = 0; e--; )
    n += t.charCodeAt(e);
  return n.toString(36);
}
function dn(i) {
  jt.length = 0;
  for (var t = i.getElementsByTagName("input"), e = t.length; e--; ) {
    var n = t[e];
    n.checked && jt.push(n);
  }
}
function Ft(i) {
  return setTimeout(i, 0);
}
function oe(i) {
  return clearTimeout(i);
}
qt && E(document, "touchmove", function(i) {
  (f.active || ct) && i.cancelable && i.preventDefault();
});
f.utils = {
  on: E,
  off: b,
  css: p,
  find: Ce,
  is: function(t, e) {
    return !!z(t, e, t, !1);
  },
  extend: Ve,
  throttle: Te,
  closest: z,
  toggleClass: B,
  clone: Oe,
  index: X,
  nextTick: Ft,
  cancelNextTick: oe,
  detectDirection: Ae,
  getChild: ft
};
f.get = function(i) {
  return i[F];
};
f.mount = function() {
  for (var i = arguments.length, t = new Array(i), e = 0; e < i; e++)
    t[e] = arguments[e];
  t[0].constructor === Array && (t = t[0]), t.forEach(function(n) {
    if (!n.prototype || !n.prototype.constructor)
      throw "Sortable: Mounted plugin must be a constructor function, not ".concat({}.toString.call(n));
    n.utils && (f.utils = W(W({}, f.utils), n.utils)), Ot.mount(n);
  });
};
f.create = function(i, t) {
  return new f(i, t);
};
f.version = ze;
var T = [], wt, re, ae = !1, te, ee, Wt, yt;
function hn() {
  function i() {
    this.defaults = {
      scroll: !0,
      forceAutoScrollFallback: !1,
      scrollSensitivity: 30,
      scrollSpeed: 10,
      bubbleScroll: !0
    };
    for (var t in this)
      t.charAt(0) === "_" && typeof this[t] == "function" && (this[t] = this[t].bind(this));
  }
  return i.prototype = {
    dragStarted: function(e) {
      var n = e.originalEvent;
      this.sortable.nativeDraggable ? E(document, "dragover", this._handleAutoScroll) : this.options.supportPointer ? E(document, "pointermove", this._handleFallbackAutoScroll) : n.touches ? E(document, "touchmove", this._handleFallbackAutoScroll) : E(document, "mousemove", this._handleFallbackAutoScroll);
    },
    dragOverCompleted: function(e) {
      var n = e.originalEvent;
      !this.options.dragOverBubble && !n.rootEl && this._handleAutoScroll(n);
    },
    drop: function() {
      this.sortable.nativeDraggable ? b(document, "dragover", this._handleAutoScroll) : (b(document, "pointermove", this._handleFallbackAutoScroll), b(document, "touchmove", this._handleFallbackAutoScroll), b(document, "mousemove", this._handleFallbackAutoScroll)), we(), Xt(), qe();
    },
    nulling: function() {
      Wt = re = wt = ae = yt = te = ee = null, T.length = 0;
    },
    _handleFallbackAutoScroll: function(e) {
      this._handleAutoScroll(e, !0);
    },
    _handleAutoScroll: function(e, n) {
      var o = this, r = (e.touches ? e.touches[0] : e).clientX, a = (e.touches ? e.touches[0] : e).clientY, l = document.elementFromPoint(r, a);
      if (Wt = e, n || this.options.forceAutoScrollFallback || It || $ || Dt) {
        ne(e, this.options, l, n);
        var s = et(l, !0);
        ae && (!yt || r !== te || a !== ee) && (yt && we(), yt = setInterval(function() {
          var u = et(document.elementFromPoint(r, a), !0);
          u !== s && (s = u, Xt()), ne(e, o.options, u, n);
        }, 10), te = r, ee = a);
      } else {
        if (!this.options.bubbleScroll || et(l, !0) === j()) {
          Xt();
          return;
        }
        ne(e, this.options, et(l, !1), !1);
      }
    }
  }, Z(i, {
    pluginName: "scroll",
    initializeByDefault: !0
  });
}
function Xt() {
  T.forEach(function(i) {
    clearInterval(i.pid);
  }), T = [];
}
function we() {
  clearInterval(yt);
}
var ne = Te(function(i, t, e, n) {
  if (t.scroll) {
    var o = (i.touches ? i.touches[0] : i).clientX, r = (i.touches ? i.touches[0] : i).clientY, a = t.scrollSensitivity, l = t.scrollSpeed, s = j(), u = !1, h;
    re !== e && (re = e, Xt(), wt = t.scroll, h = t.scrollFn, wt === !0 && (wt = et(e, !0)));
    var d = 0, g = wt;
    do {
      var y = g, v = I(y), w = v.top, H = v.bottom, V = v.left, A = v.right, Y = v.width, L = v.height, nt = void 0, R = void 0, it = y.scrollWidth, pt = y.scrollHeight, M = p(y), mt = y.scrollLeft, J = y.scrollTop;
      y === s ? (nt = Y < it && (M.overflowX === "auto" || M.overflowX === "scroll" || M.overflowX === "visible"), R = L < pt && (M.overflowY === "auto" || M.overflowY === "scroll" || M.overflowY === "visible")) : (nt = Y < it && (M.overflowX === "auto" || M.overflowX === "scroll"), R = L < pt && (M.overflowY === "auto" || M.overflowY === "scroll"));
      var gt = nt && (Math.abs(A - o) <= a && mt + Y < it) - (Math.abs(V - o) <= a && !!mt), q = R && (Math.abs(H - r) <= a && J + L < pt) - (Math.abs(w - r) <= a && !!J);
      if (!T[d])
        for (var ot = 0; ot <= d; ot++)
          T[ot] || (T[ot] = {});
      (T[d].vx != gt || T[d].vy != q || T[d].el !== y) && (T[d].el = y, T[d].vx = gt, T[d].vy = q, clearInterval(T[d].pid), (gt != 0 || q != 0) && (u = !0, T[d].pid = setInterval(function() {
        n && this.layer === 0 && f.active._onTouchMove(Wt);
        var vt = T[this.layer].vy ? T[this.layer].vy * l : 0, K = T[this.layer].vx ? T[this.layer].vx * l : 0;
        typeof h == "function" && h.call(f.dragged.parentNode[F], K, vt, i, Wt, T[this.layer].el) !== "continue" || Ie(T[this.layer].el, K, vt);
      }.bind({
        layer: d
      }), 24))), d++;
    } while (t.bubbleScroll && g !== s && (g = et(g, !1)));
    ae = u;
  }
}, 30), Me = function(t) {
  var e = t.originalEvent, n = t.putSortable, o = t.dragEl, r = t.activeSortable, a = t.dispatchSortableEvent, l = t.hideGhostForTarget, s = t.unhideGhostForTarget;
  if (e) {
    var u = n || r;
    l();
    var h = e.changedTouches && e.changedTouches.length ? e.changedTouches[0] : e, d = document.elementFromPoint(h.clientX, h.clientY);
    s(), u && !u.el.contains(d) && (a("spill"), this.onSpill({
      dragEl: o,
      putSortable: n
    }));
  }
};
function ue() {
}
ue.prototype = {
  startIndex: null,
  dragStart: function(t) {
    var e = t.oldDraggableIndex;
    this.startIndex = e;
  },
  onSpill: function(t) {
    var e = t.dragEl, n = t.putSortable;
    this.sortable.captureAnimationState(), n && n.captureAnimationState();
    var o = ft(this.sortable.el, this.startIndex, this.options);
    o ? this.sortable.el.insertBefore(e, o) : this.sortable.el.appendChild(e), this.sortable.animateAll(), n && n.animateAll();
  },
  drop: Me
};
Z(ue, {
  pluginName: "revertOnSpill"
});
function ce() {
}
ce.prototype = {
  onSpill: function(t) {
    var e = t.dragEl, n = t.putSortable, o = n || this.sortable;
    o.captureAnimationState(), e.parentNode && e.parentNode.removeChild(e), o.animateAll();
  },
  drop: Me
};
Z(ce, {
  pluginName: "removeOnSpill"
});
f.mount(new hn());
f.mount(ce, ue);
class fn {
  constructor() {
    D(this, "eventTarget", new EventTarget());
  }
  on(t, e) {
    this.eventTarget.addEventListener(t, (n) => {
      e(n.detail);
    });
  }
  emit(t, e) {
    const n = new CustomEvent(t, {
      detail: e
    });
    this.eventTarget.dispatchEvent(n);
  }
}
const pn = '<svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="17" data-view-component="true" class="octicon octicon-grabber"><path d="M10 13a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-4a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm-4 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm5-9a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM7 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM6 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"></path></svg>', mn = '<svg class="meu_edit" width="16" fill="#5156be" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg>', gn = '<svg width="16" fill="red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>', vn = {
  maxLevel: -1
};
class ye {
  constructor(t) {
    D(this, "button", document.createElement("button"));
    this.button.innerHTML = t, this.button.classList.add("btn" );
  }
  onClick(t) {
    this.button.addEventListener("click", t);
  }
  getElement() {
    return this.button;
  }
  getParemtElement() {
    return this.button.closest(".list-group-item");
  }
}
class bn {
  constructor(t) {
    D(this, "item");
    D(this, "container", document.createElement("div"));
    D(this, "eventEmitter", new fn());
    D(this, "buttons", {
      edit: new ye(mn),
      delete: new ye(gn)
    });
    this.item = t, this.setEvents();
  }
  setEvents() {
    this.buttons.delete.onClick(() => {
      this.eventEmitter.emit("clickDelete", { item: this.item });
    })
    , this.buttons.edit.onClick(() => {
      this.eventEmitter.emit("clickEdit", { item: this.item });
    });
  }
  onClickDelete(t) {
    this.eventEmitter.on("clickDelete", t);
  }
  onClickEdit(t) {
    this.eventEmitter.on("clickEdit", t);
  }
  mount() {
    this.container,this.container.append(this.buttons.edit.getElement()),this.container.append(this.buttons.delete.getElement());
  }
  getElement() {
    return this.container;
  }
}
class Be {
  constructor() {
    D(this, "items", []);
  }
  insertAt(t, e) {
    this.items.splice(e, 0, t);
  }
  add(t, e = -1) {
    let n = Math.trunc(e);
    if (n >= 0 && n < this.items.length) {
      this.insertAt(t, n);
      return;
    }
    this.items.push(t);
  }
  getItems() {
    return this.items;
  }
  empty() {
    this.items = [];
  }
  getLength() {
    return this.items.length;
  }
}
function En(i) {
  let t = { text: "",};
  for (let e in i)
    typeof i[e] == "string" && (t[e] = i[e]);
  return t;
}
function wn(i) {
  let t = { text: "",};
  for (let e in i)
    typeof i[e] == "string" && (t[e] = i[e]);
  return t;
}
function Ht(i, t) {
  for (let e in t)
    i.dataset[e] = t[e];
}
function Yt(i, t = -1) {
  i.ariaLevel = `${t}`;
  let e = i.children;
  for (let n = 0; n < e.length; n++) {
    let o = t;
    e[n].matches(".list-group-item") && (o = o + 1), Yt(e[n], o);
  }
}
function le(i, t) {
  let e = i.querySelectorAll(".list-group-item"), n = t;
  for (let o = 0; o < e.length; o++) {
    let r = le(e[o], t + 1);
    n = Math.max(n, r);
  }
  return n;
}
class Vt {
  constructor(t) {
    D(this, "element", document.createElement("div"));
    D(this, "dataset");
    D(this, "collection");
    D(this, "options", { sortableClassname: "nested-sortable" });
    D(this, "listenerEditButton", () => {
    });
    D(this, "listenerDeleteButton", () => {
    });
    D(this, "buttonGroup");
    this.collection = new Be(), this.buttonGroup = new bn(this), this.element.classList.add("list-group-item"), this.dataset = En(t);
  }
  setOptions(t) {
    this.options = t;
  }
  setDataset(t) {
    this.dataset = t;
  }
  getDataset() {
    return this.dataset;
  }
  setListenerEditButton(t) {
    this.listenerEditButton = t;
  }
  setListenerDeleteButton(t) {
    this.listenerDeleteButton = t;
  }
  add(t) {
    this.collection.add(t);
  }
  remove() {
    this.getElement().remove();
  }
  updateUI(t) {
    let e = this.element.querySelector(".item-text"), n = this.element.querySelector("i");
    e != null && (e.innerHTML = t.text), n != null && (n.className = t.icon);
  }
  addArray(t) {
    t.forEach((e) => {
        // Create a new instance for each menu item
        let n = new Vt(e);

        // Set options and listeners for the current item
        n.setOptions(this.options);
        n.setListenerDeleteButton(this.listenerDeleteButton);
        n.setListenerEditButton(this.listenerEditButton);

        // Attach click event handlers to buttons
        n.buttonGroup.onClickDelete(this.listenerDeleteButton);
        n.buttonGroup.onClickEdit(this.listenerEditButton);

        // Set data attributes for the current element
        const element = n.getElement();
        element.setAttribute('data-row-edit', e.id); // Set data-row-edit attribute
        element.setAttribute('data-row-delete', e.id); // Set data-row-delete attribute

        // Apply the dataset to the element
        Ht(element, n.getDataset());

        // If the current item has children, recursively add them
        if (e.children && e.children.length > 0) {
            n.addArray(e.children); // Recursively add child items
        }

        // Add the current item to the container
        this.add(n);
    });
}
  
  createHandler() {
    let t = document.createElement("span");
    return t.style.mixBlendMode = "difference", t.style.filter = "invert(1) grayscale(1)", t.className = "jme-handle", t.innerHTML = pn, t;
  }
  mount() {
    let t = document.createElement("div"), e = document.createElement("span"), n = document.createElement("i");
    n.className = this.dataset.icon;
    let o = this.createHandler(), r = document.createElement("span");
    r.className = "item-text", r.style.paddingLeft = "5px", r.innerHTML = this.dataset.text;
    let a = document.createElement("div");
    t.className = "d-flex w-100 justify-content-between align-items-center", e.append(o), e.append(n), e.append(r), a.classList.add("list-group", this.options.sortableClassname), t.append(e), this.buttonGroup.mount(), t.append(this.buttonGroup.getElement()), this.element.append(t), this.collection.getItems().forEach((l) => {
      l.mount(), a.appendChild(l.getElement());
    }), this.element.append(a);
  }
  getElement() {
    return this.element;
  }
}
class yn {
  constructor(t) {
    D(this, "element");
    D(this, "id");
    D(this, "collection");
    D(this, "options", { sortableClassname: "nested-sortable" });
    const e = document.getElementById(t);
    if (e == null)
      throw Error(`Error: Element with id="${t}" does not exists.`);
    this.id = t, this.element = e, this.collection = new Be();
  }
  setOptions(t) {
    this.options = t;
  }
  add(t, e = -1) {
    this.collection.add(t, e);
  }
  empty() {
    this.collection.empty();
    let t = this.element;
    for (; t.firstChild; )
      t.removeChild(t.firstChild);
  }
  mount() {
    this.element.classList.add("list-group", this.options.sortableClassname), this.collection.getItems().forEach((t) => {
      t.setOptions(this.options), t.mount(), this.element.append(t.getElement());
    });
  }
  getElement() {
    return this.element;
  }
}
class MenuEditor {
  constructor(t, e = vn) {
    D(this, "menuContainer");
    D(this, "currentItem", null);
    D(this, "listenerDeleteButton");
    D(this, "listenerEditButton");
    D(this, "sortableClassname", "");
    D(this, "options");
    this.menuContainer = new yn(t), this.sortableClassname = `${t}-nested-sortable`, this.options = e, this.menuContainer.setOptions({ sortableClassname: this.sortableClassname }), this.listenerDeleteButton = () => {
    }, this.listenerEditButton = () => {
    };
  }
  add(t) {
    let e = new Vt(t);
    e.setOptions({ sortableClassname: this.sortableClassname }), e.setListenerEditButton(this.listenerEditButton), e.buttonGroup.onClickEdit(this.listenerEditButton), e.setListenerDeleteButton(this.listenerDeleteButton), e.buttonGroup.onClickDelete(this.listenerDeleteButton), Ht(e.getElement(), t), e.getElement().ariaLevel = "0", this.menuContainer.add(e), e.mount(), this.makeItemSortable(e), this.menuContainer.getElement().append(e.getElement());
  }
  edit(t) {
    this.currentItem = t;
  }
  update(t) {
    this.currentItem != null && (this.currentItem.setDataset(t), Ht(this.currentItem.getElement(), t), this.currentItem.updateUI(t), this.currentItem = null);
  }
  setArray(t) {
    t.forEach((e) => {
        let n = new Vt(e); // Create a new instance for each menu item

        
        // Set options like before
        n.setOptions({ sortableClassname: this.sortableClassname });
        n.setListenerDeleteButton(this.listenerDeleteButton);
        n.setListenerEditButton(this.listenerEditButton);
        
        // Add custom data attributes (data-row-edit and data-row-delete)
        const element = n.getElement();
        element.setAttribute('data-row-edit', e.id); 
        element.setAttribute('data-row-delete', e.id); 
        
        
        
        Ht(element, n.getDataset());
        
        // Recursively add children if they exist
        if (e.children && e.children.length > 0) {
          // Use `n.addArray` to add children to the parent element
          n.addArray(e.children);
          // console.log(e);
        }

        // Add the element to the menu container
        this.menuContainer.add(n);
    });
}


  getString() { 
    let t = this.htmlToJson(this.menuContainer.getElement());

    return JSON.stringify(t);
  }
  htmlToJson(t) {
    let e = t.children, n = [];
    for (var o = 0; o < e.length; o++) {
      let r = e.item(o), a = wn(r.dataset), l = r.lastElementChild;
      if (a.children = [], l.childElementCount > 0) {
        let s = this.htmlToJson(l);
        a.children = s;
      }
      n.push(a);
    }
    return n;
  }
  onClickEdit(t) {
    this.listenerEditButton = t;
  }
  onClickDelete(t) {
    this.listenerDeleteButton = t;
  }
  empty() {
    this.menuContainer.empty();
  }
  mount() {
    this.menuContainer.mount(), this.makeItSortable(), Yt(this.menuContainer.getElement());
  }
  makeItSortable() {
    for (var t = [].slice.call(document.querySelectorAll("." + this.sortableClassname)), e = 0; e < t.length; e++)
      new f(t[e], {
        handle: ".jme-handle",
        ghostClass: "ghost",
        group: {
          name: "nested",
          pull: (n, o, r) => {
            if (this.options.maxLevel < 0)
              return !0;
            let a = parseInt(n.el.ariaLevel);
            return le(r, 0) + a < this.options.maxLevel;
          }
        },
        onEnd: (n) => {
          Yt(this.menuContainer.getElement());
        },
        animation: 150,
        fallbackOnBody: !0,
        swapThreshold: 0.65
      });
  }
  makeItemSortable(t) {
    let e = t.getElement().querySelector("." + this.sortableClassname);
    e != null && new f(e, {
      handle: ".jme-handle",
      ghostClass: "ghost",
      group: {
        name: "nested",
        pull: (n, o, r) => {
          if (this.options.maxLevel < 0)
            return !0;
          let a = parseInt(n.el.ariaLevel);
          return le(r, 0) + a < this.options.maxLevel;
        }
      },
      onEnd: (n) => {
        Yt(this.menuContainer.getElement());
      },
      animation: 150,
      fallbackOnBody: !0,
      swapThreshold: 0.65
    });
  }
}
