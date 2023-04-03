<x-layout title="Editar série">

    <x-series.form :action="route('series.update', $series->id)" nome="{{ $series->nome }}" update="true"></x-series.form>

</x-layout>
