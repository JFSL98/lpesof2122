@extends('layout.master')
  <body>
      <!--
    <h1>Nota:</h1>
    <h2>O que faz esta página (account)?</h2>
    <p>Página onde poderá selecionar se quer fazer Login ou Registar, mas reencaminha para / se já estiver logged in.</p>
      -->
    <div class="container-lg d-flex justify-content-md-center align-items-center vh-100 text-center">
        <div class="row">
            <div class="col-6">
                <!-- logotipo UFP -->
                <a href="/"><img src="{{ asset('images/UFP-Logo.png') }}" alt="logotipo UFP" class="img-fluid"></a>
            </div>
            <div class="col">
                        <h5 class="card-title">Bem-vindo!</h5>
                        <a class="btn" href="/login" role="button">Login</a>
                        <a class="btn" href="/register" role="button">Registar</a>
            </div>
        </div>
    </div>
      

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    @include('includes.footer')
  </body>
</html>
