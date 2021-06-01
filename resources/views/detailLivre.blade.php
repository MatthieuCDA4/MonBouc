@extends('layouts.app')

@section('content')
    
    <div id="wrapperMainDetail">
        <div id="detailBox">

            <div class="titreDetail">
                <h1> {{ $detailLivre[0]->titre_livre}}</h1>
            </div>
            <div id="image">
                <div>
                    <img src="{{$detailLivre[0]->image}}" alt="">
                
                </div>
            </div>
            <div id="detail">
                <p>
                    Catégorie : {{ $detailLivre[0]->nom_genre}}
                    <br>
                    @for ($i = 0; $i < count($detailLivre); $i++)
                        Auteur {{$i+1}} : {{ $detailLivre[$i]->nom_a}} {{ $detailLivre[$i]->prenom_a}}
                        @if (  $i+1 < count($detailLivre))
                           <br> 
                        @endif   
                    @endfor
                    <br>
                    Editeur : {{ $detailLivre[0]->nom_e}}
                    <br>
                    Nombre pages : {{ $detailLivre[0]->nombre_page}}
                    <br> 
                    Etat :{{ $detailLivre[0]->integrite_du_livre}}
                    <br>
                    Code postal : {{ $detailLivre[0]->code_postal}}
                    <br>
                    Ville : {{ $detailLivre[0]->ville}}
                    <br>
                    Possedé par : {{ $detailLivre[0]->pseudo}}
                </p>


            </div>
            
            <div id="lien">
                <div>
                    <form action="{{route('emprunter')}}">
                        @csrf
                        <input type="hidden"  name="id_exemplaire" value="{{ $detailLivre[0]->id_exemplaire }}">
                        <input type="hidden"  name="pseudo" value="{{ $detailLivre[0]->pseudo }}">
                        <input type="hidden"  name="isbn" value="{{ $detailLivre[0]->isbn }}">
                        <input type="submit" value="Emprunter livre" class="boutonEmprunt">
                    </form>
                </div>
                
                <div>
                    <form action="{{route('ajouterCommentaire')}}" method="POST">
                        @csrf
                        <input type="hidden"  name="id_exemplaire" value="{{ $detailLivre[0]->id_exemplaire }}">
                        <input type="hidden"  name="pseudo" value="{{ $detailLivre[0]->pseudo }}">
                        <input type="text" name="avis" placeholder="commentaire">
                        <input type="hidden" name="isbn" value=" {{$detailLivre[0]->isbn}} ">
                        <input type="submit" value="Déposer commentaire"  class="boutonCommentaire">
                    </form>
                </div>
            </div>
            <div id="description">
                <h1>Description</h1>
                <p>
                    {{ $detailLivre[0]->resume}}
                </p>
            </div>
            <div id="commentaire">
                <h1>Commentaire</h1>

                @foreach ($listeCommentaire as $item)
                    <p>Le {{ $item->date_avis}} - {{$item->pseudo}} : {{$item->avis}}.  </p>
                @endforeach
            </div>
        </div>
    </div>
@endsection
