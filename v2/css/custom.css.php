<?php
header('Content-type: text/css');
$ActiveMenu = $GLOBALS['ActiveMenu']??'';
echo'
.main-sidebar{
    -webkit-box-shadow: 1px 0px 20px rgba(0, 0, 0, 0.2) !important;
    box-shadow: 1px 0px 20px rgba(0, 0, 0, 0.2)!important;
}
.main-header{
    -webkit-box-shadow: 5px 0px 10px rgba(0, 0, 0, 0.5) !important;
    box-shadow: 5px 0px 10px rgba(0, 0, 0, 0.5) !important;
}
.no-radius {
    /* border-radius: 0px !important; */
    -webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);
    box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);
}
.no-border {
     border-radius: 0px !important;
}
.radius6 {
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 4px !important;
}
.skin-green .sidebar-menu>li.header {
    color: #00acc1!important;
}
.modal-content{
    -webkit-border-radius: 5px !important;
    -moz-border-radius: 5px !important;
    border-radius: 5px !important;
}
.logoQuoto {
        max-width:50%;
}
@media (min-width: 768px) {
    .logoQuoto {
        max-width:75%;
        padding-bottom: 5px;
    }
}
@media (max-width: 992px) {
    .logoQuoto {
        max-width:30%;
    }
}
span.fa {
    margin-top:5px;
}
.btn-viola {
    border-color: #605ca8;
    background-color: #605ca8;
    color: #FFFFFF;
}

.btn-viola:hover,
.btn-viola:active,
.btn-viola.hover {
    background-color: #605ca8;
    color: #FFFFFF;
}
.link-menu>a:hover,
.link-menu>a:active,
.link-menu>a:visited {
    color:#ffffff !important;
}
.link-menu>a:link{
    display:block!important;
    padding: 5px 5px 5px 15px!important;
    '.($ActiveMenu=="active"?"color: #ffffff!important;":"color: #8aa4af!important;").'
}
.cont_check {
    display: block;
    position: relative;
    padding-left: 12px;
    margin-bottom: 7px;
    cursor: pointer;
    font-size: 18px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;

}
.cont_check input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    border:1px solid #363636;
}
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 18px;
    width: 18px;
    background-color: #FFF;
    border:1px solid #363636;
}
.cont_check:hover input ~ .checkmark {
    background-color: #E1E1E1;
}
.cont_check input:checked ~ .checkmark {
    background-color: #00acc1 ;
}
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}
.cont_check input:checked ~ .checkmark:after {
    display: block;
}
.cont_check .checkmark:after {
    left: 6px;
    top: 2px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

.cont_check_op {
    display: block;
    position: relative;
    padding-left: 12px;
    margin-bottom: 7px;
    cursor: pointer;
    font-size: 12px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;

}
.cont_check_op input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    border:1px solid #363636;
}
.checkmark_op {
    position: absolute;
    top: 0;
    left: 0;
    height: 12px;
    width: 12px;
    background-color: #FFF;
    border:1px solid #363636;
}
.cont_check_op:hover input ~ .checkmark_op {
    background-color: #E1E1E1;
}
.cont_check_op input:checked ~ .checkmark_op {
    background-color: #f90707;
}
.checkmark_op:after {
    content: "";
    position: absolute;
    display: none;
}
.cont_check_op input:checked ~ .checkmark_op:after {
    display: block;
}
.cont_check_op .checkmark_op:after {
    left: 3px;
    top: 0px;
    width: 5px;
    height: 8px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

.scroll::-webkit-scrollbar {
    width: 6px;
}

.scroll::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    border-radius: 4px;
}

.scroll::-webkit-scrollbar-thumb {
    border-radius: 4px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
}

.cassetto-info {
    color: #31708f;
    background-color: #d9edf7;
    border-color: #bce8f1;
}
.cassetto-info hr {
    border-top-color: #a6e1ec;
}
.cassetto-info .cassetto-link {
    color: #245269;
}

.smart .rslides {
    position: relative;
    list-style: none;
    overflow: hidden;
    width: 100%;
    padding: 0;
    margin: 0;
}

