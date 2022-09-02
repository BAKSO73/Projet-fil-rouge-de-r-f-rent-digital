jQuery(document).ready(function ($) {
    function s9ShowMessage(message, error = true) {
        $('.s9-loading').hide();
        if (message) {
            $('.s9-message').html('<div class="s9-' + (error ? "error" : "success") + '">' + message + '</div>');
            $("html, body").animate({
                scrollTop: 0
            }, 1000);
            setTimeout(function () {
                $('.s9-message').html('');
            }, 10000);
        }
    }
    $('.s9TriggerStatus').click(function () {
        //$(this).
        var data = {
            'action': 'social9_trigger_widget_status',
            'widget_action': $(this).attr('data-action'),
            'widget_id': $(this).attr('data-id'),
        };
        $('.s9-loading').show();
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(s9_ajax_object.ajax_url, data, function (response) {
            //show message data has been updated and rederect to social share page
            response = JSON.parse(response);
            location.reload(true);
        });
    });

    $('#s9-new-widget-submit').click(function () {
        var data = s9WidgetPayload('new');
        data.action = 'social9_create_widget';
        $('.s9-loading').show();
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(s9_ajax_object.ajax_url, data, function (response) {
            //show message data has been updated and rederect to social share page
            response = JSON.parse(response);
            if (response.error) {
                s9ShowMessage(response.error);
            } else {
                window.location.href = "admin.php?page=social9_share";
            }

        });
    });

    $('#s9-edit-widget-submit').click(function () {
        var data = s9WidgetPayload('edit');
        data.action = 'social9_create_widget';
        data.id = $('#s9-edit-widget-id').val();
        $('.s9-loading').show();
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(s9_ajax_object.ajax_url, data, function (response) {
            //show message data has been updated and rederect to social share page
            response = JSON.parse(response);
            if (response.error) {
                s9ShowMessage(response.error);
            } else {
                window.location.href = "admin.php?page=social9_share"
            }

        });
    });
    $('#s9-guest-widget-submit').click(function () {
        var data = s9WidgetPayload('guest');
        data.action = 'social9_guest_widget';
        data.id = $('#s9-guest-widget-id').val();
        $('.s9-loading').show();
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(s9_ajax_object.ajax_url, data, function (response) {
            //show message data has been updated and rederect to social share page
            window.location.href = 'admin.php?page=social9&action=register';
        });
    });

    pageLoadActions();
    sharePreview();
    $('input,select').change(function () {
        sharePreview();
    })
    function sharePreview() {
        $('#s9-share-floating').remove();
        if ($("#s9-edit-widget-container-name").length > 0) {
            var container = $("#s9-edit-widget-container-name").val().substring(1);
            $('#s9-widget-preview').html('<div id="' + container + '" class="' + container + '"></div>');
            new s9.widget(s9WidgetPayload("edit")).render();
        }
        if ($("#s9-new-widget-container-name").length > 0) {
            var container = $("#s9-new-widget-container-name").val().substring(1);
            $('#s9-widget-preview').html('<div id="' + container + '" class="' + container + '"></div>');
            new s9.widget(s9WidgetPayload("new")).render();
        }
        if ($("#s9-guest-widget-container-name").length > 0) {
            var container = $("#s9-guest-widget-container-name").val().substring(1);
            $('#s9-widget-preview').html('<div id="' + container + '" class="' + container + '"></div>');
            new s9.widget(s9WidgetPayload("guest")).render();
        }
        var s9ShareFloating = document.getElementById("s9-share-floating");
        if (s9ShareFloating) {
            s9ShareFloating.addEventListener("click", function (e) {
                e.stopPropagation();
                e.preventDefault();
            }, true);
        }
        var s9ShareInline = document.getElementById('s9-share-inline');
        if (s9ShareInline) {
        s9ShareInline.addEventListener("click", function (e) {
            e.stopPropagation();
            e.preventDefault();
        }, true);
    }

}
    
    function pageLoadActions() {
        if ($(".s9-social-provider").length > 0) {
            $(".s9-social-provider").sortable({
                update: function (event, ui) {
                    sharePreview();
                }
            });
            $(".s9-social-provider").disableSelection();
            $('.s9-social-provider a').click(function () {
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                } else {
                    $(this).addClass('active');
                }
                sharePreview();
            });
            $.each(["new", "edit", "guest"], function (i, val) {
                $('#s9-' + val + '-widget-icon-color-picker,#s9-' + val + '-widget-button-color-picker,#s9-' + val + '-widget-label-color-picker').change((e) => {
                    $('#' + e.currentTarget.id.replace('-picker', '')).val(e.target.value)
                });
                if ($('#s9-' + val + '-hide-social-provider-names').length > 0) {
                    if ($('#s9-' + val + '-hide-social-provider-names').is(':checked')) {
                        $('.hidelabel').hide();
                    } else {
                        $('.hidelabel').show();
                    }
                }
                $('#s9-' + val + '-hide-social-provider-names').change(function () {
                    if ($(this).is(':checked')) {
                        $('.hidelabel').hide();
                    } else {
                        $('.hidelabel').show();
                    }
                });
                if ($('#s9-' + val + '-hide-social-hide-on-desktop').length > 0) {
                    if ($('#s9-' + val + '-hide-social-hide-on-desktop').is(':checked')) {
                        $('.desktop.hidelabel').hide();
                    } else {
                        if ($('#s9-' + val + '-widget-type').val() == "floating") {
                            $('.desktop.hideinline').show();
                        }
                    }
                }

                $('#s9-' + val + '-hide-social-hide-on-desktop').change(function () {
                    if ($(this).is(':checked')) {
                        $('.desktop.hideinline').hide();
                    } else {
                        if ($('#s9-' + val + '-widget-type').val() == "floating") {
                            $('.desktop.hideinline').show();
                        }
                    }
                });
                if ($('#s9-' + val + '-hide-social-hide-on-mobile').length > 0) {
                    if ($('#s9-' + val + '-hide-social-hide-on-mobile').is(':checked')) {
                        $('.mobile.hidelabel').hide();
                    } else {
                        if ($('#s9-' + val + '-widget-type').val() == "floating") {
                            $('.mobile.hideinline').show();
                        }
                    }
                }
                $('#s9-' + val + '-hide-social-hide-on-mobile').change(function () {
                    if ($(this).is(':checked')) {
                        $('.mobile.hideinline').hide();
                    } else {
                        if ($('#s9-' + val + '-widget-type').val() == "floating") {
                            $('.mobile.hideinline').show();
                        }
                    }
                });
                if ($('#s9-' + val + '-widget-type').length > 0) {
                    if ($('#s9-' + val + '-widget-type').val() == "floating") {
                        $('.hidefloting').hide();
                        $('.hideinline').show();
                    } else {
                        $('.hidefloting').show();
                        $('.hideinline').hide();
                    }
                }
                $('#s9-' + val + '-widget-type').change((e) => {
                    if (e.target.value == "floating") {
                        $('.hidefloting').hide();
                        $('.hideinline').show();

                    } else {
                        $('.hidefloting').show();
                        $('.hideinline').hide();
                    }
                })
            });
        }
    }
    function s9WidgetPayload(action) {
        var selectedProvider = [];
        $('#s9-' + action + '-share-provider a.active').each(function () {
            var provider = {};
            provider.name = $(this).data('provider').toLowerCase();
            provider.intent = "share";
            if ($('#s9-' + action + '-widget-custom-share-url').val() != "") {
                provider.share_url = $('#s9-' + action + '-widget-custom-share-url').val();
            }
            selectedProvider.push(provider);
        })
        return {
            "name": $('#s9-' + action + '-widget-name').val(),
            "widget_category": "sharing",
            "widget_type": $('#s9-' + action + '-widget-type').val(),
            "providers": {
                "list": selectedProvider,
                "use_default_buttons": false,
                "max_visible_providers": selectedProvider.length + 1
            },
            "design": {
                "buttons": {
                    "size": $('#s9-' + action + '-widget-button-size').val(),
                    "color": $('#s9-' + action + '-widget-label-color').val(),
                    "bg_color": $('#s9-' + action + '-widget-button-color').val(),
                    "icon_color": $('#s9-' + action + '-widget-icon-color').val(),
                    "border_radius": $('#s9-' + action + '-widget-corners').val(),
                    "hide_label": $('#s9-' + action + '-hide-social-provider-names').is(":checked")
                },
                "animations": {
                    "entrance": $('#s9-' + action + '-widget-animation-entrance').val(),
                    "hover": $('#s9-' + action + '-widget-animation-hover').val()
                }
            },
            "options": {
                "counter": {
                    "type": $('#s9-' + action + '-social-counter-type').val(),
                    "min_show_count": $('#s9-' + action + '-social-counter-min-count').val()
                },
                "container": $('#s9-' + action + '-widget-container-name').val(),
            },
            "layout": {
                "position": {
                    "desktop": {
                        "value": $('#s9-' + action + '-hide-social-position-on-desktop').val(),
                        "offset": $('#s9-' + action + '-hide-social-offset-on-desktop').val(),
                        "hide": $('#s9-' + action + '-hide-social-hide-on-desktop').is(":checked")
                    },
                    "mobile": {
                        "value": $('#s9-' + action + '-hide-social-position-on-mobile').val(),
                        "offset": null,
                        "hide": $('#s9-' + action + '-hide-social-hide-on-mobile').is(":checked")
                    }
                }
            },
            "shares": { "total": 0 }
        };
    }
})