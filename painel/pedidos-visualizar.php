<?php 
$id_pedido = encrypt_decrypt('decrypt', $Complemento1);
  
////////// PEDIDOS
$s_pedidos = "SELECT * FROM pedidos WHERE id_pedido='$id_pedido' AND apagado='N'";
$q_pedidos = mysqli_query($conexao, $s_pedidos) or die('ERRO - PEDIDOS');
$pedidos   = mysqli_fetch_assoc($q_pedidos);
$t_pedidos = mysqli_num_rows($q_pedidos);
?>
<div class="pt-2 pb-2 mb-4 border-bottom">
<h1 class="h4">Pedidos - Visualizar | <?php echo $pedidos['cliente']; ?></h1>
</div>
<div class="row mb-3">
  <div class="col-md-4">
    <form id="FormStatusPedido" name="FormStatusPedido" method="POST" autocomplete="OFF">
    <input name="acao" type="hidden" id="acao" value="pedido-status">
    <input name="id" type="hidden" id="id" value="<?php echo $Complemento1; ?>">
    <label for="status_pedido" class="form-label">Status do Pedido</label>
    <div class="input-group">
      <select name="status_pedido" class="form-select" id="status_pedido">
        <option value="INSERIDO"<?php if($pedidos['status_pedido']=='INSERIDO') echo ' selected'; ?>>INSERIDO</option>
        <option value="ANDAMENTO"<?php if($pedidos['status_pedido']=='ANDAMENTO') echo ' selected'; ?>>ANDAMENTO</option>
        <option value="CONCLUIDO"<?php if($pedidos['status_pedido']=='CONCLUIDO') echo ' selected'; ?>>CONCLUIDO</option>
        <option value="CANCELADO"<?php if($pedidos['status_pedido']=='CANCELADO') echo ' selected'; ?>>CANCELADO</option>
      </select>
      <button class="btn btn-primary" type="submit" id="BtnAlterar">Alterar</button>
    </div>
    </form>
 </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="mb-3">
      <label for="nome" class="form-label">Cliente</label>
      <input name="nome" class="form-control" id="nome" maxlength="100" value="<?php echo $pedidos['cliente']; ?>" disabled>
    </div>
  </div>
  <div class="col-md-2">
    <label for="cep" class="form-label">CEP</label>
    <div class="mb-3">
      <input name="cep" type="tel" class="form-control cep" id="cep" value="<?php echo $pedidos['cep']; ?>" disabled>
    </div>
  </div>
  <div class="col-md-8">
    <div class="mb-3">
      <label for="endereco" class="form-label">Endereço</label>
      <input name="endereco" class="form-control" id="endereco" maxlength="100" value="<?php echo $pedidos['endereco']; ?>" disabled>
    </div>
  </div>
  <div class="col-md-2">
    <div class="mb-3">
      <label for="numero" class="form-label">Número</label>
      <input name="numero" class="form-control" id="numero" maxlength="10" value="<?php echo $pedidos['numero']; ?>" disabled>
    </div>
  </div>
  <div class="col-md-3">
    <div class="mb-3">
      <label for="bairro" class="form-label">Bairro</label>
      <input name="bairro" class="form-control" id="bairro" maxlength="100" value="<?php echo $pedidos['bairro']; ?>" disabled>
    </div>
  </div>
  <div class="col-md-3">
    <div class="mb-3">
      <label for="complemento" class="form-label">Complemento</label>
      <input name="complemento" class="form-control" id="complemento" maxlength="100" value="<?php echo $pedidos['complemento']; ?>" disabled>
    </div>
  </div>
  <div class="col-md-3">
    <div class="mb-3">
      <label for="cidade" class="form-label">Cidade</label>
      <input name="cidade" class="form-control" id="cidade" maxlength="50" value="<?php echo $pedidos['cidade']; ?>" disabled>
    </div>
  </div>
  <div class="col-md-3">
    <div class="mb-3">
      <label for="estado" class="form-label">Estado</label>
      <input name="estado" class="form-control" id="estado" maxlength="2" value="<?php echo $pedidos['estado']; ?>" disabled>
    </div>
  </div>
</div>
<hr class="my-5" />
<div class="pt-2 pb-2 mb-4 border-bottom">
<h1 class="h4">Itens do Pedido</h1>
</div>
<input name="FiltroID" type="hidden" id="FiltroID" value="<?php echo $Complemento1; ?>">
<table id="PedidosItensListar" class="table table-striped py-4 border-top border-bottom">
  <thead>
    <tr>
      <th scope="col" width="80" class="text-center">ID</th>
      <th scope="col">Produto</th>
      <th scope="col" width="200" class="text-center">Quantidade</th>
      <th scope="col" width="200" class="text-center">Valor</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<hr class="my-5" />

<h2 class="text-center m-0">Valor Pedido: R$ <?php echo dinheiro($pedidos['valor_pedido']); ?></h2>