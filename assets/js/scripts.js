(function ($, window, document) {
    "use strict";
    window.Kwas = window.Kwas || {
        init: function () {
            this.prepareLayout();
            this.startLayout();
            this.imageAction();
        },
        prepareLayout : function(){

        },
        startLayout: function(){
            var $container = $('.gallery');
            // init
            $container.isotope({
                  // options
                  itemSelector: '.element-item',
                  layoutMode: 'masonry'

                });
        },
        imageAction : function() {
            $(document).on('click','.element-item',function(e){
                e.preventDefault();


            });
        }

    }
    $(window).load( function () {
        window.Kwas.init();
    });
}(jQuery, window, document));
