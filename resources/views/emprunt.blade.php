@extends('layouts.app')

@section('content')

@if (auth()->user()->nombre_jeton < 1)
    <div class="empruntPasJeton">
        <img src="{{asset('/assets/img/bouc-panneau-jeton.png')}}" alt="">
        <p> vous n'avez pas assez de jeton pour emprunter un livre. Pensez à déposez un livre pour récupérer un jeton. </p>
    </div>
@else
    <div id="wrapperMain">
        <div></div>
        <div class="detailActivite">
            
            <fieldset>  
                
                <legend> Emprunter livre à : {{{$livreDetail[0]->pseudo}}} </legend>
                <form action=" {{ route('prendreLivre')}} " method="POST">
                    @csrf
                    <input type="hidden"  name="id_exemplaire" value="{{ $livreDetail[0]->id_exemplaire }}">
                    <input type="text" readonly name="isbn" value="{{ $livreDetail[0]->isbn }}">
                    <input type="text" readonly  name="pseudo" value="{{ $livreDetail[0]->pseudo }}">
                    <input type="submit" value="Emprunter" class="boutonEmprunt">
                </form>
    
            </fieldset>
            
            <div class="imageEmprunt">
                <img src="{{asset('/assets/img/bouc-flemme.png')}}" alt="">
            </div>

        </div>
    </div>                
@endif
    

        

@endsection