<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Series;
use App\Models\Episode;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $series = Series::all();
        $mensagemSucesso = session('mensagem.sucesso');

        return view("series.index", compact("series", "mensagemSucesso"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("series.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeriesFormRequest $request)
    {
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

        return to_route("series.index")->with("mensagem.sucesso", "Série {$serie->nome} criada com sucesso!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Series $series)
    {
        return view("series.edit")->with("serie", $series);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route("series.index")->with("mensagem.sucesso", "Série {$series->nome} atualizada com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Series $series)
    {
        $series->delete();
        return to_route("series.index")->with("mensagem.sucesso", "Série {$series->nome} excluída com sucesso!");
    }
}
