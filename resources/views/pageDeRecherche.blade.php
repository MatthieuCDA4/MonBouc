@extends('layouts.app')

@section('content')
    
    <div id="wrapperMain">
        <div id="bandeauGauche">
            
            <div class="categorie">
                <form action=" {{ route('rechercheLivre') }} " method="POST">
                    @csrf
                    <fieldset>
                        <legend class="legend"> Auteur</legend>

                        @foreach ($listeAuteur as $item)
                        <input type="radio" id="{{$item->id_auteur}}" name="check" value="{{$item->id_auteur}}" />
                        <label for="{{$item->id_auteur}}">{{$item->prenom_a}} {{$item->nom_a}} </label><br />
                        @endforeach
                    </fieldset>

                    <fieldset>
                        <legend class="legend">Catégorie</legend>

                        @foreach ($listeGenre as $item)
                            <input type="radio" id="{{$item->nom_genre}}" name="check" value="{{$item->nom_genre}}" />
                            <label for="{{$item->nom_genre}}">{{$item->nom_genre}}</label><br />
                        @endforeach
                        
                    </fieldset>

                    <fieldset>
                        <legend class="legend">Etats</legend>
                        @foreach ($listeEtat as $item)
                            <input type="radio" id="{{$item->integrite_du_livre}}" name="check" value="{{$item->integrite_du_livre}}" />
                            <label for="{{$item->integrite_du_livre}}">{{$item->integrite_du_livre}}</label><br />
                            
                        @endforeach
                    </fieldset>
                    <div id="recherche">
                        <input type="submit" value="Rechercher">
                    </div>
                </form>

            </div>

        </div id="bandeauMilieu">

        @if ($dispo == null)
            
            <div class="padDeLivre">

                <p>Il n'existe pas de livre pour cette recherche voulez-vous ajouter une fiche.</p>
                <a href="{{route('ficheLivre')}}">Ajouter un livre</a> 
            </div>
        

        @else
            <div>
                @foreach ($dispo  as $item)

                    <div class= "box">

                        <img src="{{$item->image }}" alt=" {{ $item->titre_livre }} ">

                        <p>{{ $item->titre_livre }}
                            <br>
                            Nombre pages :<br>
                            {{ $item->nombre_page }}<br>
                            <br>
                            Catégorie :<br>
                            {{ $item->nom_genre }}<br>
                            <br>
                            Code Postal : <br>
                            {{ $item->code_postal }}   
                            <br>
                            {{ $item->ville }}   
                        </p>
                        <form action="{{route('detailLivre')}}">
                            @csrf
                            <input type="hidden"  name="id_exemplaire" value="{{ $item->id_exemplaire }}">
                            <input type="hidden"  name="pseudo" value="{{ $item->pseudo }}">
                            <input type="hidden"  name="isbn" value="{{ $item->isbn }}">
                            <input class="voirDetail" type="submit" value="Voir détail">
                        </form>

                    </div>   
                      
                @endforeach
            </div>
        @endif
        
        
    </div>
@endsection
