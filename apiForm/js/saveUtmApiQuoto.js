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

function leggiCookie(nomeCookie) {
    if (document.cookie.length > 0) {
            var inizio = document.cookie.indexOf(nomeCookie + "=");
            if (inizio != -1) {
                inizio = inizio + nomeCookie.length + 1;
                var fine = document.cookie.indexOf(";", inizio);
                if (fine == -1) fine = document.cookie.length;
                return unescape(document.cookie.substring(inizio, fine));
            } else {
                return "";
            }
        }
        return "";
    }
    document.addEventListener("DOMContentLoaded", function() {

        var sito             = 'https://' + window.location.hostname;
        var request_uri      = window.location.pathname + window.location.search;
        var provenienza_tmp  = request_uri.split('?'); 
        var provenienza      = provenienza_tmp[0];
        var urlback          = sito + provenienza;
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


        /**
        ** estraggo il _GA di Analytics per creare il CLIENT ID utile per la tracciabilità
        */
        setTimeout(function(){
            var CLIENT_ID_ = leggiCookie("_ga");
            var CLIENT_ID_tmp =  CLIENT_ID_.split(".");
            var CLIENT_ID = CLIENT_ID_tmp[2]+"."+CLIENT_ID_tmp[3];
            document.getElementById("CLIENT_ID").value = CLIENT_ID;
        }, 3000);
        /**
        ** estraggo gli UTM SOURCE per la tracciabilità
        */
        setTimeout(function(){
            var UTM_SOURCE = leggiCookie("utm_source");
            document.getElementById("utm_source").value = UTM_SOURCE;
        }, 3000);

        /**
        ** estraggo gli UTM MEDIUM per la tracciabilità
        */
        setTimeout(function(){
            var UTM_MEDIUM = leggiCookie("utm_medium");
            document.getElementById("utm_medium").value = UTM_MEDIUM;
        }, 3000);

        /**
        ** estraggo gli UTM CAMPAIGN per la tracciabilità
        */
        setTimeout(function(){
            var UTM_CAMPAIGN = leggiCookie("utm_campaign");
            document.getElementById("utm_campaign").value = UTM_CAMPAIGN;
        }, 3000);
    });