$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    $(window).scroll(function () {

    console.log($(window).scrollTop());

    if ($(window).scrollTop() > 218) {
      $('#mynav').addClass('navbar-fixed-top');
    }

    if ($(window).scrollTop() < 219) {
      $('#mynav').removeClass('navbar-fixed-top');
    }
    });
});
