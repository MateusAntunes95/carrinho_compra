<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Adicionar Produto</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input name="name" id="name" class="form-control rounded" required
                        value="{{ $product->name }}">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="value">Valor:</label>
                    <input name="value" id="value" class="form-control number rounded" required
                        value="{{ $product->value }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9">
                @if (empty($product->id))
                    <div class="form-group">
                        <label for="anexo" class="form-label">imagem:</label>
                        <input name="anexo" required id="anexo" accept=".png" type="file"
                            class="form-control rounded">
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-3">
                            <img width="100" height="100" src="{{ '/images/product/' . $product->image }}">
                            <input name="anexo" hidden id="anexo" type="file" class="form-control rounded">
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-sm-3">
                <div class="form-check mb-3">
                    <input class="mt-5 ml-3 form-check-input" type="checkbox" id="activeCheckbox" checked>
                    <label class="mt-5 form-check-label" for="activeCheckbox">
                        Ativo
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" required class="form-control rounded" rows="4">{{ $product->description }}</textarea>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">
            Salvar
        </button>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/product.js?v=1') }}"></script>
