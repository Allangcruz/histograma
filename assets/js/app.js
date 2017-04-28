var histograma = (function(){
	/**
	 * Inicializa o modulo
	 */
	var iniciar = function() {
		getValoresHistograma();
	}

	/**
	 * Retorna os calores do histograma da imagem lida.
	 */
	var getValoresHistograma = function() {
		$.ajax({
			type: 'get',
			url: 'backend/Main.php',
			dataType: 'json',
			success: function(response) {
				gerarIndicador(response);
			},
			error: function(response) {
				alert(response.responseText);
			}
		});
	}

	/**
	 * Gera a indicador
	 */
	var gerarIndicador = function(valores) {
		Highcharts.chart('indicador', {
		    chart: { type: 'area' },
		    title: { text: 'HISTOGRAMA - PROCESSAMENTO DIGITAL DE IMAGEM' },
		    xAxis: {
		        categories: ['1750', '1800', '1850', '1900', '1950', '1999', '2050'],
		        tickmarkPlacement: 'on',
		        title: {
		            enabled: false
		        }
		    },
		    yAxis: {
		        title: {
		            text: 'Cores'
		        },
		    },
		    plotOptions: {
		        area: {
		            stacking: 'normal',
		            lineColor: '#666666',
		            lineWidth: 1,
		            marker: {
		                lineWidth: 1,
		                lineColor: '#666666'
		            }
		        }
		    },
		    series: valores.data
		});
	}

	/**
	 * Retorna api publica.
	 */
	return {
		iniciar : iniciar,
		gerarIndicador : gerarIndicador
	}
})();

$(function(){
    histograma.iniciar();
});