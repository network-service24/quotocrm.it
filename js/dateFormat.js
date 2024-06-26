var dateFormat = (function() {
    var keywords = {
        Y: 'getFullYear',
        m: 'getUTCMonth',
        d: 'getUTCDate',
        H: 'getUTCHours',
        i: 'getUTCMinutes',
        s: 'getUTCSeconds',
        u: 'getUTCMilliseconds'
    };

    function pad(number) {
        var r = String(number);
        if (r.length === 1) {
            r = '0' + r;
        }
        return r;
    }
    return function dateFormat(date, format) {
        var str = '';
        var i, len = format.length;
        for (i = 0; i < len; i += 1) {
            if (keywords.hasOwnProperty(format[i])) {
                str += pad(Date.prototype[keywords[format[i]]].call(date));
            } else {
                str += format[i];
            }
        }
        return str;
    }
})();

//console.log(dateFormat(new Date(), 'Y-m-dTH:i:s.u'));