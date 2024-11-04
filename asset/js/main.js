$(function (){
    $('.gIquit').click(function () {
        $('.galleryModal').css({'transform' : 'scale(0)' })
        $('.galleryShadow').fadeOut()
    })
    $('#slideshow-icon').click(function () {
        galleryNavigate($('.image'), 'opened')
        $('.galleryModal').css({ 'transform' : 'scale(1)' })
        $('.galleryShadow').fadeIn()
    })

    let galleryNavigate
    let galleryNew
    let galleryNewImg
    let galleryNewText
    $('.gIleft').click(function () {
        galleryNew = $(galleryNav).prev()
        galleryNavigate(galleryNew,'list')
    })
    $('.gIright').click(function () {
        galleryNew = $(galleryNav).next()
        galleryNavigate(galleryNew,'first')
    })

    function galleryNavigate(gDate, direction) {
        galleryNewImg = gDate.children('img').attr('src')
        if(typeof galleryNewImg !== 'underfined') {
            galleryNav = gData 
            $('.galleryModal img').attr('src', galleryNewImg)
        } else {
            gDate = $('.image:', + direction)
            galleryNav = gData
            galleryNewImg = gData.children('img').attr('src')
            $('.galleryModal img').attr('src', galleryNewImg)
        }
        galleryNewText = gData.children('img').attr('data-text')
        if(typeof galleryNewText !== 'Underfined') {
            $('.galleryModal .galleryContainer .galleryText').remove()
            $('.galleryModal .galleryContainer').append('<div class="galleryText">' + galleryNewText + '</div>')
        } else {
            $('.galleryModal .galleryContainer .galleryText').remove();
        }
    }
})