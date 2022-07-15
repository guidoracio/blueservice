//// BOTAO DE ENVIO
function ProcesarForm(botao)
{
document.getElementById(botao).innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Aguarde';
document.getElementById(botao).disabled = true;	
}

//// ALERTA SIMPLES SWEETALERT
function AlertaSimples(titulo, sub_titulo, tipo) {
	Swal.fire({   
		title: titulo,
		text: sub_titulo,
		icon: tipo,
		timer: 3500,
		showConfirmButton: false
	});
}

//// ALERTA SIMPLES SWEETALERT COM BT
function AlertaSimplesBT(titulo, sub_titulo, tipo) {
	Swal.fire({   
		title: titulo,
		text: sub_titulo,
		icon: tipo,
		showConfirmButton: true
	});
}

//// BUSCA ENDEREÇO POR CEP
function getEndereco(campos) {
  var cep_code = $("#cep" + campos).val();
  cep_code = cep_code.replace(/[^\d]+/g, '');
  if (cep_code.length < 8) {
    return false;
  }
  document.getElementById('LoaderCep' + campos).innerHTML = 'CEP <i class="fa-solid fa-spinner fa-pulse"></i>';
  $.get("https://viacep.com.br/ws/" + cep_code + "/json/",
    function(result) {
      if (result.erro == true) {
        document.getElementById('LoaderCep' + campos).innerHTML = 'CEP';
        alert("Endereço não encontrado");
        return;
      }
      $("input#endereco" + campos).val(result.logradouro);
      $("input#bairro" + campos).val(result.bairro);
      $("input#cidade" + campos).val(result.localidade);
      $("input#estado" + campos).val(result.uf);

      document.getElementById('LoaderCep' + campos).innerHTML = 'CEP';
      $('#numero' + campos).focus();
    });
}

$(document).ready(function() {
  //// MAX LENGTH DOS CAMPOS
  $('[data-plugin-maxlength]').maxlength({
    alwaysShow: true,
    threshold: 10,
    warningClass: "badge text-bg-success",
    limitReachedClass: "badge text-bg-danger"
  });
  
  //// MASCARAS
  $(function() {
  var TELMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
  },
    TELOptions = {
	 onKeyPress: function(val, e, field, options) {
		  field.mask(TELMaskBehavior.apply({}, arguments), options);
	 }
  };

    $('.telefone').mask(TELMaskBehavior, TELOptions);
  });
	
  $('.data').mask('99/99/9999');
  $('.cep').mask('99999-999');
  $('.rg').mask('99.999.999-*');
  $('.cpf').mask('999.999.999-99');
  $('.dinheiro').maskMoney({allowNegative: true, selectAllOnFocus: true, thousands:'', decimal:'.'});
});