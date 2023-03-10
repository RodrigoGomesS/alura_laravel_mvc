<x-layout title="Séries">
    <a class="btn btn-dark mb-2" href="/series/criar">Adicionar série</a>
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item">{{ $serie->nome }}</li>
        @endforeach
    </ul>
</x-layout>
