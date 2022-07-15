////////// APAGAR ARQUIVO
function excluirArquivo(id,acao) {
	c = confirm("Deseja realmente apagar?");
	if(c) {
	document.getElementById('btApagar-'+id).innerHTML='<i class="fa-solid fa-spinner fa-spin"></i>';
	$.post("./ajax/funcoes.php?acao="+acao, { id: id },
	function(data) {
	if(data==1) {
	$("#divArquivo").fadeOut();
	document.getElementById('divNovoArquivo').innerHTML='<label for="arquivo" class="form-label">Imagem</label><input name="arquivo" type="file" class="form-control" id="arquivo" accept="image/gif, image/jpg, image/jpeg, image/png">';
	$("#divNovoArquivo").fadeIn();
	} else {
	AlertaSimples('Desculpe, não foi possível excluir!', '', 'warning');
	var newURL = window.location.protocol +"//"+ window.location.host + window.location.pathname;
	window.location = newURL;
	}});
}}

////////// STATUS REGISTRO
$('table tbody').on('click', '.statusRegistro', function() {
var id   = $(this).data('id');
var acao = $(this).data('acao');
$(this).html('<i class="fa-solid fa-spinner fa-spin"></i>');
$.post("./ajax/funcoes.php?acao="+acao, { id: id },
function(data) {
	if(data=='S' || data=='N') {
	 $('#btStatus-'+id).removeClass('btn-danger btn-success');
	 if(data=='N') {
	   $('#btStatus-'+id).addClass('btn btn-sm btn-danger');
	   $('#btStatus-'+id).html('inativo');
	 }
	 if(data=='S') {
	   $('#btStatus-'+id).addClass('btn btn-sm btn-success');
	   $('#btStatus-'+id).html('ativo');
	 }
	 AlertaSimples('Alterado com sucesso!', '', 'success');
  } else {
	 AlertaSimples('Desculpe, não foi possível alterar!', '', 'warning');
	 var newURL = window.location.protocol +"//"+ window.location.host + window.location.pathname;
	 window.location = newURL;
  }
});
});

////////// APAGAR REGISTRO
$('table tbody').on('click', '.excluirRegistro', function() {
c = confirm("Deseja realmente apagar?");
if(c) {
var id   = $(this).data('id');
var acao = $(this).data('acao');
$(this).html('<i class="fa-solid fa-spinner fa-spin"></i>');
$.post("./ajax/funcoes.php?acao="+acao, { id: id },
function(data) {
	if(data==1) {
    AlertaSimples('Apagado com sucesso!', '', 'success');
	  $("#tr-"+id).fadeOut();
  } else {
	  AlertaSimples('Desculpe, não foi possível alterar!', '', 'warning');
	  var newURL = window.location.protocol +"//"+ window.location.host + window.location.pathname;
	  window.location = newURL;
  }
});
}
});

////////// TABELAS
$(document).ready(function() {
//// CATEGORIAS NO PRODUTOS
if($("#ProdutosCategoriasListar").length>0) {
$('#ProdutosCategoriasListar').DataTable({
  language: {
    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
  },
  'processing': true,
  'serverSide': true,
  'serverMethod': 'POST',
  'createdRow': function(row, data) {
    var id = 'tr-'+data.id_tr;
    $(row).prop('id', id).data('id', id);
  },
  'ajax': {
    'url':'./tabelas/produtos-categorias.php',
    'data': {
      'id': $("#FiltroID").val()
    }
  },
  'columns': [
    { data: 'id' },
    { data: 'categoria' },
    { data: 'funcoes' }
  ],
  columnDefs: [{ "targets": 'no-sort', "orderable": false }, { "targets": 'no-search', "searchable": false }, { "targets": 0, "className": "text-center" }, { "targets": 2, "className": "text-center" }],
});
}
  
//// PRODUTOS
if($("#ProdutosListar").length>0) {
$('#ProdutosListar').DataTable({
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
    'url':'./tabelas/produtos.php'
  },
  'columns': [
    { data: 'id_produto' },
    { data: 'nome' },
    { data: 'status' },
    { data: 'funcoes' }
  ],
  columnDefs: [{ "targets": 'no-sort', "orderable": false }, { "targets": 'no-search', "searchable": false }, { "targets": 0, "className": "text-center" }, { "targets": 2, "className": "text-center" }, { "targets": 3, "className": "text-center" }],
});
}
  
//// CATEGORIAS
if($("#CategoriasListar").length>0) {
$('#CategoriasListar').DataTable({
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
    'url':'./tabelas/categorias.php'
  },
  'columns': [
    { data: 'id_categoria' },
    { data: 'nome' },
    { data: 'status' },
    { data: 'funcoes' }
  ],
  columnDefs: [{ "targets": 'no-sort', "orderable": false }, { "targets": 'no-search', "searchable": false }, { "targets": 0, "className": "text-center" }, { "targets": 2, "className": "text-center" }, { "targets": 3, "className": "text-center" }],
});
}
  
