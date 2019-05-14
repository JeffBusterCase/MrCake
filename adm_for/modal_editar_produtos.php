<div ng-controller="editar_produto">
    <!-- Modal -->
	<form action="" class="modal fade" id="modalEditarProduto" tabindex="-1" role="form" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
		method="POST">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Edição de Produto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
						<label for="nome-roduto" class="col-3 col-form-label">Produto</label>
						<div class="col-8">
							<input class="form-control" type="text" value="<?php echo $produto; ?>" name = "txtNomeP" id="txtNomeP">
						</div>

						<label for="descricao-produto" class="col-3 col-form-label"> Descrição</label>
						<div class="col-8">
							<input class="form-control" type="text" value="<?php echo $descricao; ?>" name = "txtDescricaoP" id="txtDescricaoP">
						</div>

						<label for="preco-produto" class="col-3 col-form-label"> Preço R$</label>
						<div class="col-8">
							<input class="form-control" type="nunber" value="<?php echo $preco; ?>" name = "txtPrecoP" id="txtPrecoP">
						</div>
						
						<label class="col-6 " for="produto-img"> Inserir imagens</label>
						<input type="file" class="col-9 form-control-file" name = "foto" id="exampleFormControlFile1">
						<label for=""></label>

					</div>
					<input type = "text" name = "email" value = "<?php echo "$email"; ?>" style = "display:none">
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<input type="submit" class="btn btn-primary"  value = "Cadastrar">
					</div>
				</div>
			</div>
		</div>
	</form>
	<div id = "recebeDados"></div>
</div>