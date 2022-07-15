<?php 
////////// CATEGORIAS
$s_categorias = "SELECT * FROM categorias WHERE status='S' ORDER BY nome ASC";
$q_categorias = mysqli_query($conexao, $s_categorias) or die('ERRO - CATEGORIAS');
$categorias   = mysqli_fetch_assoc($q_categorias);
$t_categorias = mysqli_num_rows($q_categorias);

////////// CARACTERÍSTICAS
$s_caracteristicas = "SELECT * FROM caracteristicas WHERE status='S' ORDER BY nome ASC";
$q_caracteristicas = mysqli_query($conexao, $s_caracteristicas) or die('ERRO - CARACTERÍSTICAS');
$caracteristicas   = mysqli_fetch_assoc($q_caracteristicas);
$t_caracteristicas = mysqli_num_rows($q_caracteristicas);
?>
<div class="pt-2 pb-2 mb-4 border-bottom">
  <div class="row">
    <div class="col-md-6">
      <h1 class="h4">Produtos - Cadastrar</h1></div>
  </div>
</div>
<form action="POST" enctype="multipart/form-data" name="FormCadastraProduto" id="FormCadastraProduto" autocomplete="OFF">
  <input name="acao" type="hidden" id="acao" value="produtos-cadastrar">
  <div class="row">
    <div class="col-md-6">
      <div class="mb-3">
        <label for="id_categoria" class="form-label">Categorias</label>
        <select name="id_categoria[]" class="selectpicker w-100" id="id_categoria" multiple>
          <?php do { ?>
            <option value="<?php echo encrypt_decrypt('encrypt', $categorias['id_categoria']); ?>"><?php echo $categorias['nome']; ?></option>
          <?php } while ($categorias = mysqli_fetch_assoc($q_categorias)); ?>
        </select>
      </div>
   </div>
    <div class="col-md-6">
      <div class="mb-3">
        <label for="caracteristicas" class="form-label">Características</label>
        <select name="caracteristicas[]" class="selectpicker w-100" id="caracteristicas" multiple>
          <?php do { ?>
            <option value="<?php echo encrypt_decrypt('encrypt', $caracteristicas['id_caracteristica']); ?>"><?php echo $caracteristicas['nome']; ?></option>
          <?php } while ($caracteristicas = mysqli_fetch_assoc($q_caracteristicas)); ?>
        </select>
      </div>
    </div>
    <div class="col-md-9">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input name="nome" class="form-control" id="nome" maxlength="100" data-plugin-maxlength>
      </div>
    </div>
    <div class="col-md-3">
      <div class="mb-3">
        <label for="valor" class="form-label">Valor</label>
        <input name="valor" type="tel" class="form-control dinheiro" id="valor">
      </div>
    </div>
    <div class="col-md-12">
      <div class="mb-3">
        <label for="arquivo" class="form-label">Imagem</label>
        <input name="arquivo" type="file" class="form-control" id="arquivo" accept="image/gif, image/jpg, image/jpeg, image/png">
      </div>
    </div>
    <div class="col-md-12">
      <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" rows="10" class="form-control" id="descricao"></textarea>
      </div>
    </div>
    <div class="col-md-12 text-center">
      <button id="BtnCadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
  </div>
</form>