(function ($) {
    'use strict';

    var browserWindow = $(window);

    // :: 1.0 Preloader Active Code
    function showLoader() {
        $('.preloader').fadeIn('slow', function () {
            $(this).addClass('d-flex');
        });
    }
    function hideLoader() {
        $('.preloader').fadeOut('slow', function () {
            $(this).removeClass('d-flex');
        });
    }
    browserWindow.on('load', function () {
        hideLoader();
    });

    // :: 2.0 Nav Active Code
    if ($.fn.classyNav) {
        $('#alazeaNav').classyNav();
    }

    // :: 3.0 Search Active Code
    $('#searchIcon').on('click', function () {
        $('.search-form').toggleClass('active');
    });
    $('.closeIcon').on('click', function () {
        $('.search-form').removeClass('active');
    });


    // :: 5.0 Masonary Gallery Active Code
    if ($.fn.imagesLoaded) {
        $('.alazea-portfolio').imagesLoaded(function () {
            // filter items on button click
            $('.portfolio-filter').on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });
            // init Isotope
            var $grid = $('.alazea-portfolio').isotope({
                itemSelector: '.single_portfolio_item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.single_portfolio_item'
                }
            });
        });
    }

    // :: 6.0 magnificPopup Active Code
    if ($.fn.magnificPopup) {
        // $('.portfolio-img, .product-img').magnificPopup({
        //     gallery: {
        //         enabled: true
        //     },
        //     type: 'image'
        // });

        $(document).on('click', '.video-icon', function (e) {
            e.preventDefault();
            $(this).magnificPopup({
                type: 'iframe'
            }).magnificPopup('open');

            let videoId = $(this).data('videoid');
            updateVideoViewCount(videoId);
        });
    }

    // :: 7.0 Barfiller Active Code
    if ($.fn.barfiller) {
        $('#bar1').barfiller({
            tooltip: true,
            duration: 1000,
            barColor: '#70c745',
            animateOnResize: true
        });
        $('#bar2').barfiller({
            tooltip: true,
            duration: 1000,
            barColor: '#70c745',
            animateOnResize: true
        });
        $('#bar3').barfiller({
            tooltip: true,
            duration: 1000,
            barColor: '#70c745',
            animateOnResize: true
        });
        $('#bar4').barfiller({
            tooltip: true,
            duration: 1000,
            barColor: '#70c745',
            animateOnResize: true
        });
    }

    // :: 8.0 ScrollUp Active Code
    if ($.fn.scrollUp) {
        browserWindow.scrollUp({
            scrollSpeed: 1500,
            scrollText: '<i class="fa fa-angle-up"></i>'
        });
    }

    // :: 9.0 CounterUp Active Code
    if ($.fn.counterUp) {
        $('.counter').counterUp({
            delay: 10,
            time: 2000
        });
    }

    // :: 10.0 Sticky Active Code
    if ($.fn.sticky) {
        $(".alazea-main-menu").sticky({
            topSpacing: 0
        });
    }

    // :: 11.0 Tooltip Active Code
    if ($.fn.tooltip) {
        $('[data-toggle="tooltip"]').tooltip()
    }

    // :: 12.0 Price Range Active Code
    $('.slider-range-price').each(function () {
        var min = jQuery(this).data('min');
        var max = jQuery(this).data('max');
        var unit = jQuery(this).data('unit');
        var value_min = jQuery(this).data('value-min');
        var value_max = jQuery(this).data('value-max');
        var label_result = jQuery(this).data('label-result');
        var t = $(this);
        $(this).slider({
            range: true,
            min: min,
            max: max,
            values: [value_min, value_max],
            slide: function (event, ui) {
                var result = label_result + " " + unit + ui.values[0] + ' - ' + unit + ui.values[1];
                console.log(t);
                t.closest('.slider-range').find('.range-price').html(result);
            }
        });
    })

    // :: 13.0 prevent default a click
    $('a[href="#"]').on('click', function ($) {
        $.preventDefault();
    });

    // :: 14.0 wow Active Code
    if (browserWindow.width() > 767) {
        new WOW().init();
    }

    // :: 15.0 Shlok randor color active
    document.addEventListener('DOMContentLoaded', () => {
        const newsItems = document.querySelectorAll('.shlok-item');

        newsItems.forEach((item, index) => {
            item.style.color = getRandomColor(index);
        });

        function getRandomColor(index) {
            // const letters = '0123456789ABCDEF';
            // let color = '#';
            // for (let i = 0; i < 6; i++) {
            //     color += letters[Math.floor(Math.random() * 16)];
            // }
            // return color;
            const colorList = [
                '#000000',
                '#600000',
                '#191970',
                '#FFA500',
                '#074c07',
                '#913718',
                '#4B0082'

            ];
            var color = colorList[Math.floor(Math.random() * 7)];
            return color;
        }
    });

    // Common AJAX header setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Cookie popup
    document.addEventListener('DOMContentLoaded', () => {
        var cookiePopup = checkCookie('cookiepopup');

        if (cookiePopup == false) {
            $('#cookie-policy-popup').removeClass('d-none');
            $('#accept-cookies').click(function () {
                setCookie('cookiepopup', true, 365);
                $('#cookie-policy-popup').addClass('wow fadeOutLeftBig animated');
            });
        }

    });



    const $editableDiv = $('.contenteditable-input');
    const $editableDivPlaceholder = $('.contenteditable-placeholder');
    const $editableDivSubmit = $('.contenteditable-submit-btn');

    function togglePlaceholder() {
        if ($editableDiv.text().trim() === '') {
            $editableDivPlaceholder.show();
            $editableDivSubmit.attr('disabled', true);

        } else {
            $editableDivPlaceholder.hide();
            $editableDivSubmit.attr('disabled', false);
        }
    }

    // Show/hide the placeholder on input
    $editableDiv.on('input', togglePlaceholder);

    // Initial check
    togglePlaceholder();



})(jQuery);

