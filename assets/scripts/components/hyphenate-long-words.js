(function($){
  /**
   * Hyphenates long words - requires [data-hyphens] css styles to be correct
   */
  var hyphenate_long_words = function(){
    var pattern = /(\S{12,})/gi; // words you want to wrap
    var replaceWith = '<span data-hyphens>$1</span>'; // Here's the wap
    $('a, .nostoblokki__otsikko *, h1, h1 *, h2, h2 *, h3, h3 *, h4, h5, h6').each(function(){

      if ($(this).has('*').length){
        return;
      }

      if ($(this).html() !== undefined){
        $(this).html(
          $(this).html().replace(pattern,replaceWith)
        );
      }
    });
  };

  $(document).ready(function(){
    hyphenate_long_words();
  });
})(jQuery);
