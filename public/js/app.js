$(document).ready(function () {
    const $topbar = $('#topbar');
    const $hamburgerButton = $('#hamburgerButton');
    const $closeSidebar = $('#closeSidebar');
    const $sidebar = $('#sidebar');
    const $dashboardContent = $('#dashboardContent');
    const $menuList = $('#menu-list');
    const $sidebarTitle = $('#sidebar-title');
    const $logoDashboard = $('.logo_dashboard'); // Selector del logo

    if (!$hamburgerButton.length || !$sidebar.length) {
        console.error('Uno o más elementos no se encontraron en el DOM.');
        return;
    }

    // Función para detectar si es móvil
    const isMobile = () => window.matchMedia("(max-width: 768px)").matches;

    // Expandir/Colapsar Sidebar (Botón Hamburguesa)
    $hamburgerButton.on('click', function () {
        if (isMobile()) {
            // Modo móvil: Mostrar/Ocultar Sidebar (100% de ancho o colapsado)
            const isCollapsed = $sidebar.hasClass('collapsed');
            $sidebar
                .css('width', isCollapsed ? '100%' : '0')
                .toggleClass('collapsed', !isCollapsed);
            $topbar.css('left', '0'); // Siempre al borde en móviles
        } else {
            // Modo escritorio: Expandir/Colapsar Sidebar (50px o 250px)
            const isCollapsed = $sidebar.width() === 50;
            $sidebar
                .css('width', isCollapsed ? '250px' : '50px')
                .toggleClass('collapsed', !isCollapsed);
            $dashboardContent.css('margin-left', isCollapsed ? '250px' : '50px');
            $topbar.css('left', isCollapsed ? '250px' : '50px'); // Ajustar topbar

            // Mostrar/Ocultar el texto del logo
            if (isCollapsed) {
                $logoDashboard.find('span').fadeIn();
            } else {
                $logoDashboard.find('span').fadeOut();
            }
        }
    });

    // Expandir/Colapsar Submenús
    $('.expand-menu').on('click', function () {
        const submenu = $(this).next('.submenu');
        submenu.toggleClass('open');
        $(this).find('i').toggleClass('fa-plus fa-minus');
    });

    // Colapsar Sidebar (Botón Cerrar)
    $closeSidebar.on('click', function () {
        const isCollapsed = $sidebar.hasClass('collapsed');

        if (!isCollapsed) {
            $sidebar
                .addClass('collapsed')
                .css('width', isMobile() ? '0' : '50px');
            $menuList.css('font-size', '14px');
            $sidebarTitle.hide();

            // Ocultar el texto del logo al colapsar
            if (!isMobile()) {
                $logoDashboard.find('span').fadeOut();
            }
        } else {
            $sidebar
                .removeClass('collapsed')
                .css('width', isMobile() ? '100%' : '250px');
            $menuList.css('font-size', '16px');
            $sidebarTitle.show();

            // Mostrar el texto del logo al expandir
            if (!isMobile()) {
                $logoDashboard.find('span').fadeIn();
            }
        }
    });

    // Ajustar Sidebar al cambiar el tamaño de la ventana
    $(window).on('resize', function () {
        if (isMobile()) {
            // Modo móvil
            $sidebar.css('width', '0').addClass('collapsed');
            $topbar.css('left', '0');
            $dashboardContent.css('margin-left', '0');
            $logoDashboard.find('span').show(); // Siempre mostrar el texto en móvil
        } else {
            // Modo escritorio
            $sidebar.css('width', '250px').removeClass('collapsed');
            $topbar.css('left', '250px');
            $dashboardContent.css('margin-left', '250px');
            $logoDashboard.find('span').fadeIn(); // Mostrar el texto del logo
        }
    }).trigger('resize'); // Ejecutar al cargar para inicializar el diseño
});
