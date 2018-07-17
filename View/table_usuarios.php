<form>
	<div class="form-group">
    <label for="exampleInputEmail1">Nome</label>
    <input type="" class="form-control" id="nome" aria-describedby="emailHelp" placeholder="Enter Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">CPF</label>
    <input type="" class="form-control" id="cpf" aria-describedby="emailHelp" placeholder="Enter CPF">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Login</label>
    <input type="" class="form-control" id="login" aria-describedby="emailHelp" placeholder="Enter Login"> 
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Senha</label>
    <input type="" class="form-control" id="senha" aria-describedby="emailHelp" placeholder="Enter Password">
  </div>
  <div class="form-group">
  </div>

  <div class="form-group">
    <div class="radio">
  		<label><input type="radio" id="optradio" value="m">Masculino</label>
	</div>
	<div class="radio">
  		<label><input type="radio" id="optradio" value="f">Feminino</label>
	</div>
  </div>
  <div id="novo" class="btn btn-primary">Novo Usuário</div>
</form>

<div id="table">
	
</div>

<script type="text/javascript">
	
	function getTable() {
		$.ajax({
			url: './Controller/usuarios_controller.php',
			type: 'POST',
			success: function(data) {
				$('#table').html(data);
			}
		});
	}

	$('#novo').click(function() {
		var nome = $('#nome').val();
		var cpf = $('#cpf').val();
		var login = $('#login').val();
		var senha = $('#senha').val();
		var sexo = $('#optradio').val();

		$.ajax({
			url: './Controller/view.php',
			type: 'POST',
			data: {"nome": nome, "cpf": cpf, "login_user": login, "senha": senha, "sexo": sexo } ,
			success: function(data) {
				alert(data);
				getTable();
			}
		});
	});

	$(document).ready(function () {
    	getTable();
	});

</script>