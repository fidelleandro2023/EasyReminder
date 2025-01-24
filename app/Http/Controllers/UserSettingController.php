<?php

namespace App\Http\Controllers;

use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSettingController extends Controller
{
    /**
     * Lista las configuraciones del usuario autenticado.
     */
    public function index()
    {
        $userSettings = UserSetting::where('user_id', Auth::id())->get();

        return view('user_settings.index', compact('userSettings'));
    }

    /**
     * Muestra el formulario para crear una nueva configuración.
     */
    public function create()
    {
        return view('user_settings.create');
    }

    /**
     * Almacena una nueva configuración en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:user_settings,key,NULL,id,user_id,' . Auth::id(),
            'value' => 'required|string|max:500',
        ]);

        UserSetting::create([
            'user_id' => Auth::id(),
            'key' => $request->key,
            'value' => $request->value,
        ]);

        return redirect()->route('user-settings.index')->with('success', 'Configuración guardada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una configuración específica.
     */
    public function edit(UserSetting $userSetting)
    {
        $this->authorize('update', $userSetting);

        return view('user_settings.edit', compact('userSetting'));
    }

    /**
     * Actualiza una configuración en la base de datos.
     */
    public function update(Request $request, UserSetting $userSetting)
    {
        $this->authorize('update', $userSetting);

        $request->validate([
            'key' => 'required|string|max:255|unique:user_settings,key,' . $userSetting->id . ',id,user_id,' . Auth::id(),
            'value' => 'required|string|max:500',
        ]);

        $userSetting->update($request->only('key', 'value'));

        return redirect()->route('user-settings.index')->with('success', 'Configuración actualizada exitosamente.');
    }

    /**
     * Elimina una configuración específica.
     */
    public function destroy(UserSetting $userSetting)
    {
        $this->authorize('delete', $userSetting);

        $userSetting->delete();

        return redirect()->route('user-settings.index')->with('success', 'Configuración eliminada exitosamente.');
    }
}
