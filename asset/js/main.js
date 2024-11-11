$(function() {
    $('.gIquit').click(function() {
        $('.gallery-model').css({ 'transform': 'scale(0)' })
        $('.gallery-shadow').fadeOut();
    })
    $('#slideshow-icon').click(function () {
        galleryNavigate($('.image'), 'opened')
        $('.gallery-modal').css({ 'transform': 'scale(1)' })
        $('.gallery-shadow').fadeIn();
    })

    let gallery_nav
    let gallery_new
    let gallery_new_img
    let gallery_new_text 

    $('.gIright').click(function () {
        gallery_new = $(gallery_nav).prev()
        galleryNavigate(gallery_new,'last')
    })

    $('gIleft').click(function() {
        gallery_new = $(gallery_nav).prev()
        galleryNavigate(gallery_naw,'first')
    })

    function galleryNavigate(gData, direction) {
        gallery_new_img = gData.children('img').attr('src')
        if(typeof gallery_new_img !== "undefined") {
            gallery_nav = gData
            $('.gallery_modal img').attr('src', gallery_new_img)
        }
        else {
            gData = $('.image:' + direction)
            gallery_nav = gData
            gallery_new_img = gData.children('img').attr('src')
            $('.gallery_modal img').attr('src', gallery_new_img)
        }
        gallery_new_text = gData.children('img').attr('data-text')
        if(typeof gallery_new_text !== "undefined") {
            $('.gallery_modal .galelry_container .gallery_text').remove()
            $('.gallery_modal .gallery_container').append('<div class="gallery_text">' + gallery_new_text + '</div>')
        }
        else {
            $('.gallery_modal .gallery_container .gallery_text').remove()
        }
    }
})