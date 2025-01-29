<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Menu;

class Breadcrumb extends Component
{ 
    public $breadcrumb;
    public $menus;

    public function mount()
    { 
        $this->menus = Menu::with('children') 
                        ->whereNull('parent_id')  
                        ->get();

        $this->breadcrumb = $this->getBreadcrumb();
    }
    public function render()
    {
        return view('livewire.breadcrumb');
    }
     
    public function getBreadcrumb()
    { 
        $currentUrl = request()->path();
        //echo $currentUrl;
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
        
        if (isset($menu->url) && $menu->url === "/".$currentUrl) {
            return true;
        }
 
        foreach ($menu->children as $child) {
            if ($this->findInMenu($child, $currentUrl, $breadcrumb)) {
                return true;
            }
        }
 
        array_pop($breadcrumb);
        return false;
    }

}
