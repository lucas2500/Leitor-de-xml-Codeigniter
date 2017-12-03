<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<style type="text/css">

	input[type=file] {
		width: 35%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		box-sizing: border-box;
		background-color: #FF7F50;
		font-family: times;
		color: white;
	}

	td{

		background-color: #F8F8FF;

	}

</style>
</head>
<body>
	<div class="container" align="center" style="margin-top: 5%;">
		<form action="<?php echo base_url();?>cadastro/insertData" method="post" enctype="multipart/form-data">
			<input type="file" name="arquivo" required=""></ins>
			<br />
			<br />
			<button type="submit" class="btn btn-success">Enviar</button>
		</form>
	</div>

	<div class="container" style="margin-top: 4%;">
		<table class="table table-bordered">

			<thead>
				<tr>
					<th>Cliente</th>
					<th>CNPJ</th>
					<th>Bairro</th>
					<th>UF</th>
					<th>Visualizar cliente</th>
					<th>Excluir</th>
				</tr>
			</thead>

			<tbody>
				
				<?php 

				foreach($regs as $REGS){

					echo "<tr>";

					echo "<td>".$REGS->xNome."</td>";
					echo "<td>".$REGS->CNPJ."</td>";
					echo "<td>".$REGS->xBairro."</td>";
					echo "<td>".$REGS->UF."</td>";
					echo '<td><a href = "/deletar/deleteUser/'.$REGS->ID.'" <button class = "btn btn-primary" onclick="return apagarUsuario()"><span class="glyphicon glyphicon-eye-open"></span></button></a>';
					echo '<td><a href = "/cadastro/deleteRegistro/'.$REGS->ID.'" <button class = "btn btn-danger" onclick="return deleteReg()"><span class="glyphicon glyphicon-trash"></span></button></a>';

					echo "</tr>";
				}
				?>
			</tbody>
		</table>
	</div>

	<script type="text/javascript">
		
		function deleteReg(){

			var x = confirm("Deseja realmente apagar este registro?");

			if(x == true){

				return x;

			} else{

				return false;
			}

		}
	</script>
</body>
</html>