@extends('layout.app', ["current" => "home", "titulo" => "Cadastro de clientes"])

@section('body')
<div class = "card border">
    <div class = "card-body">
        <form>
            <div class="form-group row">
                <label for="nomeProjeto" class="col-sm-2 col-form-label">Nome</label>
                <div class = "col-sm-5">
                    <input type="text" class="form-control" id="nomeProjeto" name="nomeProjeto" placeholder="Nome do projeto">
                </div>
            </div>
            <div class = "form-group row">
                <label for="descricaoProjeto" class="col-sm-2 col-form-label"> Descricao Projeto </label>
                <div class = "col-sm-5">
                    <input class="form-control" type="text" id="descricaoProjeto" name = "descricaoProjeto" placeholder="Descrição">
                </div>
            </div>
            <div class = "form-group row">
                <label for="cliente" class="col-sm-2 col-form-label">Cliente</label>
                <div class = "col-sm-5">
                        <select class="form-control" id="cliente" name = "cliente">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        </select>
                </div>
            </div>
            <div class = "form-group row">
                <label for="usuarios" class="col-sm-2 col-form-label"> Usuários </label>
                <div class = "col-sm-5">
                    <input class="form-control" type="text" id="usuarios" name = "usuarios">
                </div>
                <a href = "#" class = "btn btn-info addRow">+</a>
            </div>
            
        </form>
    </div>
</div>

<script type = "text/javascript">
	$('.addRow').on('click', function(){
		addRow();
});

function addRow(){
	var elemento = '<div class = "form-group row"> <label for="usuarios" class="col-sm-2 col-form-label"></label> <div class = "col-sm-5"> <input class="form-control" type="text" id="usuarios" name = "usuarios"> </div> </div>';
    $('form').append(elemento);
}
</script>
@endsection