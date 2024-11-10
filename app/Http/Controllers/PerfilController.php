<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Regalo;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function verPerfil($id)
    {
        $usuario = User::findOrFail($id);
        
        $regalos = Regalo::where('user_id', $id)
                           ->orderBy('precio', 'desc')->get();

        return view('regalo.perfil', compact('regalos', 'usuario'));
    }
}
