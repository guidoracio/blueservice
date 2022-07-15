<?php 
////////// ITENS
$s_carrinho = "SELECT i.*, p.imagem, ca.nome AS Caracteristica
              FROM carrinho_itens AS i, carrinho AS c, produtos AS p, caracteristicas AS ca
              WHERE 
              i.id_carrinho=c.id_carrinho AND 
              i.id_caracteristica=ca.id_caracteristica AND 
              i.id_produto=p.id_produto AND
              c.codigo='$SESSION_CARRINHO'
              ORDER BY i.nome_produto ASC";
$q_carrinho = mysqli_query($conexao, $s_carrinho) or die('ERRO - ITENS');
$carrinho   = mysqli_fetch_assoc($q_carrinho);
$t_carrinho = mysqli_num_rows($q_carrinho);

////////// CATEGORIAS
$s_categorias = "SELECT * FROM categorias WHERE status='S' ORDER BY nome ASC";
$q_categorias = mysqli_query($conexao, $s_categorias) or die('ERRO - CATEGORIAS');
$categorias   = mysqli_fetch_assoc($q_categorias);
$t_categorias = mysqli_num_rows($q_categorias);
?>
<div class="row align-items-center my-4">
  <div class="col-md-4">
    <div class="logo">
      <a href="<?php echo $dominio; ?>"><img src="<?php echo $componentes; ?>/imagens/icones/apple-touch-icon-120x120.png" class="img-fluid" alt="Loja" /></a>
    </div>
  </div>
  <div class="col-md-4">
    <form id="FormBusca" name="FormBusca" method="GET" action="./busca/" autocomplete="OFF">
    <div class="input-group">
      <input name="txt_busca" type="text" class="form-control" id="txt_busca" placeholder="Buscar produto" required>
      <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
    </div>
    </form>
  </div>
  <div class="col-md-4 text-end">
    <ul class="list-inline">
    <li class="list-inline-item">
    <div class="dropdown">
      <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-cart-shopping"></i> CARRINHHO<br>
      </button>
      <ul class="dropdown-menu p-4" aria-labelledby="dropdownMenuButton1" style="width: 350px;">
        <?php if($t_carrinho==0) { ?>
        <li class="text-center">CARRINHO VAZIO <i class="fa-solid fa-face-frown"></i></li>
        <?php } else { 
          $TotalCarrinho = 0;
        do { ?>
        <li class="border-bottom mb-3">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <img src="<?php echo $dominio; ?>/uploads/produtos/<?php echo $carrinho['imagem']; ?>" alt="<?php echo $carrinho['nome_produto']; ?>" width="65">
            </div>
            <div class="flex-grow-1 ms-3">
              <p class="mb-1"><?php echo $carrinho['nome_produto']; ?><br><small><strong><?php echo $carrinho['Caracteristica'];?></strong></small></p>
              <p class="mb-1">Qtde.: <?php echo $carrinho['quantidade']; ?></p>
              <p class="mb-">Valor: R$ <?php echo dinheiro($carrinho['valor']); ?></p>
            </div>
          </div>
        </li>
        <?php 
           $TotalCarrinho = $TotalCarrinho + ($carrinho['quantidade']*$carrinho['valor']);
           } while ($carrinho = mysqli_fetch_assoc($q_carrinho)); ?>
        <li class="text-center">Total: <strong>R$ <?php echo dinheiro($TotalCarrinho); ?></strong></li>
        <li><hr class="dropdown-divider my-3"></li>
        <li class="text-center"><a href="./carrinho" class="btn btn-success">Ver carrinho</a></li>
        <?php } ?>
      </ul>
    </div>
    </li>
    <li class="list-inline-item">
    <?php if($t_logado>0) { ?>
    <div class="dropdown">
      <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="<?php echo $componentes; ?>/imagens/user.jpg" class="img-fluid rounded-circle" width="45" alt="Usuario" />
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="./meus-dados">Meus Dados</a></li>
        <li><a class="dropdown-item" href="./meus-pedidos">Meus Pedidos</a></li>
        <li><a class="dropdown-item" href="logout.php">Sair</a></li>
      </ul>
    </div>
    <?php } else { ?>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalLogin">Login</button>
    <?php } ?>
    </li>
    </ul>
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#Menu" aria-controls="Menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="Menu">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-uppercase <?php if($urlAcesso=='home') echo ' active'; ?>" aria-current="page" href="<?php echo $dominio; ?>">Home</a>
        </li>
        <?php do { ?>
        <li class="nav-item">
          <a class="nav-link text-uppercase <?php if($urlAcesso=='categorias' and $Complemento1==$categorias['id_categoria']) echo ' active'; ?>" href="./categorias/<?php echo $categorias['id_categoria']; ?>/<?php echo tiraAcentos($categorias['nome']); ?>"><?php echo $categorias['nome']; ?></a>
        </li>
        <?php } while ($categorias = mysqli_fetch_assoc($q_categorias)); ?>
      </ul>
    </div>
  </div>
</nav>
<?php if($t_logado==0) { ?>
<div class="modal fade" id="ModalLogin" tabindex="-1" aria-labelledby="ModalLoginLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLoginLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="FormLogin" name="FormLogin" method="POST" autocomplete="OFF">
      <input name="acao" type="hidden" id="acao" value="login">
      <div class="modal-body">
        <div class="mb-3">
          <label for="login" class="form-label">CPF</label>
          <input name="login" type="text" class="form-control cpf" id="login">
        </div>
        <div class="mb-3">
          <label for="senha" class="form-label">Senha</label>
          <input name="senha" type="password" class="form-control" id="senha">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button id="BtnEntrar" type="submit" class="btn btn-primary">Entrar</button>
      </div>
      </form>
   </div>
  </div>
</div>
<?php } ?>