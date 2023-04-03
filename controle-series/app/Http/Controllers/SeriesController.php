<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Models\Series;
use App\Models\User;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{

    private $repository;

    public function __construct(SeriesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $series = Series::all();
        $mensagemSucesso = $request->session()->get('messagem.sucesso');
        return view(
            'series.index',
            [
                'series' => $series,
                'mensagemSucesso' => $mensagemSucesso,
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
        $serie = $this->repository->add($request);

        //busca todos os usuarios
        $users =  User::all();



        foreach ($users as $index => $user) {

            //cria o email, passando os parametros
            $email = new SeriesCreated(
                $serie->nome,
                $serie->id,
                $request->seasonsQty,
                $request->episodesPerSeason
            );

            //add Assunto
            $email->subject('Série criada');

            $when = now()->addSeconds($index * 5);

            //Enviar email
            Mail::to($user)->later($when, $email);
        }

        return redirect()->route('series.index')
            ->with('messagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
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
            ->with('messagem.sucesso', "Série '{$series->nome}' atualizada com sucesso"); // insere uma mensagem flash na sessão
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
            ->with('messagem.sucesso', "Série '{$serie->nome}' removida com sucesso"); // insere uma mensagem flash na sessão
    }
}
