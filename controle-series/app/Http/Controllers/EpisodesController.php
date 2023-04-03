<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodesController extends Controller
{
    public function index(Season $season)
    {
        return view('episodes.index', [
            'season' => $season,
            'episodes' => $season->episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }

    public function update(Request $request, Season $season)
    {
        return DB::transaction(function () use ($request, $season) {
            $watchedEpisodes = $request->episodes;
            $season->episodes()->whereIn('id', $watchedEpisodes)->update(['watched' => true]);
            $season->episodes()->whereNotIn('id', $watchedEpisodes)->update(['watched' => false]);
            $season->refresh();

            return redirect()->route('episodes.index', $season->id)
                ->with('mensagem.sucesso', 'Episódios marcados como assistidos');
        });
    }
}
