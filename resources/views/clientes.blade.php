@extends('layout.app', ["current" => "home", "titulo" => "Clientes"])

@section('body')
<div class = "card border">
    <div class = "card-body">
        <h5 class = "card-title"> Clientes </h5>
    
        <table class = "table table-ordered table hover" id = "tabelaClientes">
            <thead>
                <th> Código </th>
                <th> Nome </th>
                <th> Ações </th>
            </thead>
            <tbody>
            </tbody>
        </table>
        
    </div>
    <div class = "card-footer">
        <button class = "btn btn-sm btn-primary" role = "button" onClick="novoCliente()"> Novo cliente </a>
</div>


<div class = "modal" tabindex="-1" role = "dialog" id = "dlgClientes">
    <div class = "modal-dialog" role = "document">
        <div class = "modal-content">
            <form classs = "form-horizontal" id = "formCliente">
                <div class = "modalheader">
                    <h5 class="modal-title"> Novo cliente </45>
                </div>
                <div class = "modal-body">
                    <input type="hidden" id = "id" class = "form-control">
                    <div class = "form-group">
                        <label for="nomeCliente" class = "control-label"> Nome do cliente </label>
                        <div class = "input-group">
                            <input type = "text" class = "form-control" id = "nomeCliente">
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

    function novoCliente(){
        $('#id').val('');
        $('#nomeCliente').val('');
        $('#dlgClientes').modal('show')
    }


    function montarLinha(c){
        var linha = "<tr> " +
        "<td> " + c.id + "</td>" +
        "<td>" + c.nome + "</td>" +
        "<td>" + 
            '<button class = "btn btn-sm btn-primary" onClick="editar('+c.id+')"> Editar </button> ' + 
            '<button class = "btn btn-sm btn-danger" onClick="remover('+ c.id +')"> Apagar </button> ' + 
        "</td>" +
        "</tr>";

        return linha;
    }

    function salvarCliente(){

        cliente = {
            id: $("#id").val(),
            nome: $("#nomeCliente").val()
        };

        console.log('editando ' + cliente.id);
        $.ajax({
            type: "PUT", 
            url: "/api/clientes/" + cliente.id,
            context: this,
            data: cliente, 
            success: function(data){
                cli = JSON.parse(data);
                console.log(cli);
                linhas = $("#tabelaClientes>tbody>tr");
                e = linhas.filter(function (i, e) {
                    console.log(e.cells[0].textContent + " - " + cli.id)
                    return ( e.cells[0].textContent == cli.id);
                });

                if(e){
                    e[0].cells[0].textContent = cli.id;
                    e[0].cells[1].textContent = cli.nome;

                }
                console.log('editou ok');
            
            },
            error: function(error){
                console.log(error);
            }
        });
    }

    $("#formCliente").submit(function(event){
        event.preventDefault();
        if($("#id").val() != '')
            salvarCliente();
        else
            criarCliente();
        $("#dlgClientes").modal('hide');
       
    });

    function criarCliente(){
        cliente = {
            nome: $("#nomeCliente").val()
        };

        console.log(cliente);
        $.post("api/clientes", cliente, function(data){
            cliente = JSON.parse(data);
            linha = montarLinha(cliente);
            $('#tabelaClientes>tbody').append(linha);
            });
            
    }
    function carregarClientes(){
        $.getJSON('/api/clientes', function(clientes){
            for(i=0;i<clientes.length;i++){
                linha = montarLinha(clientes[i]);
                $('#tabelaClientes>tbody').append(linha);
            }
        });
    }

    function editar(id){
        $.getJSON('/api/clientes/' + id, function(cliente){
            $('#id').val(cliente.id);
            $('#nomeCliente').val(cliente.nome);
            $('#dlgClientes').modal('show')
        });
    }
    function remover(id){
        console.log('apagando');
        $.ajax({
            type: "DELETE", 
            url: "/api/clientes/" + id,
            context: this,
            success: function(){
                console.log('apagouo ok');
                linhas = $("#tabelaClientes>tbody>tr");
                e = linhas.filter( function(i, elemento) { return elemento.cells[0].textContent == id; });
                if(e)
                    e.remove();
            },
            error: function(error){
                console.log(error);
            }
        });

    }

    $(function(){
        carregarClientes();
    })
</script>
@endsection