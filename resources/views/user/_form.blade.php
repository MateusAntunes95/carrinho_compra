<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Editando usuário</h5>
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="col-sm-3 mb-4">
                <label for="name">Nome:</label>
                <input name="name" id="name" class="form-control rounded" required value="{{ $user->name }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-3 mb-3">
                <label for="email">email:</label>
                <input name="email" class="form-control rounded" required value="{{  $user->email }}">
            </div>
        </div>
        @if(empty($user->id))
            <div class="form-group">
                <label for="password">Senha</label>
                <input name="password" class="form-control rounded" required >
            </div>
        @endif
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">
            Salvar
        </button>
    </div>
</div>
