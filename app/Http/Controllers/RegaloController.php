<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regalo;

class RegaloController extends Controller
{
    // Constructor para proteger con middleware 'auth'
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $regalos = Regalo::where('user_id', auth()->id())
                           ->orderBy('precio', 'desc')->get();

        return view('regalo.index', compact('regalos'));
    }

    public function create()
    {
        return view('regalo.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'regalo' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
        ]);

        // Crear un nuevo regalo y guardar en la base de datos
        Regalo::create([
            'user_id' => auth()->id(),
            'regalo' => $request->input('regalo'),
            'precio' => $request->input('precio'),
        ]);

        // Redirigir a la lista de regalos con un mensaje de éxito
        return redirect()->route('regalos.index')->with('success', 'Regalo agregado con éxito.');
    }
}
