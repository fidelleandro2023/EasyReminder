<?php
namespace App\Http\Controllers;
use App\Models\ServiceEntity;
use Illuminate\Http\Request;

class ServiceEntityController extends Controller
{
    /**
     * Lista todas las entidades de servicio.
     */
    public function index()
    {
        $serviceEntities = ServiceEntity::all();

        return view('service_entity.index', compact('serviceEntities'));
    }

    /**
     * Muestra el formulario para crear una nueva entidad de servicio.
     */
    public function create()
    {
        return view('service_entity.create');
    }

    /**
     * Almacena una nueva entidad de servicio en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:service_entity',
            'description' => 'nullable|string|max:500',
        ]);

        ServiceEntity::create($request->all());

        return redirect()->route('service-entity.index')->with('success', 'Entidad de servicio creada exitosamente.');
    }

    /**
     * Muestra los detalles de una entidad de servicio específica.
     */
    public function show(ServiceEntity $serviceEntity)
    {
        return view('service_entity.show', compact('serviceEntity'));
    }

    /**
     * Muestra el formulario para editar una entidad de servicio existente.
     */
    public function edit(ServiceEntity $serviceEntity)
    {
        return view('service_entity.edit', compact('serviceEntity'));
    }

    /**
     * Actualiza una entidad de servicio en la base de datos.
     */
    public function update(Request $request, ServiceEntity $serviceEntity)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:service_entity,name,' . $serviceEntity->id,
            'description' => 'nullable|string|max:500',
        ]);

        $serviceEntity->update($request->all());

        return redirect()->route('service-entity.index')->with('success', 'Entidad de servicio actualizada exitosamente.');
    }

    /**
     * Elimina una entidad de servicio.
     */
    public function destroy(ServiceEntity $serviceEntity)
    {
        $serviceEntity->delete();

        return redirect()->route('service-entity.index')->with('success', 'Entidad de servicio eliminada exitosamente.');
    }
}
