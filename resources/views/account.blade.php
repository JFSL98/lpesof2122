<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
      <!--
    <h1>Nota:</h1>
    <h2>O que faz esta página (account)?</h2>
    <p>Página onde poderá selecionar se quer fazer Login ou Registar, mas reencaminha para / se já estiver logged in.</p>
      -->
    <div class="container-lg d-flex justify-content-md-center align-items-center vh-100">
        <div class="row">
            <div class="col">
                <!-- logotipo UFP -->
                <p>logo</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Bem-vindo!</h3>
                <a class="btn btn-primary" href="/login" role="button">Login</a>
                <a class="btn btn-primary" href="/register" role="button">Registar</a>
            </div>
        </div>
    </div>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    @include('includes.footer');
  </body>
</html>
