<script>
    $('document').ready(function() {
        $("#kt_datatable_dom_positioning").DataTable({
            "language": {
                "lengthMenu": "Show _MENU_",
            },
            //  "lengthMenu": [30,40,50,100],
            "dom": "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });
        $("#kt_datatable_dom_positioning_filter input[type=search]").addClass('border-gray-400');


        var elements = document.getElementsByClassName('menu-accordion');
        elements.forEach((element) => {
            var links = element.getElementsByTagName('a');
            links.forEach((link) => {
                if (link.href == window.location.href) {
                    link.classList.add('bg-light');
                    link.closest(".menu-accordion").classList.add('here', 'show');
                    // link.closest(".menu-main-accordion").classList.add('here', 'show');
                    // console.log(link.closest(".menu-main-accordion"));
                    link.closest(".menu-item").classList.add('here');
                };
            });
        });
    });
    $('#kt_app_sidebar_menu_wrapper .menu-item .menu-title').css({fontWeight:"bold"});
    // $('#kt_app_sidebar_menu_wrapper .menu-item .svg-icon').css("color","black");


</script>
