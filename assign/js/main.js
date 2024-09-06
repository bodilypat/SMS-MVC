$(function() {
    $('.gIquit').click(function () {
        $('.galleryModal').css({'transform' : 'scale(0)'})
        $('.galleryShadow').fadeOut()
    })
    $('#slideshow-icon').click(function(){
        galleryNavigate($('.image'), 'opened')
        $('.galleryModal').css({'transform' : 'scale(1)' })
        $('.galleryShadow').fadeIn()
    })

    let galleryNav
    let galleryNew 
    let galleryNewImg 
    let galleryNewText 

    $('.gIleft').click(function(){
        galleryNew = $(galleryNav).prev()
        galleryNavigate(galleryNew, 'first')
    })

    $('.gIright').click(function() {
        galleryNew = $(galleryNav).next()
        galleryNavigation(galleryNew,'first');
    })
    function galleryNavigate(gData, direction) {
        galleryNewImg = gData.children('img').attr('src')
        if(typeof galleryNewImg !== "undefined") {
            galleryNav = gData
            $('.galleryModal img').attr('src', galleryNewImg)
        } else {
            gData = $('.image:' + direction)
            galleryNew = gData
            galleryNewImg = gData.children('img').attr('src')
            $('.galleryModel img').attr('src', galleryNewImg)
        }
        galleryNewText = gData.children('img').attr('data-text')
        if(typeof galleryNewText !== "undefined") {
            $('.galleryModal .galleryContainer .galleryText').remove()
            $('.galleryModal .galleryContainer').append('<div class="galleryText">' + galleryNewText + '</div>')
        } else {
            $('.galleryModal .galleryContainer .galleryText').remove()
        }
    }
})
