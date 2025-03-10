/*!
 * jQuery.filer minified
 * Copyright (c) 2016 CreativeDream
 * Website: https://github.com/CreativeDream/jquery.filer
 * Version: 1.3 (14-Sep-2016)
 * Requires: jQuery v1.7.1 or later
 */
! function(a) {
    "use strict";
    a.fn.filer = function(b) {
        return this.each(function(c, d) {
            var e = a(d),
                f = ".jFiler",
                g = a(),
                h = a(),
                i = a(),
                j = [],
                k = a.isFunction(b) ? b(e, a.fn.filer.defaults) : b,
                l = k && a.isPlainObject(k) ? a.extend(!0, {}, a.fn.filer.defaults, k) : a.fn.filer.defaults,
                m = {
                    init: function() {
                        e.wrap('<div class="jFiler"></div>'), m._set("props"), e.prop("jFiler").boxEl = g = e.closest(f), m._changeInput()
                    },
                    _bindInput: function() {
                        l.changeInput && h.length > 0 && h.on("click", m._clickHandler), e.on({
                            focus: function() {
                                h.addClass("focused")
                            },
                            blur: function() {
                                h.removeClass("focused")
                            },
                            change: m._onChange
                        }), l.dragDrop && (l.dragDrop.dragContainer.on("drag dragstart dragend dragover dragenter dragleave drop", function(a) {
                            a.preventDefault(), a.stopPropagation()
                        }), l.dragDrop.dragContainer.on("drop", m._dragDrop.drop), l.dragDrop.dragContainer.on("dragover", m._dragDrop.dragEnter), l.dragDrop.dragContainer.on("dragleave", m._dragDrop.dragLeave)), l.uploadFile && l.clipBoardPaste && a(window).on("paste", m._clipboardPaste)
                    },
                    _unbindInput: function(b) {
                        l.changeInput && h.length > 0 && h.off("click", m._clickHandler), b && (e.off("change", m._onChange), l.dragDrop && (l.dragDrop.dragContainer.off("drop", m._dragDrop.drop), l.dragDrop.dragContainer.off("dragover", m._dragDrop.dragEnter), l.dragDrop.dragContainer.off("dragleave", m._dragDrop.dragLeave)), l.uploadFile && l.clipBoardPaste && a(window).off("paste", m._clipboardPaste))
                    },
                    _clickHandler: function() {
                        if (!l.uploadFile && l.addMore && 0 != e.val().length) {
                            m._unbindInput(!0);
                            var b = a('<input type="file" />'),
                                c = e.prop("attributes");
                            a.each(c, function() {
                                "required" != this.name && b.attr(this.name, this.value)
                            }), e.after(b), j.push(b), e = b, m._bindInput(), m._set("props")
                        }
                        e.click()
                    },
                    _applyAttrSettings: function() {
                        var a = ["name", "limit", "maxSize", "fileMaxSize", "extensions", "changeInput", "showThumbs", "appendTo", "theme", "addMore", "excludeName", "files", "uploadUrl", "uploadData", "options"];
                        for (var b in a) {
                            var c = "data-jfiler-" + a[b];
                            if (m._assets.hasAttr(c)) {
                                switch (a[b]) {
                                    case "changeInput":
                                    case "showThumbs":
                                    case "addMore":
                                        l[a[b]] = ["true", "false"].indexOf(e.attr(c)) > -1 ? "true" == e.attr(c) : e.attr(c);
                                        break;
                                    case "extensions":
                                        l[a[b]] = e.attr(c).replace(/ /g, "").split(",");
                                        break;
                                    case "uploadUrl":
                                        l.uploadFile && (l.uploadFile.url = e.attr(c));
                                        break;
                                    case "uploadData":
                                        l.uploadFile && (l.uploadFile.data = JSON.parse(e.attr(c)));
                                        break;
                                    case "files":
                                    case "options":
                                        l[a[b]] = JSON.parse(e.attr(c));
                                        break;
                                    default:
                                        l[a[b]] = e.attr(c)
                                }
                                e.removeAttr(c)
                            }
                        }
                    },
                    _changeInput: function() {
                        if (m._applyAttrSettings(), null != l.beforeRender && "function" == typeof l.beforeRender ? l.beforeRender(g, e) : null, l.theme && g.addClass("jFiler-theme-" + l.theme), "input" != e.get(0).tagName.toLowerCase() && "file" != e.get(0).type) h = e, e = a('<input type="file" name="' + l.name + '" />'), e.css({
                            position: "absolute",
                            left: "-9999px",
                            top: "-9999px",
                            "z-index": "-9999"
                        }), g.prepend(e), m._isGn = e;
                        else if (l.changeInput) {
                            switch (typeof l.changeInput) {
                                case "boolean":
                                    h = a('<div class="jFiler-input"><div class="jFiler-input-caption"><span>' + l.captions.feedback + '</span></div><div class="jFiler-input-button">' + l.captions.button + '</div></div>"');
                                    break;
                                case "string":
                                case "object":
                                    h = a(l.changeInput);
                                    break;
                                case "function":
                                    h = a(l.changeInput(g, e, l))
                            }
                            e.after(h), e.css({
                                position: "absolute",
                                left: "-9999px",
                                top: "-9999px",
                                "z-index": "-9999"
                            })
                        }
                        e.prop("jFiler").newInputEl = h, l.dragDrop && (l.dragDrop.dragContainer = l.dragDrop.dragContainer ? a(l.dragDrop.dragContainer) : h), (!l.limit || l.limit && l.limit >= 2) && (e.attr("multiple", "multiple"), "[]" != e.attr("name").slice(-2) ? e.attr("name", e.attr("name") + "[]") : null), e.attr("disabled") || l.disabled ? (l.disabled = !0, m._unbindInput(!0), g.addClass("jFiler-disabled")) : (l.disabled = !1, m._bindInput(), g.removeClass("jFiler-disabled")), l.files && m._append(!1, {
                            files: l.files
                        }), null != l.afterRender && "function" == typeof l.afterRender ? l.afterRender(i, g, h, e) : null
                    },
                    _clear: function() {
                        m.files = null, e.prop("jFiler").files = null, l.uploadFile || l.addMore || m._reset(), m._set("feedback", m._itFl && m._itFl.length > 0 ? m._itFl.length + " " + l.captions.feedback2 : l.captions.feedback), null != l.onEmpty && "function" == typeof l.onEmpty ? l.onEmpty(g, h, e) : null
                    },
                    _reset: function(b) {
                        if (!b) {
                            if (!l.uploadFile && l.addMore) {
                                for (var c = 0; c < j.length; c++) j[c].remove();
                                j = [], m._unbindInput(!0), e = m._isGn ? m._isGn : a(d), m._bindInput()
                            }
                            m._set("input", "")
                        }
                        m._itFl = [], m._itFc = null, m._ajFc = 0, m._set("props"), e.prop("jFiler").files_list = m._itFl, e.prop("jFiler").current_file = m._itFc, m._itFr = [], g.find("input[name^='jfiler-items-exclude-']:hidden").remove(), i.fadeOut("fast", function() {
                            a(this).remove()
                        }), e.prop("jFiler").listEl = i = a()
                    },
                    _set: function(a, b) {
                        switch (a) {
                            case "input":
                                e.val(b);
                                break;
                            case "feedback":
                                h.length > 0 && h.find(".jFiler-input-caption span").html(b);
                                break;
                            case "props":
                                e.prop("jFiler") || e.prop("jFiler", {
                                    options: l,
                                    listEl: i,
                                    boxEl: g,
                                    newInputEl: h,
                                    inputEl: e,
                                    files: m.files,
                                    files_list: m._itFl,
                                    current_file: m._itFc,
                                    append: function(a) {
                                        return m._append(!1, {
                                            files: [a]
                                        })
                                    },
                                    enable: function() {
                                        l.disabled && (l.disabled = !1, e.removeAttr("disabled"), g.removeClass("jFiler-disabled"), m._bindInput())
                                    },
                                    disable: function() {
                                        l.disabled || (l.disabled = !0, g.addClass("jFiler-disabled"), m._unbindInput(!0))
                                    },
                                    remove: function(a) {
                                        return m._remove(null, {
                                            binded: !0,
                                            data: {
                                                id: a
                                            }
                                        }), !0
                                    },
                                    reset: function() {
                                        return m._reset(), m._clear(), !0
                                    },
                                    retry: function(a) {
                                        return m._retryUpload(a)
                                    }
                                })
                        }
                    },
                    _filesCheck: function() {
                        var b = 0;
                        if (l.limit && m.files.length + m._itFl.length > l.limit) return l.dialogs.alert(m._assets.textParse(l.captions.errors.filesLimit)), !1;
                        for (var c = 0; c < m.files.length; c++) {
                            var d = m.files[c],
                                e = d.name.split(".").pop().toLowerCase(),
                                f = {
                                    name: d.name,
                                    size: d.size,
                                    size2: m._assets.bytesToSize(d.size),
                                    type: d.type,
                                    ext: e
                                };
                            if (null != l.extensions && a.inArray(e, l.extensions) == -1 && a.inArray(f.type, l.extensions) == -1) return l.dialogs.alert(m._assets.textParse(l.captions.errors.filesType, f)), !1;
                            if (null != l.maxSize && m.files[c].size > 1048576 * l.maxSize || null != l.fileMaxSize && m.files[c].size > 1048576 * l.fileMaxSize) return l.dialogs.alert(m._assets.textParse(l.captions.errors.filesSize, f)), !1;
                            if (4096 == d.size && 0 == d.type.length) return l.dialogs.alert(m._assets.textParse(l.captions.errors.folderUpload, f)), !1;
                            if (null != l.onFileCheck && "function" == typeof l.onFileCheck ? l.onFileCheck(f, l, m._assets.textParse) === !1 : null) return !1;
                            if ((l.uploadFile || l.addMore) && !l.allowDuplicates) {
                                var f = m._itFl.filter(function(a, b) {
                                    if (a.file.name == d.name && a.file.size == d.size && a.file.type == d.type && (!d.lastModified || a.file.lastModified == d.lastModified)) return !0
                                });
                                if (f.length > 0) {
                                    if (1 == m.files.length) return !1;
                                    d._pendRemove = !0
                                }
                            }
                            b += m.files[c].size
                        }
                        return !(null != l.maxSize && b >= Math.round(1048576 * l.maxSize)) || (l.dialogs.alert(m._assets.textParse(l.captions.errors.filesSizeAll)), !1)
                    },
                    _thumbCreator: {
                        create: function(b) {
                            var c = m.files[b],
                                d = m._itFc ? m._itFc.id : b,
                                e = c.name,
                                f = c.size,
                                g = c.file,
                                h = c.type ? c.type.split("/", 1) : "".toString().toLowerCase(),
                                j = e.indexOf(".") != -1 ? e.split(".").pop().toLowerCase() : "",
                                k = l.uploadFile ? '<div class="jFiler-jProgressBar">' + l.templates.progressBar + "</div>" : "",
                                n = {
                                    id: d,
                                    name: e,
                                    size: f,
                                    size2: m._assets.bytesToSize(f),
                                    url: g,
                                    type: h,
                                    extension: j,
                                    icon: m._assets.getIcon(j, h),
                                    icon2: m._thumbCreator.generateIcon({
                                        type: h,
                                        extension: j
                                    }),
                                    image: '<div class="jFiler-item-thumb-image fi-loading"></div>',
                                    progressBar: k,
                                    _appended: c._appended
                                },
                                o = "";
                            return c.opts && (n = a.extend({}, c.opts, n)), o = a(m._thumbCreator.renderContent(n)).attr("data-jfiler-index", d), o.get(0).jfiler_id = d, m._thumbCreator.renderFile(c, o, n), c.forList ? o : (m._itFc.html = o, o.hide()[l.templates.itemAppendToEnd ? "appendTo" : "prependTo"](i.find(l.templates._selectors.list)).show(), void(c._appended || m._onSelect(b)))
                        },
                        renderContent: function(a) {
                            return m._assets.textParse(a._appended ? l.templates.itemAppend : l.templates.item, a)
                        },
                        renderFile: function(b, c, d) {
                            if (0 == c.find(".jFiler-item-thumb-image").length) return !1;
                            if (b.file && "image" == d.type) {
                                var e = '<img src="' + b.file + '" draggable="false" />',
                                    f = c.find(".jFiler-item-thumb-image.fi-loading");
                                return a(e).error(function() {
                                    e = m._thumbCreator.generateIcon(d), c.addClass("jFiler-no-thumbnail"), f.removeClass("fi-loading").html(e)
                                }).load(function() {
                                    f.removeClass("fi-loading").html(e)
                                }), !0
                            }
                            if (window.File && window.FileList && window.FileReader && "image" == d.type && d.size < 1e7) {
                                var g = new FileReader;
                                g.onload = function(a) {
                                    var b = c.find(".jFiler-item-thumb-image.fi-loading");
                                    if (l.templates.canvasImage) {
                                        var e = document.createElement("canvas"),
                                            f = e.getContext("2d"),
                                            g = new Image;
                                        g.onload = function() {
                                            var a = b.height(),
                                                c = b.width(),
                                                d = g.height / a,
                                                h = g.width / c,
                                                i = d < h ? d : h,
                                                j = g.height / i,
                                                k = g.width / i,
                                                l = Math.ceil(Math.log(g.width / k) / Math.log(2));
                                            if (e.height = a, e.width = c, g.width < e.width || g.height < e.height || l <= 1) {
                                                var m = g.width < e.width ? e.width / 2 - g.width / 2 : g.width > e.width ? -(g.width - e.width) / 2 : 0,
                                                    n = g.height < e.height ? e.height / 2 - g.height / 2 : 0;
                                                f.drawImage(g, m, n, g.width, g.height)
                                            } else {
                                                var o = document.createElement("canvas"),
                                                    p = o.getContext("2d");
                                                o.width = .5 * g.width, o.height = .5 * g.height, p.fillStyle = "#fff", p.fillRect(0, 0, o.width, o.height), p.drawImage(g, 0, 0, o.width, o.height), p.drawImage(o, 0, 0, .5 * o.width, .5 * o.height), f.drawImage(o, k > e.width ? k - e.width : 0, 0, .5 * o.width, .5 * o.height, 0, 0, k, j)
                                            }
                                            b.removeClass("fi-loading").html('<img src="' + e.toDataURL("image/png") + '" draggable="false" />')
                                        }, g.onerror = function() {
                                            c.addClass("jFiler-no-thumbnail"), b.removeClass("fi-loading").html(m._thumbCreator.generateIcon(d))
                                        }, g.src = a.target.result
                                    } else b.removeClass("fi-loading").html('<img src="' + a.target.result + '" draggable="false" />')
                                }, g.readAsDataURL(b)
                            } else {
                                var e = m._thumbCreator.generateIcon(d),
                                    f = c.find(".jFiler-item-thumb-image.fi-loading");
                                c.addClass("jFiler-no-thumbnail"), f.removeClass("fi-loading").html(e)
                            }
                        },
                        generateIcon: function(b) {
                            var c = new Array(3);
                            if (b && b.type && b.type[0] && b.extension) switch (b.type[0]) {
                                case "image":
                                    c[0] = "f-image", c[1] = '<i class="icon-jfi-file-image"></i>';
                                    break;
                                case "video":
                                    c[0] = "f-video", c[1] = '<i class="icon-jfi-file-video"></i>';
                                    break;
                                case "audio":
                                    c[0] = "f-audio", c[1] = '<i class="icon-jfi-file-audio"></i>';
                                    break;
                                default:
                                    c[0] = "f-file f-file-ext-" + b.extension, c[1] = b.extension.length > 0 ? "." + b.extension : "", c[2] = 1
                            } else c[0] = "f-file", c[1] = b.extension && b.extension.length > 0 ? "." + b.extension : "", c[2] = 1;
                            var d = '<span class="jFiler-icon-file ' + c[0] + '">' + c[1] + "</span>";
                            if (1 == c[2]) {
                                var e = m._assets.text2Color(b.extension);
                                if (e) {
                                    var f = a(d).appendTo("body");
                                    f.css("background-color", m._assets.text2Color(b.extension)), d = f.prop("outerHTML"), f.remove()
                                }
                            }
                            return d
                        },
                        _box: function(b) {
                            if (null != l.beforeShow && "function" == typeof l.beforeShow && !l.beforeShow(m.files, i, g, h, e)) return !1;
                            if (i.length < 1) {
                                if (l.appendTo) var c = a(l.appendTo);
                                else var c = g;
                                c.find(".jFiler-items").remove(), i = a('<div class="jFiler-items jFiler-row"></div>'), e.prop("jFiler").listEl = i, i.append(m._assets.textParse(l.templates.box)).appendTo(c), i.on("click", l.templates._selectors.remove, function(c) {
                                    c.preventDefault();
                                    var d = [b ? b.remove.event : c, b ? b.remove.el : a(this).closest(l.templates._selectors.item)],
                                        e = function(a) {
                                            m._remove(d[0], d[1])
                                        };
                                    l.templates.removeConfirmation ? l.dialogs.confirm(l.captions.removeConfirmation, e) : e()
                                })
                            }
                            for (var d = 0; d < m.files.length; d++) m.files[d]._appended || (m.files[d]._choosed = !0), m._addToMemory(d), m._thumbCreator.create(d)
                        }
                    },
                    _upload: function(b) {
                        var c = m._itFl[b],
                            d = c.html,
                            f = new FormData;
                        if (f.append(e.attr("name"), c.file, !!c.file.name && c.file.name), null != l.uploadFile.data && a.isPlainObject("function" == typeof l.uploadFile.data ? l.uploadFile.data(c.file) : l.uploadFile.data))
                            for (var g in l.uploadFile.data) f.append(g, l.uploadFile.data[g]);
                        m._ajax.send(d, f, c)
                    },
                    _ajax: {
                        send: function(b, c, d) {
                            return d.ajax = a.ajax({
                                url: l.uploadFile.url,
                                data: c,
                                type: l.uploadFile.type,
                                enctype: l.uploadFile.enctype,
                                xhr: function() {
                                    var c = a.ajaxSettings.xhr();
                                    return c.upload && c.upload.addEventListener("progress", function(a) {
                                        m._ajax.progressHandling(a, b)
                                    }, !1), c
                                },
                                complete: function(a, b) {
                                    d.ajax = !1, m._ajFc++, l.uploadFile.synchron && d.id + 1 < m._itFl.length && m._upload(d.id + 1), m._ajFc >= m.files.length && (m._ajFc = 0, e.get(0).value = "", null != l.uploadFile.onComplete && "function" == typeof l.uploadFile.onComplete ? l.uploadFile.onComplete(i, g, h, e, a, b) : null)
                                },
                                beforeSend: function(a, c) {
                                    return null == l.uploadFile.beforeSend || "function" != typeof l.uploadFile.beforeSend || l.uploadFile.beforeSend(b, i, g, h, e, d.id, a, c)
                                },
                                success: function(a, c, f) {
                                    d.uploaded = !0, null != l.uploadFile.success && "function" == typeof l.uploadFile.success ? l.uploadFile.success(a, b, i, g, h, e, d.id, c, f) : null
                                },
                                error: function(a, c, f) {
                                    d.uploaded = !1, null != l.uploadFile.error && "function" == typeof l.uploadFile.error ? l.uploadFile.error(b, i, g, h, e, d.id, a, c, f) : null
                                },
                                statusCode: l.uploadFile.statusCode,
                                cache: !1,
                                contentType: !1,
                                processData: !1
                            }), d.ajax
                        },
                        progressHandling: function(a, b) {
                            if (a.lengthComputable) {
                                var c = Math.round(100 * a.loaded / a.total).toString();
                                null != l.uploadFile.onProgress && "function" == typeof l.uploadFile.onProgress ? l.uploadFile.onProgress(c, b, i, g, h, e) : null, b.find(".jFiler-jProgressBar").find(l.templates._selectors.progressBar).css("width", c + "%")
                            }
                        }
                    },
                    _dragDrop: {
                        dragEnter: function(a) {
                            clearTimeout(m._dragDrop._drt), l.dragDrop.dragContainer.addClass("dragged"), m._set("feedback", l.captions.drop), null != l.dragDrop.dragEnter && "function" == typeof l.dragDrop.dragEnter ? l.dragDrop.dragEnter(a, h, e, g) : null
                        },
                        dragLeave: function(a) {
                            clearTimeout(m._dragDrop._drt), m._dragDrop._drt = setTimeout(function(a) {
                                return m._dragDrop._dragLeaveCheck(a) ? (l.dragDrop.dragContainer.removeClass("dragged"), m._set("feedback", l.captions.feedback), void(null != l.dragDrop.dragLeave && "function" == typeof l.dragDrop.dragLeave ? l.dragDrop.dragLeave(a, h, e, g) : null)) : (m._dragDrop.dragLeave(a), !1)
                            }, 100, a)
                        },
                        drop: function(a) {
                            clearTimeout(m._dragDrop._drt), l.dragDrop.dragContainer.removeClass("dragged"), m._set("feedback", l.captions.feedback), a && a.originalEvent && a.originalEvent.dataTransfer && a.originalEvent.dataTransfer.files && a.originalEvent.dataTransfer.files.length > 0 && m._onChange(a, a.originalEvent.dataTransfer.files), null != l.dragDrop.drop && "function" == typeof l.dragDrop.drop ? l.dragDrop.drop(a.originalEvent.dataTransfer.files, a, h, e, g) : null
                        },
                        _dragLeaveCheck: function(b) {
                            var c = a(b.currentTarget),
                                d = 0;
                            return !(!c.is(h) && (d = h.find(c).length, d > 0))
                        }
                    },
                    _clipboardPaste: function(a, b) {
                        if ((b || a.originalEvent.clipboardData || a.originalEvent.clipboardData.items) && (!b || a.originalEvent.dataTransfer || a.originalEvent.dataTransfer.items) && !m._clPsePre) {
                            var c = b ? a.originalEvent.dataTransfer.items : a.originalEvent.clipboardData.items,
                                d = function(a, b, c) {
                                    b = b || "", c = c || 512;
                                    for (var d = atob(a), e = [], f = 0; f < d.length; f += c) {
                                        for (var g = d.slice(f, f + c), h = new Array(g.length), i = 0; i < g.length; i++) h[i] = g.charCodeAt(i);
                                        var j = new Uint8Array(h);
                                        e.push(j)
                                    }
                                    var k = new Blob(e, {
                                        type: b
                                    });
                                    return k
                                };
                            if (c)
                                for (var e = 0; e < c.length; e++)
                                    if (c[e].type.indexOf("image") !== -1 || c[e].type.indexOf("text/uri-list") !== -1) {
                                        if (b) try {
                                            window.atob(a.originalEvent.dataTransfer.getData("text/uri-list").toString().split(",")[1])
                                        } catch (a) {
                                            return
                                        }
                                        var f = b ? d(a.originalEvent.dataTransfer.getData("text/uri-list").toString().split(",")[1], "image/png") : c[e].getAsFile();
                                        f.name = Math.random().toString(36).substring(5), f.name += f.type.indexOf("/") != -1 ? "." + f.type.split("/")[1].toString().toLowerCase() : ".png", m._onChange(a, [f]), m._clPsePre = setTimeout(function() {
                                            delete m._clPsePre
                                        }, 1e3)
                                    }
                        }
                    },
                    _onSelect: function(b) {
                        l.uploadFile && !a.isEmptyObject(l.uploadFile) && (!l.uploadFile.synchron || l.uploadFile.synchron && 0 == a.grep(m._itFl, function(a) {
                            return a.ajax
                        }).length) && m._upload(m._itFc.id), m.files[b]._pendRemove && (m._itFc.html.hide(), m._remove(null, {
                            binded: !0,
                            data: {
                                id: m._itFc.id
                            }
                        })), null != l.onSelect && "function" == typeof l.onSelect ? l.onSelect(m.files[b], m._itFc.html, i, g, h, e) : null, b + 1 >= m.files.length && (null != l.afterShow && "function" == typeof l.afterShow ? l.afterShow(i, g, h, e) : null)
                    },
                    _onChange: function(b, c) {
                        if (c) {
                            if (!c || 0 == c.length) return m._set("input", ""), m._clear(), !1;
                            m.files = c
                        } else {
                            if (!e.get(0).files || "undefined" == typeof e.get(0).files || 0 == e.get(0).files.length) return l.uploadFile || l.addMore || (m._set("input", ""), m._clear()), !1;
                            m.files = e.get(0).files
                        }
                        if (l.uploadFile || l.addMore || m._reset(!0), e.prop("jFiler").files = m.files, !m._filesCheck() || null != l.beforeSelect && "function" == typeof l.beforeSelect && !l.beforeSelect(m.files, i, g, h, e)) return m._set("input", ""), m._clear(), l.addMore && j.length > 0 && (m._unbindInput(!0), j[j.length - 1].remove(), j.splice(j.length - 1, 1), e = j.length > 0 ? j[j.length - 1] : a(d), m._bindInput()), !1;
                        if (m._set("feedback", m.files.length + m._itFl.length + " " + l.captions.feedback2), l.showThumbs) m._thumbCreator._box();
                        else
                            for (var f = 0; f < m.files.length; f++) m.files[f]._choosed = !0, m._addToMemory(f), m._onSelect(f)
                    },
                    _append: function(a, b) {
                        var c = !!b && b.files;
                        if (c && !(c.length <= 0) && (m.files = c, e.prop("jFiler").files = m.files, l.showThumbs)) {
                            for (var d = 0; d < m.files.length; d++) m.files[d]._appended = !0;
                            m._thumbCreator._box()
                        }
                    },
                    _getList: function(a, b) {
                        var c = !!b && b.files;
                        if (c && !(c.length <= 0) && (m.files = c, e.prop("jFiler").files = m.files, l.showThumbs)) {
                            for (var d = [], f = 0; f < m.files.length; f++) m.files[f].forList = !0, d.push(m._thumbCreator.create(f));
                            b.callback && b.callback(d, i, g, h, e)
                        }
                    },
                    _retryUpload: function(b, c) {
                        var d = parseInt("object" == typeof c ? c.attr("data-jfiler-index") : c),
                            f = m._itFl.filter(function(a, b) {
                                return a.id == d
                            });
                        return f.length > 0 && (!l.uploadFile || a.isEmptyObject(l.uploadFile) || f[0].uploaded ? void 0 : (m._itFc = f[0], e.prop("jFiler").current_file = m._itFc, m._upload(d), !0))
                    },
                    _remove: function(b, d) {
                        if (d.binded) {
                            if ("undefined" != typeof d.data.id && (d = i.find(l.templates._selectors.item + "[data-jfiler-index='" + d.data.id + "']"), 0 == d.length)) return !1;
                            d.data.el && (d = d.data.el)
                        }
                        var f = function(b) {
                                var d = g.find("input[name^='jfiler-items-exclude-']:hidden").first();
                                0 == d.length && (d = a('<input type="hidden" name="jfiler-items-exclude-' + (l.excludeName ? l.excludeName : ("[]" != e.attr("name").slice(-2) ? e.attr("name") : e.attr("name").substring(0, e.attr("name").length - 2)) + "-" + c) + '">'), d.appendTo(g)), b && a.isArray(b) && (b = JSON.stringify(b), d.val(b))
                            },
                            j = function(b, c) {
                                var d = m._itFl[c],
                                    e = [];
                                if (d.file._choosed || d.file._appended || d.uploaded) {
                                    m._itFr.push(d);
                                    for (var g = m._itFl.filter(function(a) {
                                            return a.file.name == d.file.name
                                        }), h = 0; h < m._itFr.length; h++) l.addMore && m._itFr[h] == d && g.length > 0 && (m._itFr[h].remove_name = g.indexOf(d) + "://" + m._itFr[h].file.name), e.push(m._itFr[h].remove_name ? m._itFr[h].remove_name : m._itFr[h].file.name)
                                }
                                f(e), m._itFl.splice(c, 1), m._itFl.length < 1 ? (m._reset(), m._clear()) : m._set("feedback", m._itFl.length + " " + l.captions.feedback2), b.fadeOut("fast", function() {
                                    a(this).remove()
                                })
                            },
                            k = d.get(0).jfiler_id || d.attr("data-jfiler-index"),
                            n = null;
                        for (var o in m._itFl) "length" !== o && m._itFl.hasOwnProperty(o) && m._itFl[o].id == k && (n = o);
                        return !!m._itFl.hasOwnProperty(n) && (m._itFl[n].ajax ? (m._itFl[n].ajax.abort(), void j(d, n)) : void(null != l.onRemove && "function" == typeof l.onRemove && l.onRemove(d, m._itFl[n].file, n, i, g, h, e) === !1 || j(d, n)))
                    },
                    _addToMemory: function(b) {
                        m._itFl.push({
                            id: m._itFl.length,
                            file: m.files[b],
                            html: a(),
                            ajax: !1,
                            uploaded: !1
                        }), (l.addMore || m.files[b]._appended) && (m._itFl[m._itFl.length - 1].input = e), m._itFc = m._itFl[m._itFl.length - 1], e.prop("jFiler").files_list = m._itFl, e.prop("jFiler").current_file = m._itFc
                    },
                    _assets: {
                        bytesToSize: function(a) {
                            if (0 == a) return "0 Byte";
                            var b = 1e3,
                                c = ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"],
                                d = Math.floor(Math.log(a) / Math.log(b));
                            return (a / Math.pow(b, d)).toPrecision(3) + " " + c[d]
                        },
                        hasAttr: function(a, b) {
                            var b = b ? b : e,
                                c = b.attr(a);
                            return !(!c || "undefined" == typeof c)
                        },
                        getIcon: function(b, c) {
                            var d = ["audio", "image", "text", "video"];
                            return a.inArray(c, d) > -1 ? '<i class="icon-jfi-file-' + c + " jfi-file-ext-" + b + '"></i>' : '<i class="icon-jfi-file-o jfi-file-type-' + c + " jfi-file-ext-" + b + '"></i>'
                        },
                        textParse: function(b, c) {
                            switch (c = a.extend({}, {
                                limit: l.limit,
                                maxSize: l.maxSize,
                                fileMaxSize: l.fileMaxSize,
                                extensions: l.extensions ? l.extensions.join(",") : null
                            }, c && a.isPlainObject(c) ? c : {}, l.options), typeof b) {
                                case "string":
                                    return b.replace(/\{\{fi-(.*?)\}\}/g, function(a, b) {
                                        return b = b.replace(/ /g, ""), b.match(/(.*?)\|limitTo\:(\d+)/) ? b.replace(/(.*?)\|limitTo\:(\d+)/, function(a, b, d) {
                                            var b = c[b] ? c[b] : "",
                                                e = b.substring(0, d);
                                            return e = b.length > e.length ? e.substring(0, e.length - 3) + "..." : e
                                        }) : c[b] ? c[b] : ""
                                    });
                                case "function":
                                    return b(c);
                                default:
                                    return b
                            }
                        },
                        text2Color: function(a) {
                            if (!a || 0 == a.length) return !1;
                            for (var b = 0, c = 0; b < a.length; c = a.charCodeAt(b++) + ((c << 5) - c));
                            for (var b = 0, d = "#"; b < 3; d += ("00" + (c >> 2 * b++ & 255).toString(16)).slice(-2));
                            return d
                        }
                    },
                    files: null,
                    _itFl: [],
                    _itFc: null,
                    _itFr: [],
                    _itPl: [],
                    _ajFc: 0
                };
            return e.on("filer.append", function(a, b) {
                m._append(a, b)
            }).on("filer.remove", function(a, b) {
                b.binded = !0, m._remove(a, b)
            }).on("filer.reset", function(a) {
                return m._reset(), m._clear(), !0
            }).on("filer.generateList", function(a, b) {
                return m._getList(a, b)
            }).on("filer.retry", function(a, b) {
                return m._retryUpload(a, b)
            }), m.init(), this
        })
    }, a.fn.filer.defaults = {
        limit: null,
        maxSize: null,
        fileMaxSize: null,
        extensions: null,
        changeInput: !0,
        showThumbs: !1,
        appendTo: null,
        theme: "default",
        templates: {
            box: '<ul class="jFiler-items-list jFiler-items-default"></ul>',
            item: '<li class="jFiler-item"><div class="jFiler-item-container"><div class="jFiler-item-inner"><div class="jFiler-item-icon pull-left">{{fi-icon}}</div><div class="jFiler-item-info pull-left"><div class="jFiler-item-title" title="{{fi-name}}">{{fi-name | limitTo:30}}</div><div class="jFiler-item-others"><span>size: {{fi-size2}}</span><span>type: {{fi-extension}}</span><span class="jFiler-item-status">{{fi-progressBar}}</span></div><div class="jFiler-item-assets"><ul class="list-inline"><li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li></ul></div></div></div></div></li>',
            itemAppend: '<li class="jFiler-item"><div class="jFiler-item-container"><div class="jFiler-item-inner"><div class="jFiler-item-icon pull-left">{{fi-icon}}</div><div class="jFiler-item-info pull-left"><div class="jFiler-item-title">{{fi-name | limitTo:35}}</div><div class="jFiler-item-others"><span>size: {{fi-size2}}</span><span>type: {{fi-extension}}</span><span class="jFiler-item-status"></span></div><div class="jFiler-item-assets"><ul class="list-inline"><li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li></ul></div></div></div></div></li>',
            progressBar: '<div class="bar"></div>',
            itemAppendToEnd: !1,
            removeConfirmation: !0,
            canvasImage: !0,
            _selectors: {
                list: ".jFiler-items-list",
                item: ".jFiler-item",
                progressBar: ".bar",
                remove: ".jFiler-item-trash-action"
            }
        },
        files: null,
        uploadFile: null,
        dragDrop: null,
        addMore: !1,
        allowDuplicates: !1,
        clipBoardPaste: !0,
        excludeName: null,
        beforeRender: null,
        afterRender: null,
        beforeShow: null,
        beforeSelect: null,
        onSelect: null,
        onFileCheck: null,
        afterShow: null,
        onRemove: null,
        onEmpty: null,
        options: null,
        dialogs: {
            alert: function(a) {
                return alert(a)
            },
            confirm: function(a, b) {
                confirm(a) ? b() : null
            }
        },
        captions: {
            button: "Choose Files",
            feedback: "Choose files To Upload",
            feedback2: "files were chosen",
            drop: "Drop file here to Upload",
            removeConfirmation: "Are you sure you want to remove this file?",
            errors: {
                filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
                filesType: "Only Images are allowed to be uploaded.",
                filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-fileMaxSize}} MB.",
                filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB.",
                folderUpload: "You are not allowed to upload folders."
            }
        }
    }
}(jQuery);