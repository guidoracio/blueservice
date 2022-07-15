<?php 
////////// CARRINHO
$s_carrinho = "SELECT * FROM carrinho WHERE codigo='$SESSION_CARRINHO'";
$q_carrinho = mysqli_query($conexao, $s_carrinho) or die('ERRO - CARRINHO');
$carrinho   = mysqli_fetch_assoc($q_carrinho);
$t_carrinho = mysqli_num_rows($q_carrinho);

if($t_carrinho==0) echo "<script>window.location='./'</script>";

////////// ITENS
$s_carrinho_itens = "SELECT i.*, p.imagem, ca.nome AS Caracteristica
                     FROM carrinho_itens AS i, carrinho AS c, produtos AS p, caracteristicas AS ca
                     WHERE 
                     i.id_carrinho=c.id_carrinho AND 
                     i.id_caracteristica=ca.id_caracteristica AND 
                     i.id_produto=p.id_produto AND
                     c.codigo='$SESSION_CARRINHO'
                     ORDER BY i.nome_produto ASC";
$q_carrinho_itens = mysqli_query($conexao, $s_carrinho_itens) or die('ERRO - ITENS');
$carrinho_itens   = mysqli_fetch_assoc($q_carrinho_itens);
$t_carrinho_itens = mysqli_num_rows($q_carrinho_itens);
?>
<div class="pt-2 pb-2 mb-4 border-bottom">
<h1 class="h4">Carrinho</h1>
</div>
<div class="row">
  <div class="col-md-12">
    <?php if($t_carrinho_itens>0) { ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Produto</th>
            <th scope="col" class="text-center">Quantidade</th>
            <th scope="col" class="text-center">Valor</th>
            <th scope="col" class="text-center">Total</th>
            <th scope="col">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $TotalCarrinho = 0;
        do { ?> 
          <tr>
            <td>
            <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <img src="<?php echo $dominio; ?>/uploads/produtos/<?php echo $carrinho_itens['imagem']; ?>" alt="<?php echo $carrinho_itens['nome_produto']; ?>" width="65">
            </div>
            <div class="flex-grow-1 ms-3">
              <p class="mb-1"><?php echo $carrinho_itens['nome_produto']; ?></p>
              <p class="mb-0"><small><strong><?php echo $carrinho_itens['Caracteristica'];?></strong></small></p>
            </div>
            </div>
            </td>
            <td class="text-center"><?php echo $carrinho_itens['quantidade']; ?></td>
            <td class="text-center">R$ <?php echo dinheiro($carrinho_itens['valor']); ?></td>
            <td class="text-center">R$ <?php echo dinheiro($carrinho_itens['quantidade']*$carrinho_itens['valor']); ?></td>
            <td class="text-center"><button data-item="<?php echo encrypt_decrypt('encrypt', $carrinho_itens['id_item']); ?>" type="button" class="btn btn-danger btn-sm ApagarItemCarrinho"><i class="fa-solid fa-trash-can"></i></button></td>
          </tr>
        <?php 
           $TotalCarrinho = $TotalCarrinho + ($carrinho_itens['quantidade']*$carrinho_itens['valor']);
           } while ($carrinho_itens = mysqli_fetch_assoc($q_carrinho_itens)); ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5" class="text-center py-5"><h4 class="m-0">TOTAL: <strong>R$ <?php echo dinheiro($TotalCarrinho); ?></strong></h4></td>
          </tr>
        </tfoot>
      </table>
      <div class="row">
        <div class="col-md-12 mt-4 text-center">
          <button id="FinalizarCarrinho" type="button" class="btn btn-primary btn-lg">Finalizar Compra</button>
       </div>
   </div>
    <?php } else { ?>
      <div class="p-5"><h3 class="m-0 text-center">CARRINHO VAZIO <i class="fa-solid fa-face-frown"></i></h3></div>
    <?php } ?>
 </div>
</div>