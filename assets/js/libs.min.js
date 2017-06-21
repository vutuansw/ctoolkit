/*
 * cToolkit library
 * 
 * @license: GPLv3
 * @author: tuanvu
 */


jQuery(function ($) {

    'use strict';

    var $document = $(document);

    $.fn.ctoolkitLink = function () {

        $document.on('click', '.ctoolkit-link .link_button', function (e) {

            e.preventDefault();
            var $block, $input, $url_label, $title_label, value_object, $link_submit, $ctoolkit_link_submit, $ctoolkit_link_nofollow, dialog;
            $block = $(this).closest(".ctoolkit-link");
            $input = $block.find("input.ctoolkit_value");
            $url_label = $block.find(".url-label");
            $title_label = $block.find(".title-label");
            value_object = $input.data("json");
            $link_submit = $("#wp-link-submit");
            $ctoolkit_link_submit = $('<input type="button" name="ctoolkit_link-submit" id="ctoolkit_link-submit" class="button-primary" value="Set Link">');
            $link_submit.hide();
            $("#ctoolkit_link-submit").remove();
            $ctoolkit_link_submit.insertBefore($link_submit);
            $ctoolkit_link_nofollow = $('<div class="link-target ctoolkit-link-nofollow"><label><span></span> <input type="checkbox" id="ctoolkit-link-nofollow"> Add nofollow option to link</label></div>');
            $("#link-options .ctoolkit-link-nofollow").remove();
            $ctoolkit_link_nofollow.insertAfter($("#link-options .link-target"));
            setTimeout(function () {
                var currentHeight = $("#most-recent-results").css("top");
                $("#most-recent-results").css("top", parseInt(currentHeight) + $ctoolkit_link_nofollow.height())
            }, 200);
            dialog = window.wpLink;
            dialog.open('content');

            if (typeof value_object.url == 'string' && $("#wp-link-url").length) {
                $("#wp-link-url").val(value_object.url);
            } else {
                $("#url-field").val(value_object.url);
            }

            if (typeof value_object.url == 'string' && $("#wp-link-text").length) {
                $("#wp-link-text").val(value_object.title);
            } else {
                $("#link-title-field").val(value_object.title);
            }

            if ($("#wp-link-target").length) {

                $("#wp-link-target").prop("checked", value_object.target.length);
            } else {
                $("#link-target-checkbox").prop("checked", value_object.target.length);
            }

            if ($("#ctoolkit-link-nofollow").length) {
                $("#ctoolkit-link-nofollow").prop("checked", value_object.rel.length);
            }


            $ctoolkit_link_submit.unbind("click.ctoolkitLink").bind("click.ctoolkitLink", function (e) {

                e.preventDefault();
                e.stopImmediatePropagation();
                var string, options = {};
                options.url = $("#wp-link-url").length ? $("#wp-link-url").val() : $("#url-field").val();
                options.title = $("#wp-link-text").length ? $("#wp-link-text").val() : $("#link-title-field").val();
                var $checkbox = $($("#wp-link-target").length ? "#wp-link-target" : "#link-target-checkbox");
                options.target = $checkbox[0].checked ? " _blank" : "";
                options.rel = $("#ctoolkit-link-nofollow")[0].checked ? "nofollow" : "";

                string = $.map(options, function (value, key) {
                    return typeof value == 'string' && 0 < value.length ? key + ":" + encodeURIComponent(value) : void 0
                }).join("|");

                $input.val(string).change();
                $input.data("json", options);
                $url_label.html(options.url + options.target);
                $title_label.html(options.title);
                dialog.close('noReset');
                window.wpLink.textarea = "";
                $link_submit.show();
                $ctoolkit_link_submit.unbind("click.ctoolkitLink");
                $ctoolkit_link_submit.remove();
                $("#wp-link-cancel").unbind("click.ctoolkitLink");
                $checkbox.attr("checked", false);
                $("#most-recent-results").css("top", "");
                $("#ctoolkit-link-nofollow").attr("checked", false);
                return false;
            });
            $("#wp-link-cancel").unbind("click.ctoolkitLink").bind("click.ctoolkitLink", function (e) {
                e.preventDefault();
                dialog.close('noReset');
                $ctoolkit_link_submit.unbind("click.ctoolkitLink");
                $ctoolkit_link_submit.remove();
                $("#wp-link-cancel").unbind("click.ctoolkitLink");
                $("#wp-link-close").unbind("click.ctoolkitCloseLink");
                window.wpLink.textarea = "";
                return false;
            });
            $('#wp-link-close').unbind('click').bind('click.ctoolkitCloseLink', function (e) {
                e.preventDefault();
                dialog.close('noReset');
                $ctoolkit_link_submit.unbind("click.ctoolkitLink");
                $ctoolkit_link_submit.remove();
                $("#wp-link-cancel").unbind("click.ctoolkitLink");
                $("#wp-link-close").unbind("click.ctoolkitCloseLink");
                window.wpLink.textarea = "";
                return false;
            });
        });
    }

    $.fn.ctoolkitTypography = function () {

        var typography_data = {};

        var is_font_changed = false;

        var font_changed = function ($wrapper, data, data2) {

            var font_formated = {
                'font-family': data.value
            };

            var $subsets = $wrapper.find('.subsets select');
            var $variants = $wrapper.find('.variants select');
            var $subsets_selectize = $subsets[0].selectize;
            var $variants_selectize = $variants[0].selectize;

            if (data.variants != '') {

                var variants = data.variants.split(',');
                var options = [];
                var _variants = ctoolkit_var.variants;


                for (var i in data.variants) {
                    var text = _variants.hasOwnProperty(variants[i]) ? _variants[variants[i]] : variants[i];
                    options.push({text: text, value: variants[i]});
                }

                $variants_selectize.enable();
                $variants_selectize.clearOptions();
                $variants_selectize.addOption(options);

                if (typeof data2 == 'object' && data2.hasOwnProperty('variants')) {
                    var selected_variants = data2.variants.split(',');
                    $variants_selectize.addItems(selected_variants);
                } else {

                    $variants_selectize.addItems(variants);
                }


                font_formated['variants'] = data.variants;
            } else {
                $variants_selectize.clearOptions();
                $variants_selectize.disable();
            }

            if (data.subsets != '') {

                var subsets = data.subsets.split(',');
                var options = [];
                var _subsets = ctoolkit_var.subsets;

                for (var i in subsets) {
                    var text = _subsets.hasOwnProperty(subsets[i]) ? _subsets[subsets[i]] : subsets[i];
                    options.push({text: text, value: subsets[i]});
                }

                $subsets_selectize.enable();
                $subsets_selectize.clearOptions();
                $subsets_selectize.addOption(options);

                if (typeof data2 == 'object' && data2.hasOwnProperty('subsets')) {
                    var selected_subsets = data2.subsets.split(',');
                    $subsets_selectize.addItems(selected_subsets);
                } else {
                    if ($.inArray('latin', subsets) >= 0) {
                        $subsets_selectize.addItem('latin');
                        font_formated['subsets'] = 'latin';
                    }
                }



            } else {
                $subsets_selectize.clearOptions();
                $subsets_selectize.disable();
            }

            if (typeof data2 == 'function') {
                data2(font_formated);
            }
        }

        var $typography = $(this);

        var $typo_font_family = $typography.find('.font_family select');

        $typography.find('.variants select').selectize({
            plugins: ['remove_button'],
            create: false,
            onChange: function (value) {
                if (!is_font_changed) {
                    var $field = $(this)[0].$wrapper.closest('.ctoolkit-typography');

                    var id = $field.data('id');

                    var _typography_data = typography_data[id];

                    var text = $field.data('value');

                    if (text != '') {

                        if (_typography_data.hasOwnProperty('variants')) {
                            _typography_data.variants = value.join(',');

                            var val = encodeURIComponent(JSON.stringify(_typography_data));
                            typography_data[id] = _typography_data;
                            $field.find('.ctoolkit_value').val(val).change();

                        }
                    }
                }
            }
        });

        $typography.find('.subsets select').selectize({
            plugins: ['remove_button'],
            create: false,
            onChange: function (value) {
                if (!is_font_changed) {
                    var $field = $(this)[0].$wrapper.closest('.ctoolkit-typography');

                    var id = $field.data('id');

                    var _typography_data = typography_data[id];

                    var text = $field.data('value');

                    if (text != '') {
                        if (_typography_data.hasOwnProperty('subsets')) {
                            _typography_data['subsets'] = value.join(',');
                            var val = encodeURIComponent(JSON.stringify(_typography_data));
                            typography_data[id] = _typography_data;
                            $field.find('.ctoolkit_value').val(val).change();
                        }
                    }

                }
            }
        });

        $typo_font_family.selectize({
            labelField: "label",
            valueField: "value",
            searchField: "label",
            create: false,
            options: ctoolkit_var.fonts,
            render: {
                option: function (item, escap) {
                    return "<div class='option' data-value='" + item.value + "' data-variants='" + item.variants + "' data-subsets='" + item.subsets + "'>" + item.label + " </div>";
                }
            },
            onInitialize: function () {

                var $field = $(this)[0].$wrapper.closest('.ctoolkit-typography');

                var id = $field.data('id');

                typography_data[id] = {};

                var value = $field.data('value');

                if (value != '') {

                    var data = JSON.parse(decodeURIComponent(value));

                    if (data.hasOwnProperty('font-family')) {
                        typography_data[id] = data;
                        $(this)[0].addItem(data['font-family']);
                    }
                }
            },
            onChange: function (value) {

                is_font_changed = true;

                if (value == '') {
                    return;
                }

                var $field = $(this)[0].$wrapper.closest('.ctoolkit-typography');

                var id = $field.data('id');

                var _typography_data = typography_data[id];

                if (_typography_data.hasOwnProperty('font-family') && _typography_data['font-family'] === value) {

                    font_changed($field, this.options[value], _typography_data);

                } else {

                    font_changed($field, this.options[value], function (data) {

                        _typography_data['font-family'] = data['font-family'];
                        _typography_data['subsets'] = data['subsets'];
                        _typography_data['variants'] = data['variants'];

                        var val = encodeURIComponent(JSON.stringify(_typography_data));

                        $field.find('.ctoolkit_value').val(val).change();

                        typography_data[id] = _typography_data;

                    });
                }

                is_font_changed = false;

            }
        });

        $typography.on('change', '.subrow input, .subrow select', function (e) {

            var key = $(this).data('key');

            var $this = $(this);

            var $field = $this.closest('.ctoolkit-typography');

            var id = $field.data('id');

            var value = $this.val();

            if (value != '') {

                typography_data[id][key] = $this.val();

                var val = encodeURIComponent(JSON.stringify(typography_data[id]));

                $field.find('.ctoolkit_value').val(val).change();
            }

            e.preventDefault();
        });
    }

    $.fn.ctoolkitAutocomplete = function () {
        $(this).selectize({
            valueField: 'value',
            searchField: 'label',
            labelField: 'label',
            options: [],
            create: false,
            plugins: ['remove_button', 'drag_drop'],
            render: {
                option: function (item, escape) {
                    return '<div class="option" data-value="' + item.value + '">#' + item.value + ' - ' + escape(item.label) + '</div>';
                }
            },
            load: function (query, callback) {

                var $container = $(this)[0].$wrapper.closest('.ctoolkit-field');

                var min_length = $container.data('min_length');

                if (query.length < parseInt(min_length))
                    return callback();

                var type = $container.data('ajax_type');

                var values = $container.data('ajax_value');

                $.ajax({
                    url: ajaxurl,
                    type: 'GET',
                    data: {
                        action: 'ctoolkit_autocomplete_' + type,
                        types: values,
                        s: query
                    },
                    error: function () {
                        callback();
                    },
                    success: function (data) {
                        callback(data);
                    }
                });
            }
        });
    };
    
});
