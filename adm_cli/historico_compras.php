<div class="tab-pane fade show active" id="pills-compras" role="tabpanel" aria-labelledby="pills-home-tab">
	<div class="container" style="margin-top: 50px">
		<h2>Histórico de Compras</h2>
		<table class="table table-striped">
			<thead align="left">
				<tr>
					<th>Data da Entrega</th>
					<th>Produto</th>
					<th>Fornecedor</th>
					<th>Valor</th>
                    <th>Quantidade</th>
                    <th>Total</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody align="left">
                <?php // TODO: Aplicar DRY ( Don't Repeat Yourself )
                    require_once "bd\conexao.php";

                    function toReal($val){
                        return str_replace(".",",", "$val");
                    }

                    $con = getConnection();

                    $pedidos_em_aguardo = $sql->get_historico_compras_em_aguardo($id_origem);

                    foreach($pedidos_em_aguardo as $pedido_row) {
                        $id_produto = $pedido_row['id_produto'];

                        $query = "SELECT * FROM Produtos WHERE id_produto=$id_produto";
                        $query_results = sqlsrv_query($con, $query);
                        $produto_row = sqlsrv_fetch_array($query_results, SQLSRV_FETCH_ASSOC);

                        $id_fornecedor = $produto_row['id_fornecedor'];

                        $query = "SELECT nome_fantasia FROM Fornecedores WHERE id_fornecedor=$id_fornecedor";
                        $query_results = sqlsrv_query($con, $query);
                        $fornecedor_row = sqlsrv_fetch_array($query_results, SQLSRV_FETCH_ASSOC);

                ?>
                    <tr>
                        <td>sem data prévia</td>
                        <td>  <?php echo utf8_encode($produto_row['nome']);?></td>
                        <td>  <?php echo utf8_encode($fornecedor_row['nome_fantasia']);?></td>
                        <td>R$<?php echo toReal($produto_row['preco']) ?></td>
                        <td><?php echo $pedido_row['num_pedido']; ?></td>
                        <td>R$
                            <?php
                            $valor = intval($pedido_row['num_pedido']) * floatval($produto_row['preco']);
                            echo toReal($valor);
                            ?></td>
                        <td>Aguardando</td>
                    </tr>
                <?php
                    } // FOREACH END

                    // este $sql vem do call em index para um instancia da classe sql.
                    // que gera as variaveis globais $id_origem, $nome, etc
                    // Melhoria: Corrigir para $sql->id_origem em vez de variaveis globais.
                    $pedidos_entregues = $sql->get_historico_compras_entregues($id_origem);

                    foreach($pedidos_entregues as $pedido_row) {
                        $id_produto = $pedido_row['id_produto'];

                        $query = "SELECT * FROM Produtos WHERE id_produto=$id_produto";
                        $query_results = sqlsrv_query($con, $query);
                        $produto_row = sqlsrv_fetch_array($query_results, SQLSRV_FETCH_ASSOC);

                        $id_fornecedor = $produto_row['id_fornecedor'];

                        $query = "SELECT nome_fantasia FROM Fornecedores WHERE id_fornecedor=$id_fornecedor";
                        $query_results = sqlsrv_query($con, $query);
                        $fornecedor_row = sqlsrv_fetch_array($query_results, SQLSRV_FETCH_ASSOC);

                ?>
                    <tr>
                        <td>
                            <?php
                                //$data_classe = DateTime::createFromFormat("l dS F Y", $pedido_row['data_entrega']);
                                //$data_convertida = $data_classe->format('d/m/Y');
                                echo $pedido_row['data_entrega']->format('d/m/Y');
                            ?>
                        </td>
                        <td>  <?php echo utf8_encode($produto_row['nome']); ?></td>
                        <td>  <?php echo utf8_encode($fornecedor_row['nome_fantasia']); ?></td>
                        <td>R$<?php echo toReal($produto_row['preco']); ?></td>
                        <td><?php echo $pedido_row['num_pedido']; ?></td>
                        <td>R$
                            <?php
                                $valor = intval($pedido_row['num_pedido']) * floatval($produto_row['preco']);
                                echo toReal($valor);
                            ?>
                        </td>
                        <td>Entregue</td>
                    </tr>
                <?php
                    }

                    sqlsrv_close($con);
                ?>
			</tbody>
		</table>
	</div>
</div>