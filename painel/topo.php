<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
  <div class="container">
    <a class="navbar-brand" href="<?php echo $painel; ?>"><i class="fa-solid fa-lock"></i> PAINEL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#Menu" aria-controls="Menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="Menu">
      <ul class="navbar-nav ms-auto">
			<li class="nav-item"><a href="./produtos" class="nav-link<?php if (in_array($urlAcesso, array('produtos','produtos-cadastrar','produtos-alterar','produtos-categorias'))) echo ' active'; ?>" aria-current="page">Produtos</a></li>
			<li class="nav-item"><a href="./categorias" class="nav-link<?php if (in_array($urlAcesso, array('categorias','categorias-cadastrar','categorias-alterar'))) echo ' active'; ?>">Categorias</a></li>
			<li class="nav-item"><a href="./caracteristicas" class="nav-link<?php if (in_array($urlAcesso, array('caracteristicas','caracteristicas-cadastrar','caracteristicas-alterar'))) echo ' active'; ?>">Características</a></li>
			<li class="nav-item"><a href="./clientes" class="nav-link<?php if (in_array($urlAcesso, array('clientes','clientes-cadastrar','clientes-alterar','clientes-pedidos'))) echo ' active'; ?>">Clientes</a></li>
			<li class="nav-item"><a href="./pedidos" class="nav-link<?php if (in_array($urlAcesso, array('pedidos','pedidos-alterar'))) echo ' active'; ?>">Pedidos</a></li>
			<li class="nav-item"><a href="./usuarios" class="nav-link<?php if (in_array($urlAcesso, array('usuarios','usuarios-cadastrar','usuarios-alterar'))) echo ' active'; ?>">Usuários</a></li>
			<li class="nav-item"><a href="logout.php" class="nav-link">Sair</a></li>
      </ul>
    </div>
  </div>
</nav>