<x-layout title="Temporadas de {!! $series->nome !!}">

    <div class="d-flex justify-center my-4">
        @if ($series->cover)
            <img src="{{ asset('storage/' . $series->cover) }}" style="max-height: 400px" alt="Capa da série"
                class="img-fluid">
        @else
            <img src="{{ asset('images/off_serie.jpeg') }}" style="max-height: 400px" alt="Capa da série" class="img-fluid">
        @endif
    </div>


    <ul class="list-group">
        @foreach ($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('episodes.index', $season->id) }}">
                    Temporada {{ $season->number }}
                </a>
                <span class="badge bg-secondary">
                    {{ $season->episodesWatched() }} / {{ $season->episodes->count() }}
                </span>
            </li>
        @endforeach
    </ul>
</x-layout>
