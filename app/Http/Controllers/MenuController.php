<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('order')->get();
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        $roles = Role::all();  
        $permissions = Permission::all(); 
        return view('menus.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'roles' => 'nullable|array',
            'permissions' => 'nullable|array',
            'order' => 'nullable|integer',
        ]);

        Menu::create([
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'roles' => $request->roles,
            'permissions' => $request->permissions,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('menus.index')->with('success', 'Menú creado exitosamente.');
    }

    public function edit(Menu $menu)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('menus.edit', compact('menu', 'roles', 'permissions'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'roles' => 'nullable|array',
            'permissions' => 'nullable|array',
            'order' => 'nullable|integer',
        ]);

        $menu->update([
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'roles' => $request->roles,
            'permissions' => $request->permissions,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('menus.index')->with('success', 'Menú actualizado exitosamente.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menú eliminado exitosamente.');
    }
}
