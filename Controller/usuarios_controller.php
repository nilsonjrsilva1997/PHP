<script type="text/javascript">
$(document).ready( function () {
    $('#myTable').DataTable();
});
</script>

<?php
	require_once('../Model/login.class.php');

	$sql = getUsuarios();

	if(count($sql) != 0) {
	?>
	<table id="myTable">
		<thead>
			<tr>
				<th>Cpf</th>
				<th>Login</th>
				<th>Sexo</th>
				<th>Nome</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($sql as $key => $value) {			
			?>

			<tr>
				<td><?php echo $value['cpf']; ?></td>
				<td><?php echo $value['login_user']; ?></td>
				<td><?php echo $value['sexo']; ?></td>
				<td><?php echo $value['nome']; ?></td>
			</tr>

			<?php
			}
			?>
		</tbody>
	</table>

	<?php
	} else {
		echo "Não possuem usuarios cadastrados";
	}
?>