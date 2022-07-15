////////// ADICIONAR PRODUTO NO CARRINHO
if($("#ComprarProduto").length>0) {
$('#ComprarProduto').click(function(){
	c = confirm("Deseja realmente comprar?");
	if(c) {	
		var produto = $(this).data('produto');
		var caracteristicas = $('#caracteristicasProduto').val();
    if(caracteristicas.length==0) {
      AlertaSimples('Você deve selecionar uma característica!', 'Tente novamente...', 'error');
      $('#caracteristicasProduto').focus();
      return '';
    }    
	$.post('./ajax/compra.php', { produto: produto, caracteristicas: caracteristicas }, function(data) {
 		result = JSON.parse(data);
		if(result.retorno=='success') {
			AlertaSimples(result.mensagem, result.sub_mensagem, 'success');
			setInterval(function(){ window.location.href = './carrinho'; }, 3500);	 
		} else {
			AlertaSimples(result.mensagem, result.sub_mensagem, 'error');
		}
	}).fail(function() {
   	AlertaSimples('Erro ao comprar!', '', 'error');
	});
	}
});
}

////////// APAGAR PRODUTO DO CARRINHO
if($(".ApagarItemCarrinho").length>0) {
$('.ApagarItemCarrinho').click(function(){
	c = confirm("Deseja realmente apagar?");
	if(c) {	
    $(this).html("<i class='fa-solid fa-rotate fa-spin'></i>");
		var item = $(this).data('item');
	$.post('./ajax/carrinho.php', { acao: 'apagar-item', item: item }, function(data) {
 		result = JSON.parse(data);
		if(result.retorno=='success') {
			AlertaSimples(result.mensagem, result.sub_mensagem, 'success');
			setInterval(function(){ window.location.href = './carrinho'; }, 3500);	 
		} else {
      $(this).html('<i class="fa-solid fa-trash-can"></i>');
			AlertaSimples(result.mensagem, result.sub_mensagem, 'error');
		}
	}).fail(function() {
   	AlertaSimples('Erro ao apagar!', '', 'error');
	});
	}
});
}

////////// FINALIZAR CARRINHO
if($("#FinalizarCarrinho").length>0) {
$('#FinalizarCarrinho').click(function(){
	c = confirm("Deseja realmente finalizar?");
	if(c) {	
    $(this).html("<i class='fa-solid fa-rotate fa-spin'></i>");
	$.post('./ajax/carrinho.php', { acao: 'finalizar-carrinho' }, function(data) {
 		result = JSON.parse(data);
		if(result.retorno=='success') {
			AlertaSimples(result.mensagem, result.sub_mensagem, 'success');
			setInterval(function(){ window.location.href = './'; }, 3500);	 
		} else {
      $(this).html('Finalizar Compra');
			AlertaSimples(result.mensagem, result.sub_mensagem, 'error');
		}
	}).fail(function() {
   	AlertaSimples('Erro ao apagar!', '', 'error');
	});
	}
});
}

////////// FORM CLIENTES ALTERAR
if($("#FormAlterarClientes").length>0) {
$("#FormAlterarClientes").validate({
		rules: { 
			nome:            { required: true },
			data_nascimento: { required: true },
			documento:       { required: true },
			cep:             { required: true },
			endereco:        { required: true },
			numero:          { required: true },
			bairro:          { required: true },
			cidade:          { required: true },
			estado:          { required: true },
			telefone:        { required: true },
			email:           { required: true }
			},
		messages: {
			nome:            { required: 'Você deve preencher o nome' },
			data_nascimento: { required: 'Você deve preencher o data nascimento' },
			documento:       { required: 'Você deve preencher o cpf' },
			cep:             { required: 'Você deve preencher o cep' },
			endereco:        { required: 'Você deve preencher o nndereço' },
			numero:          { required: 'Você deve preencher o número' },
			bairro:          { required: 'Você deve preencher o bairro' },
			cidade:          { required: 'Você deve preencher o cidade' },
			estado:          { required: 'Você deve preencher o estado' },
			telefone:        { required: 'Você deve preencher o telefone' },
			email:           { required: 'Você deve preencher o e-mail' }
		},	
    submitHandler: function(form) {
		$("#BtnAlterar").html("<i class='fa-solid fa-rotate fa-spin'></i>");
        var data = $(form).serialize();
        $.post('./ajax/alterar.php', data, function(data) {
					$("#BtnAlterar").html("Alterar");
          var result = JSON.parse(data);
 					if(result.retorno=='success') {
						AlertaSimples(result.mensagem, result.sub_mensagem, 'success');
            setInterval(function(){ location.reload(); }, 3550);	 
					} else {
						AlertaSimples(result.mensagem, result.sub_mensagem, 'error');						
					}
      });
    }
});
}

//// PEDIDOS ITENS
if($("#PedidosItensListar").length>0) {
$('#PedidosItensListar').DataTable({
  language: {
    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
  },
  'paging': false,
  'info': false,
  'processing': true,
  'serverSide': true,
  'serverMethod': 'POST',
  'createdRow': function(row, data) {
    var id = 'tr-'+data.id_tr;
    $(row).prop('id', id).data('id', id);
  },
  'ajax': {
    'url':'./tabelas/pedidos-itens.php',
    'data': {
      'id': $('#FiltroID').val()
    }
  },
  'columns': [
    { data: 'id_item' },
    { data: 'produto' },
    { data: 'quantidade' },
    { data: 'valor' }
  ],
  columnDefs: [{ "targets": 'no-sort', "orderable": false }, { "targets": 'no-search', "searchable": false }, { "targets": 0, "className": "text-center" }, { "targets": 2, "className": "text-center" }, { "targets": 3, "className": "text-center" }],
});
}

//// PEDIDOS 
if($("#PedidosListar").length>0) {
$('#PedidosListar').DataTable({
  language: {
    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
  },
  'processing': true,
  'serverSide': true,
  'serverMethod': 'POST',
  'createdRow': function(row, data) {
    var id = 'tr-'+data.id;
    $(row).prop('id', id).data('id', id);
  },
  'ajax': {
    'url':'./tabelas/pedidos.php'
  },
  'columns': [
    { data: 'id_pedido' },
    { data: 'valor' },
    { data: 'status' },
    { data: 'funcoes' }
  ],
  columnDefs: [{ "targets": 'no-sort', "orderable": false }, { "targets": 'no-search', "searchable": false }, { "targets": 0, "className": "text-center" }, { "targets": 1, "className": "text-center" }, { "targets": 2, "className": "text-center" }, { "targets": 3, "className": "text-center" }],
});
}

////////// FORM LOGIN	
if($("#FormLogin").length>0) {
$("#FormLogin").validate({
		rules: {
			login: { required: true },
			senha: { required: true }
			},
		messages: {
			login: { required: 'Você deve preencher o login' },
			senha: { required: 'Você deve preencher a senha' }
		},	
    submitHandler: function(form) {
		$("#BtnEntrar").html("<i class='fa-solid fa-rotate fa-spin'></i>");
        var data = $(form).serialize();
        $.post('./ajax/login.php', data, function(data) {
					$("#BtnEntrar").html("Entrar");
          var result = JSON.parse(data);
 					if(result.retorno=='success') {
						AlertaSimples(result.mensagem, result.sub_mensagem, 'success');
            setInterval(function(){ location.reload(); }, 3550);	 
					} else {
						$('#FormLogin #senha').val("");
						$('#FormLogin #senha').focus();
						AlertaSimples(result.mensagem, result.sub_mensagem, 'error');						
					}
      });
    }
});
}
////////// FORM LOGIN