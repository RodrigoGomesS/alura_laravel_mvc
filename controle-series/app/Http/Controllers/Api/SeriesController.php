<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{

    private $repository;

    public function __construct(SeriesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return Series::all();
    }

    public function store(SeriesFormRequest $request)
    {
        return response()
            ->json($this->repository->add($request), 201);
    }

    public function show(int $series)
    {
        $series = Series::whereId($series)->with('seasons.episodes')->first();
        return $series;
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return $series;
    }

    public function destroy(int $series)
    {
        $delete =  Series::destroy($series);
        return $delete ? 'Série deletada' : 'Erro ao deletar série';
    }

    public function upload(Request $request)
    {
        // Verificar se o arquivo foi enviado na requisição
        if (!$request->hasFile('cover')) {
            return response()->json(['erro' => 'Arquivo não enviado'], 400);
        }

        // Obter o arquivo enviado na requisição
        $arquivo = $request->file('cover');

        // Obter o diretório base de armazenamento dos arquivos
        $diretorioBase = storage_path('app/public/');

        // Obter o parâmetro "path" da URL, ou definir um valor padrão
        $path = $request->input('path', 'default');

        // Criar o diretório para armazenar o arquivo, se ele não existir
        $caminhoDiretorio = $diretorioBase . '/' . $path;
        if (!file_exists($caminhoDiretorio)) {
            mkdir($caminhoDiretorio, 0755, true);
        }

        // Definir o nome do arquivo
        $nomeArquivo = time() . '.' . $arquivo->getClientOriginalExtension();

        // Salvar o arquivo no diretório
        $arquivo->move($caminhoDiretorio, $nomeArquivo);

        // Gerar o caminho completo para o arquivo
        $caminhoArquivo = $caminhoDiretorio . '/' . $nomeArquivo;

        // Retornar a resposta da API
        return response()->json(['caminho' => $caminhoArquivo]);
    }
}
