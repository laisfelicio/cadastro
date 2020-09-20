@extends('layout.app', ["current" => "home", "titulo" => "Cadastro de tarefa"])

@section('body')
<div class = "card border">
    <div class = "card-body">
        <form>
            <div class = "form-group row">
                <label for="projeto" class="col-sm-2 col-form-label">Projeto</label>
                <div class = "col-sm-5">
                        <select class="form-control" id="projeto" name = "projeto">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="nomeTarefa" class="col-sm-2 col-form-label">Nome</label>
                <div class = "col-sm-5">
                    <input type="text" class="form-control" id="nomeTarefa" name="nomeTarefa" placeholder="Nome da tarefa">
                </div>
            </div>
            <div class = "form-group row">
                <label for="descricaoTarefa" class="col-sm-2 col-form-label"> Descricao</label>
                <div class = "col-sm-5">
                    <textarea class="form-control" id="descricaoTarefa" rows="3"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="tempoPrevisto" class="col-sm-2 col-form-label">Tempo previsto</label>
                <div class = "col-sm-5">
                    <input type="text" class="form-control" id="tempoPrevisto" name="tempoPrevisto" placeholder="Tempo previsto">
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