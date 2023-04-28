(function ($) {
  'use strict'
  // Scrollspy
  $('body').scrollspy({
    target: '#nav',
    offset: $(window).height() / 2
  })

  // Smooth scroll
  $("#nav .main-nav a[href^='#']").on('click', function (e) {
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
  /*$('#inputBirthDate').click(function (e) {
    e.preventDefault()
  })
  $('#registerAlertSuccess').on('close.bs.alert', function () {
    $('#registerAlertSuccess').addClass('hidden')
    return false
  })
  $('#registerAlertFailure').on('close.bs.alert', function () {
    $('#registerAlertFailure').addClass('hidden')
    return false
  })
  $('#inputName').keyup(function (e) {
    $('#groupInputName').removeClass('has-error')
  })
  $('#inputLast').keyup(function (e) {
    $('#groupInputLastName').removeClass('has-error')
  })*/
  $('#registerAlertSuccess').on('close.bs.alert', function () {
    $('#registerAlertSuccess').addClass('hidden')
    return false
  })
  $('#registerAlertFailure').on('close.bs.alert', function () {
    $('#registerAlertFailure').addClass('hidden')
    return false
  })
  $('#registrationForm').submit(function (e) {
    e.preventDefault()
    var postdata = $('#registrationForm').serialize()
    var error = false
    /*if ($('#inputName').val().trim() === '') {
      $('#groupInputName').addClass('has-error')
      error = true
    } else if ($('#inputLastName').val().trim() === '') {
      $('#groupInputLastName').addClass('has-error')
      error = true
    }*/
    if (!error) {
      $.ajax({
        type: 'POST',
        url: 'register/',
        data: postdata,
        dataType: 'json',
        success: function (result) {
          if (result.error === true && result.errorNumber === 1) {
            $('#registerAlertFailure').removeClass('hidden')
            $('#registerAlertSuccess').addClass('hidden')
            $('#registerAlertFailureMessage').html('<strong>Rayos!</strong> Ese correo ya está en uso!')
          } else if (result.error === true && result.errorNumber === 2) {
            $('#registerAlertFailure').removeClass('hidden')
            $('#registerAlertSuccess').addClass('hidden')
            $('#registerAlertFailureMessage').html('<strong>Rayos!</strong> No pudimos enviar un correo en este momento, envíanos mensaje.')
          } else if (result.error === true ) {
            $('#registerAlertFailure').removeClass('hidden')
            $('#registerAlertSuccess').addClass('hidden')
            $('#registerAlertFailureMessage').html('<strong>Rayos!</strong> Hubo un error en la validación!')
          }
          else {
            $('#registerAlertFailure').addClass('hidden')
            $('#registerAlertSuccess').removeClass('hidden')
            document.getElementById('registrationForm').reset()
          }
        },
        error: function (res) {
          console.log(res)
          $('#registerAlertFailure').removeClass('hidden')
          $('#registerAlertSuccess').addClass('hidden')
        }
      })
    }
  })

})(jQuery)
