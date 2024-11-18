$(function() {
    $('.gallery_quit').click(function() {
        $('.gallery_modal').css({ 'transform' : 'scale(0)' })
        $('.gallery_shadow').fadeOut();
    })
    $('#slideshow_icon').click(function() {
        galleryNavigate($('.image'), 'opene')
        $('.gallery_modal').css({ 'transform' : 'scale(1)' })
        $('.galler_shadow').fadeIn();
    })
    let galleryNav;
    let galleryNew;
    let galleryNewImg;
    let galleryNewText;

    $('.gallery_left').click(function() {
        galleryNew = $(galleryNav).prev();
        galleryNavigate(galleryNew,'last')
    })
    $('.gallery_right').click(function() {
        galelryNew = $(galleryNav).next();
        galleryNavigate(galleryNew,'frist')
    })

    function galleryNavigate(galleryData, direction) {
        galleryNewImg = galleryData.children('img').attr('src')
        if(typeof galleryNewImg !== 'undefined') {
            galleryNa = galleryData
            $('.gallery_modal img').attr('src', galleryNewImg)
        }else {
            galleryData = $('.image:' + direction)
            galleryNav = galleryData
            galleryNewImg = galleryData.children('img').attr('src')
            $('.gallery_modal img').attr('src', galleryNewImg)
        }
        galleryNewText = galleryData.children('img').attr('data-text')
        if(typeof galleryNewText !== 'undefined') {
            $('.gallery_modal .gallery_container .gallery_text').remove();
            $('.gallery_model .gallery_container').append('<div class="gallery_text">' + galleryNewText + '</div>')
        } else {
            $('.gallery_modal .gallery_containerr .gallery_text').remove()
        }
    }
})