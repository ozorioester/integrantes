<?php
	session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Ester Ozorio Rosa dos Santos">
    <title>Integrantes do Sistema de Gerenciamento da Frota de Blindados</title>
    <script src="./js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <style>
     body
     {
      margin:0;
      padding:0;
      background-color:#f1f1f1;
     }
     .box
     {
      width:1270px;
      padding:20px;
      background-color:#fff;
      border:1px solid #ccc;
      border-radius:5px;
      margin-top:100px;
     }
    </style>
 </head>
 <body>
  <div class="container box">

   <h1 align="center">Integrantes do Sistema de Gerenciamento da Frota de Blindados</h1>
   <br />
   <div align="right">
    <button type="button" id="modal_button" class="btn btn-success">Novo Integrante</button>

    <!-- It will show Modal for Create new Records !-->
   </div>
   <br />
   <div id="result" class="table-responsive"> <!-- Data will load under this tag!-->

   </div>
   <div align="center">
   <button type="button" id="exit_button" class="btn btn-info" onclick="window.location.href='login.php'">Sair</button>
 </div>
  </div>
 </body>
</html>

<!-- This is Customer Modal. It will be use for Create new Records and Update Existing Records!-->
<div id="customerModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Novo Integrante</h4>
   </div>
   <div class="modal-body">
    <label>Digite a OM</label>
    <input type="text" name="om" id="om" class="form-control" />

    <br />
    <label>Digite a atividade</label>
    <input type="text" name="atv" id="atv" class="form-control" />
    <br />
    <label>Digite o Posto/Graduação</label>
    <input type="text" name="post_grad" id="post_grad" class="form-control" />
    <br />
    <label>Digite o Nome Completo</label>
    <input type="text" name="nome" id="nome" class="form-control" />
    <br />
    <label>Digite o Nome de Guerra</label>
    <input type="text" name="nome_guerra" id="nome_guerra" class="form-control" />
    <br />
    <label>Digite o Telefone</label>
    <input type="text" name="tel" id="tel" class="form-control" />
    <br />
    <label>Digite o Celular</label>
    <input type="text" name="cel" id="cel" class="form-control" />
    <br />
    <label>Digite o E-mail</label>
    <input type="text" name="email" id="email" class="form-control" />
    <br />
   </div>
   <div class="modal-footer">
    <input type="hidden" name="customer_id" id="customer_id" />
    <input type="submit" name="action" id="action" class="btn btn-success" />
    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
   </div>
  </div>
 </div>
</div>

