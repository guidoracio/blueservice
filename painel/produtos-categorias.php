<?php 
$id_produto = encrypt_decrypt('decrypt', $Complemento1);
  
////////// PRODUTOS
$s_produtos = "SELECT nome FROM produtos WHERE id_produto='$id_produto' AND status<>'D'";
$q_produtos = mysqli_query($conexao, $s_produtos) or die('ERRO - PRODUTOS');
$produtos   = mysqli_fetch_assoc($q_produtos);
$t_produtos = mysqli_num_rows($q_produtos);

////////// CATEGORIAS
$s_categorias = "SELECT * FROM categorias WHERE status='S' ORDER BY nome ASC";
$q_categorias = mysqli_query($conexao, $s_categorias) or die('ERRO - CATEGORIAS');
$categorias   = mysqli_fetch_assoc($q_categorias);
$t_categorias = mysqli_num_rows($q_categorias);
?>
<div class="pt-2 pb-2 mb-4 border-bottom">
<div class="row">
  <div class="col-md-6"><h1 class="h4">Produtos - Categorias | <?php echo $produtos['nome']; ?></h1></div>
  <div class="col-md-6 text-end"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalCadastrar">CADASTRAR NOVA CATEGORIA</button>
</div>
</div>
</div>
<input name="FiltroID" type="hidden" id="FiltroID" value="<?php echo $Complemento1; ?>">
<table id="ProdutosCategoriasListar" class="table table-striped py-4 border-top border-bottom">
  <thead>
    <tr>
      <th scope="col" width="80" class="text-center">ID</th>
      <th scope="col">Categoria</th>
      <th scope="col" width="120" class="text-center no-sort">Funções</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<div class="modal fade" id="ModalCadastrar" tabindex="-1" aria-labelledby="ModalCadastrarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalCadastrarLabel">CADASTRAR NOVA CATEGORIA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="FormCadastrarCategoriaProduto" name="FormCadastrarCategoriaProduto" method="POST" autocomplete="OFF">
      <input name="acao" type="hidden" id="acao" value="produtos-categorias-cadastrar">
      <input name="produto" type="hidden" id="produto" value="<?php echo $Complemento1; ?>">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="mb-3">
              <label for="id_categoria" class="form-label">Categorias</label>
              <select name="id_categoria[]" class="selectpicker w-100" id="id_categoria" multiple>
                <?php do { ?>
                  <option value="<?php echo encrypt_decrypt('encrypt', $categorias['id_categoria']); ?>"><?php echo $categorias['nome']; ?></option>
                <?php } while ($categorias = mysqli_fetch_assoc($q_categorias)); ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button id="BtnCadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
      </form>
   </div>
  </div>
</div>
