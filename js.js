    var mlSlider = function($scope, $) {
        var $_this = $scope.find('.owl-carousel');
        $_this.owlCarousel({
            loop: false,
            margin: 0,
            nav: true,
            dots: true,
            responsiveClass: true,
            startPosition: 0,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 1,
                },
                1000: {
                    items: 1,
                }
            }

        })


    }
    
    
     $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/landscape-mm-slider.default', mlSlider);
    });
    
