function fadein (){
    var reveal = document.querySelectorAll('.fade');
    reveal.forEach(function (event) {
      event.classList.add('active');
    });
}