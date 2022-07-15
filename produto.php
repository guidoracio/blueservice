<?php 
$id_produto = $Complemento1;

////////// PRODUTOS
$s_produtos = "SELECT * FROM produtos WHERE status='S' AND id_produto='$id_produto'";
$q_produtos = mysqli_query($conexao, $s_produtos) or die('ERRO - PRODUTOS');
$produtos   = mysqli_fetch_assoc($q_produtos);
$t_produtos = mysqli_num_rows($q_produtos);

if($t_produtos==0) echo "<script>window.location='./'</script>";

$caracteristicas_produto = $produtos['caracteristicas'];

////////// CARACTERÍSTICAS
$s_caracteristicas = "SELECT * FROM caracteristicas WHERE id_caracteristica IN ($caracteristicas_produto) AND status='S' ORDER BY nome ASC";
$q_caracteristicas = mysqli_query($conexao, $s_caracteristicas) or die('ERRO - CARACTERÍSTICAS');
$caracteristicas   = mysqli_fetch_assoc($q_caracteristicas);
$t_caracteristicas = mysqli_num_rows($q_caracteristicas);
?>
<div class="row">
  <div class="col-md-5">
    <img src="<?php echo $dominio; ?>/uploads/produtos/<?php echo $produtos['imagem']; ?>" class="card-img-top" alt="<?php echo $produtos['nome']; ?>">
  </div>
  <div class="col-md-7">
    <h3><?php echo $produtos['nome']; ?></h3>
    <p>R$ <?php echo dinheiro($produtos['valor']); ?></p>
    <div class="w-50 mb-3">
     <label for="caracteristicas" class="form-label">Características</label>
      <select name="caracteristicas" class="form-select" id="caracteristicasProduto">
        <option value="" selected>Selecione</option>
        <?php do { ?>
          <option value="<?php echo encrypt_decrypt('encrypt', $caracteristicas['id_caracteristica']); ?>"><?php echo $caracteristicas['nome']; ?></option>
        <?php } while ($caracteristicas = mysqli_fetch_assoc($q_caracteristicas)); ?>
      </select>
    </div>
    <button id="ComprarProduto" type="button" class="btn btn-success" data-produto="<?php echo encrypt_decrypt('encrypt', $produtos['id_produto']); ?>">Compra produto</button>
  </div>
</div>
<div class="row mt-5">
  <div class="col-md-12">
    <div class="pt-2 pb-2 mb-4 border-bottom">
      <h1 class="h4">Descrição</h1>
    </div>
    <p><?php echo nl2br($produtos['descricao']); ?></p>
  </div>
</div>