<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesa;
use App\Models\Mesero;
use App\Models\Pedido;
use App\Models\DetallePedido;

class ControlVistas extends Controller{

    public function vistaMesas(){
        // Recuperamos las mesas junto con el mesero asignado (si lo hay)
        $mesas = Mesa::with('mesero')->get();
        return view('mesas', ['mesas' => $mesas]); 
    }

    public function vistaMenu(){
        // Para el formulario de nueva orden, obtenemos las mesas y meseros activos
        $mesas = Mesa::all();
        $meseros = Mesero::all();
        return view('menu', ['mesas' => $mesas, 'meseros' => $meseros]); 
    }

    public function guardarOrden(Request $request){
        // Validamos la información recibida
        $request->validate([
            'mesa_id' => 'required|exists:mesas,id',
            'mesero_id' => 'required|exists:meseros,id',
            'items' => 'required|array|min:1',
            'items.*.nombre' => 'required|string',
            'items.*.cantidad' => 'required|integer|min:1',
            'items.*.precio' => 'required|numeric|min:0',
        ]);

        // Creamos el pedido con total inicial 0 (se actualizará)
        $pedido = Pedido::create([
            'mesa_id' => $request->mesa_id,
            'mesero_id' => $request->mesero_id,
            'total' => 0,
        ]);

        $total = 0;
        // Guardamos cada detalle del pedido y acumulamos el total
        foreach ($request->items as $detalle) {
            $subtotal = $detalle['cantidad'] * $detalle['precio'];
            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'item' => $detalle['nombre'],
                'cantidad' => $detalle['cantidad'],
                'precio' => $detalle['precio'],
            ]);
            $total += $subtotal;
        }

        // Actualizamos el total del pedido
        $pedido->update(['total' => $total]);

        // Actualizamos la mesa: se marca como ocupada y se asocia el mesero
        $mesa = Mesa::find($request->mesa_id);
        $mesa->update([
            'status' => 'ocupada',
            'mesero_id' => $request->mesero_id,
        ]);

        return redirect()->route('menu')->with('success', 'Orden guardada correctamente.');
    }
    
    //vistas mesero inicio
    public function vistaMesero()
    {
        $meseros = Mesero::all(); // Obtener todos los meseros
        return view('mesero', compact('meseros'));
    }

    // Agregar un nuevo mesero
    public function agregarMesero(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $mesero = new Mesero();
        $mesero->nombre = $request->nombre;
        $mesero->save();

        return redirect()->route('mesero')->with('success', 'Mesero agregado con éxito');
    }

    // Editar un mesero
    public function editarMesero($id)
    {
        $mesero = Mesero::findOrFail($id);
        return view('editar_mesero', compact('mesero'));
    }

    // Actualizar un mesero
    public function actualizarMesero(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $mesero = Mesero::findOrFail($id);
        $mesero->nombre = $request->nombre;
        $mesero->save();

        return redirect()->route('mesero')->with('success', 'Mesero actualizado con éxito');
    }

    // Eliminar un mesero
    public function eliminarMesero($id)
    {
        $mesero = Mesero::findOrFail($id);
        $mesero->delete();

        return redirect()->route('mesero')->with('success', 'Mesero eliminado con éxito');
    }

    //cierre vistas mesero

    public function vistaInicio(){
        return view('inicio'); 
    }

    public function vistaNotificaciones(){
        return view('notificaciones'); 
    }

    public function vistaCuenta(){
        // Obtener todos los pedidos de mesas que están ocupadas
        $pedidos = Pedido::whereHas('mesa', function ($query) {
            $query->where('status', 'ocupada'); // Ajusta esto según tu lógica de estado
        })->with('mesa', 'mesero', 'detalles')->get();
    
        return view('cuenta', compact('pedidos'));
    }
    public function finalizarCuenta($id)
{
    // Encuentra la mesa por ID
    $mesa = Mesa::find($id);

    if ($mesa) {
        // Cambia el estado de la mesa a 'libre'
        $mesa->status = 'libre';
        $mesa->save();
        $mesa->pedidos()->delete();
        return redirect()->route('cuenta')->with('success', 'Cuenta finalizada, mesa liberada y registros eliminados.');
    }

    return redirect()->route('cuenta')->with('error', 'Mesa no encontrada.');
}

}

