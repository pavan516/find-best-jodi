! function() {
    "use strict";
    var a = function() {
            $("body").on("click", ".js-fh5co-menu-btn, .nav-menu-btn , .js-fh5co-offcanvass-close", function() {
                $("#fh5co-offcanvass").toggleClass("fh5co-awake")
            })
        },
        o = function() {
            $(document).click(function(a) {
                var o = $("#fh5co-offcanvass, .js-fh5co-menu-btn , .nav-menu-btn");
                o.is(a.target) || 0 !== o.has(a.target).length || $("#fh5co-offcanvass").hasClass("fh5co-awake") && $("#fh5co-offcanvass").removeClass("fh5co-awake")
            }), $(window).scroll(function() {
                $(window).scrollTop() > 500 && $("#fh5co-offcanvass").hasClass("fh5co-awake") && $("#fh5co-offcanvass").removeClass("fh5co-awake")
            })
        },
        n = function() {
            $(".image-popup").magnificPopup({
                type: "image",
                removalDelay: 300,
                mainClass: "mfp-with-zoom",
                titleSrc: "title",
                gallery: {
                    enabled: !0
                },
                zoom: {
                    enabled: !0,
                    duration: 300,
                    easing: "ease-in-out",
                    opener: function(a) {
                        return a.is("img") ? a : a.find("img")
                    }
                }
            })
        },
        s = function() {
            $(".animate-box").length > 0 && $(".animate-box").waypoint(function(a) {
                "down" !== a || $(this).hasClass("animated") || $(this.element).addClass("bounceIn animated")
            }, {
                offset: "75%"
            })
        };
    $(function() {
        n(),  s()
    })
}();