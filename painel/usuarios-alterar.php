<?php 
$id_usuario = encrypt_decrypt('decrypt', $Complemento1);
  
////////// USUÁRIOS
$s_usuarios = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario' AND status<>'D'";
$q_usuarios = mysqli_query($conexao, $s_usuarios) or die('ERRO - USUÁRIOS');
$usuarios   = mysqli_fetch_assoc($q_usuarios);
$t_usuarios = mysqli_num_rows($q_usuarios);

if($t_usuarios==0) echo "<script>window.location='./'</script>";
?>
<div class="pt-2 pb-2 mb-4 border-bottom">
  <div class="row">
    <div class="col-md-6">
      <h1 class="h4">Usuários - Alterar</h1></div>
  </div>
</div>
<form action="POST" name="FormAlterarUsuario" id="FormAlterarUsuario" autocomplete="OFF">
  <input name="acao" type="hidden" id="acao" value="usuarios-alterar">
  <input name="id" type="hidden" id="id" value="<?php echo $Complemento1; ?>">
  <div class="row">
    <div class="col-md-4">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input name="nome" class="form-control" id="nome" maxlength="100" value="<?php echo $usuarios['nome'];?>" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-4">
      <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input name="login" class="form-control" id="login" maxlength="50" value="<?php echo $usuarios['login'];?>" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-4">
      <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input name="senha" class="form-control" id="senha" maxlength="20" data-plugin-maxlength>
        <small class="form-text text-muted">Preencha caso queira alterar</small>
      </div>
    </div>
    <div class="col-md-12 text-center">
      <button id="BtnAlterar" type="submit" class="btn btn-warning">Alterar</button>
    </div>
  </div>
</form>