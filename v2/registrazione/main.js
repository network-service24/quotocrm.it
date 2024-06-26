//--------------------------------------------------//
//--------------------------------------------------//
// Equalize //
function EQ(id) {
    wWindow = $(window).width();
    HEQ = 0;
    $('.' + id).css({
        'height': 'auto'
    });
    $('.' + id).each(function() {
        HID = $(this).outerHeight();
        if (HID > HEQ) {
            HEQ = HID;
        }
    });
    $('.' + id).css({
        'height': HEQ
    });
}
//
function EQR() {
    EQ('m-eq');
    EQ('m-eq1');
    EQ('m-eq2');
    EQ('m-eq3');
    EQ('m-eq4');
    EQ('m-eq5');
    EQ('m-eq6');
    EQ('m-eq7');
    EQ('olm-eq');
    EQ('footer-eq2');
    EQ('footer-eq');
    EQ('bnf-eq');
    EQ('bnfb-eq');
    EQ('bnfb-eq2');
    EQ('video-eq');
}
EQR();
$(window).on('load', function() {
    EQR();
});
$(window).on('resize', function() {
    EQR();
});

// Funzione scroll //
function scroll_to(id, scarto, tempo) {
    if (scarto === null) {
        scarto = 0;
    }
    if (tempo === null) {
        tempo = 300;
    }
    $('html,body').animate({
        scrollTop: $('#' + id).offset().top - scarto
    }, {
        queue: false,
        duration: tempo
    });
}