<?php
namespace App\Http\Controllers;
use App\Models\Payment;
use App\Models\RecurringPayment;  
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'pendingPaymentsCount' => Payment::where('status', 'pending')->count(),
            'paidPaymentsCount' => Payment::where('status', 'paid')->count(),
            'overduePaymentsCount' => Payment::where('status', 'overdue')->count(),
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
