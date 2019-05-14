<div class="tab-pane fade" id="pills-produtos" role="tabpanel" aria-labelledby="pills-produtos-tab">
	<div class="container" style="margin-top: 50px">
		<h2>Meus Produtos</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Produto</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
			
               $produtos = $sql->getProdutos($email);
				echo var_dump($produtos);
			   //$len = count($produtos);
			
               //if($len > 0) {
			      //foreach($produtos as $produto) {
					echo "<tr>
							<td style='vertical-align:middle'> 
								<img src='$produto->imagem'>
							</td>
							<td style='vertical-align:middle'> 
								$produto->nome
							</td>
							<td style='vertical-align:middle'>
								$produto->descricao
							</td>
							<td style='vertical-align:middle'>
								R$ $produto->preco 
							</td>
							<td>
								<form  method = 'post' class='prod' style='display:none;'>
									<input type = 'text' name='i' value = '1' style='display:none'/>
									<input type = 'text' name='acao' value='eproduto' style='display:none'/>
									<input type = 'submit' class='btn btn-sm btn-deep-orange' id='btneditar1' value='Editar'>
								</form>
							</td>
						</tr>";
				  //}
			   //}
               ?>
            </tbody>
        </table>
        <div id = "recebeDados">
		</div>
    </div>
</div>