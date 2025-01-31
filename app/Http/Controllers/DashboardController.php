<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\RecurringPayment;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Obtener pagos vencidos correctamente (según la lógica de overdue())
        $overduePaymentsQuery = Payment::notDeleted()
            ->where('due_date', '<', now())  
            ->where('status', '!=', 'paid');

        if ($user->role !== 'admin') {  
            $overduePaymentsQuery->where('user_id', $user->id);  
        }

        return view('dashboard', [
            'pendingPaymentsCount' => Payment::where('status', 'pending')->count(),
            'paidPaymentsCount' => Payment::where('status', 'paid')->count(),
            'overduePaymentsCount' => $overduePaymentsQuery->count(), // ✅ Corrige la cuenta de vencidos
            'priorityPayments' => Payment::where('status', '!=', 'paid')
                ->orderBy('due_date', 'asc')
                ->take(8)
                ->get(),
            'recurringPayments' => RecurringPayment::with('serviceEntity')->get(),
            'activeRecurringPaymentsCount' => RecurringPayment::where('status', 'active')->count(),
            'pausedRecurringPaymentsCount' => RecurringPayment::where('status', 'paused')->count(),
            'completedRecurringPaymentsCount' => RecurringPayment::where('status', 'completed')->count(),
        ]);
    }
}
