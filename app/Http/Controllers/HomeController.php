<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Libro;
use App\Models\SolicitudPrestamo;
use App\Models\RazonSocial;
use App\Models\Prestamo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuarios = count(User::select('users.*')
            ->join('datos_usuarios', 'datos_usuarios.user_id', '=', 'users.id')
            ->where('users.estado', 1)
            ->get());

        $libros = count(Libro::where('status', 1)->get());

        $c_prestamos = count(Prestamo::whereIn('estado', [1, 2])
            ->where('observaciones', 'PRESTAMO')
            ->orderBy('created_at', 'DESC')
            ->get());

        $c_solicituds = count(SolicitudPrestamo::all());

        $prestamos = Prestamo::where('estado', 1)
            ->where('tipo', 'EGRESO')
            ->orderBy('created_at', 'DESC')
            ->get();


        $solicituds = SolicitudPrestamo::orderBy("created_at", "DESC")->get();

        return view('home', compact('usuarios', 'prestamos', 'solicituds', 'libros', 'c_solicituds', 'c_prestamos'));
    }
}