// Check if the cookie is already set
function checkCookie(name) {
    var cookieConsent = $.cookie(name);
    if (!cookieConsent) {
        return false;
    } else {
        return true;
    }
}

function getCookie(name) {
    var cookieConsent = $.cookie(name);
    return cookieConsent;
}


// Set a cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getYouTubeThumbnailUrl(url) {
    var videoId = null;
    var regex = /(?:https?:\/\/)?(?:www\.)?youtube\.com\/(?:watch\?v=|embed\/|v\/|.+\?v=|.+\/)([a-zA-Z0-9_-]{11})/;
    var match = url.match(regex);

    if (match && match[1]) {
        videoId = match[1];
        // Construct the thumbnail URL
        $thumbnailUrl = `https://img.youtube.com/vi/${videoId}/0.jpg`;

        return $thumbnailUrl;
    }
    return null;
}

function getYouTubeEmbedUrl(url, autoplay = false) {
    var videoId = null;
    var regex = /(?:https?:\/\/)?(?:www\.)?youtube\.com\/(?:watch\?v=|embed\/|v\/|.+\?v=|.+\/)([a-zA-Z0-9_-]{11})/;
    var match = url.match(regex);
    var embedUrl = 'https://www.youtube.com/embed/';
    if (match && match[1]) {
        videoId = match[1];
        embedUrl += embedUrl + videoId
        if (autoplay) {
            embedUrl += '?autoplay=1';
        } else {
            embedUrl += '?autoplay=0';
        }
        return embedUrl;
    }
    return '#';
}

function getYouTubeId(url) {
    var videoId = null;
    var regex = /(?:https?:\/\/)?(?:www\.)?youtube\.com\/(?:watch\?v=|embed\/|v\/|.+\?v=|.+\/)([a-zA-Z0-9_-]{11})/;
    var match = url.match(regex);
    if (match && match[1]) {
        videoId = match[1];
        return videoId;
    }
    return '#';
}

function getMediaDetailUrl(url) {
    var videoId = null;
    var regex = /(?:https?:\/\/)?(?:www\.)?youtube\.com\/(?:watch\?v=|embed\/|v\/|.+\?v=|.+\/)([a-zA-Z0-9_-]{11})/;
    var match = url.match(regex);
    if (match && match[1]) {
        videoId = match[1];
        return window.siteUrl + '/video/watch/' + videoId;
    }
    return '#';
}

function formatViewCount(count) {
    if (count >= 1000000) {
        return (count / 1000000).toFixed(1) + 'M';
    } else if (count >= 1000) {
        return (count / 1000).toFixed(1) + 'K';
    } else {
        return count;
    }
}

function updateVideoViewCount(videoId) {
    $.ajax({
        url: `${window.siteUrl}/update-video-view-count/${videoId}`,
        method: 'GET',
        contentType: 'JSON',
        success: function (response) {
            if (response.status == true) {
                $('.view-count-' + videoId).text(response.view_count);
            }
        },
        error: function (xhr, status, error) {
            // Handle error
            $('#response').text('Error: ' + error);
        }
    });
}

// Global Search Form Submit Action
function globalSearchAction(event) {
    event.preventDefault();
    const searchTerm = document.getElementById('searchTerm').value.trim();
    if (!searchTerm) return; 
    const form = document.getElementById('globalSearchForm');
    const formAction = form.action.replace(/\/[^/]*$/, '/search/' + encodeURIComponent(searchTerm));
    window.location.href = formAction;
}