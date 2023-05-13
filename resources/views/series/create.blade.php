<x-layout title="Nova Série">
    {{-- <x-series.form :action="route('series.store')" :nome="old('nome')" :update="false"></x-series.form> --}}

    <form action="{{ route('series.store') }}" method="post">
        @csrf

        <div class="row mb-3">
            <div class="col-8">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome') }}" autofocus>
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label for="seasonsQty" class="form-label">N Temporadas:</label>
                    <input type="int" id="seasonsQty" name="seasonsQty" class="form-control" value="{{ old('seasonsQty') }}">
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label for="episodesPerSeason" class="form-label">EP / Temporada:</label>
                    <input type="int" id="episodesPerSeason" name="episodesPerSeason" class="form-control" value="{{ old('episodesPerSeason') }}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layout>
