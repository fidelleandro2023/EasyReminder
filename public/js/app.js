$(document).ready(function () {
    const $topbar = $('#topbar');
    const $hamburgerButton = $('#hamburgerButton');
    const $closeSidebar = $('#closeSidebar');
    const $sidebar = $('#sidebar');
    const $dashboardContent = $('#dashboardContent');
    const $menuList = $('#menu-list');
    const $sidebarTitle = $('#sidebar-title');
    const $logoDashboard = $('.logo_dashboard');  

    if (!$hamburgerButton.length || !$sidebar.length) {
        console.error('Uno o más elementos no se encontraron en el DOM.');
        return;
    }
 
    const isMobile = () => window.matchMedia("(max-width: 768px)").matches;
 
    $hamburgerButton.on('click', function () {
        if (isMobile()) { 
            const isCollapsed = $sidebar.hasClass('collapsed');
            $sidebar
                .css('width', isCollapsed ? '100%' : '0')
                .toggleClass('collapsed', !isCollapsed);
            $topbar.css('left', '0');  
        } else { 
            const isCollapsed = $sidebar.width() === 50;
            $sidebar
                .css('width', isCollapsed ? '250px' : '50px')
                .toggleClass('collapsed', !isCollapsed);
            $dashboardContent.css('margin-left', isCollapsed ? '250px' : '50px');
            $topbar.css('left', isCollapsed ? '250px' : '50px');  
 
            if (isCollapsed) {
                $logoDashboard.find('span').fadeIn();
            } else {
                $logoDashboard.find('span').fadeOut();
            }
        }
    });
 
    $('.expand-menu').on('click', function () {
        const submenu = $(this).next('.submenu');
        submenu.toggleClass('open');
        $(this).find('i').toggleClass('fa-plus fa-minus');
    });
 
    $closeSidebar.on('click', function () {
        const isCollapsed = $sidebar.hasClass('collapsed');

        if (!isCollapsed) {
            $sidebar
                .addClass('collapsed')
                .css('width', isMobile() ? '0' : '50px');
            $menuList.css('font-size', '14px');
            $sidebarTitle.hide();
 
            if (!isMobile()) {
                $logoDashboard.find('span').fadeOut();
            }
        } else {
            $sidebar
                .removeClass('collapsed')
                .css('width', isMobile() ? '100%' : '250px');
            $menuList.css('font-size', '16px');
            $sidebarTitle.show();
 
            if (!isMobile()) {
                $logoDashboard.find('span').fadeIn();
            }
        }
    });
 
    $(window).on('resize', function () {
        if (isMobile()) { 
            $sidebar.css('width', '0').addClass('collapsed');
            $topbar.css('left', '0');
            $dashboardContent.css('margin-left', '0');
            $logoDashboard.find('span').show();  
        } else { 
            $sidebar.css('width', '250px').removeClass('collapsed');
            $topbar.css('left', '250px');
            $dashboardContent.css('margin-left', '250px');
            $logoDashboard.find('span').fadeIn();  
        }
    }).trigger('resize');  
});
