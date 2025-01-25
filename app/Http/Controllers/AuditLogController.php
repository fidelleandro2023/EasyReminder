<?php
namespace App\Http\Controllers; 
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Lista los registros de auditoría.
     */
    public function index(Request $request)
    {
        $auditLogs = AuditLog::with('user')
            ->when($request->has('user_id'), function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->when($request->has('entity'), function ($query) use ($request) {
                $query->where('entity', $request->entity);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('audit_logs.index', compact('auditLogs'));
    }

    /**
     * Muestra los detalles de un registro de auditoría específico.
     */
    public function show(AuditLog $auditLog)
    {
        return view('audit_logs.show', compact('auditLog'));
    }
}