<script>
$(document).ready(function(){
 fetchUser(); //This function will load all data on web page when page load
 function fetchUser() // This function will fetch data from table and display under <div id="result">
 {
  var action = "Load";
  $.ajax({
   url : "action.php", //Request send to "action.php page"
   method:"POST", //Using of Post method for send data
   data:{action:action}, //action variable data has been send to server
   success:function(data){
    $('#result').html(data); //It will display data under div tag with id result
   }
  });
 }

 //This JQuery code will Reset value of Modal item when modal will load for create new records
 $('#modal_button').click(function(){
  $('#customerModal').modal('show'); //It will load modal on web page
  $('#om').val(''); //This will clear Modal om textbox
  $('#atv').val(''); //This will clear Modal atv textbox
  $('#post_grad').val(''); //This will clear Modal post_grad textbox
  $('#nome').val(''); //This will clear Modal last name textbox
  $('#nome_guerra').val(''); //This will clear Modal last name textbox
  $('#tel').val(''); //This will clear Modal last name textbox
  $('#cel').val(''); //This will clear Modal last name textbox
  $('#email').val(''); //This will clear Modal last name textbox
  $('.modal-title').text("Novo Integrante"); //It will change Modal title to Create new Records
  $('#action').val('Criar'); //This will reset Button value ot Create
 });

 //This JQuery code is for Click on Modal action button for Create new records or Update existing records. This code will use for both Create and Update of data through modal
 $('#action').click(function(){
  var om = $('#om').val(); //Get the value of first name textbox.
  var atv = $('#atv').val(); //Get the value of last name textbox
  var post_grad = $('#post_grad').val(); //Get the value of last name textbox
  var nome = $('#nome').val(); //Get the value of last name textbox
  var nome_guerra = $('#nome_guerra').val(); //Get the value of last name textbox
  var tel = $('#tel').val(); //Get the value of last name textbox
  var cel = $('#cel').val(); //Get the value of last name textbox
  var email = $('#email').val(); //Get the value of last name textbox
  var id = $('#customer_id').val();  //Get the value of hidden field customer id
  var action = $('#action').val();  //Get the value of Modal Action button and stored into action variable
  if(om.trim() != '' && atv.trim() != '' && post_grad.trim() != '' && nome.trim() != '' && nome_guerra.trim() != '' &&  cel.trim() != '' &&  email.trim() != '') //This condition will check both variable has some value
  {
   $.ajax({
    url : "action.php",    //Request send to "action.php page"
    method:"POST",     //Using of Post method for send data
    data:{om:om,atv:atv,post_grad:post_grad,nome:nome,nome_guerra:nome_guerra,tel:tel,cel:cel,email:email,id:id,action:action}, //Send data to server
    success:function(data){
     alert(data);    //It will pop up which data it was received from server side
     $('#customerModal').modal('hide'); //It will hide Customer Modal from webpage.
     fetchUser();    // Fetch User function has been called and it will load data under divison tag with id result
    }
   });
  }
  else
  {
   alert("Todos os campos são obrigatórios"); //If both or any one of the variable has no value them it will display this message
  }
 });

 //This JQuery code is for Update customer data. If we have click on any customer row update button then this code will execute
 $(document).on('click', '.update', function(){
  var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
  var action = "Select";   //We have define action variable value is equal to select
  $.ajax({
   url:"action.php",   //Request send to "action.php page"
   method:"POST",    //Using of Post method for send data
   data:{id:id, action:action},//Send data to server
   dataType:"json",   //Here we have define json data type, so server will send data in json format.
   success:function(data){
    $('#customerModal').modal('show');   //It will display modal on webpage
    $('.modal-title').text("Update Records"); //This code will change this class text to Update records
    $('#action').val("Update");     //This code will change Button value to Update
    $('#customer_id').val(id);     //It will define value of id variable to this customer id hidden field
    $('#om').val(data.om);  //It will assign value to modal first name texbox
    $('#atv').val(data.atv);  //It will assign value of modal last name textbox
    $('#post_grad').val(data.post_grad);  //It will assign value of modal last name textbox
    $('#nome').val(data.nome);  //It will assign value of modal last name textbox
    $('#nome_guerra').val(data.nome_guerra);  //It will assign value of modal last name textbox
    $('#tel').val(data.tel);  //It will assign value of modal last name textbox
    $('#cel').val(data.cel);  //It will assign value of modal last name textbox
    $('#email').val(data.email);  //It will assign value of modal last name textbox
   }
  });
 });

 //This JQuery code is for Delete customer data. If we have click on any customer row delete button then this code will execute
 $(document).on('click', '.delete', function(){
  var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
  if(confirm("Você tem certeza que gostaria de remover esta informação?")) //Confim Box if OK then
  {
   var action = "Delete"; //Define action variable value Delete
   $.ajax({
    url:"action.php",    //Request send to "action.php page"
    method:"POST",     //Using of Post method for send data
    data:{id:id, action:action}, //Data send to server from ajax method
    success:function(data)
    {
     fetchUser();    // fetchUser() function has been called and it will load data under divison tag with id result
     alert(data);    //It will pop up which data it was received from server side
    }
   })
  }
  else  //Confim Box if cancel then
  {
   return false; //No action will perform
  }
 });
});
</script>
