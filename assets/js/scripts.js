(function ($, window, document) {
    "use strict";
    window.Kwas = window.Kwas || {
        init: function () {
            this.prepareLayout();
            this.startLayout();
            this.okejka();
            this.fDisableSelection();
            this.fLazy();
        },
        prepareLayout : function(){

        },
        startLayout: function(){
            var $container = $('.gallery');
            // init
            $container.masonry({
              itemSelector: '.element-item'
            });
        },
        okejka: function() {
            var $counter = 0;

            $(document).on('click','.element-item a',function(e){
                e.preventDefault();

                if (!e.target.cnt){
                    e.target.cnt =0;
                }

                e.target.cnt++;
                console.log(e.target.cnt);
                var $class='okejka';

                if(e.target.cnt > 5){
                    $class = 'okejka ten';
                }
                if (e.target.cnt > 15 ){
                    $class = 'okejka hundred';
                }
                if (e.target.cnt >= 25 ){
                    $class = 'okejka max';
                    e.target.cnt = 100;
                }
                $(this).prepend('<div class="'+$class+'"></div>');

                $('.okejka').animate({
                    marginTop: "-=100px",
                    opacity: 0
                },1000,function(){
                    $(this).remove();
                    setTimeout(function(){
                       e.target.cnt--;
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
        },
        fLazy : function() {

            jQuery(window).scroll(function () {

                var scrollpos = $(document).scrollTop();
                var docH = $(document).height();
                var winH = $(window).height();
                var page = $('.gallery').data('page')+1;
                var url = 'ajax.php?page='+page;
                if (scrollpos + winH >= docH){
                    $.ajax({
                        url: url,
                        method: 'get',
                        success: function(data){
                            //var nodes = $.parseHTML(data);
                            var el = $(data);
//                            var items= [];
//                            $(nodes).each(function(i){
//                               items+=$(this);
//                            });
//                            console.dir(items);
                            $('.gallery').append(el).masonry('appended',el,true).masonry( 'layout' );

                            $('.gallery').data('page',page);
                        }
                    });
                }


            });
        }
    }
    $(window).load( function () {
        window.Kwas.init();
    });
}(jQuery, window, document));


