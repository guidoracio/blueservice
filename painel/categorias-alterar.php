<?php 
$id_categoria = encrypt_decrypt('decrypt', $Complemento1);
  
////////// CATEGORIAS
$s_categorias = "SELECT * FROM categorias WHERE id_categoria='$id_categoria' AND status<>'D'";
$q_categorias = mysqli_query($conexao, $s_categorias) or die('ERRO - CATEGORIAS');
$categorias   = mysqli_fetch_assoc($q_categorias);
$t_categorias = mysqli_num_rows($q_categorias);

if($t_categorias==0) echo "<script>window.location='./'</script>";
?>
<div class="pt-2 pb-2 mb-4 border-bottom">
  <div class="row">
    <div class="col-md-6">
      <h1 class="h4">Categorias - Alterar</h1></div>
  </div>
</div>
<form action="POST" name="FormAlterarCategoria" id="FormAlterarCategoria" autocomplete="OFF">
  <input name="acao" type="hidden" id="acao" value="categorias-alterar">
  <input name="id" type="hidden" id="id" value="<?php echo $Complemento1; ?>">
  <div class="row">
    <div class="col-md-12">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input name="nome" class="form-control" id="nome" maxlength="100" value="<?php echo $categorias['nome']; ?>" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-12 text-center">
      <button id="BtnAlterar" type="submit" class="btn btn-warning">Alterar</button>
    </div>
  </div>
</form>