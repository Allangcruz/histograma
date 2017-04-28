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
				gerarIndicador(response.data);
			},
			error: function(response) {
				$("#msg-error").html(response.responseText);
	    		$("#modal-error").modal("show");
			}
		});
	}

	/**
	 * Gera a indicador
	 */
	var gerarIndicador = function(valores) {
		console.log(valores.data.x);
		Highcharts.chart('indicador', {
		    chart: { type: 'area' },
		    title: { text: 'HISTOGRAMA - PROCESSAMENTO DIGITAL DE IMAGEM' },
		    xAxis: {
		        //categories: [253,254,255,251,250,248,246,235,236,249,252,245,244,243,247,237,229,240,239,241,242,226,218,188,170,168,180,192,196,198,201,205,212,224,227,231,214,197,195,203,207,210,217,219,221,228,185,107,60,36,22,31,48,49,51,54,58,63,67,70,77,62,50,47,57,59,64,66,68,69,114,116,120,124,129,134,137,139,167,206,208,211,234,233,238,232,223,109,11,2,34,41,29,23,17,15,12,8,5,3,6,4,16,9,7,32,30,100,101,135,136,178,179,181,184,194,189,154,150,155,166,190,230,103,159,204,191,174,149,144,125,102,99,106,128,130,132,133,119,112,105,45,25,20,18,0,1,10,13,14,37,39,43,65,72,76,121,122,131,138,140,142,145,148,151,171,172,173,175,177,200,216,81,92,98,113,162,182,213,42,127,209,193,161,156,152,146,111,52,46,33,28,26,21,27,56,78,82,85,87,143,157,164,176,199,202,225,220,222,117,44,55,84,88,108,158,183,187,215,35,186,126,19,53,61,71,75,153,115,163,89,74,79,95,73,24,40,123,93,90,118,104,97,86,38,141,94,110,83,147,80,165,96,91,169,160],
		        categories: valores.data.x,
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
		    series: [{
		        	name: 'Tom de cinza',
		        	data: valores.data.y,
		    	}
		    ]
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