
//----Submit form Validation---------------------------

document.addEventListener("DOMContentLoaded", function() {
    function btn1() {
        var user_name = document.querySelector('.wpcf7-text');
        var user_email = document.querySelector('.wpcf7-email');
        var user_comment = document.querySelector('.wpcf7-textarea');
        var flag = false;
      var collection = [user_name,user_email,user_comment];
      for (var i = 0; i < collection.length; i++) {
          collection[i].style.backgroundColor = "rgba(42, 43, 44, 1)";
      }
            if (user_name.value === '' || user_name.value.length < 3 ) {
                user_name.style.backgroundColor = "rgba(255, 0, 0, 0.4)";
                flag = alert('Type your name');
            } else if (user_email.value === '' || user_email.value.length < 3) {
                user_email.style.backgroundColor = "rgba(255, 0, 0, 0.4)";
                flag = alert('Type your e-mail');
            } else if (user_comment.value === '' || user.comment.value.length < 3) {
                user_comment.style.backgroundColor = "rgba(255, 0, 0, 0.4)";
                flag = alert('Type your comment');
            }
            if(flag) {
                return flag;
            } else {
                return true;
            }
    }
    var btn = document.querySelector('.btn-form');
    btn.addEventListener('click', btn1, false);

    var authorName = document.getElementById('author');
   authorName.placeholder = 'Name*';
    var authorEmail = document.getElementById('email');
    authorEmail.placeholder = 'Email*';
    var authorText = document.getElementById('comment');
    authorText.placeholder = 'Type your comment';
});


jQuery(document).ready(function($) {

    //--------------------------------------------------------------

    $('.services-list li').hover(function () {
        $('.services-list a').removeClass('service-hover');
        $(this).find("a").addClass('service-hover');
    });
    $('.services-list li').hover(function () {
        $('.services-list .service-text-block').removeClass('service-text-block-hover');
        $(this).find(".service-text-block").addClass('service-text-block-hover');
    });

//    -------LIght SLider------------------------
    $('#light-slider').lightSlider({
        item: 3,
        adaptiveHeight: true,
        slideMove: 3,
        speed: 1000,
        slideMargin: 0,

        auto: false,
        loop: false,
        slideEndAnimation: true,
        pause: 2000,
        keyPress: false,
        controls: false,
        prevHtml: '',
        nextHtml: '',
        responsive : [
            {
                breakpoint:992,
                settings: {
                    item:2,
                    slideMove:2,
                    slideMargin:0,
                }
            },
            {
                breakpoint:767,
                settings: {
                    item:1,
                    slideMove:1,
                    slideMargin:0,
                }
            }
        ]
    });

    // -----Partners Slider ----------------------

    $('#partners-slider').lightSlider({
        item: 5,
        adaptiveHeight: true,
        slideMove: 5,
        speed: 1000,
        slideMargin: 0,

        auto: false,
        loop: false,
        slideEndAnimation: true,
        pause: 2000,
        keyPress: false,
        controls: false,
        prevHtml: '',
        nextHtml: '',
        responsive : [
            {
                breakpoint:992,
                settings: {
                    item:3,
                    slideMove:2,
                    slideMargin:0,
                }

            },
            {
                breakpoint:767,
                settings: {
                    item:2,
                    slideMove:2,
                    slideMargin:0,
                }
            }
        ],
    });


// ---For changing class ".is-checked" on clicked buttons---(OPTIONAL)--

    // $('.navbar-nav').each(function (i, item) {
    //     var item = $(item);
    //     item.on('hover', 'li a', function () {
    //         $(this).addClass('is-checked');
    //         item.find('.is-checked').not(this).removeClass('is-checked');
    //     });
    // });

    //-----Footer-hover ---------------------------------------(OPTIONAL)--


    // $('.footer-navbar-nav').each(function (i, item) {
    //     var item = $(item);
    //     item.on('hover', 'li a', function () {
    //         $(this).addClass('is-checked');
    //         item.find('.is-checked').not(this).removeClass('is-checked');
    //     });
    // });

});
