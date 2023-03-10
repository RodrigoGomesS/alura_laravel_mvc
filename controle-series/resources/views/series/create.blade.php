<x-layout title="Nova série">
    <a class="btn btn-dark mb-2" href="{{ route('series.index') }}">Home</a>

    <form method="post" action="{{ route('series.store') }}">
        @csrf
        <div class="mb-2">
            <label class="form-label" for="nome">Nome</label>
            <input class="form-control" type="text" name="nome" id="nome">
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</x-layout>
