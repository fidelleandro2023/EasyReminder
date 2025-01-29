<?php
namespace App\Http\Controllers\Auth; 
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;  
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function create()
    {
        return view('auth.login');  
    }

    /**
     * Maneja una solicitud de autenticación entrante.
     */
    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');  
    }

    /**
     * Destruye una sesión autenticada.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');  
    }
}