.smart .rslides li {
    -webkit-backface-visibility: hidden;
    position: absolute;
    display: none;
    width: 100%;
    left: 0;
    top: 0;
}

.smart .rslides li:first-child {
    position: relative;
    display: block;
    float: left;
}

.smart .rslides img {
    display: block;
    height: auto;
    float: left;
    width: 100%;
    border: 0;
}
#chat{
    font-size:14px!important;
    width:100%;
    height:auto;
    border-radius: 10px 10px 10px 10px;
    -moz-border-radius: 10px 10px 10px 10px;
    -webkit-border-radius: 10px 10px 10px 10px;
    background: rgba(255,255,255,1);
    background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255,255,255,1)), color-stop(47%, rgba(246,246,246,1)), color-stop(100%, rgba(237,237,237,1)));
    background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
    background: -o-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
    background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
    background: linear-gradient(to bottom, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#ffffff\', endColorstr=\'#ededed\', GradientType=0 );
}
.text-ottanio{
    color:#00acc1;
}
.bg-ottanio{
    background-color:#00acc1;
}
.user-profile{
    position:relative !important;
}
.user-profile .profile-img {
    width: 50px !important;
    margin-left: 30px !important;
    padding: 40px 0 !important;
    border-radius: 100% !important;
}
.user-profile .profile-text>a {
    color: #ffffff !important;
    width: 100% !important;
    padding: 6px 30px !important;
    background: rgba(0, 0, 0, 0.5) !important;
    display: block !important;
}
.float-right{
    float:right !important;
}
.half-image{
    max-width:50px!important;
}
.pulsing {
    -webkit-animation: pulsatilla .7s ease-out infinite alternate running;
    animation: pulsatilla .7s ease-out infinite alternate running;
}
@keyframes pulsatilla {
    0% {
        opacity: .5;
    }
    100% {
        opacity: 1;
    }
}

@-webkit-keyframes pulsatilla {
    0% {
        opacity: .5;
    }
    100% {
        opacity: 1;
    }
}
.ombra-sfocata {
    box-shadow:  6px  6px 6px rgba(0, 0, 0, 0.08) ,
                -6px -6px 6px rgba(0, 0, 0, 0.08) ,
                 6px -6px 6px rgba(0, 0, 0, 0.08) ,
                -6px  6px 6px rgba(0, 0, 0, 0.08) ;
}
.del1{
    animation-delay: .2s;
    -moz-animation-delay: .2s;
    -webkit-animation-delay: .2s;
}

.del2{
    animation-delay: .4s;
    -moz-animation-delay: .4s;
    -webkit-animation-delay: .4s;
}

.del3{
    animation-delay: .6s;
    -moz-animation-delay: .6s;
    -webkit-animation-delay: .6s;
}

.del4{
    animation-delay: .8s;
    -moz-animation-delay: .8s;
    -webkit-animation-delay: .8s;
}

.del5{
    animation-delay: 1s;
    -moz-animation-delay: 1s;
    -webkit-animation-delay: 1s;
}
.del6{
    animation-delay: 1.2s;
    -moz-animation-delay: 1.2s;
    -webkit-animation-delay: 1.2s;
}
.inline{
  display: inline-block!important;
}
.float-right-10{
  float:right!important;
  margin-left:10px!important;
}
.float-left-0{
    float:left!important;
    margin-right:0px!important;
  }
