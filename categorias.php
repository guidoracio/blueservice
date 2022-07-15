<?php 
$id_categoria = $Complemento1;
  
////////// CATEGORIAS
$s_categorias = "SELECT * FROM categorias WHERE id_categoria='$id_categoria' AND status='S'";
$q_categorias = mysqli_query($conexao, $s_categorias) or die('ERRO - CATEGORIAS');
$categorias   = mysqli_fetch_assoc($q_categorias);
$t_categorias = mysqli_num_rows($q_categorias);

if($t_categorias==0) echo "<script>window.location='./'</script>";

////////// PRODUTOS
$s_produtos = "SELECT p.* 
               FROM produtos_categorias AS c, produtos AS p
               WHERE 
               c.id_categoria='$id_categoria' AND 
               c.id_produto=p.id_produto AND
               p.status='S' 
               ORDER BY rand() ASC";
$q_produtos = mysqli_query($conexao, $s_produtos) or die('ERRO - PRODUTOS');
$produtos   = mysqli_fetch_assoc($q_produtos);
$t_produtos = mysqli_num_rows($q_produtos);
?>
<div class="pt-2 pb-2 mb-4 border-bottom">
<h1 class="h4"><?php echo $categorias['nome']; ?></h1>
</div>
<?php if($t_produtos>0) { ?>
<div class="row">
  <?php do { ?>
  <div class="col-md-3">
    <div class="card">
      <img src="<?php echo $dominio; ?>/uploads/produtos/<?php echo $produtos['imagem']; ?>" class="card-img-top" alt="<?php echo $produtos['nome']; ?>">
      <div class="card-body">
        <h5 class="card-title"><?php echo $produtos['nome']; ?></h5>
        <p>R$ <?php echo dinheiro($produtos['valor']); ?></p>      
        <a href="./produto/<?php echo $produtos['id_produto']; ?>/<?php echo tiraAcentos($produtos['nome']); ?>" class="btn btn-link  p-0">Ver Produto</a>
      </div>
    </div>
  </div>
  <?php } while ($produtos = mysqli_fetch_assoc($q_produtos)); ?>
</div>
<?php } ?>