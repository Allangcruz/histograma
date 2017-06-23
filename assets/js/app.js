var histograma = (function(){
	/**
	 * Inicializa o modulo
	 */
	var iniciar = function() {
		//getValoresHistograma();
		showDivImage('#original-imagem');
		showDivImage('#filtro-imagem');
	}

	/**
	 * Retorna os calores do histograma da imagem lida.
	 */
	var getValoresHistograma = function() {
		$.ajax({
			type: 'get',
			url: 'backend/Main.php',
			dataType: 'json',
			data: {'acao': 'histograma'},
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
		console.log(valores);
		Highcharts.chart('indicador', {
		    chart: { type: 'area' },
		    title: { text: 'HISTOGRAMA - PROCESSAMENTO DIGITAL DE IMAGEM' },
		    xAxis: {
		        categories: valores.data.x,
		        tickmarkPlacement: 'on',
		        title: { enabled: true, text: 'Quantidade de Preto' }
		    },
		    yAxis: { title: { text: 'Quantidade de Branco' }, },
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
		    series: [{ name: 'Quantidade de Branco', data: valores.data.y, }]
		});
	}

	/**
     * Display the image of load.
     *
     * @param input
     * @param destination
     */
    var readURL = function(input, destination) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(destination).attr('src', e.target.result);
            };
            reader.onloadend = function() {
                showDivImage(destination);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            var img = input.value;
            $(destination).attr('src', img);
            showDivImage(destination);
        }
    }

	/**
     * Display and Hide the element div that contains the image.
     *
     * @param element
     */
    var showDivImage = function(element) {
        var image = $(element);

        image.parent().addClass('hide');
        if (image.attr('src') !== '') {
            image.parent().removeClass('hide');
        }
    }

	/**
	 * Aplica filtro de mascara.
	 */
	var aplicarFiltro = function(form) {
		var url = $(form).attr("action");
        var dados = new FormData($(form)[0]);
		dados.append('acao', 'filtrar');

        $.ajax({
            type: 'post',
            url: url,
            data : dados,
            enctype: 'multipart/form-data',
            dataType: 'json',
            contentType : false,
            processData : false,
            success: function(response) {
				$('#filtro-imagem').attr('src', response.data);
				showDivImage('#filtro-imagem');
				console.log(response);
			},
			error: function(response) {
				$("#msg-error").html(response.responseText);
	    		$("#modal-error").modal("show");
			}
        });
	}

	/**
	 * Retorna api publica.
	 */
	return {
		iniciar : iniciar,
		readURL : readURL,
		aplicarFiltro : aplicarFiltro,
		gerarIndicador : gerarIndicador
	}
})();

$(function(){
    histograma.iniciar();
});