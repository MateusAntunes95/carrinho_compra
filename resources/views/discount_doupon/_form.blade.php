<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Editando cupom</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input name="name" id="name" class="form-control rounded" required
                        value="{{ $doupon->name }}">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="locator">Localizador:</label>
                    <input name="locator" class="form-control rounded" required value="{{ $doupon->locator }}">
                </div>
            </div>
            <div class="col-sm-3 mb-3">
                <div class="form-group">
                    <label for="discount">Desconto:</label>
                    <input type="number" name="discount" class="form-control rounded" required
                        value="{{ $doupon->discount }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="limit">Limite:</label>
                    <input type="number" name="limit" class="form-control rounded" required
                        value="{{ $doupon->limit }}">
                </div>
            </div>
            <div class="col-sm-3 mb-3">
                <div class="form-group">
                    <label for="expiration_date">Data de expiração:</label>
                    <input type="date" name="expiration_date" class="form-control rounded" required
                        value="{{ $doupon->expiration_date }}">
                </div>
            </div>
            <div class="col-sm-3 mb-3">
                <div class="form-group">
                    <label for="active" class="form-check-label">Ativo?</label>
                    <div class="form-check">
                        <input type="checkbox" checked name="active" id="active" class="form-check-input"
                            {{ $doupon->active ? 'checked' : '' }}>
                        <label class="form-check-label" for="active"></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">
            Salvar
        </button>
    </div>
</div>
