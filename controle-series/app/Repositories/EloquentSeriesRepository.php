<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository
{
    public function add(SeriesFormRequest $request): Series
    {
        return $serie = DB::transaction(function () use ($request) {
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

            return $serie;
        });
    }
}
