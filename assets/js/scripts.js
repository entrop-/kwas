(function ($, window, document) {
    "use strict";
    window.Kwas = window.Kwas || {
        init: function () {
            this.prepareLayout();
            this.startLayout();
            this.okejka();
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
        okejka: function() {
            $(document).on('click','.element-item',function(e){
                e.preventDefault();
                $(this).prepend('<div class="okejka"></div>');
                $('.okejka').animate({
                    marginTop: "-=100px",
                    opacity: 0
                },1000,function(){

                });
                //todo ajax
            });
        }

    }
    $(window).load( function () {
        window.Kwas.init();
    });
}(jQuery, window, document));
