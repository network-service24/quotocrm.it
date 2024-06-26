function setcountdown(theyear, themonth, theday) {
  yr = theyear;
  mo = themonth;
  da = theday;
}
$(function () {
  var i = 0;
  var speed = 500;
  link = setInterval(function () {
    i++;
    $(".lampeggiante").css("color", i%2 == 1 ? "#FFFFFF" : "#14b2e7");
  }, speed);
})
setcountdown(2024, 10, 1);

var occasion = "chiusura della vecchia UI";
var message_on_occasion = "";

var countdownwidth = "auto";
var countdownheight = "20px";
var opentags = '<span class="lampeggiante"><b class="p-r-10"></b>&#10230; <small>';
var closetags = "</small></span>";

var montharray = new Array(
  "Jan",
  "Feb",
  "Mar",
  "Apr",
  "May",
  "Jun",
  "Jul",
  "Aug",
  "Sep",
  "Oct",
  "Nov",
  "Dec"
);
var crosscount = "";

function start_countdown() {
  if (document.layers) document.countdownnsmain.visibility = "show";
  else if (document.all || document.getElementById)
    crosscount =
      document.getElementById && !document.all
        ? document.getElementById("countdownie")
        : countdownie;
  countdown();
}

if (document.all || document.getElementById)
  document.write(
    '<span id="countdownie" style="width:' + countdownwidth + ';margin-left:-30px!important"></span>'
  );

window.onload = start_countdown;

function countdown() {
  var today = new Date();
  var todayy = today.getYear();
  if (todayy < 1000) todayy += 1900;
  var todaym = today.getMonth();
  var todayd = today.getDate();
  var todayh = today.getHours();
  var todaymin = today.getMinutes();
  var todaysec = today.getSeconds();
  var todaystring =
    montharray[todaym] +
    " " +
    todayd +
    ", " +
    todayy +
    " " +
    todayh +
    ":" +
    todaymin +
    ":" +
    todaysec;
  futurestring = montharray[mo - 1] + " " + da + ", " + yr;
  dd = Date.parse(futurestring) - Date.parse(todaystring);
  dday = Math.floor(dd / (60 * 60 * 1000 * 24) * 1);
  dhour = Math.floor(dd % (60 * 60 * 1000 * 24) / (60 * 60 * 1000) * 1);
  dmin = Math.floor(
    dd % (60 * 60 * 1000 * 24) % (60 * 60 * 1000) / (60 * 1000) * 1
  );
  dsec = Math.floor(
    dd % (60 * 60 * 1000 * 24) % (60 * 60 * 1000) % (60 * 1000) / 1000 * 1
  );

  if (dday <= 0 && dhour <= 0 && dmin <= 0 && dsec <= 1 && todayd == da) {
    if (document.layers) {
      document.countdownnsmain.document.countdownnssub.document.write(
        opentags + message_on_occasion + closetags
      );
      document.countdownnsmain.document.countdownnssub.document.close();
    } else if (document.all || document.getElementById)
      crosscount.innerHTML = opentags + message_on_occasion + closetags;
    return;
  } else if (dday <= -1) {

    if (document.layers) {
      document.countdownnsmain.document.countdownnssub.document.write(
        opentags + "Evento passato! " + closetags
      );
      document.countdownnsmain.document.countdownnssub.document.close();
    } else if (document.all || document.getElementById)
      crosscount.innerHTML = opentags + "Evento passato! " + closetags;
    return;
  } else {

    if (document.layers) {
      document.countdownnsmain.document.countdownnssub.document.write(
        opentags + dday + " gg., alla " + occasion + closetags
      );
      document.countdownnsmain.document.countdownnssub.document.close();
    } else if (document.all || document.getElementById)
      crosscount.innerHTML =
        opentags + dday + " gg. alla  " + occasion + closetags;
  }
  setTimeout("countdown()", 1000);
}
