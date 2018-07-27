$(document).ready(function(){
	$("#ValorVenda").focusout(function(){
		var valorVenda = $(this).val();
		var valorCompra = $("#ValorPago").val();
		var resultado = valorVenda - valorCompra;
		$("#TotalGanho").val(resultado);
	});
})