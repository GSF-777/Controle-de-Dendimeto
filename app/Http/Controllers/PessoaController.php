<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect; 
use App\Models\Pessoa;
use Illuminate\Http\Request;
use App\Services\PessoaService;

class PessoaController extends Controller
{

    public function __construct( private PessoaService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        Pessoa::create([
    'name' => $request->name,
    'cpf' => $request->cpf,
    'telefone' => $request->telefone,
    'tipo' => $request->tipo,
]);

        return redirect::route('cadastro');

    }

    /**
     * Display the specified resource.
     */
    public function show(Pessoa $pessoa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pessoa $pessoa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pessoa $pessoa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pessoa $pessoa)
    {
        //
    }
}
