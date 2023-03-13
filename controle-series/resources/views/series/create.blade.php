<x-layout title="Nova série">

    <a class="btn btn-dark mb-2" href="{{ route('series.index') }}">Home</a>

    <x-series.form action="{{ route('series.store') }}" :nome="old('nome')"></x-series.form>

</x-layout>
