function strstr(haystack, needle, bool) {
    var pos = 0;

    haystack += "";
    pos = haystack.indexOf(needle); if (pos == -1) {
        return false;
    } else {
        if (bool) {
            return haystack.substr(0, pos);
        } else {
            return haystack.slice(pos);
        }
    }
}

function scriviCookie(nomeCookie, valoreCookie, durataCookie) {
    var scadenza = new Date();
    var adesso = new Date();
    scadenza.setTime(adesso.getTime() + (parseInt(durataCookie) * 60000));
    document.cookie = nomeCookie + '=' + escape(valoreCookie) + '; expires=' + scadenza.toGMTString() + '; path = /';
}

var sito = 'https://' + window.location.hostname;
var request_uri            = window.location.pathname + window.location.search;
var provenienza_tmp        = request_uri.split('?'); 
var provenienza            = provenienza_tmp[0];
var urlback                = sito + provenienza;

/**
 *!SCRIVI COOKIE UTM
 */
 if (strstr(request_uri,'utm_campaign',true)) {
    var utm__ = request_uri.split('?');
    var utm_ = utm__[1].split('&');
    for (var i = 0; i < utm_.length; ++i) {
        var val_utm = utm_[i].split('=');
        var utm_nome = val_utm[0];
        var utm_valore = val_utm[1];
        console.log(utm_nome + ' ' + utm_valore);
        scriviCookie(utm_nome, utm_valore, '60');
    }
}