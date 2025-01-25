<?php
namespace App\Http\Controllers;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Lista las notificaciones del usuario autenticado.
     */
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Muestra los detalles de una notificación específica.
     */
    public function show(Notification $notification)
    {
        $this->authorize('view', $notification);

        if ($notification->status === 'unread') {
            $notification->update(['status' => 'read']);
        }

        return view('notifications.show', compact('notification'));
    }

    /**
     * Marca una notificación como leída.
     */
    public function markAsRead(Notification $notification)
    {
        $this->authorize('update', $notification);

        if ($notification->status === 'unread') {
            $notification->update(['status' => 'read']);
        }

        return redirect()->route('notifications.index')->with('success', 'Notificación marcada como leída.');
    }

    /**
     * Elimina una notificación.
     */
    public function destroy(Notification $notification)
    {
        $this->authorize('delete', $notification);

        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notificación eliminada exitosamente.');
    }
}
