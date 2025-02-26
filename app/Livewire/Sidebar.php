<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Menu;

class Sidebar extends Component
{
    public $menus;
    public $breadcrumb;

    public function mount()
    {
        $this->menus = Menu::with('children') 
                        ->whereNull('parent_id')  
                        ->get();
        $this->breadcrumb = $this->getBreadcrumb();
    }
    public function render()
    {
        return view('livewire.sidebar');
    }
     
    public function getBreadcrumb()
    {
        // Obtener la URL actual
        $currentUrl = url()->current();

        // Buscar en el menú la jerarquía del breadcrumb
        $breadcrumb = [];
        foreach ($this->menus as $menu) {
            if ($this->findInMenu($menu, $currentUrl, $breadcrumb)) {
                break;
            }
        }

        return $breadcrumb;
    }

    private function findInMenu($menu, $currentUrl, &$breadcrumb)
    {
        $breadcrumb[] = $menu;

        // Verificar si la URL coincide
        if (url($menu->route) === $currentUrl) {
            return true;
        }

        // Buscar en los hijos
        foreach ($menu->children as $child) {
            if ($this->findInMenu($child, $currentUrl, $breadcrumb)) {
                return true;
            }
        }

        // Eliminar si no es parte del breadcrumb
        array_pop($breadcrumb);
        return false;
    }

}
