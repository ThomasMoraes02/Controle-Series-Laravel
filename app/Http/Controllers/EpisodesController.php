<?php 
namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController
{
    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes
        ]);
    }

     /**
     * Updates the watched status of episodes of a season based on the input request.
     *
     * @param Request $request the HTTP request object containing the list of watched episode IDs
     * @param Season $season the season object whose episodes are to be updated
     */
    public function update(Request $request, Season $season)
    {
        $watchedEpisodes = $request->episodes;
        $season->episodes->each(function(Episode $episode) use($watchedEpisodes) {
            $episode->watched = in_array($episode->id, $watchedEpisodes);
        });

        $season->push();

        return to_route('episodes.index', $season->id);
    }
}