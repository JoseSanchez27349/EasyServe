<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Mesa;
use App\Models\Mesero;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Producto;



class ControlVistas extends Controller{

    public function vistaMesas(){
        // Recuperamos las mesas junto con el mesero asignado (si lo hay)
        $mesas = Mesa::with('mesero')->get();
        return view('mesas', ['mesas' => $mesas]); 
    }
    
    public function vistaMenu()
    {
        // Verificar si el mesero está autenticado
        if (Auth::guard('mesero')->check()) {
            $mesero = Auth::guard('mesero')->user();
    
            // Obtener todas las categorías únicas
            $categorias = Producto::select('categoria')->distinct()->get();
    
            // Obtener productos organizados por categoría
            $productos = Producto::all();
    
            // Obtener todas las mesas
            $mesas = Mesa::all();
    
            // Pasar las variables a la vista
            return view('menu', compact('categorias', 'productos', 'mesas', 'mesero'));
        } else {
            // El mesero no está autenticado, redirige al login
            return redirect()->route('mesero.login');
        }
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
    public function vistaAdminDashboard()
    {
        return view('admin.dashboard'); // Asegúrate de que esta vista exista
    }

    // Agregar un nuevo mesero
    public function agregarMesero(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:255',
        'password' => 'required|string|min:8', 
    ]);

    // Crear un nuevo mesero
    $mesero = new Mesero();
    $mesero->nombre = $request->nombre;
    $mesero->password = bcrypt($request->password); // Hasheo de la contraseña
    $mesero->save();

    return redirect()->route('mesero')->with('success', 'Mesero agregado con éxito');
}
public function mostrarFormularioAgregar()
{
    return view('agregar_mesero'); // Renderiza la vista del formulario
}

    // Editar un mesero
    public function editarMesero($id)
{
    $mesero = Mesero::findOrFail($id); // Obtén el mesero por su ID
    return view('editar_mesero', compact('mesero')); // Pasa la variable $mesero a la vista
}
    

    
    // Actualizar un mesero
    public function actualizarMesero(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'password' => 'nullable|string|min:8', // La contraseña es opcional
    ]);

    $mesero = Mesero::findOrFail($id);
    $mesero->nombre = $request->nombre;

    // Actualiza la contraseña solo si se proporciona
    if ($request->filled('password')) {
        $mesero->password = bcrypt($request->password);
    }

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

public function index()
{
    $meseros = Mesero::all(); // Obtén todos los meseros
    return view('mesero', compact('meseros')); // Pasa la variable $meseros a la vista
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