.h-w-input{
  height:23px!important;
  width:77%!important;
}
select.h-input-medio{
  height:23px!important;
  font-size:60%!important;
  padding:3px 2px!important;
}
.cerchio{
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    border: 1px dashed #363636;
    border-radius: 10px;
}
.cerchio_gray{
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    border: 1px dashed #D2D6DE!important;
    border-radius: 10px;
}
.row-eq-height {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
}
.form-control{
    border-radius:.25rem !important;
}
.input-group .input-group-addon {
    border-radius: .25em !important;
}
.chosen-select,chosen-container,chosen-container-single,chosen-with-drop{
    border-radius:.25rem !important;
}
.ui-dialog-titlebar-close:after {
    content: \'x\';
    position: absolute;
    top: -4px;
    left: 3px;
    color:#000;
}
.lineheight10{
    line-height:10px !important;
}
.lineheight25{
    line-height:25px !important;
}
.table-bordered > thead > tr > th {
    background-color: #00acc1 !important;
    border-right: 1px solid #ffffff;
    color: #fff !important;
} 
.table-bordered > thead > tr > td {
    border-color: transparent !important;
    background-color: #00acc1 !important;
    color: #fff !important;
}
.alert-default-profila{
    background-color: #F6F6F6!important;
}
.alert-default{
    border: 1px solid #333333!important;
}
.alert-profila {
    border: 1px solid #CCCCCC!important;
}
.ballon{
    font-size:14px!important;
    width:100%;
    height:auto;
    border-radius: 10px 10px 10px 10px;
    -moz-border-radius: 10px 10px 10px 10px;
    -webkit-border-radius: 10px 10px 10px 10px;
    border: 1px solid #d5d2d2;
  background: rgba(237,237,237,1);
  background: -moz-linear-gradient(top, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
  background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(237,237,237,1)), color-stop(53%, rgba(246,246,246,0.79)), color-stop(100%, rgba(255,255,255,0.6)));
  background: -webkit-linear-gradient(top, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
  background: -o-linear-gradient(top, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
  background: -ms-linear-gradient(top, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
  background: linear-gradient(to bottom, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#ededed\', endColorstr=\'#ffffff\', GradientType=0 );
  }
  .clear{
    clear:both;
    height:10px;
  }
  .messaggi{
    list-style-type: none;
    padding:0px;
  }
  .user2{
  float:right;
  text-align:right;
  padding:20px;
  }
  .textchat{
    float:left;
    text-align:left;
    padding:20px;
    position:relative;
  }
  .operatore{
  float:left;
  text-align:left;
  padding:20px 20px 0px 20px;
  }
  .textchatoperatore{
    clear:both;
    float:left;
    text-align:left;
    padding:20px;
    position:relative;
  }
.clearfix{
    clear:both !important;
    height: 8px !important;
}
.linea_green {
    border-bottom: 1px solid #00a65a!important;
}
.linea_orange {
    border-bottom: 1px solid #ff851b!important
}
.linea_red {
    border-bottom: 1px solid #dd4b39!important;
}
.linea_aqua {
    border-bottom: 1px solid #00c0ef!important
}
input.error#PrezzoP_1  {
    border: 0px!important;
    display: table-cell!important;
    border: 1px solid!important;
    border-color: #d2d6de!important;
    box-shadow: none!important;
}
input.error#PrezzoP_2  {
    border: 0px!important;
    display: table-cell!important;
    border: 1px solid!important;
    border-color: #d2d6de!important;
    box-shadow: none!important;
}
input.error#PrezzoP_3  {
    border: 0px!important;
    display: table-cell!important;
    border: 1px solid!important;
    border-color: #d2d6de!important;
    box-shadow: none!important;
}
label#PrezzoP_1-error,label#PrezzoP_2-error,label#PrezzoP_3-error{
    color:  #FF0000!important;
    font-weight:normal!important;
    display: inline-block!important;
    z-index:2!important;
}

.modale_drag{
   background: transparent;!important;
}
.draggable.is-dragging,
.draggable:hover {
  cursor: move;
}
.no_border_top{
    border-top:0px!important;
}
.no_padding{
    padding:0px!important;
}
.text12{
    font-size:12px !important;
}
.text16{
    font-size:16px !important;
}
.toast-content-text{
    font-size: 16px !important;
    line-height:11px !important;
}
.tt-query,
.tt-hint {
    -webkit-border-radius: 0px !important;
    -moz-border-radius: 0px !important;
    border-radius: 0px !important;
    box-shadow: none;
}

.twitter-typeahead{
    width:100%!important;
    display:block!important;
}
.tt-query {
-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}

.tt-hint {
    color: #999
}

