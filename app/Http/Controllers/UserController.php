<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Lista todos los usuarios. 
     */
    public function index()
    {
        $users = User::paginate(10);  
        return view('users.index', compact('users'));
    }
    /**
     * Crear usuario
    */
    public function create()
    {
        return view('users.create');
    }
    /**
     * Almacena un nuevo usuario.
     */
    public function store(Request $request)
    { 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
 
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra los detalles de un usuario específico.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Muestra el formulario para editar un usuario.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Actualiza los datos de un usuario.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Elimina un usuario. 
     */
    public function destroy(User $user)
    {
        $user->delete(); 
        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
    /**
     * Busca usuarios basados en el nombre o correo electrónico.
     */
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        $users = $query->paginate(10);

        return view('users.index', compact('users'));
    }
}
