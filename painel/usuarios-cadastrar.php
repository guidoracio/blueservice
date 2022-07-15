<div class="pt-2 pb-2 mb-4 border-bottom">
  <div class="row">
    <div class="col-md-6">
      <h1 class="h4">Usuários - Cadastrar</h1></div>
  </div>
</div>
<form action="POST" name="FormCadastraUsuario" id="FormCadastraUsuario" autocomplete="OFF">
  <input name="acao" type="hidden" id="acao" value="usuarios-cadastrar">
  <div class="row">
    <div class="col-md-4">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input name="nome" class="form-control" id="nome" maxlength="100" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-4">
      <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input name="login" class="form-control" id="login" maxlength="50" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-4">
      <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input name="senha" class="form-control" id="senha" maxlength="20" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-12 text-center">
      <button id="BtnCadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
  </div>
</form>