//// CARACTERÍSTICAS
if($("#CaracteristicasListar").length>0) {
$('#CaracteristicasListar').DataTable({
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
    'url':'./tabelas/caracteristicas.php'
  },
  'columns': [
    { data: 'id_caracteristica' },
    { data: 'nome' },
    { data: 'status' },
    { data: 'funcoes' }
  ],
  columnDefs: [{ "targets": 'no-sort', "orderable": false }, { "targets": 'no-search', "searchable": false }, { "targets": 0, "className": "text-center" }, { "targets": 2, "className": "text-center" }, { "targets": 3, "className": "text-center" }],
});
}
  
//// CLIENTES
if($("#ClientesListar").length>0) {
$('#ClientesListar').DataTable({
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
    'url':'./tabelas/clientes.php'
  },
  'columns': [
    { data: 'id_cliente' },
    { data: 'nome' },
    { data: 'status' },
    { data: 'funcoes' }
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
    { data: 'codigo' },
    { data: 'cliente' },
    { data: 'valor' },
    { data: 'status' },
    { data: 'funcoes' }
  ],
  columnDefs: [{ "targets": 'no-sort', "orderable": false }, { "targets": 'no-search', "searchable": false }, { "targets": 0, "className": "text-center" }, { "targets": 3, "className": "text-center" }, { "targets": 4, "className": "text-center" }, { "targets": 5, "className": "text-center" }],
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
  
//// USUARIOS
if($("#UsuariosListar").length>0) {
$('#UsuariosListar').DataTable({
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
    'url':'./tabelas/usuarios.php'
  },
  'columns': [
    { data: 'id_usuario' },
    { data: 'nome' },
    { data: 'status' },
    { data: 'funcoes' }
  ],
  columnDefs: [{ "targets": 'no-sort', "orderable": false }, { "targets": 'no-search', "searchable": false }, { "targets": 0, "className": "text-center" }, { "targets": 2, "className": "text-center" }, { "targets": 3, "className": "text-center" }],
});
}
  
});
////////// TABELAS

