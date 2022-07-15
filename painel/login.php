<div class="container-fluid h-100">
  <div class="row justify-content-center align-items-center h-100">
    <div class="col-md-3">
      <div class="card mb-0">
        <div class="card-body">
          <h5 class="card-title text-center mb-0">DADOS DE ACESSO</h5>
          <hr/>
          <form id="FormLogin" name="FormLogin" method="POST" autocomplete="OFF">
            <input name="acao" type="hidden" id="acao" value="login">
            <div class="mb-3">
              <label for="login" class="form-label">Login</label>
              <input name="login" type="text" class="form-control" id="login">
            </div>
            <div class="mb-3">
              <label for="senha" class="form-label">Senha</label>
              <input name="senha" type="password" class="form-control" id="senha">
            </div>
            <div class="d-grid gap-2">
              <button id="BtnEntrar" type="submit" class="btn btn-primary">ENTRAR</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>