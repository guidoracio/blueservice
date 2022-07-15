<?php 
$id_produto = encrypt_decrypt('decrypt', $Complemento1);
  
////////// USUÁRIOS
$s_produtos = "SELECT * FROM produtos WHERE id_produto='$id_produto' AND status<>'D'";
$q_produtos = mysqli_query($conexao, $s_produtos) or die('ERRO - USUÁRIOS');
$produtos   = mysqli_fetch_assoc($q_produtos);
$t_produtos = mysqli_num_rows($q_produtos);

$caracteristicas_produto = explode(',', $produtos['caracteristicas']);

if($t_produtos==0) echo "<script>window.location='./'</script>";

////////// CARACTERÍSTICAS
$s_caracteristicas = "SELECT * FROM caracteristicas WHERE status='S' ORDER BY nome ASC";
$q_caracteristicas = mysqli_query($conexao, $s_caracteristicas) or die('ERRO - CARACTERÍSTICAS');
$caracteristicas   = mysqli_fetch_assoc($q_caracteristicas);
$t_caracteristicas = mysqli_num_rows($q_caracteristicas);
?>
<div class="pt-2 pb-2 mb-4 border-bottom">
  <div class="row">
    <div class="col-md-6">
      <h1 class="h4">Produtos - Alterar</h1></div>
  </div>
</div>
<form action="POST" enctype="multipart/form-data" name="FormAlterarProduto" id="FormAlterarProduto" autocomplete="OFF">
  <input name="acao" type="hidden" id="acao" value="produtos-alterar">
  <input name="id" type="hidden" id="id" value="<?php echo $Complemento1; ?>">
  <div class="row">
    <div class="col-md-6">
      <div class="mb-3">
        <label for="caracteristicas" class="form-label">Características</label>
        <select name="caracteristicas[]" class="selectpicker w-100" id="caracteristicas" multiple>
          <?php do { ?>
            <option value="<?php echo encrypt_decrypt('encrypt', $caracteristicas['id_caracteristica']); ?>"<?php if(in_array($caracteristicas['id_caracteristica'], $caracteristicas_produto)) echo ' selected'; ?>><?php echo $caracteristicas['nome']; ?></option>
          <?php } while ($caracteristicas = mysqli_fetch_assoc($q_caracteristicas)); ?>
        </select>
      </div>
    </div>
    <div class="col-md-9">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input name="nome" class="form-control" id="nome" maxlength="100" value="<?php echo $produtos['nome']; ?>" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-3">
      <div class="mb-3">
        <label for="valor" class="form-label">Valor</label>
        <input name="valor" type="tel" class="form-control dinheiro" id="valor" value="<?php echo $produtos['valor']; ?>">
      </div>
    </div>
    <div class="col-md-12">
      <?php if(empty($produtos['imagem'])) { ?>
      <div class="mb-3">
        <label for="arquivo" class="form-label">Imagem</label>
        <input name="arquivo" type="file" class="form-control" id="arquivo" accept="image/gif, image/jpg, image/jpeg, image/png">
      </div>
      <?php } else { ?>
      <div class="mb-3">
        <div id="divArquivo">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#VerImagem">VISUALIZAR IMAGEM</button>
          <button id="btApagar-<?php echo $Complemento1; ?>" type="button" class="btn btn-danger" onClick="excluirArquivo('<?php echo $Complemento1; ?>','produtoImagemApaga')">APAGAR IMAGEM</button>
        </div>
        <div id="divNovoArquivo"></div>
      </div>
      <?php } ?>
    </div>
    <div class="col-md-12">
      <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" rows="10" class="form-control" id="descricao"><?php echo $produtos['descricao']; ?></textarea>
      </div>
    </div>
    <div class="col-md-12 text-center">
      <button id="BtnAlterar" type="submit" class="btn btn-warning">Alterar</button>
    </div>
  </div>
</form>

<div class="modal fade" id="VerImagem" tabindex="-1" aria-labelledby="VerImagemLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="VerImagemLabel">Imagem Produto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img class="img-fluid" src="../uploads/produtos/<?php echo $produtos['imagem']; ?>" alt="<?php echo $produtos['nome']; ?>" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
