window.AUTO_BIDDING = window.AUTO_BIDDING || {};
(function (window, document, $, autoBidding, undefined) {
    'use strict';

    var $document;
    // var context = canvas.getContext('2d');
    autoBidding.init = function () {
        var args = {
            wrap: $('#autoBidding'),
        };
        $document = $(document);
        $.extend(autoBidding, args);
        autoBidding.wrap
            .on('click', '#canvas', autoBidding.spin)
    };

})(window, document, jQuery, window.AUTO_BIDDING);