.tt-menu {
    width: 100%!important;
    margin: 32px 0;
    padding: 8px 0;
    background-color: #fff;
    border: 1px solid #ccc;
    border: 1px solid rgba(0, 0, 0, 0.2);
    -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
            border-radius: 8px;
    -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
        -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
            box-shadow: 0 5px 10px rgba(0,0,0,.2);
}

.tt-suggestion {
    padding: 3px 20px;
    font-size: 18px;
    line-height: 24px;
}

.tt-suggestion:hover {
    cursor: pointer;
    color: #fff;
    background-color: #0097cf;
}

.tt-suggestion.tt-cursor {
    color: #fff;
    background-color: #0097cf;
}

.tt-suggestion p {
    margin: 0;
}

.gist {
    font-size: 14px;
}
.no-border-top{
    border-top: 0px !important;
    vertical-align:top !important;
}
.td25pdl0pdr0{
    width:25% !important;
    padding-left:0px !important;
    padding-right:0px !important;
}
.td25pdl0pdr10{
    width:25% !important;
    padding-left:0px !important;
    padding-right:10px !important;
}
.td30pdl0pdr10{
    width:25% !important;
    padding-left:0px !important;
    padding-right:10px !important;
}
.td25pdl10pdr10{
    width:25% !important;
    padding-left:10px !important;
    padding-right:10px !important;
}
.td9pdl0pdr10{
    width:9% !important;
    padding-left:0px !important;
    padding-right:10px !important;
}
.td6pdl0pdr10{
    width:6% !important;
    padding-left:0px !important;
    padding-right:10px !important;
}
.td20pdl0pdr10{
    width:20% !important;
    padding-left:0px !important;
    padding-right:10px !important;
}
.td35pdl0pdr10{
    width:35% !important;
    padding-left:0px !important;
    padding-right:10px !important;
}
.td5pdl0pdr0{
    width:5% !important;
    padding-left:0px !important;
    padding-right:0px !important;
}
.nopadding {
    padding: 0 !important;
    margin: 0 !important;
 }
 .padding2 {
    padding: 2px !important;
 }
 .iconaDimension {
    width:32px !important;
    height:32px !important;
 }
 .content_icona{
    width:auto !important;
    height:32px !important;
    padding:4px!important;
    margin: 4px!important;
    border:1px solid #ccc!important;
    border-radius: 4px 4px 4px 4px!important;
    -moz-border-radius: 4px 4px 4px 4px!important;
    -webkit-border-radius: 4px 4px 4px 4px!important;
    display: inherit !important;
 }
 .content_icona_empty{
    width:auto !important;
    height:32px !important;
    padding:4px!important;
    margin: 4px!important;
    display: inherit !important;
 }
.100-percento{
    width:100% !important;
}
.transparent{
    background:transparent!important
}
.posizione_spiegazione_prezzo{
    position:absolute;
    text-align: center;
    margin-top: -20px;
    margin-bottom:5px;
    padding-top:2px;
    padding-bottomp:2px;

}
.resize_font{
    font-size:90% !important;
}

.active a {
  color: #FFFFFF;
}
.nowrap{
    white-space: nowrap !important;
}
.pointer {
    cursor: pointer;
}
.small_ico_emessenger{
    width:18px;
    -webkit-filter: brightness(2);
    filter: brightness(2);
    -webkit-filter: contrast(4);
    filter: contrast(4);
}
.ico_emessenger{
    width:20px;
}
.linea_bottom{
    border-bottom: 1px solid #F4F4F4;
}
.dropdown-menu .orange {
    color: #f39c12 !important;
}
.dropdown-menu .green {
    color: #00acc1 !important;
}
.dropdown-menu .red {
    color: #dd4b39 !important;
}
.dropdown-menu .info {
    color: #00c0ef !important;
}
.dropdown-menu .black {
    color: #000000 !important;
}
.dropdown-menu > li > a {
    color: #363636 !important;
}
.btn-group-100{
    width:100% !important;
}
.width100{
    width:100% !important;
}
input.h-medio{
    height: 23px!important;
    font-size: 60%!important;
    padding: 3px 2px!important;
}
.inline-flex{
    display:inline-flex !important;
}
.pd20{
    padding:20px !important;
}
.pd20-noTop{
    padding-top:0px !important;
    padding-right:20px !important;
    padding-bottom:20px !important;
    padding-left:20px !important;
}
.fontsize80{
    font-size: 80px !important;
}
.text30{
    font-size: 30px !important;
}
#risultato,
#risultato_del,
#risultato_newsletter,
#risultato_dis,
#risultato_resave{
    z-index:999 !important;
}
.width5{
    width:5% !important;
}
.pdL20{
    padding-left:20px !important;
}
.pdR20{
    padding-right:20px !important;
}
.pdL8{
    padding-left:8px !important;
}
.no_permessi {
    color: #666666!important;
}
.70_upper{
    font-size:70%;
    text-transform:uppercase;
}
.font30{
    font-size:30px;
}
.bgf86c6b{
    background-color:#f86c6b;
}
.bgffb22b{
    background-color:#ffb22b;
}
.bg455a64{
    background-color:#455a64;
}
.bg1e88e5{
    background-color:#1e88e5;
}

