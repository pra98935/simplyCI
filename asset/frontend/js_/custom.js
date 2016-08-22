$(document).ready(function() {
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        // e.g. linkElement: 'a:not([target="_blank"]):not([href^=#])'
        loading: true,
        loadingParentElement: 'body', //animsition wrapper element
        loadingClass: 'animsition-loading',
        loadingInner: '', // e.g '<img src="loading.svg" />'
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: ['animation-duration', '-webkit-animation-duration'],
        // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
        // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
        overlay: false,
        overlayClass: 'animsition-overlay-slide',
        overlayParentElement: 'body',
        transition: function(url) { window.location.href = url; }
    });
    $("#content-slider").lightSlider({
        loop: true,
        keyPress: true
    });
    $('#menu_slider').owlCarousel({
        navigation: true,
        pagination: false,
        items: 6,
        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        autoPlay: true,
        margin: 10,
        loop: true,
    })
    /**********calendar******* */
    $("#my-calendar").zabuto_calendar({
        legend: [
            { type: "text", label: "Special event", badge: "00" },
            { type: "block", label: "Regular event", classname: "purple" },
            { type: "spacer" },
            { type: "text", label: "Bad" },
            { type: "list", list: ["grade-1", "grade-2", "grade-3", "grade-4"] },
            { type: "text", label: "Good" }
        ],
        ajax: {
            url: "show_data.php?grade=1"
        }
    });
    $("#my-calendar1").zabuto_calendar({
        legend: [
            { type: "text", label: "Special event", badge: "00" },
            { type: "block", label: "Regular event", classname: "purple" },
            { type: "spacer" },
            { type: "text", label: "Bad" },
            { type: "list", list: ["grade-1", "grade-2", "grade-3", "grade-4"] },
            { type: "text", label: "Good" }
        ],
        ajax: {
            url: "show_data.php?grade=1"
        }
    });

var owl = $('#dish_slider');

    owl.owlCarousel({
        center: true,
        items: 5,
        loop: true,
        margin: 0,
        nav: false,
        pagination: true,
        slideBy:1
    });
    
    /*$('.item').click(function() {
        console.log("next");
        owl.trigger('next.owl.carousel');
    })
*/
    if($(".contain_bar").length){
        $(".contain_bar li").hover(
            function () {
                $(".notice").addClass("result_hover");
            },
            function () {
                $(".notice").removeClass("result_hover");
            }
        );
    }

   /**/
    $('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: true,
  centerMode: true,
  focusOnSelect: true
}); 
       
});


