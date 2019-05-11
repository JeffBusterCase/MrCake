<div class="tab-pane fade" id="pills-produtos" role="tabpanel" aria-labelledby="pills-profile-tab">
	<div class="container" style="margin-top: 50px">
		<h2>Meus Produtos</h2>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Produto</th>
					<th>Valor</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			
				 <?php
				 /*
                    require_once "bd\conexao.php";
                    
                    $id = $sql->produtos($email);				

					$query = "SELECT nome, preco, id_produto FROM Produtos WHERE id_fornecedor=$id";
					$stmt = sqlsrv_query($conn, $query);		

					while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
					{
                ?>
						<tr>
							<td style="vertical-align:middle"><?php echo $row['nome'];?></td>
							<td style="vertical-align:middle">R$<?php echo $row['preco'];?></td>
							<td>
								<button class="btn btn-sm btn-deep-orange" id = "btneditar" value = "1" onclick = "editarProduto()">
									Editar
								</button>
							</td>
						</tr>
                <?php
                    }

                    sqlsrv_free_stmt( $stmt);
					*/
                ?>
			
				<tr>
					<td style="vertical-align:middle">Bolo 1</td>
					<td style="vertical-align:middle">R$ 30,00</td>
					<td>
						<form action = "" method = "post" class = "prod">
							<input type = "text" name = "i" value = "1" style="display:none"/>  
							<input type = "text" name = "acao" value = "eproduto" style="display:none"/>  
							<input type = "submit" class="btn btn-sm btn-deep-orange" id = "btneditar1" value = "Editar">
						</form>
					</td>
				</tr>
				<tr>
					<td style="vertical-align:middle">Bolo 2</td>
					<td style="vertical-align:middle">R$ 40,00</td>
					<td>
						<form action = "" method = "post" class = "prod">
							<input type = "text" name = "i" value = "2" style="display:none"/>  
							<input type = "text" name = "acao" value = "eproduto" style="display:none"/>  
							<input type = "submit" class="btn btn-sm btn-deep-orange" id = "btneditar2" value = "Editar">
						</form>
					</td>
				</tr>
				<tr>
					<td style="vertical-align:middle">Bolo 3</td>
					<td style="vertical-align:middle">R$ 50,00</td>
					<td>
						<form action = "" method = "post" class = "prod">
							<input type = "text" name = "i" value = "3" style="display:none"/>  
							<input type = "text" name = "acao" value = "eproduto" style="display:none"/>  
							<input type = "submit" class="btn btn-sm btn-deep-orange" id = "btneditar3" value = "Editar">
						</form>
						
					</td>
				</tr>
			</tbody>
		</table>
		<div id = "recebeDados"></div>
	</div>
</div>
