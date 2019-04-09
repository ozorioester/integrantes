<?php
	session_start();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ester Ozorio">
    <meta name="author" content="">

    <title>Integrantes do Sistema de Gerenciamento da Frota de Blindados</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">

    <div class="container">
      <form class="form-signin" action="controller/valida.php" method="post">
          <h3>Integrantes do Sistema de Gerenciamento da Frota de Blindados</h3>

      <img class="mb-4" src="images/5rm.gif" alt="" width="72" height="100">
      <h4 class="form-signin-heading">LOGIN</h4>
      <label for="inputEmail" class="sr-only">Usuário</label>
      <input type="text" name="login" id="inputEmail" class="form-control" placeholder="Usuário" required autofocus>
      <label for="inputPassword" class="sr-only">Senha</label>
      <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox"  value="remember-me"> Manter logado
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
      <p class="mt-5 mb-3 text-muted">&copy; STI - 5ª RM - 2019</p>

    </form>
		<p class="text-center text-danger">
			<?php if(isset($_SESSION['loginErro'])){
				echo $_SESSION['loginErro'];
				unset($_SESSION['loginErro']);
			}?>
		</p>
		<p class="text-center text-success">
			<?php
			if(isset($_SESSION['logindeslogado'])){
				echo $_SESSION['logindeslogado'];
				unset($_SESSION['logindeslogado']);
			}
			?>
		</p>
	</div> <!--container-->
  </body>
</html>
