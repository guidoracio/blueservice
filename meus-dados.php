<?php 
////////// CLIENTES
$s_clientes = "SELECT * FROM clientes WHERE id_cliente='$ID_CLIENTE' AND status<>'D'";
$q_clientes = mysqli_query($conexao, $s_clientes) or die('ERRO - CLIENTES');
$clientes   = mysqli_fetch_assoc($q_clientes);
$t_clientes = mysqli_num_rows($q_clientes);

if($t_clientes==0) echo "<script>window.location='./'</script>";
?>
<div class="pt-2 pb-2 mb-4 border-bottom">
  <div class="row">
    <div class="col-md-6">
      <h1 class="h4">Meus Dados</h1></div>
  </div>
</div>
<form action="POST" name="FormAlterarClientes" id="FormAlterarClientes" autocomplete="OFF">
  <input name="acao" type="hidden" id="acao" value="clientes-alterar">
  <div class="row">
    <div class="col-md-6">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input name="nome" class="form-control" id="nome" maxlength="100" value="<?php echo $clientes['nome']; ?>" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-3">
      <div class="mb-3">
        <label for="data_nascimento" class="form-label">Data Nascimento</label>
        <input name="data_nascimento" class="form-control data" id="data_nascimento" value="<?php echo DATA_BR($clientes['data_nascimento']); ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="mb-3">
        <label for="documento" class="form-label">CPF</label>
        <input name="documento" class="form-control cpf" id="documento" value="<?php echo $clientes['documento']; ?>">
      </div>
    </div>
    <div class="col-md-2">
      <label for="cep" class="form-label" id="LoaderCep">CEP</label>
      <div class="input-group mb-3">
        <input name="cep" type="tel" class="form-control cep" id="cep" onBlur="getEndereco('')" value="<?php echo $clientes['cep']; ?>">
        <button class="btn btn-primary" type="button" onClick="getEndereco('')"><i class="fas fa-search"></i></button>
      </div>
    </div>
    <div class="col-md-8">
      <div class="mb-3">
        <label for="endereco" class="form-label">Endereço</label>
        <input name="endereco" class="form-control" id="endereco" maxlength="100" value="<?php echo $clientes['endereco']; ?>" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-2">
      <div class="mb-3">
        <label for="numero" class="form-label">Número</label>
        <input name="numero" class="form-control" id="numero" maxlength="10" value="<?php echo $clientes['numero']; ?>" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-3">
      <div class="mb-3">
        <label for="bairro" class="form-label">Bairro</label>
        <input name="bairro" class="form-control" id="bairro" maxlength="100" value="<?php echo $clientes['bairro']; ?>" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-3">
      <div class="mb-3">
        <label for="complemento" class="form-label">Complemento</label>
        <input name="complemento" class="form-control" id="complemento" maxlength="100" value="<?php echo $clientes['complemento']; ?>" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-3">
      <div class="mb-3">
        <label for="cidade" class="form-label">Cidade</label>
        <input name="cidade" class="form-control" id="cidade" maxlength="50" value="<?php echo $clientes['cidade']; ?>" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-3">
      <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <input name="estado" class="form-control" id="estado" maxlength="2" value="<?php echo $clientes['estado']; ?>" data-plugin-maxlength>
      </div>
    </div>
    
    <div class="col-md-3">
      <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input name="telefone" type="tel" class="form-control telefone" value="<?php echo $clientes['telefone']; ?>" id="telefone">
      </div>
    </div>
    <div class="col-md-3">
      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input name="email" type="email" class="form-control" id="email" value="<?php echo $clientes['email']; ?>" maxlength="100" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-3">
      <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input name="senha" class="form-control" id="senha" maxlength="10" data-plugin-maxlength>
        <small class="form-text text-muted">Preencha caso queira alterar</small>
      </div>
    </div>
    <div class="col-md-12 text-center">
      <button id="BtnAlterar" type="submit" class="btn btn-warning">Alterar</button>
    </div>
  </div>
</form>