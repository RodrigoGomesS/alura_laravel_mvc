<x-layout title="Séries">
    <a href="/series/criar">Nova série</a>
    <ul>
        @foreach ($series as $serie)
            <li>{{ $serie }}</li>
        @endforeach
    </ul>
</x-layout>
