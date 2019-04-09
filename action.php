<?php
//Database connection by using PHP PDO
$server = "127.0.0.1";
$user = "root";
$senha = "brasil";
$banco = "integrantes";
$dsn = "mysql:host=$server  ;dbname=$banco;charset=utf8";
$connection = new \PDO($dsn, $user, $senha);


//$username = 'root';
//$password = 'brasil';
//$port = '8888';
//$connection = new PDO( 'mysql:host=127.0.0.1;port=8888;dbname=integrantes', $username, $password ); // Create Object of PDO class by connecting to Mysql database

if(isset($_POST["action"])) //Check value of $_POST["action"] variable value is set to not
{
 //For Load All Data
 if($_POST["action"] == "Load")
 {
  $statement = $connection->prepare("SELECT * FROM militares ORDER BY id DESC");
  $statement->execute();
  $result = $statement->fetchAll();
  $output = '';
  $output .= '
   <table class="table table-bordered">
    <tr>
     <th width="15%">OM</th>
     <th width="5%">Atividade</th>
     <th width="5%">Posto/Graduação</th>
     <th width="15%">Nome</th>
     <th width="15%">Nome de Guerra</th>
     <th width="15%">Telefone</th>
     <th width="15%">Celular</th>
     <th width="15%">E-mail</th>
     <th width="5%">Atualizar</th>
     <th width="5%">Deletar</th>
    </tr>
  ';
  if($statement->rowCount() > 0)
  {
   foreach($result as $row)
   {
    $output .= '
    <tr>
     <td>'.$row["om"].'</td>
     <td>'.$row["atv"].'</td>
     <td>'.$row["post_grad"].'</td>
     <td>'.$row["nome"].'</td>
     <td>'.$row["nome_guerra"].'</td>
     <td>'.$row["tel"].'</td>
     <td>'.$row["cel"].'</td>
     <td>'.$row["email"].'</td>
     <td><button type="button" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Atualizar</button></td>
     <td><button type="button" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Deletar</button></td>
    </tr>
    ';
   }
  }
  else
  {
   $output .= '
    <tr>
     <td align="center">Dados não encontrados</td>
    </tr>
   ';
  }
  $output .= '</table>';
  echo $output;
 }

 //This code for Create new Records
 if($_POST["action"] == "Criar")
 {
  $statement = $connection->prepare("
   INSERT INTO militares (om, atv, post_grad, nome, nome_guerra, tel, cel, email)
   VALUES (:om, :atv, :post_grad, :nome, :nome_guerra, :tel, :cel, :email)
  ");
  $result = $statement->execute(
   array(
    ':om' => $_POST["om"],
    ':atv' => $_POST["atv"],
    ':post_grad' => $_POST["post_grad"],
    ':nome' => $_POST["nome"],
    ':nome_guerra' => $_POST["nome_guerra"],
    ':tel' => $_POST["tel"],
    ':cel' => $_POST["cel"],
    ':email' => $_POST["email"]
   )
  );
  if(!empty($result))
  {
   echo 'Dados Inseridos';
  }
 }

 //This Code is for fetch single customer data for display on Modal
 if($_POST["action"] == "Select")
 {
  $output = array();
  $statement = $connection->prepare(
   "SELECT * FROM militares
   WHERE id = '".$_POST["id"]."'
   LIMIT 1"
  );
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
   $output["om"] = $row["om"];
   $output["atv"] = $row["atv"];
   $output["post_grad"] = $row["post_grad"];
   $output["nome"] = $row["nome"];
   $output["nome_guerra"] = $row["nome_guerra"];
   $output["tel"] = $row["tel"];
   $output["cel"] = $row["cel"];
   $output["email"] = $row["email"];
  }
  echo json_encode($output);
 }

 if($_POST["action"] == "Update")
 {
  $statement = $connection->prepare(
   "UPDATE militares
   SET om = :om, atv = :atv, post_grad = :post_grad, nome = :nome, nome_guerra = :nome_guerra, tel = :tel, cel = :cel, email = :email
   WHERE id = :id
   "
  );
  $result = $statement->execute(
   array(
    ':om' => $_POST["om"],
    ':atv' => $_POST["atv"],
    ':post_grad' => $_POST["post_grad"],
    ':nome' => $_POST["nome"],
    ':nome_guerra' => $_POST["nome_guerra"],
    ':tel' => $_POST["tel"],
    ':cel' => $_POST["cel"],
    ':email' => $_POST["email"],
    ':id'   => $_POST["id"]
   )
  );
  if(!empty($result))
  {
   echo 'Dados atualizados';
  }
 }

 if($_POST["action"] == "Delete")
 {
  $statement = $connection->prepare(
   "DELETE FROM militares WHERE id = :id"
  );
  $result = $statement->execute(
   array(
    ':id' => $_POST["id"]
   )
  );
  if(!empty($result))
  {
   echo 'Dados deletados';
  }
 }

}

?>
