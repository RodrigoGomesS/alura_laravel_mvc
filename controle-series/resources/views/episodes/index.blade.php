<x-layout title="Episódios" :mensagem-sucesso="$mensagemSucesso">

    <a class="btn btn-dark mb-2" href="{{ route('seasons.index', $season->series_id) }}">Série</a>

    <form method="post">
        @csrf
        <ul class="list-group">
            @foreach ($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episode->number }}

                    <input type="checkbox" name="episodes[]" value="{{ $episode->id }}"
                        @if ($episode->watched) checked @endif>
                </li>
            @endforeach
        </ul>
        <button type="submit" class="btn btn-primary my-3">Salvar</button>
    </form>
</x-layout>
