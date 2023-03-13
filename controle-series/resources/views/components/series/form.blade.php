<form method="post" action="{{ $action }}">
    @csrf
    @isset($update)
        @method('PUT')
    @endisset
    <div class="mb-2">
        <label class="form-label" for="nome">Nome</label>
        <input class="form-control" type="text" name="nome" id="nome"
            @isset($nome)
            value="{{ $nome }}"
        @endisset>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
