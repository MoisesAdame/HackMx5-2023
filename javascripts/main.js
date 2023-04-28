(function ($) {
      'use strict'
      // Scrollspy
      $('body').scrollspy({
            target: '#nav',
            offset: $(window).height() / 2
      })
      $('#modalSchedule').modal('show')

      // Smooth scroll
      $("#nav .main-nav a[href^='#']").on('click', function (e) {
            e.preventDefault()
            $('html, body').animate({
                  scrollTop: $(this.hash).offset().top
            }, 600)
      })
      $("a[href^='#']").on('click', function (e) {
            e.preventDefault()
            // var hash = this.hash
            $('html, body').animate({
                  scrollTop: $(this.hash).offset().top
            }, 600)
      })

      $('#back-to-top').on('click', function () {
            $('body,html').animate({
                  scrollTop: 0
            }, 600)
      })

      // Btn nav collapse
      $('#nav .nav-collapse').on('click', function () {
            $('#nav').toggleClass('open')
      })

      // On Scroll
      $(window).on('scroll', function () {
            var wScroll = $(this).scrollTop()

            // Fixed nav
            wScroll > 1 ? $('#nav').addClass('fixed-nav') : $('#nav').removeClass('fixed-nav')

            // Back To Top Appear
            wScroll > 700 ? $('#back-to-top').fadeIn() : $('#back-to-top').fadeOut()
      })
      $('#contactAlertSuccess').on('close.bs.alert', function () {
            $('#contactAlertSuccess').addClass('hidden')
            return false
      })
      $('#contactAlertFailure').on('close.bs.alert', function () {
            $('#contactAlertFailure').addClass('hidden');
            return false
      })

      $('#inputName').keyup(function (e) {
            $('#groupInputName').removeClass('has-error')
      })
      $('#inputMsg').keyup(function (e) {
            $('#groupInputName').removeClass('has-error')
      })
      $('#inputSubject').keyup(function (e) {
            $('#groupInputName').removeClass('has-error')
      })
      $('#contactForm').submit(function (e) {
            e.preventDefault()
            var postdata = $('#contactForm').serialize()
            var error = false
            if ($('#inputName').val().trim() === '') {
                  $('#groupInputName').addClass('has-error')
                  error = true
            } else if ($('#inputMsg').val().trim() === '') {
                  $('#groupInputMsg').addClass('has-error')
                  error = true
            } else if ($('#inputSubject').val().trim() === '') {
                  $('#groupInputSubject').addClass('has-error')
                  error = true
            }
            if (!error) {
                  $.ajax({
                        type: 'POST',
                        url: 'contact/',
                        data: postdata,
                        dataType: 'json'
                  }).done(function (result) {
                        if (result.error) {
                              $('#contactAlertFailure').removeClass('hidden');
                              $('#contactAlertSuccess').addClass('hidden');
                        } else {
                              $('#contactAlertFailure').addClass('hidden');
                              $('#contactAlertSuccess').removeClass('hidden');
                              document.getElementById('contactForm').reset();
                        }
                  }).fail(function () {
                        $('#contactAlertFailure').removeClass('hidden');
                        $('#contactAlertSuccess').addClass('hidden');
                  })
                  return false
            }
      })

})(jQuery)
