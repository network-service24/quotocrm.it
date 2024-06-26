  'use strict';
  $(window).on('load', function() {
      //Welcome Message (not for login page)
      function notify(message, type) {
          $.growl({
              message: message
          }, {
              type: type,
              allow_dismiss: false,
              label: 'Cancel',
              className: 'btn-xs btn-inverse',
              placement: {
                  from: 'top',
                  align: 'center'
              },
              delay: 2500,
              animate: {
                  enter: 'animated fadeInRight',
                  exit: 'animated fadeOutRight'
              },
              offset: {
                  x: 30,
                  y: 30
              }
          });
      };


      notify('Benvenuto nella gestione della Media Gallery, ti sarà utile per tutto il CMS!!', 'inverse');

  });