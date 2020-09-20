@extends('layout.app', ["current" => "home", "titulo" => "Projetos"])

@section('body')
<div class = "card border">
    <div class = "card-body">
        <h5 class = "card-title"> Projetos </h5>
    
        <table class = "table table-ordered table hover" id = "tabelaProjetos">
            <thead>
                <th> Código </th>
                <th> Nome </th>
                <th> Descrição </th>
                <th> Tempo gasto </th>
                <th> Cliente </th>
                <th> Status </th>
                <th> Ações </th>
            </thead>
            <tbody>
            </tbody>
        </table>
        
    </div>
    <div class = "card-footer">
        <button class = "btn btn-sm btn-primary" role = "button" onClick="novoProjeto()"> Novo projeto </a>
</div>


<div class = "modal" tabindex="-1" role = "dialog" id = "dlgProjetos">
    <div class = "modal-dialog" role = "document">
        <div class = "modal-content">
            <form classs = "form-horizontal" id = "formProjeto">
                <div class = "modalheader">
                    <h5 class="modal-title"> Novo Projeto </h5>
                </div>
                <div class = "modal-body">
                    <input type="hidden" id = "id" class = "form-control">
                    <div class = "form-group">
                        <label for="nomeProjeto" class = "control-label"> Nome </label>
                        <div class = "input-group">
                            <input type = "text" class = "form-control" id = "nomeProjeto">
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for="descricaoProjeto" class = "control-label"> Descrição </label>
                        <div class = "input-group">
                            <input type = "text" class = "form-control" id = "descricaoProjeto">
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for="clienteProjeto" class = "control-label"> Cliente </label>
                        <div class = "input-group">
                            <select class = "form-control" id = "clienteProjeto"> </select>
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for="statusProjeto" class = "control-label"> Status </label>
                        <div class = "input-group">
                            <input type = "text" class = "form-control" id = "statusProjeto">
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

    $("#formProjeto").submit(function(event){
        event.preventDefault();
        if($("#id").val() != '')
            salvarProjeto();
        else
            criarProjeto();
        $("#dlgProjetos").modal('hide');
       
    });

    function salvarProjeto(){
        projeto = {
            id: $("#id").val(),
            nome: $("#nomeProjeto").val(),
            descricao: $('#descricaoProjeto').val(),
            cliente_id: $('#clienteProjeto').val(),
            tempo_gasto: "00:00:00", 
            status_id: $('#statusProjeto').val()

        };

        console.log('editando ' + projeto.id);
        $.ajax({
            type: "PUT", 
            url: "/api/projetos/" + projeto.id,
            context: this,
            data: projeto, 
            success: function(data){
                proj = JSON.parse(data);
                console.log(proj);
                linhas = $("#tabelaProjetos>tbody>tr");
                e = linhas.filter(function (i, e) {
                    console.log(e.cells[0].textContent + " - " + proj.id)
                    return ( e.cells[0].textContent == proj.id);
                });

                if(e){
                    e[0].cells[0].textContent = proj.id;
                    e[0].cells[1].textContent = proj.nome;
                    e[0].cells[2].textContent = proj.descricao;
                    e[0].cells[4].textContent = proj.cliente_id;
                    e[0].cells[5].textContent = proj.status_id;

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
            url: "/api/projetos/" + id,
            context: this,
            success: function(){
                console.log('apagouo ok');
                linhas = $("#tabelaProjetos>tbody>tr");
                e = linhas.filter( function(i, elemento) { return elemento.cells[0].textContent == id; });
                if(e)
                    e.remove();
            },
            error: function(error){
                console.log(error);
            }
        });

    }

    function montarLinha(p){
        var linha = "<tr> " +
        "<td> " + p.id + "</td>" +
        "<td>" + p.nome + "</td>" +
        "<td>" + p.descricao + "</td>" +
        "<td>" + p.tempo_gasto + "</td>" +
        "<td>" + p.cliente_id + "</td>" +
        "<td>" + p.status_id + "</td>" +
        "<td>" + 
            '<button class = "btn btn-sm btn-primary" onClick="editar('+p.id+')"> Editar </button> ' + 
            '<button class = "btn btn-sm btn-danger" onClick="remover('+ p.id +')"> Apagar </button> ' + 
        "</td>" +
        "</tr>";

        return linha;
    }

    function novoProjeto(){
        $('#id').val('');
        $('#nomeProjeto').val('');
        $('#descricaoProjeto').val('');
        $('#tempoGasto').val('');
        $('#clienteProjeto').val('');
        $('#statusProjeto').val('');
        $('#dlgProjetos').modal('show')
    }

    function carregarProjetos(){
        $.getJSON('/api/projetos', function(projetos){
            for(i=0;i<projetos.length;i++){
                linha = montarLinha(projetos[i]);
                $('#tabelaProjetos>tbody').append(linha);
            }
        });
    }


    function carregarClientes(){
        $.getJSON('/api/clientes', function(data){
            for(i=0; i<data.length;i++){
                opcao = '<option value = "' + data[i].id + '">' + data[i].nome + '</option>';
                $('#clienteProjeto').append(opcao);
            }
        });
    }

    function criarProjeto(){
        
        
            projeto = {
                nome: $("#nomeProjeto").val(),
                descricao: $('#descricaoProjeto').val(),
                cliente_id: $('#clienteProjeto').val(),
                tempo_gasto: "00:00:00", 
                status_id: $('#statusProjeto').val()
            };
        

        console.log(projeto);
        $.post("api/projetos", projeto, function(data){
            console.log("depois da ai veio aqui");
            proj = JSON.parse(data);
            linha = montarLinha(proj);
            $('#tabelaProjetos>tbody').append(linha);
            });
            
    }

    function editar(id){
        $.getJSON('/api/projetos/' + id, function(projeto){
            $('#id').val(projeto.id);
            $('#nomeProjeto').val(projeto.nome);
            $('#descricaoProjeto').val(projeto.descricao);
            $('#clienteProjeto').val(projeto.cliente_id);
            $('#tempoGasto').val(projeto.tempo_gasto);
            $('#statusProjeto').val(projeto.status_id);
            $('#dlgProjetos').modal('show');
        });
    }
    $(function(){
        carregarProjetos();
        carregarClientes();

    })
</script>
@endsection