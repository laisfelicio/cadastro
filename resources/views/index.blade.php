@extends('layout.app', ["current" => "home"])

@section('body')
<div class = "jumbotron bg-light border border-secondary">
    <div class = "row">
        <div class = "card deck">
            <div class = "card border border-primary">
                <div class = "card-body">
                    <h5 class = "card-title"> Cadastro de produtos </h5>
                    <p class = "card-text">
                    Aqui vc cadastra todos os seus projetos
                    </p>
                    <a href = "/projetos" class = "btn btn-primary"> Cadastre seus projetos </a>
                </div>
            </div>
            <div class = "card border border-primary">
                <div class = "card-body">
                    <h5 class = "card-title"> Cadastro de categorias </h5>
                    <p class = "card-text">
                        Aqui vc cadastra todos as suas categorias
                    </p>
                    <a href = "/categorias" class = "btn btn-primary"> Cadastre suas categorias </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection