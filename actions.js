var _gaq=[['_setAccount','UA-19606286-4'],['_trackPageview']];
(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
g.src=('https:'==location.protocol?'//web.archive.org/web/20120504071719/http://ssl':'//web.archive.org/web/20120504071719/http://www')+'.google-analytics.com/ga.js';
s.parentNode.insertBefore(g,s)}(document,'script'));

var _gauges = _gauges || [];
(function() {
  var t   = document.createElement('script');
  t.type  = 'text/javascript';
  t.async = true;
  t.id    = 'gauges-tracker';
  t.setAttribute('data-site-id', '4ea5aac6f5a1f51fd1000002');
  t.src = '//web.archive.org/web/20120504071719/http://secure.gaug.es/track.js';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(t, s);
})();

$('#contactTrigger').bind('click', function() {
  $('#contact-form')
    .show()
    .find('a')
    .bind('click', function() {
      $('#contact-form').hide();
      return false;
    });
  return false;
});

$('#aboutTrigger').bind('click',function(e){
  $('html, body').stop().animate({
    scrollTop: $('#who-is-prime').offset().top
  }, 1000);
  return false;
});


$("#contact-form").submit(function(){                       
  var self = $(this),
      emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
      email = $('#email'),
      message = $('#message');
  if( !email.val() || !emailReg.test(email.val()) ) {
    email.parent().addClass('invalid');
  } else if ( !message.val() ) {
    message.parent().addClass('invalid');
    email.parent().removeClass('invalid');
  } else {
    message.parent().removeClass('invalid');
    email.parent().removeClass('invalid');
    self.find('h3').text('sending...');
    $.post("/php/email.php",
        {
          email: email.val(),
          message: message.val()
        },
        function(data){
          self.hide();
          self.find('h3').text('contact');
          email.val('');
          message.val('');
        }
    );
  }
  return false;
});

/*
     FILE ARCHIVED ON 07:17:19 May 04, 2012 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 10:04:46 Mar 28, 2017.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/