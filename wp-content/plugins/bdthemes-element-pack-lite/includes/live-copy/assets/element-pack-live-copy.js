(function (window, document, $, undefined) {

    'use strict';

    var ElementPackLiveCopy = {
        //Initializing properties and methods
        init                      : function (e) {
            ElementPackLiveCopy.globalVars();
            ElementPackLiveCopy.loadxdLocalStorage();
            ElementPackLiveCopy.loadContextMenuGroupsHooks();
        },
        globalVars                : function (e) {
            window.lc_ajax_url = bdt_ep_live_copy.ajax_url;
            window.lc_ajax_nonce = bdt_ep_live_copy.nonce;
            window.lc_key = bdt_ep_live_copy.magic_key;
        },
        loadxdLocalStorage        : function () {
            xdLocalStorage.init({
                                    iframeUrl   : 'https://elementpack.pro/eptools/magic/index.html',
                                    initCallback: function () {
                                        // if need any callback
                                    }
                                });
        },
        loadContextMenuGroupsHooks: function () {
            elementor.hooks.addFilter('elements/section/contextMenuGroups', function (groups, element) {
                return ElementPackLiveCopy.prepareMenuItem(groups, element);
            });

            elementor.hooks.addFilter('elements/widget/contextMenuGroups', function (groups, element) {
                return ElementPackLiveCopy.prepareMenuItem(groups, element);
            });

            elementor.hooks.addFilter('elements/column/contextMenuGroups', function (groups, element) {
                return ElementPackLiveCopy.prepareMenuItem(groups, element);
            });
        },
        prepareMenuItem           : function (groups, element) {
            var index = _.findIndex(groups, function (element) {
                return 'clipboard' === element.name;
            });
            groups.splice(index + 1, 0, {
                name   : 'bdt-ep-live-paste',
                actions: [
                    {
                        name    : 'ep-live-paste',
                        title   : 'Live Paste',
                        icon    : 'bdt-wi-element-pack',
                        callback: function () {
                            ElementPackLiveCopy.livePaste(element);
                        }
                    }
                ]
            });
            return groups;
        },
        livePaste                 : function (e) {
            return xdLocalStorage.getItem(lc_key, function (data) {
                const magicData = JSON.parse(data.value);

                console.log(magicData);

                const widgetCode = magicData.widget;
                const EncodedWidgetCode = JSON.stringify(widgetCode);
                const hasResourcesFiles = /\.(jpeg|jpg|png|gif|svg|)/gi.test(EncodedWidgetCode);
                const ElementType = e.model.get('elType');

                var model = {elType: 'section', settings: widgetCode.settings};
                var options = {at: 0};

                if ('column' === ElementType) {
                    var containerSelector = e.getContainer().parent;
                } else {
                    var containerSelector = e.getContainer();
                }

                var container = containerSelector.parent;
                model.elements = widgetCode.elements;
                options.at = containerSelector.view.getOption('_index') + 1;
                model.isInner = false;

                var widgetSelector = $e.run('document/elements/create', {
                    container: container,
                    model    : model,
                    options  : options
                });

                if (hasResourcesFiles) {
                    $.ajax({
                               url       : lc_ajax_url,
                               method    : 'POST',
                               data      : {
                                   action  : 'ep_elementor_import_live_copy_assets_files',
                                   data    : EncodedWidgetCode,
                                   security: lc_ajax_nonce,
                               },
                               beforeSend: function () {
                                   widgetSelector.view.$el.append('<div id="bdt-live-copy-importing-images-loader">Importing Images..</div>');
                               }
                           }).done(function (response) {
                        if (response.success) {
                            var data = response.data[0];
                            model.settings = data.settings;
                            model.elType = data.elType;
                            if ('widget' === data.elType) {
                                model.widgetType = data.widgetType;
                            } else {
                                model.elements = data.elements;
                            }
                            setTimeout(function () {
                                $e.run('document/elements/delete', {container: widgetSelector});
                                var e = $e.run('document/elements/create', {
                                    model    : model,
                                    container: container,
                                    options  : options
                                });
                            }, 800);
                            $('#bdt-live-copy-importing-images-loader').remove();
                        }
                    });
                }
            });
        }
    };
    ElementPackLiveCopy.init();
})(window, document, jQuery, xdLocalStorage);