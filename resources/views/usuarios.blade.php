@extends('layout.app', ["current" => "home", "titulo" => "Usuários"])

@section('body')
<div class = "card border">
    <div class = "card-body">
        <h5 class = "card-title"> Usuários </h5>
    
        <table class = "table table-ordered table hover" id = "tabelaUsuarios">
            <thead>
                <th> Código </th>
                <th> Nome </th>
                <th> Email </th>
                <th> Time </th>
                <th> Ações </th>
            </thead>
            <tbody>
            </tbody>
        </table>
        
    </div>
    <div class = "card-footer">
        <button class = "btn btn-sm btn-primary" role = "button" onClick="novoUsuario()"> Novo usuário </a>
</div>


<div class = "modal" tabindex="-1" role = "dialog" id = "dlgUsuarios">
    <div class = "modal-dialog" role = "document">
        <div class = "modal-content">
            <form classs = "form-horizontal" id = "formUsuario">
                <div class = "modalheader">
                    <h5 class="modal-title"> Novo Usuário </h5>
                </div>
                <div class = "modal-body">
                    <input type="hidden" id = "id" class = "form-control">
                    <input type="hidden" id = "senhaUsuario" class = "form-control">
                    <div class = "form-group">
                        <label for="nomeUsuario" class = "control-label"> Nome </label>
                        <div class = "input-group">
                            <input type = "text" class = "form-control" id = "nomeUsuario">
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for="emailUsuario" class = "control-label"> Email </label>
                        <div class = "input-group">
                            <input type = "text" class = "form-control" id = "emailUsuario">
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for="timeUsuario" class = "control-label"> Time </label>
                        <div class = "input-group">
                            <select class = "form-control" id = "timeUsuario"> </select>
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

    function montarLinha(u){
        var linha = "<tr> " +
        "<td> " + u.id + "</td>" +
        "<td>" + u.nome + "</td>" +
        "<td>" + u.email + "</td>" +
        "<td>" + u.time+ "</td>" +
        "<td>" + 
            '<button class = "btn btn-sm btn-primary" onClick="editar('+u.id+')"> Editar </button> ' + 
            '<button class = "btn btn-sm btn-danger" onClick="remover('+ u.id +')"> Apagar </button> ' + 
        "</td>" +
        "</tr>";
        console.log("montando linha");
        

        return linha;
    }

    function editar(id){
        console.log("editar");
        $.getJSON('/api/usuarios/' + id, function(usuario){
            $('#id').val(usuario.id);
            $('#nomeUsuario').val(usuario.nome);
            $('#emailUsuario').val(usuario.email);
            $('#senhaUsuario').val(usuario.senha);
            $('#timeUsuario').val(usuario.time_id);
            $('#dlgUsuarios').modal('show');
        });
    }

    function procuraTime(id){
        $.getJSON('/api/times/' + id, function(time){
            return 'teste';
        });
    }

    function salvarUsuario(){
        usuario = {
            id: $("#id").val(),
            email: $("#nomeUsuario").val(),
            email: $("#emailUsuario").val(),
            senha: $('#senhaUsuario').val(),
            time_id: $('#timeUsuario').val()

        };

        console.log('editando ' + usuario.id);
        $.ajax({
            type: "PUT", 
            url: "/api/usuarios/" + usuario.id,
            context: this,
            data: usuario, 
            success: function(data){
                usu = JSON.parse(data);
                console.log(usu);
                linhas = $("#tabelaUsuarios>tbody>tr");
                e = linhas.filter(function (i, e) {
                    console.log(e.cells[0].textContent + " - " + usu.id)
                    return ( e.cells[0].textContent == usu.id);
                });

                if(e){
                    e[0].cells[0].textContent = usu.id;
                    e[0].cells[1].textContent = usu.nome;
                    e[0].cells[2].textContent = usu.email;
                    e[0].cells[3].textContent = usu.time_id;

                }
                console.log('editou ok');
            
            },
            error: function(error){
                console.log(error);
            }
        });

    }

    function carregarTimes(){
        $.getJSON('/api/times', function(data){
            for(i=0; i<data.length;i++){
                opcao = '<option value = "' + data[i].id + '">' + data[i].nome + '</option>';
                $('#timeUsuario').append(opcao);
            }
        });
    }

    function novoUsuario(){
        $('#id').val('');
        $('#nomeUsuario').val('');
        $('#emailUsuario').val('');
        $('#time_id').val('');
        $('#dlgUsuarios').modal('show')
    }

    $("#formUsuario").submit(function(event){
        event.preventDefault();
        if($("#id").val() != '')
            salvarUsuario();
        else
            criarUsuario();
        $("#dlgUsuarios").modal('hide');
       
    });

    
    function criarUsuario(){
        usuario = {
            nome: $("#nomeUsuario").val(),
            email: $("#emailUsuario").val(),
            senha: "SENHADEFAULT",
            time_id: $("#timeUsuario").val()
        };

        console.log(usuario);
        $.post("api/usuarios", usuario, function(data){
            usuario = JSON.parse(data);
            linha = montarLinha(usuario);
            $('#tabelaUsuarios>tbody').append(linha);
            });
            
    }

    function carregarUsuarios(){
        $.getJSON('/api/usuarios', function(usuarios){
            for(i=0;i<usuarios.length;i++){
                linha = montarLinha(usuarios[i]);
                $('#tabelaUsuarios>tbody').append(linha);
            }
        });
    }

    function remover(id){
        console.log('apagando');
        $.ajax({
            type: "DELETE", 
            url: "/api/usuarios/" + id,
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

    $(function(){
        carregarUsuarios();
        carregarTimes();
    })
</script>
@endsection