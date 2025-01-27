<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Menu;

class MenuPolicy
{
    public function manageMenus(User $user)
    { 
        return $user->hasRole('admin') || $user->hasPermission('manage menus');
    }
}
