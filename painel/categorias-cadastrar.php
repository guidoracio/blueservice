<div class="pt-2 pb-2 mb-4 border-bottom">
  <div class="row">
    <div class="col-md-6">
      <h1 class="h4">Categorias - Cadastrar</h1></div>
  </div>
</div>
<form action="POST" name="FormCadastraCategoria" id="FormCadastraCategoria" autocomplete="OFF">
  <input name="acao" type="hidden" id="acao" value="categorias-cadastrar">
  <div class="row">
    <div class="col-md-12">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input name="nome" class="form-control" id="nome" maxlength="100" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-12 text-center">
      <button id="BtnCadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
  </div>
</form>