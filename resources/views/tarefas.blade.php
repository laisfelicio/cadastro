@extends('layout.app', ["current" => "home", "titulo" => "Tarefas"])

@section('body')
<div class = "card border">
    <div class = "card-body">
        <h5 class = "card-title"> Tarefas </h5>
    
        <table class = "table table-ordered table hover" id = "tabelaTarefas">
            <thead>
                <th> Código </th>
                <th> Projeto </th>
                <th> Nome </th>
                <th> Descricao </th>
                <th> Status </th>
                <th> Tempo previsto </th>
                <th> Ações </th>
            </thead>
            <tbody>
            </tbody>
        </table>
        
    </div>
    <div class = "card-footer">
        <button class = "btn btn-sm btn-primary" role = "button" onClick="novaTarefa()"> Nova Tarefa </a>
</div>


<div class = "modal" tabindex="-1" role = "dialog" id = "dlgTarefas">
    <div class = "modal-dialog" role = "document">
        <div class = "modal-content">
            <form classs = "form-horizontal" id = "formTarefa">
                <div class = "modalheader">
                    <h5 class="modal-title"> Nova Tarefa </h5>
                </div>
                <div class = "modal-body">
                    <input type="hidden" id = "id" class = "form-control">
                    <div class = "form-group">
                        <label for="projetoTarefa" class = "control-label"> Projeto </label>
                        <div class = "input-group">
                            <select class = "form-control" id = "projetoTarefa"> </select>
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for="nomeTarefa" class = "control-label"> Nome </label>
                        <div class = "input-group">
                            <input type = "text" class = "form-control" id = "nomeTarefa">
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for="descTarefa" class = "control-label"> Descrição </label>
                        <div class = "input-group">
                            <input type = "text" class = "form-control" id = "descTarefa">
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for="statusTarefa" class = "control-label"> Status </label>
                        <div class = "input-group">
                            <select class = "form-control" id = "statusTarefa"> </select>
                        </div>
                    </div>
                </div>
                <div class = "modal-footer">
                    <button type = "submit" class = "btn btn-primary"> Salvar </button>
                    <button type = "cancel" class = "btn btn-secondary" data-dismiss="modal"> Cancelar </button>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type = "text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{csrf_token() }}"
        }
    });

    function carregarTarefas(){
        $.getJSON('/api/tarefas', function(tarefas){
            for(i=0;i<tarefas.length;i++){
                linha = montarLinha(tarefas[i]);
                $('#tabelaTarefas>tbody').append(linha);
            }
        });
    }

    function montarLinha(p){
        var linha = "<tr> " +
        "<td> " + p.id + "</td>" +
        "<td>" + p.projeto + "</td>" +
        "<td>" + p.nome + "</td>" +
        "<td>" + p.descricao + "</td>" +
        "<td>" + p.status + "</td>" +
        "<td>" + p.tempo_previsto + "</td>" +
        "<td>" + 
            '<button class = "btn btn-sm btn-primary" onClick="editar('+p.id+')"> Editar </button> ' + 
            '<button class = "btn btn-sm btn-primary" onClick="alocarUsuario('+ p.id +')"> Alocar Usuário </button> ' +
            '<button class = "btn btn-sm btn-primary" onClick="maisInfo('+ p.id +')"> + Info </button> ' +
            '<button class = "btn btn-sm btn-danger" onClick="remover('+ p.id +')"> Apagar </button> ' + 
        "</td>" +
        "</tr>";

        return linha;
    }

    $(function(){
        carregarTarefas();

    })

</script>

@endsection