////////// FORM PRODUTOS CADASTRAR	
if($("#FormCadastraProduto").length>0) {
$("#FormCadastraProduto").validate({
		rules: { 
      id_categoria:    { required: true },
      caracteristicas: { required: true },
			nome:            { required: true },
			valor:           { required: true },
			arquivo:         { required: true, extension: 'jpg|jpeg|png|gif' },
			descricao:       { required: true }
			},
		messages: {
      id_categoria:    { required: 'Você deve selecionar a categoria' },
      caracteristicas: { required: 'Você deve selecionar a característica' },
			nome:            { required: 'Você deve preencher o nome' },
			valor:           { required: 'Você deve preencher o valor' },
			arquivo:         { required: 'Você deve selecionar a imagem', extension: 'Formatos permitidos (jpg, jpeg, png, gif)' },
			descricao:       { required: 'Você deve preencher a descricao' },
		},	
    submitHandler: function(form) {
		$("#BtnCadastrar").html("<i class='fa-solid fa-rotate fa-spin'></i>");
    var data = new FormData($("#FormCadastraProduto")[0]);
    $.ajax({
      'url': "./ajax/cadastrar.php",
      'method': "POST",
      'timeout': 0,
      'processData': false,
      'mimeType': "multipart/form-data",
      'contentType': false,
      'data': data
    }).done(function (response) {
      $("#BtnCadastrar").html("Cadastrar");
        var result = JSON.parse(response);
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

////////// FORM CATEGORIA CADASTRAR
if($("#FormCadastraCategoria").length>0) {
$("#FormCadastraCategoria").validate({
		rules: { 
			nome: { required: true },
			},
		messages: {
			nome: { required: 'Você deve preencher o nome' }
		},	
    submitHandler: function(form) {
		$("#BtnCadastrar").html("<i class='fa-solid fa-rotate fa-spin'></i>");
        var data = $(form).serialize();
        $.post('./ajax/cadastrar.php', data, function(data) {
					$("#BtnCadastrar").html("Cadastrar");
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

////////// FORM CATEGORIA CADASTRAR
if($("#FormCadastraCaracteristica").length>0) {
$("#FormCadastraCaracteristica").validate({
		rules: { 
			nome: { required: true },
			},
		messages: {
			nome: { required: 'Você deve preencher o nome' }
		},	
    submitHandler: function(form) {
		$("#BtnCadastrar").html("<i class='fa-solid fa-rotate fa-spin'></i>");
        var data = $(form).serialize();
        $.post('./ajax/cadastrar.php', data, function(data) {
					$("#BtnCadastrar").html("Cadastrar");
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

////////// FORM CATEGORIA CADASTRAR
if($("#FormCadastraUsuario").length>0) {
$("#FormCadastraUsuario").validate({
		rules: { 
			nome:  { required: true },
			login: { required: true },
			senha: { required: true }
			},
		messages: {
			nome:  { required: 'Você deve preencher o nome' },
			login: { required: 'Você deve preencher o login' },
			senha: { required: 'Você deve preencher a senha' }
		},	
    submitHandler: function(form) {
		$("#BtnCadastrar").html("<i class='fa-solid fa-rotate fa-spin'></i>");
        var data = $(form).serialize();
        $.post('./ajax/cadastrar.php', data, function(data) {
					$("#BtnCadastrar").html("Cadastrar");
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

////////// FORM CLIENTES CADASTRAR
if($("#FormCadastraClientes").length>0) {
$("#FormCadastraClientes").validate({
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
			email:           { required: true },
			senha:           { required: true }
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
			email:           { required: 'Você deve preencher o e-mail' },
			senha:           { required: 'Você deve preencher a senha' }
		},	
    submitHandler: function(form) {
		$("#BtnCadastrar").html("<i class='fa-solid fa-rotate fa-spin'></i>");
        var data = $(form).serialize();
        $.post('./ajax/cadastrar.php', data, function(data) {
					$("#BtnCadastrar").html("Cadastrar");
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

////////// FORM PRODUTOS CADASTRAR	
if($("#FormCadastrarCategoriaProduto").length>0) {
$("#FormCadastrarCategoriaProduto").validate({
		rules: { 
      id_categoria:    { required: true }
			},
		messages: {
      id_categoria:    { required: 'Você deve selecionar a categoria' }
		},	
    submitHandler: function(form) {
		$("#BtnCadastrar").html("<i class='fa-solid fa-rotate fa-spin'></i>");
        var data = $(form).serialize();
        $.post('./ajax/cadastrar.php', data, function(data) {
					$("#BtnCadastrar").html("Cadastrar");
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

////////// FORM PRODUTOS ALTERAR	
if($("#FormAlterarProduto").length>0) {
$("#FormAlterarProduto").validate({
		rules: { 
      caracteristicas: { required: true },
			nome:            { required: true },
			valor:           { required: true },
			descricao:       { required: true }
			},
		messages: {
      caracteristicas: { required: 'Você deve selecionar a característica' },
			nome:            { required: 'Você deve preencher o nome' },
			valor:           { required: 'Você deve preencher o valor' },
			descricao:       { required: 'Você deve preencher a descricao' },
		},	
    submitHandler: function(form) {
		$("#BtnAlterar").html("<i class='fa-solid fa-rotate fa-spin'></i>");
    var data = new FormData($("#FormAlterarProduto")[0]);
    $.ajax({
      'url': "./ajax/alterar.php",
      'method': "POST",
      'timeout': 0,
      'processData': false,
      'mimeType': "multipart/form-data",
      'contentType': false,
      'data': data
    }).done(function (response) {
      console.log(response);
      $("#BtnAlterar").html("Alterar");
        var result = JSON.parse(response);
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

////////// FORM CATEGORIA ALTERAR
if($("#FormAlterarCategoria").length>0) {
$("#FormAlterarCategoria").validate({
		rules: { 
			nome: { required: true },
			},
		messages: {
			nome: { required: 'Você deve preencher o nome' }
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

////////// FORM CATEGORIA ALTERAR
if($("#FormAlterarCaracteristica").length>0) {
$("#FormAlterarCaracteristica").validate({
		rules: { 
			nome: { required: true },
			},
		messages: {
			nome: { required: 'Você deve preencher o nome' }
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

////////// FORM CATEGORIA ALTERAR
if($("#FormAlterarUsuario").length>0) {
$("#FormAlterarUsuario").validate({
		rules: { 
			nome:  { required: true },
			login: { required: true }
			},
		messages: {
			nome:  { required: 'Você deve preencher o nome' },
			login: { required: 'Você deve preencher o login' }
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

////////// FORM CATEGORIA ALTERAR
if($("#FormStatusPedido").length>0) {
$("#FormStatusPedido").validate({
		rules: { 
			status_pedido: { required: true },
			},
		messages: {
			status_pedido: { required: 'Você deve selecionar o status' }
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