<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Muestra una lista de roles.
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return view('roles.index', compact('roles'));
    }

    /**
     * Muestra el formulario para crear un nuevo rol.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Almacena un nuevo rol en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un rol existente.
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * Actualiza un rol en la base de datos.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id . '|max:255',
        ]);

        $role->update(['name' => $request->name]);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    /**
     * Elimina un rol de la base de datos.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
    }
}
