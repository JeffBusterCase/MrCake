<div class="tab-pane fade show active" id="pills-compras" role="tabpanel" aria-labelledby="pills-home-tab">
	<div class="container" style="margin-top: 50px">
		<h2>Histórico de Compras</h2>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Data da Compra</th>
					<th>Produto</th>
					<th>Fornecedor</th>
					<th>Valor</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
                <?php // TODO: Aplicar DRY ( Don't Repeat Yourself )
                    require_once "bd\conexao.php";

                    $pedidos_em_aguardo = $sql->get_historico_compras_em_aguardo($id_origem);

                    foreach($pedidos_em_aguardo as $pedido_row) {
                        $id_produto = $pedido_row['id_produto'];

                        $query = "SELECT * FROM Produtos WHERE id_produto=$id_produto";
                        $query_results = sqlsrv_query($conn, $query);
                        $produto_row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);

                        $id_fornecedor = $produto_row['id_fornecedor'];

                        $query = "SELECT nome_fantasia FROM Fornecedores WHERE id_fornecedor=$id_fornecedor";
                        $query_results = sqlsrv_query($conn, $query);
                        $fornecedor_row = sqlsrv_fetch_array($query_results, SQLSRV_FETCH_ASSOC);

                ?>
                    <tr>
                        <td>sem data prévia</td>
                        <td>  <?php echo $produto_row['nome'];?></td>
                        <td>  <?php echo $fornecedor_row['nome_fantasia'];?></td>
                        <td>R$<?php echo intval($pedido_row['num_pedido']) * floatval($produto_row['preco']);?></td>
                        <td>Aguardando aprovação</td>
                    </tr>
                <?php
                    }
                ?>
                <tr>
                    <td>sem data prévia</td>
                    <td>Exemplo</td>
                    <td>Fornecedor 3</td>
                    <td>R$ 80,00</td>
                    <td>Aguardando aprovação</td>
                </tr>
                <?php
                    require_once "bd\conexao.php";

                    // este $sql vem do call em index para um instancia da classe sql.
                    // que gera as variaveis globais $id_origem, $nome, etc
                    // Melhoria: Corrigir para $sql->id_origem em vez de variaveis globais.
                    $pedidos_entregues = $sql->get_historico_compras_entregues($id_origem);

                    foreach($pedidos_entregues as $pedido_row) {
                        $id_produto = $pedido_row['id_produto'];

                        $query = "SELECT * FROM Produtos WHERE id_produto=$id_produto";
                        $query_results = sqlsrv_query($conn, $query);
                        $produto_row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);

                        $id_fornecedor = $produto_row['id_fornecedor'];

                        $query = "SELECT nome_fantasia FROM Fornecedores WHERE id_fornecedor=$id_fornecedor";
                        $query_results = sqlsrv_query($conn, $query);
                        $fornecedor_row = sqlsrv_fetch_array($query_results, SQLSRV_FETCH_ASSOC);

                ?>
                    <tr>
                        <td>  <?php echo $pedido_row['data_entrega'];?></td>
                        <td>  <?php echo $produto_row['nome'];?></td>
                        <td>  <?php echo $fornecedor_row['nome_fantasia'];?></td>
                        <td>R$<?php echo intval($pedido_row['num_pedido']) * floatval($produto_row['preco']);?></td>
                        <td>Entregue</td>
                    </tr>
                <?php
                    }

                    sqlsrv_close($conn);
                ?>
				<tr>
					<td>01/10/2018</td>
					<td>Segundo Exemplo</td>
					<td>Fornecedor 1</td>
					<td>R$ 30,00</td>
					<td>Entregue</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>