.min-height115{
    min-height:115px;
}
.wrap{
    white-space: nowrap !important;
}
@media (max-width: 1700px) {
    .wrap{
        white-space:normal;
    }
}
.bordo-tabella > tr > th, .bordo-tabella > tr > td {
    border-color: #333333 !important;
}

.blink {
    animation: blink 3s steps(5, start) infinite;
    -webkit-animation: blink 2s steps(5, start) infinite;
}
@keyframes blink {
    to {
        visibility: hidden;
    }
}
@-webkit-keyframes blink {
    to {
        visibility: hidden;
    }
}

.switchery-opacity{
    opacity:0.2 !important;
}
.switchery-off{
    background-color: rgb(255, 255, 255) !important; 
    border-color: rgb(223, 223, 223) !important; 
    box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset !important; 
    transition: border 0.1s ease 0s, box-shadow 0.1s ease 0s !important;
}
.small-switchery-off{
    left: 0px !important;
    transition: background-color 0.1s ease 0s, left 0.05s ease 0s !important;
}
iconaservizi {
    position: absolute !important;
    top: 50%!important;
    transform: translateY(-50%)!important;
    width: 30px !important;
    left: 5px!important;
    height: auto !important;
}


.m-0 { margin:0!important; }
.m-1 { margin:.25rem!important; }
.m-2 { margin:.5rem!important; }
.m-3 { margin:1rem!important; }
.m-4 { margin:1.5rem!important; }
.m-5 { margin:3rem!important; }

.mt-0 { margin-top:0!important; }
.mr-0 { margin-right:0!important; }
.mb-0 { margin-bottom:0!important; }
.ml-0 { margin-left:0!important; }
.mx-0 { margin-left:0 !important;margin-right:0 !important; }
.my-0 { margin-top:0!important;margin-bottom:0!important; }

.mt-1 { margin-top:.25rem!important; }
.mr-1 { margin-right:.25rem!important; }
.mb-1 { margin-bottom:.25rem!important; }
.ml-1 { margin-left:.25rem!important; }
.mx-1 { margin-left:.25rem!important;margin-right:.25rem!important; }
.my-1 { margin-top:.25rem!important;margin-bottom:.25rem!important; }

.mt-2 { margin-top:.5rem!important; }
.mr-2 { margin-right:.5rem!important; }
.mb-2 { margin-bottom:.5rem!important; }
.ml-2 { margin-left:.5rem!important; }
.mx-2 { margin-right:.5rem!important;margin-left:.5rem!important; }
.my-2 { margin-top:.5rem!important;margin-bottom:.5rem!important; }

.mt-3 { margin-top:1rem!important; }
.mr-3 { margin-right:1rem!important; }
.mb-3 { margin-bottom:1rem!important; }
.ml-3 { margin-left:1rem!important; }
.mx-3 { margin-right:1rem!important;margin-left:1rem!important; }
.my-3 { margin-bottom:1rem!important;margin-top:1rem!important; }

