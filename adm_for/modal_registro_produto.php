<div ng-controller="novo_produto">
    <!-- Modal -->
	<form action="/cria_produtos.php" class="modal fade" id="modalCadastroProduto" tabindex="-1" role="form" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
		method="POST">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Cadastro de Produto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
						<label for="nome-roduto" class="col-3 col-form-label">Produto</label>
						<div class="col-8">
							<input class="form-control" type="text" value="" placeholder="Nome do produto" name = "txtNomeP" id="txtNomeP">
						</div>

						<label for="descricao-produto" class="col-3 col-form-label"> Descrição</label>
						<div class="col-8">
							<input class="form-control" type="text" value="" placeholder="Descrevar o Produto" name="txtDescricaoP" id="txtDescricaoP">
						</div>

						<label for="preco-produto" class="col-3 col-form-label"> Preço R$</label>
						<div class="col-8">
							<input class="form-control" type="number" value="" placeholder="00,00" name="txtPrecoP" id="preco">
						</div>
						<label for="ingrediente-produto"class="col-3 form-label" for="inlineFormCustomSelectPref">Ingredientes</label>
						<div class="col-8">
							<!--
								 A cada OK, vc adiciona no array, e depois manda no POST.
							-->

                            <script>
                                var qtIngredientes = 0;
                                var ingredientes = [];
                                function add_ingrediente(){
                                    var table = document.querySelector("#ingredientes_table");
                                    var ingrediente = document.querySelector("#ingrediente_input");
                                    ingrediente.focus();
                                    var nome_ingrediente = ingrediente.value.trim();
                                    if(nome_ingrediente == ''){
                                        return;
                                    }
                                    var ingrediente_row = "";
                                    ingrediente_row += "<tr>";
                                    ingrediente_row += "<td>";
                                    ingrediente_row += nome_ingrediente;
                                    ingrediente_row += "</td>";
                                    ingrediente_row += "<td>";
                                    ingrediente_row += "<button style='border:none;background-color:white' type='button' onclick='delete_ingrediente(\"" + nome_ingrediente + "\", this)'>";
                                    ingrediente_row += "<i class=' fa fa-trash'></i>";
                                    ingrediente_row += "</button>";
                                    ingrediente_row += "</td>";
                                    ingrediente_row += "</tr>";
                                    table.innerHTML += ingrediente_row;
                                    ingredientes.push(nome_ingrediente);
                                    var hiddenIngredientesInput = document.querySelector("#ingredientes");
                                    hiddenIngredientesInput.value = ingredientes.join(',');
                                    qtIngredientes++;
                                    ingrediente.value = "";
                                    ingrediente.focus();
                                }
                                window.add_ingrediente = add_ingrediente;
                                function delete_ingrediente(nome_ingrediente, row_btn){
                                    var i = ingredientes.indexOf(nome_ingrediente);
                                    ingredientes.splice(i,i);
                                    var hiddenIngredientesInput = document.querySelector("#ingredientes");
                                    hiddenIngredientesInput.value = ingredientes.join(',');
                                    qtIngredientes--;
                                    var row = row_btn.parentElement.parentElement;
                                    var ingredientes_table = document.querySelector("#ingredientes_table");
                                    ingredientes_table.removeChild(row);
                                }
                                window.delete_ingrediente = delete_ingrediente;
                                function addKPress(e){
                                    if(e.keyCode == 13){
                                        e.preventDefault();
                                        add_ingrediente();
                                    }
                                }
                                window.addKPress = addKPress;
                            </script>

                            <div style="overflow-y: scroll;max-height: 100px;background-color:white!important;margin-top:5px;width:300px;border-radius: 5px!important;color:black;">
                                <table>
                                    <tbody id="ingredientes_table" style="background-color: white !important;color:black">
                                        <tr>
                                            <th>Ingredientes</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-8" style="margin-top:5px;margin-left:0px;padding-left:0px;">
                                <!-- INPUT NORMAL QUE VAI PARA O SCRIPT QUE MANDA PARA txtIngredientesP -->
                                <input class="form-control" type="text" value="" placeholder="chocolate" name="ingredientes-produto" id="ingrediente_input" onkeypress="addKPress(event);">
                                <!-- AQUI VÃO OS NOMES DOES INGREDIENTES ATRELADOS POR VIRGULA chocolate,leite,etc -->
                                <input class="form-control" type="text" style="display:none;" name="txtIngredientesP" id="ingredientes">
                            </div>

                            <button type="button" style="margin-top: 5px;width:90px;height:30px;padding:0px;"  class="btn btn-success" onclick="window.add_ingrediente()">Adicionar</button>
						</div>

						<label class="col-6 " for="produto-img"> Inserir imagens</label>
						<input type="file" class="col-9 form-control-file" name="txtFotoP" id="exampleFormexampleFormControlFile1">

					</div>
					<input type = "text" name = "email" value = "<?php echo "$email"; ?>" style = "display:none">
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_cria_produto">Cancelar</button>
						<input type="submit" class="btn btn-primary" value="Cadastrar">
					</div>
				</div>
			</div>
		</div>
	</form>
	<div id = "recebeDados"></div>
</div>