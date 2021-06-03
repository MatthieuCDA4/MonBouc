@extends('layouts.app')


@section('content')
    @if ($errors->any())
    <div>
        <div>{{ __('Quelque chose s\'est mal passé') }}</div>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div id="wrapperMain">
        <div id="form">
            <h1>Page de création de la fiche livre</h1>
            <form action=" {{ route('ficheLivre')}} " method="GET">
                @csrf
                <div>
                    <div class="rowForm">
                        <label for="isbn">ISBN :</label>
                        <input id="isbn" type="text" name="isbn" placeholder="">
                    </div>
                    <div class="rowForm">
                        <label for="titre">Titre</label>
                        <input id="titre" type="text" name="titre" placeholder="">
                    </div>
                    
                    <div class="rowForm">
                        <label for="genre">Genre :</label>
                        <select name="genre" id="genre">
                            @foreach ($listeGenre as $item)
                                <option value=" {{ $item->nom_genre}} ">{{ $item->nom_genre}}</option>   
                            @endforeach
                        </select>        

                    </div>
                    
                    <div class="rowForm">
                        <label for="auteur1">Auteur1 :</label>
                        <input id="auteur1" type="text" name="auteur1" placeholder="">
                    </div>

                    <div class="rowForm">
                        <label for="auteur2">Auteur2 :</label>
                        <input id="auteur2" type="text" name="auteur2" placeholder="Facultatif">
                    </div>


                    <div class="rowForm">
                        <label for="editeur">Editeur :</label>
                        <input id="editeur" type="text" name="editeur" placeholder="">
                    </div>

                    <div class="rowForm">
                        <label for="adresseEditeur"> Adresse editeur :</label>
                        <input id="adresseEditeur" type="text" name="adresse_e" placeholder="">
                    </div>

                    <div class="rowForm">
                        <label for="postalEditeur">Code postal Editeur:</label>
                        <input id="postalEditeur" type="text" name="code_postal" placeholder="">
                    </div>

                    <div class="rowForm">
                        <label for="nbPage">Nombre de pages :</label>
                        <input id="nbPage" type="number" name="nombre_page" style="-moz-appearance: textfield">
                    </div>
                    

                    <div class="rowForm">
                        <label for="etat">Etat du livre :</label>
                        <select name="integrite_du_livre" id="etat">
                            @foreach ($listeEtat as $item)
                                <option value=" {{ $item->integrite_du_livre}} ">{{ $item->integrite_du_livre}}</option>   
                            @endforeach
                        </select>        
                        

                    </div>

                    <div class="rowForm">
                        <label for="imageCouverture">Image de couverture :</label>
                        <input id="imageCouverture" type="text" name="image" placeholder="Exemple.png">
                    </div>
                    
                    <div class="rowForm">
                        <label for="commentaireUtilisateur">Commentaire :</label>
                        <input id="commentaireUtilisateur" type="text" name="commentaire" placeholder="">
                    </div>


                    <div class="rowForm">
                        <label for="resume">Résumé :</label>
                        <textarea id="resume"  name="resume" rows="5" cols="33"></textarea>
                    </div>
                    
                    <div class="rowFormEnvoie">
                        <input class="boutonEnvoie" type="submit" value="Envoyer">
                        
                    </div>
                </div> 
            </form>   
        </div> 
    </div>
@endsection