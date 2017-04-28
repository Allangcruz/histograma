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
    <script src="assets/components/highcharts/highcharts.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>