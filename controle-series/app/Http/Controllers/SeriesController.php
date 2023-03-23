<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
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
        $series = Series::all();
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

        $serie = Series::create($request->all());
        $seasons = [];
        $episodes = [];

        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i,
            ];
        }

        Season::insert($seasons);

        foreach ($serie->seasons as $season) {
            for ($e = 1; $e <= $request->episodesPerSeason; $e++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $e,
                ];
            }
        }

        Episode::insert($episodes);

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


    public function edit(Series $series)
    {
        return view('series.edit')->with('series', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
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
        $serie = Series::find($request->series); //select a série
        Series::destroy($request->series); //remove série

        return redirect()->route('series.index')
            ->with('message.sucesso', "Série '{$serie->nome}' removida com sucesso"); // insere uma mensagem flash na sessão
    }
}
