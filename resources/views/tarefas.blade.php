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
                        <label for="tempoPrevisto" class = "control-label"> Tempo Previsto </label>
                        <div class = "input-group">
                            <input type = "text" class = "form-control" id = "tempoPrevisto">
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

<div class = "modal" tabindex="-1" role = "dialog" id = "dlgUsuarios">
    <div class = "modal-dialog" role = "document">
        <div class = "modal-content">
            <form classs = "form-horizontal" id = "formUsuario">
                <div class = "modalheader">
                    <h5 class="modal-title"> Alocar Usuário </h5>
                </div>
                <div class = "modal-body">
                    <input type="hidden" id = "tarefaId" class = "form-control">
                    <div class = "form-group">
                        <label for="usuarioTarefa" class = "control-label"> Usuário </label>
                        <div class = "input-group">
                            <select class = "form-control" id = "usuarioTarefa"> </select>
                        </div>
                    </div>
                </div>
                <div class = "modal-footer">
                    <button type = "submit" class = "btn btn-primary"> Alocar </button>
                    <button type = "cancel" class = "btn btn-secondary" data-dismiss="modal"> Cancelar </button>

                </div>
            </form>
        </div>
    </div>
</div>

<div class = "modal" tabindex="-1" role = "dialog" id = "dlgUsuariosAlocados">
    <div class = "modal-dialog modal-lg" role = "document">
        <div class = "modal-content">
            <table class = "table table-ordered table hover" id = "tabelaUsuarios">
                <thead>
                    <th> Código </th>
                    <th> Nome </th>
                    <th> E-mail </th>
                    <th> Tempo Gasto </th>
                    <th> Ações </th>
                </thead>
                <tbody>
                </tbody>
            </table>
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

    function salvaAlocacao(){
        alocacao = {
            tarefa_id: $("#tarefaId").val(),
            usuario_id: $('#usuarioTarefa').val()
        };

        console.log(alocacao);
        $.post("api/tarefausuarios", alocacao, function(data){
            console.log("depois da ai veio aqui");
            proj = JSON.parse(data);
        });
    }

    function montarLinhaTabela(tarUsu){
        var linha = "<tr> " +
            "<td> " + tarUsu.id + "</td>" +
            "<td>" + tarUsu.usuarioNome + "</td>" +
            "<td>" + tarUsu.usuarioEmail + "</td>" +
            "<td>" + tarUsu.tempo_gasto + "</td>" +
            "<td>" + 
                '<button class = "btn btn-sm btn-danger" onClick="removerUsuarioTarefa('+ tarUsu.id +')"> Apagar </button> ' + 
            "</td>" +
            "</tr>";
    
            return linha;
    }

    function maisInfo(id){
        linhas = $("#tabelaUsuarios>tbody>tr");
        linhas.remove();
        console.log('mais info');
        $.getJSON('/api/tarefausuarios/' + id, function(tarUsu){
            for(i=0;i<tarUsu.length;i++){
                linha = montarLinhaTabela(tarUsu[i]);
                $('#tabelaUsuarios>tbody').append(linha);
            }
            $('#dlgUsuariosAlocados').modal('show');
        });
    }
    
    function carregarUsuarios(){
        $.getJSON('/api/usuarios', function(data){
            for(i=0; i<data.length;i++){
                opcao = '<option value = "' + data[i].id + '">' + data[i].nome + '</option>';
                $('#usuarioTarefa').append(opcao);
            }
        });
    }

    $("#formUsuario").submit(function(event){
        event.preventDefault();
        salvaAlocacao();
        $("#dlgUsuarios").modal('hide');
       
    });

    function alocarUsuario(id){
        console.log("id tarefa = " + id);
        $('#dlgUsuarios').modal('show');
        $('#tarefaId').val(id);
    }

    function novaTarefa(){
        $('#id').val('');
        $('#projetoTarefa').val('');
        $('#nomeTarefa').val('');
        $('#descTarefa').val('');
        $('#statusTarefa').val('');
        $('#tempoPrevisto').val('');
        $('#dlgTarefas').modal('show');
    }

    function carregarProjetos(){
        $.getJSON('/api/projetos', function(data){
            for(i=0;i<data.length;i++){
                opcao = '<option value = "' + data[i].id + '">' + data[i].nome + '</option>';
                $('#projetoTarefa').append(opcao);
            }
        });
    }
    function carregarTarefas(){
        $.getJSON('/api/tarefas', function(tarefas){
            for(i=0;i<tarefas.length;i++){
                linha = montarLinha(tarefas[i]);
                $('#tabelaTarefas>tbody').append(linha);
            }
        });
    }

    function carregarStatusTarefas(){
        $.getJSON('/api/statustarefas', function(tarefas){
            for(i=0;i<tarefas.length;i++){
                opcao = '<option value = "' + tarefas[i].id + '">' + tarefas[i].nome + '</option>';
                $('#statusTarefa').append(opcao);
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

    $("#formTarefa").submit(function(event){
        event.preventDefault();
        if($("#id").val() != '')
            salvarTarefa();
        else
            criarTarefa();
        $("#dlgTarefas").modal('hide');
       
    });

    function salvarTarefa(){
            tarefa = {
                id: $("#id").val(),
                projeto_id: $("#projetoTarefa").val(),
                nome: $("#nomeTarefa").val(),
                descricao: $('#descTarefa').val(),
                status_id: $('#statusTarefa').val(),
                tempo_previsto: $('#tempoPrevisto').val()
            };
    
            console.log('editando ' + tarefa.id);
            $.ajax({
                type: "PUT", 
                url: "/api/tarefas/" + tarefa.id,
                context: this,
                data: tarefa, 
                success: function(data){
                    tar = JSON.parse(data);
                    console.log(tar);
                    linhas = $("#tabelaTarefas>tbody>tr");
                    e = linhas.filter(function (i, e) {
                        console.log(e.cells[0].textContent + " - " + tar.id)
                        return ( e.cells[0].textContent == tar.id);
                    });
    
                    if(e){
                        e[0].cells[0].textContent = tar.id;
                        e[0].cells[1].textContent = tar.projeto;
                        e[0].cells[2].textContent = tar.nome;
                        e[0].cells[4].textContent = tar.descricao;
                        e[0].cells[5].textContent = tar.status;
                        e[0].cells[6].textContent = tar.tempo_previsto;
    
                    }
                    console.log('editou ok');
                
                },
                error: function(error){
                    console.log(error);
                }
            });
    }

    function remover(id){
        console.log('apagando');
        $.ajax({
            type: "DELETE", 
            url: "/api/tarefas/" + id,
            context: this,
            success: function(){
                console.log('apagouo ok');
                linhas = $("#tabelaTarefas>tbody>tr");
                e = linhas.filter( function(i, elemento) { return elemento.cells[0].textContent == id; });
                if(e)
                    e.remove();
            },
            error: function(error){
                console.log(error);
            }
        });

    }

    function removerUsuarioTarefa(id){
        console.log('apagando');
        $.ajax({
            type: "DELETE", 
            url: "/api/tarefausuarios/" + id,
            context: this,
            success: function(){
                console.log('apagouo ok');
                linhas = $("#tabelaUsuarios>tbody>tr");
                e = linhas.filter( function(i, elemento) { return elemento.cells[0].textContent == id; });
                if(e)
                    e.remove();
            },
            error: function(error){
                console.log(error);
            }
        });

    }

    function criarTarefa(){
        
        tarefa = {
            projeto_id: $("#projetoTarefa").val(),
            nome: $("#nomeTarefa").val(),
            descricao: $('#descTarefa').val(),
            status_id: $('#statusTarefa').val(),
            tempo_previsto: $('#tempoPrevisto').val()
        };
    

        console.log(tarefa);
        $.post("api/tarefas", tarefa, function(data){
            console.log("depois da ai veio aqui");
            tar = JSON.parse(data);
            linha = montarLinha(tar);
            $('#tabelaTarefas>tbody').append(linha);
            });
    }

    function editar(id){
        console.log("editar");
        $.getJSON('/api/tarefas/' + id, function(tarefa){
            $('#id').val(tarefa.id);
            $('#projetoTarefa').val(tarefa.projeto_id);
            $('#nomeTarefa').val(tarefa.nome);
            $('#descTarefa').val(tarefa.descricao);
            $('#statusTarefa').val(tarefa.status_id);
            $('#tempoPrevisto').val(tarefa.tempo_previsto);
            $('#dlgTarefas').modal('show');
        });
    }

    
    $(function(){
        carregarTarefas();
        carregarProjetos();
        carregarStatusTarefas();
        carregarUsuarios();

    })

</script>

@endsection
