<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    <a class="btn btn-dark mb-2" href="{{ route('series.create') }}">Adicionar série</a>

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">

                    @if ($serie->cover)
                        <img class="me-3" src="{{ asset('storage/' . $serie->cover) }}" width="100"
                            class="img-thumbnail" alt="">
                    @else
                        <img class="me-3" src="{{ asset('images/off_serie.jpeg') }}" width="100"
                            class="img-thumbnail" alt="">
                    @endif

                    @auth <a href="{{ route('seasons.index', $serie->id) }}"> @endauth
                        {{ $serie->nome }}
                        @auth </a> @endauth
                </div>
                <span class="d-flex align-items-center">
                    <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil" viewBox="0 0 16 16">
                            <path
                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                        </svg>
                    </a>
                    <form action="{{ route('series.destroy', $serie->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            X
                        </button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>
</x-layout>
