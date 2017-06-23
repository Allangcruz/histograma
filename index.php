<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Histograma - Processamento de Imagem Digital</title>

    <!-- Bootstrap -->
    <link href="assets/components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <main class="container">
      <section class="row">
        <div class="col-md-12">
          <h1>APLICAÇÃO DE FILTROS DE MEDIA E MEDIANA</h1>
          <form class="form-horizontal" id="formFiltro" name="formFiltro" action="backend/Main.php">

            <legend>IMAGEM</legend>
            <div class="row col-md-12 form-group">
              <input type="file" id="imagem" name="imagem" onchange="histograma.readURL(this, '#original-imagem');" accept="image/x-png, image/gif, image/jpeg, image/jpg" >
            </div>

            <legend>FILTROS</legend>
            <label class="checkbox-inline">
              <input type="checkbox" id="media" value="1" name="filtros[]"> MÉDIA
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" id="mediana" value="2" name="filtros[]"> MEDIANA
            </label>
            <br><br>

            <div class="row col-md-6">
              <legend>MASCARAS MEDIA</legend>
              <label class="radio-inline">
                <input type="radio" name="mascara[media]" value="3"> 3x3
              </label>
              <label class="radio-inline">
                <input type="radio" name="mascara[media]" value="5"> 5x5
              </label>
              <label class="radio-inline">
                <input type="radio" name="mascara[media]" value="9"> 9x9
              </label>
            </div>

            <div class="row col-md-6">
              <legend>MASCARAS MEDIANA</legend>
              <label class="radio-inline">
                <input type="radio" name="mascara[mediana]" value="3"> 3x3
              </label>
              <label class="radio-inline">
                <input type="radio" name="mascara[mediana]" value="5"> 5x5
              </label>
              <label class="radio-inline">
                <input type="radio" name="mascara[mediana]" value="9"> 9x9
              </label>
            </div>

            <div class="row col-md-12">
              <br><br>
              <button type="button" class="btn btn-lg btn-primary" onclick="histograma.aplicarFiltro(formFiltro);">PROCESSAR</button>
            </div>
          </form>
        </div>
      </section>

      <section class="row">
        <div class="col-md-12">
          <h2>RESULTADOS</h2>
          <div class="row">
            <div class="col-md-6">
              <h4>Imagem Original</h4>
              <img src="" alt="Imagem Original" class="img-thumbnail" id="original-imagem">
            </div>

            <div class="col-md-6">
              <h4>Imagem com Filtro</h4>
              <img src="" alt="Imagem Com Filtro" class="img-thumbnail" id="filtro-imagem">
            </div>
          </div>
        </div>
      </section>

      <hr>
      <section class="row">
        <div class="col-md-12">
          <br><br>
          <div id="indicador" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
      </section>
    </main>

    <div class="modal fade" id="modal-error">
      <div class="modal-dialog" styel="width: 90%;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Error:</h4>
          </div>
          <div class="modal-body row">
            <div class="col-lg-12">
              <div id="msg-error"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/components/jquery/dist/jquery.min.js"></script>
    <script src="assets/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/components/highcharts/highcharts.js?v=<?php echo time(); ?>>"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>