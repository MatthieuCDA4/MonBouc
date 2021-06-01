@extends('layouts.app')

@section('content')

    <fieldset>
        <legend>Livre populaire</legend>
            <div id="wrapperMain">
                
                @foreach ( $populaire  as $item)
                <div class= "box">
                    <img src="{{$item->image }}" alt=" {{ $item->titre_livre }} ">
                    
                    <p>{{ $item->titre_livre }}
                        <br>
                        Nombre pages :<br>
                        {{ $item->nombre_page }}<br>
                        <br>
                        Catégorie :<br>
                        {{ $item->nom_genre }}<br>  
                    </p>
                </div>     
                @endforeach
                
            </div>
    </fieldset>

    <fieldset>
        <legend>Livre Reçent</legend>
            <div id="wrapperMain">
                
                @foreach ( $recent  as $item)
                <div class= "box">
                    <img src="{{$item->image }}" alt=" {{ $item->titre_livre }} ">
                    
                    <p>{{ $item->titre_livre }}
                        <br>
                        Nombre pages :<br>
                        {{ $item->nombre_page }}<br>
                        <br>
                        Catégorie :<br>
                        {{ $item->nom_genre }}<br>  
                    </p>
                    
                </div>     
                @endforeach
                
            </div>
        </fieldset>
    
        <div id="boutonValider">
            <form action=" {{ route('home')}} " method="POST">
                @csrf
                <input type="submit"  value="Valider">
                <input type="text" id="texte" name="rechercheIsbn" placeholder="Ex : ISBN">
            </form>
        </div>
    
    <fieldset>
        @if ($dispo == null)
            <div class="padDeLivre">

                <p>Le livre n'est pas disponible ou il n'existe pas. Voulez-vous ajouter une fiche ou un exemplaire.</p>
                <a href="{{route('ficheLivre')}}">Ajouter un livre</a> 
            </div>

        @else

        <legend>Livre Disponible</legend>
        <div id="wrapperMain">
            @foreach ( $dispo  as $item)
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
                {{-- <a href="  {{route('detailLivre')}} ">Voir détail</a> --}}
            </div>     
            @endforeach
            
        </div>
    </fieldset>
        
    @endif
@endsection