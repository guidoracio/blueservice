<?php 
////////// PRODUTOS
$s_produtos = "SELECT * FROM produtos WHERE status='S' ORDER BY rand() ASC";
$q_produtos = mysqli_query($conexao, $s_produtos) or die('ERRO - PRODUTOS');
$produtos   = mysqli_fetch_assoc($q_produtos);
$t_produtos = mysqli_num_rows($q_produtos);

if($t_produtos>0) {
?>
<div class="row">
  <?php do { ?>
  <div class="col-md-3">
    <div class="card">
      <img src="<?php echo $dominio; ?>/uploads/produtos/<?php echo $produtos['imagem']; ?>" class="card-img-top" alt="<?php echo $produtos['nome']; ?>">
      <div class="card-body">
        <h5 class="card-title"><?php echo $produtos['nome']; ?></h5>
        <p>R$ <?php echo dinheiro($produtos['valor']); ?></p>      
        <a href="./produto/<?php echo $produtos['id_produto']; ?>/<?php echo tiraAcentos($produtos['nome']); ?>" class="btn btn-link p-0">Ver Produto</a>
      </div>
    </div>
  </div>
  <?php } while ($produtos = mysqli_fetch_assoc($q_produtos)); ?>
</div>
<?php } ?>