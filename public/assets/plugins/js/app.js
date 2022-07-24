$(function () {

    $('.input-images').imageUploader();

    let preloaded = [{
        id: 1,
        src: 'https://picsum.photos/500/500?random=1'
    },
    {
        id: 2,
        src: 'https://picsum.photos/500/500?random=2'
    },
    {
        id: 3,
        src: 'https://picsum.photos/500/500?random=3'
    },
    {
        id: 4,
        src: 'https://picsum.photos/500/500?random=4'
    },
    {
        id: 5,
        src: 'https://picsum.photos/500/500?random=5'
    },
    {
        id: 6,
        src: 'https://picsum.photos/500/500?random=6'
    },
    ];

    $('.input-images-2').imageUploader({
        preloaded: preloaded,
        imagesInputName: 'photos',
        preloadedInputName: 'old'
    });

    // Input and label handler
    $('input').on('focus', function () {
        $(this).parent().find('label').addClass('active')
    }).on('blur', function () {
        if ($(this).val() == '') {
            $(this).parent().find('label').removeClass('active');
        }
    });

    // Sticky menu
    let $nav = $('nav'),
        $header = $('header'),
        offset = 4 * parseFloat($('body').css('font-size')),
        scrollTop = $(this).scrollTop();

    // Initial verification
    setNav();

    // Bind scroll
    $(window).on('scroll', function () {
        scrollTop = $(this).scrollTop();
        // Update nav
        setNav();
    });

    function setNav() {
        if (scrollTop > $header.outerHeight()) {
            $nav.css({
                position: 'fixed',
                'top': offset
            });
        } else {
            $nav.css({
                position: '',
                'top': ''
            });
        }
    }
});
