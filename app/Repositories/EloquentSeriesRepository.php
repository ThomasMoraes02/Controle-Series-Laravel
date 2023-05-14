<?php 
namespace App\Repositories;

use App\Models\Season;
use App\Models\Series;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SeriesFormRequest;

class EloquentSeriesRepository implements SeriesRepository
{
    /**
     * Add a new series
     *
     * @param SeriesFormRequest $request
     * @return Series
     */
    public function add(SeriesFormRequest $request): Series
    {
        return DB::transaction(function() use ($request) {
            $serie = Series::create($request->all());

            $seasons = [];
            for ($i=1; $i <= $request->seasonsQty; $i++) { 
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i,
                ];
            }
            Season::insert($seasons);
    
            $episodes = [];
            foreach($serie->seasons as $season) {
                for ($e=1; $e <= $request->episodesPerSeason; $e++) { 
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $e
                    ];
                }
            }
            Episode::insert($episodes);

            return $serie;
        });
    }
}