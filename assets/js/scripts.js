(function ($, window, document) {
    "use strict";
    window.Kwas = window.Kwas || {
        init: function () {
            this.prepareLayout();
            this.startLayout();
            this.okejka();
            this.fDisableSelection();
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
            var $counter = 0;

            $(document).on('click','.element-item a',function(e){
                e.preventDefault();

                if (e.target != this){
                    this.counter = 0;
                    console.log(e.target);
                }

                this.$counter++;
                console.log(this.counter);
                var $class='okejka';

                if(this.counter > 5){
                    $class = 'okejka ten';
                }
                if (this.counter > 15 ){
                    $class = 'okejka hundred';
                }
                if (this.counter >= 25 ){
                    $class = 'okejka max';
                    this.counter = 100;
                }
                $(this).prepend('<div class="'+$class+'"></div>');

                $('.okejka').animate({
                    marginTop: "-=100px",
                    opacity: 0
                },1000,function(){
                    $(this).remove();
                    setTimeout(function(){
                       this.counter --;
                    }, 3000);
                });
                //todo ajax
            });
        },
        fDisableSelection : function() {
            $.fn.disableSelection = function() {
                return this
                         .attr('unselectable', 'on')
                         .css('user-select', 'none')
                         .on('selectstart', false);
            };
            $('img').disableSelection();
            $('a').disableSelection();
        }

    }
    $(window).load( function () {
        window.Kwas.init();
    });
}(jQuery, window, document));


