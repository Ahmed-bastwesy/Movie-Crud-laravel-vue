$(document).ready(function(){

  function addSection(where) {
    var main = document.getElementById("add-products-details");
    var cntr = (main.datacntr || 0) + 1;
    main.datacntr = cntr;
    
    var clone = main.cloneNode(true);
    clone.id = "section" + cntr;
    where.parentNode.insertBefore(clone, where);    
}

function addSectionTwo(where) {
    var main = document.getElementById("add-products-Additions");
    var cntr = (main.datacntr || 0) + 1;
    main.datacntr = cntr;
    
    var clone = main.cloneNode(true);
    clone.id = "section" + cntr ;
    where.parentNode.insertBefore(clone, where);    
}

function addSectionThree(where) {
    var main = document.getElementById("extra-options");
    var cntr = (main.datacntr || 0) + 1;
    main.datacntr = cntr;
    
    var clone = main.cloneNode(true);
    clone.id = "section" + cntr ;
    where.parentNode.insertBefore(clone, where);    
}





    //Dashboard Navigation
    const Toggle = document.querySelector('.toggle');
    const Navigation = document.querySelector('.navigation');
    Toggle.addEventListener('click' , function(){
        Navigation.classList.toggle('active')
    })



    var acc = document.getElementsByClassName("accordion-btn");
    var i;
    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");
    
        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
          panel.style.display = "none";
        } else {
          panel.style.display = "block";
        }
      });
    }


    $('#myTab a').on('click', function (event) {
      event.preventDefault()
      $(this).tab('show')
    })



    function addSection(where) {
      var main = document.getElementById("add-product");
      var cntr = (main.datacntr || 0) + 1;
      main.datacntr = cntr;
      
      var clone = main.cloneNode(true);
      clone.id = "section" + cntr;
      where.parentNode.insertBefore(clone, where);    
    }     


    $('.table-bordered').dataTable();


    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    let triggerCollapse = document.querySelectorAll('button[data-action="toggleCollapse"]');
    for( let x = 0; x < triggerCollapse.length;x++ ) {
      triggerCollapse[x].addEventListener('click', function(){
        $(this).closest('.nav-item').find('.nav-link').slideToggle();
      });
    }
    $('.nav .nav-item .nav-link').slideUp();       



});