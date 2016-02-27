(function($){
  $(document).ready(function(){
    var $slides = $('#slides');

    $slides.superslides({
      pagination: true,
      play: 4000,
      animation: 'fade'
    })

    Hammer($slides[0]).on("swipeleft", function(e) {
      $slides.data('superslides').animate('next')
    })

    Hammer($slides[0]).on("swiperight", function(e) {
      $slides.data('superslides').animate('prev')
    })

    $('.slides-container div:first').click(function(){
      $(this).css('cursor', 'pointer')
      window.location = 'http://www.estanciadoliveira.com/destaques/alta-gastronomia-com-o-melhor-preco-da-regiao/'
    })

    // --------------------

    // Search widget. Add text on placeholder
    $('.widget_search #s').attr("placeholder", "Pesquise aqui...")

  })
})(jQuery)
