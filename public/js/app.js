$(document).ready(function () {

    $('.expand-menu').click(function() {
        var submenu = $(this).next('.submenu');  
        submenu.toggleClass('open');  
        $(this).find('i').toggleClass('fa-plus fa-minus');  
    });

    const $hamburgerButton = $('#hamburgerButton');
    const $sidebar = $('#sidebar');
    const $dashboardContent = $('#dashboardContent');

    if ($hamburgerButton.length === 0) {
        console.error('Uno o más elementos no se encontraron en el DOM.');
        return;
    }

    $hamburgerButton.on('click', function () {
        console.log('clickkkkk'); 
        const isCollapsed = $sidebar.width() === 50;  
        $sidebar.css('width', isCollapsed ? '250px' : '50px');
        $dashboardContent.css('margin-left', isCollapsed ? '250px' : '50px');
        $sidebar.toggleClass('collapsed', !isCollapsed);
        //$sidebar.find("ul li a").toggle();
        if (isCollapsed) {
            $sidebar.find("ul li").css("padding","0");
            $sidebar.find(".logo_dashboard span").fadeIn();
            $sidebar.find("ul li a").fadeIn();   
        } else {
            $sidebar.find("ul li").css("padding","1rem 10px");
            $sidebar.find(".logo_dashboard span").fadeOut();   
            $sidebar.find("ul li a").fadeOut(); 
        }
    });
});