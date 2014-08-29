(function ($, window, document) {
    "use strict";
    window.Kwas = window.Kwas || {
        init: function () {
            this.startLayout();

        },
        startLayout: function(){
            var $container = $('.gallery');
            // init
            $container.isotope({
                  // options
                  itemSelector: '.element-item',
                  layoutMode: 'masonry'

                });
        }


    }
    $(window).load( function () {
        window.Kwas.init();
    });
}(jQuery, window, document));
