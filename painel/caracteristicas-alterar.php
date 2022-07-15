<?php 
$id_caracteristica = encrypt_decrypt('decrypt', $Complemento1);
  
////////// CARACTERÍSTICAS
$s_caracteristicas = "SELECT * FROM caracteristicas WHERE id_caracteristica='$id_caracteristica' AND status<>'D'";
$q_caracteristicas = mysqli_query($conexao, $s_caracteristicas) or die('ERRO - CARACTERÍSTICAS');
$caracteristicas   = mysqli_fetch_assoc($q_caracteristicas);
$t_caracteristicas = mysqli_num_rows($q_caracteristicas);

if($t_caracteristicas==0) echo "<script>window.location='./'</script>";
?>
<div class="pt-2 pb-2 mb-4 border-bottom">
  <div class="row">
    <div class="col-md-6">
      <h1 class="h4">Características - Alterar</h1></div>
  </div>
</div>
<form action="POST" name="FormAlterarCaracteristica" id="FormAlterarCaracteristica" autocomplete="OFF">
  <input name="acao" type="hidden" id="acao" value="caracteristicas-alterar">
  <input name="id" type="hidden" id="id" value="<?php echo $Complemento1; ?>">
  <div class="row">
    <div class="col-md-12">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input name="nome" class="form-control" id="nome" maxlength="100" value="<?php echo $caracteristicas['nome']; ?>" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-12 text-center">
      <button id="BtnAlterar" type="submit" class="btn btn-warning">Alterar</button>
    </div>
  </div>
</form>