.mt-4 { margin-top:1.5rem!important; }
.mr-4 { margin-right:1.5rem!important; }
.mb-4 { margin-bottom:1.5rem!important; }
.ml-4 { margin-left:1.5rem!important; }
.mx-4 { margin-right:1.5rem!important;margin-left:1.5rem!important; }
.my-4 { margin-top:1.5rem!important;margin-bottom:1.5rem!important; }

.mt-5 { margin-top:3rem!important; }
.mr-5 { margin-right:3rem!important; }
.mb-5 { margin-bottom:3rem!important; }
.ml-5 { margin-left:3rem!important; }
.mx-5 { margin-right:3rem!important;margin-left:3rem!important; }
.my-5 { margin-top:3rem!important;margin-bottom:3rem!important; }

.mt-auto { margin-top:auto!important; }
.mr-auto { margin-right:auto!important; }
.mb-auto { margin-bottom:auto!important; }
.ml-auto { margin-left:auto!important; }
.mx-auto { margin-right:auto!important;margin-left:auto!important; }
.my-auto { margin-bottom:auto!important;margin-top:auto!important; }

.p-0 { padding:0!important; }
.p-1 { padding:.25rem!important; }
.p-2 { padding:.5rem!important; }
.p-3 { padding:1rem!important; }
.p-4 { padding:1.5rem!important; }
.p-5 { padding:3rem!important; }

.pt-0 { padding-top:0!important; }
.pr-0 { padding-right:0!important; }
.pb-0 { padding-bottom:0!important; }
.pl-0 { padding-left:0!important; }                             
.px-0 { padding-left:0!important;padding-right:0!important; }
.py-0 { padding-top:0!important;padding-bottom:0!important; }

.pt-1 { padding-top:.25rem!important; }         
.pr-1 { padding-right:.25rem!important; }                       
.pb-1 { padding-bottom:.25rem!important; }      
.pl-1 { padding-left:.25rem!important; }                            
.px-1 { padding-left:.25rem!important;padding-right:.25rem!important; }
.py-1 { padding-top:.25rem!important;padding-bottom:.25rem!important; }

.pt-2 { padding-top:.5rem!important; }                                              
.pr-2 { padding-right:.5rem!important; }                                
.pb-2 { padding-bottom:.5rem!important; }               
.pl-2 { padding-left:.5rem!important; }                                             
.px-2 { padding-right:.5rem!important;padding-left:.5rem!important; }
.py-2 { padding-top:.5rem!important;padding-bottom:.5rem!important; }

.pt-3 { padding-top:1rem!important; }                               
.pr-3 { padding-right:1rem!important; }             
.pb-3 { padding-bottom:1rem!important; }                
.pl-3 { padding-left:1rem!important; }                              
.py-3 { padding-bottom:1rem!important;padding-top:1rem!important; }
.px-3 { padding-right:1rem!important;padding-left:1rem!important; }

.pt-4 { padding-top:1.5rem!important; }                             
.pr-4 { padding-right:1.5rem!important; }               
.pb-4 { padding-bottom:1.5rem!important; }              
.pl-4 { padding-left:1.5rem!important; }                                
.px-4 { padding-right:1.5rem!important;padding-left:1.5rem!important; }
.py-4 { padding-top:1.5rem!important;padding-bottom:1.5rem!important; }

.pt-5 { padding-top:3rem!important; }   
.pr-5 { padding-right:3rem!important; } 
.pb-5 { padding-bottom:3rem!important; }    
.pl-5 { padding-left:3rem!important; }  
.px-5 { padding-right:3rem!important;padding-left:3rem!important; }
.py-5 { padding-top:3rem!important;padding-bottom:3rem!important; }

.bg-whatsapp { 
    background:url("/img/bed-whatsapp.png");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

table.dataTable tbody tr.highlight {
    font-weight: bold;
}
table.dataTable tbody tr.even.highlight {
    
}
table.dataTable tbody tr.odd.highlight {
    background-color: #f9f9f9;
}
f-11{
    font-size:11px !important;
}
.borderB{
    clear:both;
    border-top:1px solid #CCCCCC;
    border-left:1px solid #CCCCCC;
    height:8px;
    width:70%;
}
    '."\r\n";
?>
