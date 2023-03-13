<x-layout title="Editar série">
    <a class="btn btn-dark mb-2" href="{{ route('series.index') }}">Home</a>

    <x-series.form :action="route('series.update', $series->id)" nome="{{ $series->nome }}" update="true"></x-series.form>

</x-layout>
