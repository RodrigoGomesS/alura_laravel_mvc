<x-layout title="Nova série">

    <a class="btn btn-dark mb-2" href="{{ route('series.index') }}">Home</a>

    <form method="post" action="{{ route('series.store') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-8">
                <label class="form-label" for="nome">Nome</label>
                <input class="form-control" autofocus type="text" name="nome" id="nome"
                    value="{{ old('nome') }}">
            </div>
            <div class="col-2">
                <label class="form-label" for="seasonsQty">N° Temporadas</label>
                <input class="form-control" type="text" name="seasonsQty" id="seasonsQty"
                    value="{{ old('seasonsQty') }}">
            </div>
            <div class="col-2">
                <label class="form-label" for="episodesPerSeason">Eps / Temporada</label>
                <input class="form-control" type="text" name="episodesPerSeason" id="episodesPerSeason"
                    value="{{ old('episodesPerSeason') }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

</x-layout>
