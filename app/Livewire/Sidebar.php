<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Menu;

class Sidebar extends Component
{
    public $menus;

    public function mount()
    {
        $this->menus = Menu::with('children') 
                        ->whereNull('parent_id')  
                        ->get();
    }
    public function render()
    {
        return view('livewire.sidebar');
    }
}
