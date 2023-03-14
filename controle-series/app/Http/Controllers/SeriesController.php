<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $series = Serie::all();
        $messageSucesso = $request->session()->get('message.sucesso');
        return view(
            'series.index',
            [
                'series' => $series,
                'messageSucesso' => $messageSucesso,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeriesFormRequest $request)
    {
        $serie = Serie::create($request->all());

        return redirect()->route('series.index')
            ->with('message.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit(Serie $series)
    {
        dd($series->season);
        return view('series.edit')->with('series', $series);
    }

    public function update(Serie $series, SeriesFormRequest $request)
    {
        $series->nome = $request->nome;
        $series->save();

        return redirect()->route('series.index')
            ->with('message.sucesso', "Série '{$series->nome}' atualizada com sucesso"); // insere uma mensagem flash na sessão
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $serie = Serie::find($request->series); //select a série
        Serie::destroy($request->series); //remove série

        return redirect()->route('series.index')
            ->with('message.sucesso', "Série '{$serie->nome}' removida com sucesso"); // insere uma mensagem flash na sessão
    }
}
