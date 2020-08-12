@extends('layout.app', ["current" => "home", "titulo" => "Home"])

@section('body')
<div class = "card-deck">
   <div class="card bg-light border-dark text-center" style="width: 18rem;">
    
        <div class="card-body text-dark">
        <h4 class="card-title">Tarefas</h5>
        @component('component_icon_task')    
        @endcomponent
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>

    <div class="card bg-light border-dark" style="width: 18rem;">
         <div class="card-header">Header</div>
         <div class="card-body text-dark">
         <h5 class="card-title">Card title</h5>
         <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
         <a href="#" class="btn btn-primary">Go somewhere</a>
         </div>
     </div>
</div>
<br>
<div class = "card-deck">
    <div class="card bg-light border-dark" style="width: 18rem;">
         <div class="card-header">Header</div>
         <div class="card-body text-dark">
         <h5 class="card-title">Card title</h5>
         <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
         <a href="#" class="btn btn-primary">Go somewhere</a>
         </div>
     </div>
 
     <div class="card bg-light border-dark" style="width: 18rem;">
          <div class="card-header">Header</div>
          <div class="card-body text-dark">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
      </div>
 </div>
@endsection