$(document).on("scroll", function () {
    if
            ($(document).scrollTop() > 20) {
        $("#banner").addClass("shrink");
        $("body").addClass("addbody");
    } else {
        $("#banner").removeClass("shrink");
        $("body").removeClass("addbody");
    }
});

// SUB-MENU START

$(document).ready(function () {
    $('.closebtn').click(function () {
        $('body').removeClass('active');
        $(".side-nav").removeClass("wide");
    });


    $('.sidetogglebtn').on('click', function (e) {
        $('body').addClass('active');
        e.stopPropagation();
    });





    $(function () {
        $(".sidetogglebtn").on("click", function (e) {
            $(".side-nav").toggleClass("wide");
        });
        $(document).on("click", function (e) {
            if ($(e.target).is(".side-nav, .sidetogglebtn") === false) {
                $(".side-nav").removeClass("wide");
                $('body').removeClass('active');
            }
        });
    });

    $("div.buyerprt").show();
    $("div.sellerprt").hide();
    $("input[name='user']").click(function () {
        var test = $(this).val();
        $("div.desc").hide();
        $("#" + test).show();
    });

    $("div.page_buyerprt").show();
    $("div.page_sellerprt").hide();
    $("input[name='page_user']").click(function () {
        var test = $(this).val();
        $("div.page_desc").hide();
        $("#" + test).show();
    });

});




if ($(window).width() > 1200) {

    $('.mobile-link').hover(function () {
        var catid = this.id;
        $(".category-submenu").removeClass("active");
        $("#new" + catid).addClass("active");
    }, function () {
        var catid = this.id;
        $(".category-submenu").removeClass("active");
        $("#new" + catid).addClass("active");
    });

    $('.category-submenu').hover(function () {
    }, function () {
        $('.category-submenu').removeClass("active");
    });
} else {
    $(".mobile-link h2 i").click(function () {
        var catid = this.id;
        var chkid = catid.split("-");
        $('.category-submenu').removeClass('mobileView');
        $("#newsubFullsection-" + chkid[1]).addClass("mobileView");
    });

    $('.subclosebtn').click(function () {
        $('.category-submenu').removeClass('mobileView');
    });
}

$(".searchdrop").click(function () {

    $(".dropdown-search").slideToggle("slow");

});

$(".linkankerRegi").click(function () {
    $(".regibox").show();
    $(".logbody").hide();
});
$(".linkankerlog").click(function () {
    $(".logbody").show();
    $(".regibox").hide();
});
$(".page_regibox").hide();
$(".pageLinkankerRegi").click(function () {
    $(".page_regibox").show();
    $(".page_logbody").hide();
});
$(".pageLinkankerlog").click(function () {
    $(".page_logbody").show();
    $(".page_regibox").hide();
});

$(".clicksub").click(function () {

    $(".subcatList").slideToggle("slow");


});
$(".productsub").click(function () {

    $(".product-drop").slideToggle("slow");


});



(function ($) {

    $('#price-range-submit').hide();

    $("#min_price,#max_price").on('change', function () {
        alert('change');
        $('#price-range-submit').show();

        var min_price_range = parseInt($("#min_price").val());

        var max_price_range = parseInt($("#max_price").val());

        if (min_price_range > max_price_range) {
            $('#max_price').val(min_price_range);
        }

        $("#slider-range").slider({
            values: [min_price_range, max_price_range]
        });

    });


    $("#min_price,#max_price").on("paste keyup", function () {
        alert('paste keyup');
        $('#price-range-submit').show();

        var min_price_range = parseInt($("#min_price").val());

        var max_price_range = parseInt($("#max_price").val());

        if (min_price_range == max_price_range) {

            max_price_range = min_price_range + 100;

            $("#min_price").val(min_price_range);
            $("#max_price").val(max_price_range);
        }

        $("#slider-range").slider({
            values: [min_price_range, max_price_range]
        });

    });


    $(function () {
        $("#slider-range").slider({
            range: true,
            orientation: "horizontal",
            min: 0,
            max: 900000,
            values: [0, 900000],
            step: 120,

            slide: function (event, ui) {
                if (ui.values[0] == ui.values[1]) {
                    return false;
                }
                $("#min_price").val(ui.values[0]);
                $("#max_price").val(ui.values[1]);
                $('#overlay').css('visibility', 'visible');
                $('#overlay').css('opacity', '1');
                var min_price = $('#min_price').val();
                var max_price = $('#max_price').val();
                var cat_slug = $("#cat_slug").val();
                var word = $("input[name='word']").val();
                if(cat_slug == ''){cat_slug='null';}
                if(word == ''){word='null';}
                var url = './getproducts-byfilter/'+word+'/null/' + min_price + '/' + max_price + '/' + cat_slug + '/null';
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (data) {
                        $('#overlay').css('visibility', 'hidden');
                        $('#overlay').css('opacity', '0');
                        $('#lstdata').html(data);
                    }
                });
            }
        });


        $("#min_price").val($("#slider-range").slider("values", 0));
        $("#max_price").val($("#slider-range").slider("values", 1));

    });

    $("#slider-range,#price-range-submit").click(function () {
        $('#overlay').css('visibility', 'visible');
        $('#overlay').css('opacity', '1');
        var min_price = $('#min_price').val();
        var max_price = $('#max_price').val();
        var cat_slug = $("#cat_slug").val();
        var word = $("input[name='word']").val();
        if(cat_slug == ''){cat_slug='null';}
        if(word == ''){word='null';}

        var url = './getproducts-byfilter/'+word+'/null/' + min_price + '/' + max_price + '/' + cat_slug + '/null';
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                $('#overlay').css('visibility', 'hidden');
                $('#overlay').css('opacity', '0');
                $('#lstdata').html(data);
            }
        });

        $("#searchResults").text("Here List of products will be shown which are cost between " + min_price + " " + "and" + " " + max_price + ".");
    });

    $("#sortdiv").change(function (e) {
        e.preventDefault();
        $('#overlay').css('visibility', 'visible');
        $('#overlay').css('opacity', '1');
        var sort_type = $("#sortdiv").val();
        var cat_slug = $("#cat_slug").val();
        var min_price = $('#min_price').val();
        var max_price = $('#max_price').val();
        var word = $("input[name='word']").val();
        if(cat_slug == ''){cat_slug='null';}
        if(word == ''){word='null';}
        console.log(word);
        var url = './getproducts-byfilter/'+word+'/null/' + min_price + '/' + max_price + '/' + cat_slug + '/' + sort_type;

        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                $('#overlay').css('visibility', 'hidden');
                $('#overlay').css('opacity', '0');
                $("#lstdata").html("");
                $('#lstdata').html(data);
            }
        });
    });


})(jQuery);

// SUB-MENU END




AOS.init({
    duration: 1200,
})




$('.bannerslider').slick({
    draggable: true,
    arrows: false,
    dots: true,
    fade: true,
    speed: 1500,
    infinite: true,
    autoplay: true,
    cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
    touchThreshold: 100
});
$('.blogSlider').slick({
    draggable: true,
    arrows: true,
    dots: false,
    fade: true,
    speed: 1500,
    infinite: true,
    autoplay: true,
    cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
    touchThreshold: 100
  }).slickAnimation();

$('.browseSlider').slick({
    infinite: true,
    dots: false,
    arrows: true,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: false,
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});

$('.addslider').slick({
    infinite: true,
    dots: false,
    arrows: false,
    fade: true,
    speed: 1500,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});


$('.essenSlider').slick({
    infinite: true,
    dots: false,
    arrows: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});



$('.bulkSlider').slick({
    rows:3,
    infinite: false,
    dots: false,
    arrows: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: false,
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 1023,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});

$('.more-seller').slick({
    infinite: true,
    dots: false,
    arrows: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: false,
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 1023,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});


$('.testislider').slick({
    infinite: true,
    dots: true,
    arrows: false,
    speed: 1500,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});

$('.partner').slick({
    infinite: true,
    dots: false,
    arrows: false,
    speed: 1000,
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});


$('.product-item').each(function () {
    var slider = $(this);
    slider.slick({
        arrows: false,
        dots: false,
        accessibility: false,
        infinite: true,
        autoplay: false,
        autoplaySpeed: 5000,
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    var sLightbox = $(this);
    sLightbox.slickLightbox({
        src: 'src',
        itemSelector: '.product-image img'
    });
});

$('.slider-nav').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.product-item',
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 991,
            settings: {
                slidesToShow: 6,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});





$(document).ready(function () {
    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        var minqty = $('#minquantity').val();
        console.log(minqty);
        if (minqty !== undefined) {
            count = count < minqty ? minqty : count;
        } else {
            count = count < 1 ? 1 : count;
        }
        $input.val(count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        if (!(parseInt($input.val()))) {
            var minquantity = $('#minquantity').val();
            $input.val(minquantity);
        }
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
});







// ===== Scroll to Top ====
$(window).scroll(function () {
    if ($(this).scrollTop() >= 300) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function () {      // When arrow is clicked
    $('body,html').animate({
        scrollTop: 0                       // Scroll to top of body
    }, 500);
});















