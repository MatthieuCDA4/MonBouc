<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\NewFicheLivre;
use App\Models\Activite;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class MesController extends Controller
{
    public function login()
    {
        $titre = 'Connexion';
        $db = new livre();
        $rechercheVille = $db->loginRechercheLivre(env('APP_VILLE'));
        return view('auth.login')->with('title', $titre)
                                 ->with('rechercheLivre', $rechercheVille);
    }

    public function loginRechercheLivre(Request $request)
    {
        $titre = 'Connexion';
        $db = new livre();
        $ville = $request->input('rechercheVille');
        $rechercheVille = $db->loginRechercheLivre($ville);

        return view('auth.login')->with('title', $titre)
                                 ->with('rechercheLivre', $rechercheVille);
    }

    public function home()
    {
        $titre = 'accueil';
        $db =  new Livre();
        $dispo =$db->livreDisponible();
        $populaire = $db->livrePopulaire();
        $recent = $db->livreRecent();

        return view('home')->with('title', $titre)->with('dispo', $dispo)
                                                  ->with('populaire', $populaire)
                                                  ->with('recent', $recent);
    }
    
    public function homeUsers(request $request)
    {
        $titre = 'accueil';
        $db =  new Livre();
        $recherche = $request->input('rechercheIsbn');
        $dispo =$db->LivreDisponible($recherche);
        $populaire = $db->livrePopulaire();
        $recent = $db->livreRecent();
        return view('home') ->with('title', $titre)
                            ->with('populaire', $populaire)
                            ->with('recent', $recent)
                            ->with('dispo', $dispo);
        
    }
    
    public function rechercheLivreDispo(request $request )
    {
        $titre = 'Recherhe';
        $db =  new Livre();
        $recherche = $request->input('recherche');
        $dispo =$db->LivreDisponible($recherche);
        $listeGenre = $db->listeGenre();
        $listeEtat = $db->listeEtat();
        $listeAuteur = $db->listeAuteur();
        $listeIsbn = $db->listeIsbn();

        return view('pageDeRecherche')->with('title', $titre)
                                      ->with('dispo', $dispo)
                                      ->with('listeGenre', $listeGenre)
                                      ->with('listeEtat', $listeEtat)
                                      ->with('listeAuteur', $listeAuteur)
                                      ->with('listeIsbn', $listeIsbn);
    }
    
    public function rechercheLivre(request $request)
    {

        $titre = 'Recherhe';
        $db =  new Livre();
        $recherche = $request->input("check");     
        $listeGenre = $db->listeGenre();
        $listeEtat = $db->listeEtat();
        $listeAuteur = $db->listeAuteur();
        $listeIsbn = $db->listeIsbn();
        $rechercheDispo =$db->rechercheLivreDisponible($recherche);
        return view('pageDeRecherche')->with('title', $titre)
                                      ->with('dispo', $rechercheDispo)
                                      ->with('listeGenre', $listeGenre)
                                      ->with('listeEtat', $listeEtat)
                                      ->with('listeAuteur', $listeAuteur)
                                      ->with('listeIsbn', $listeIsbn);
    }

    public function formulaireLivre()
    {
        $titre = 'Ajouter un livre';
        $db = new livre();
        $listeGenre = $db->listeGenre();
        $listeEtat = $db->listeEtat();
        return view('ajouterLivre')->with('title', $titre)
                                   ->with('listeGenre', $listeGenre)
                                   ->with('listeEtat', $listeEtat);
    }

    public function ajouterLivre(request $request)
    {
        
        $this->validate( $request, [
            'isbn'               => 'required|min:10|max:13',
            'titre'              =>'required|max:255',
            'genre'              =>'required|max:255',
            'auteur1'            =>'required|max:255',
            'auteur2'            =>'max:255',
            'editeur'            =>'required|',
            'code_postal'        =>'min:5|max:5',
            'nombre_page'        =>'required|max:20',
            'integrite_du_livre' =>'required|',
            'image'              =>'required|max:255',
            'commentaire'        =>'max:255',
            'resume'             =>'required|max:1500',
        ]);

        $titre = 'Ajouter un livre';

        $db = new NewFicheLivre();
        $db2 = new Livre();

        $listeGenre = $db2->listeGenre();
        $listeEtat = $db2->listeEtat();
        $livreDetail= $db2->detailAllBooks();

        $newIsbn              = $request->input('isbn');
        $newtitreLivre        = $request->input('titre');
        $newGenre             = $request->input('genre');
        $newAuteur1           = $request->input('auteur1');
        $newAuteur2           = $request->input('auteur2');
        $newEditeur           = $request->input('editeur');
        $newAdressseEditeur   = $request->input('adresse_e');
        $newCodePostalEditeur = $request->input('code_postal');
        $newNombrePage        = $request->input('nombre_page');
        $newIntegriteDuLivre  = $request->input('integrite_du_livre');
        $newImage             = $request->input('image');
        $newCommentaire       = $request->input('commentaire');
        $NewResume            = $request->input('resume');
        if ( is_null($newAuteur2)) 
        {
            $db->formulaireLivre($newIsbn, $newtitreLivre, $newGenre, $newAuteur1, $newEditeur, $newAdressseEditeur, $newCodePostalEditeur, $newNombrePage,
                                 $newIntegriteDuLivre, $newImage, $newCommentaire, $NewResume, null);
        }
        else
        {
            $db->formulaireLivre($newIsbn, $newtitreLivre, $newGenre, $newAuteur1, $newEditeur, $newAdressseEditeur, $newCodePostalEditeur, $newNombrePage,
             $newIntegriteDuLivre, $newImage, $newCommentaire, $NewResume, $newAuteur2);
        }
        return view('ajouterLivre')->with('title', $titre)
                                   ->with('listeGenre', $listeGenre)
                                   ->with('listeEtat', $listeEtat)
                                   ->with('livreDetail', $livreDetail);
    }

    public function detailLivre(request $request)
    {
        $titre = 'Détail du livre';
        $db = new livre();
        $titreLivre = $request->input('id_exemplaire');
        $pseudo = $request->input('pseudo');
        $isbn = $request->input('isbn');
        $listeCommentaire = $db->listeCommentaire($isbn);
        $livreDetail = $db->detailLivre($titreLivre, $pseudo);
        return view('detailLivre')->with('title', $titre)
                                  ->with('detailLivre', $livreDetail)
                                  ->with('listeCommentaire', $listeCommentaire);
    }

    public function ajouterCommentaire(request $request)
    { 
       
        $titre = 'Détail du livre';
        $db = new livre();
        $commentaire = $request->input('avis');
        $isbn = $request->input('isbn');
        $titreLivre = $request->input('id_exemplaire');
        $pseudo = $request->input('pseudo');
        $db->ajoutCommentaire($commentaire, $isbn);
        $listeCommentaire = $db->listeCommentaire($isbn);
        $livreDetail = $db->detailLivre($titreLivre, $pseudo);
        return view('detailLivre')->with('title', $titre)
                                  ->with('detailLivre', $livreDetail)
                                  ->with('listeCommentaire', $listeCommentaire);
    }

    public function register()
    {
        $titre = 'Formulaire';
        return view('auth.register')->with('title', $titre);
    }

    public function pageConstruction()
    {
        $titre = 'Travaux';
        return view('PartiePasFini')->with('title', $titre);
    }

    public function Activite()
    {
        $titre = 'Activité';
        $db = new Activite();
        $db2 = new livre();
        $emprunt = $db->activiteEmpruntUsers();
        $depot = $db->activiteDepotUsers();
        $livrePosseder = $db2->livreUsers();
        
        return view('Activiter')->with('title', $titre)
                                ->with('emprunt', $emprunt)
                                ->with('depot', $depot)
                                ->with('livre', $livrePosseder);
    }

    public function deposerLivre(request $request)
    {
        // dd($request);
        $titre = 'Activité';
        $db = new Activite();
        $db2 = new livre();
        $id_exemplaire = $request->input('id_exemplaire');
        $db2->deposerLivre($id_exemplaire);
        $emprunt = $db->activiteEmpruntUsers();
        $depot = $db->activiteDepotUsers();
        $livrePosseder = $db2->livreUsers();
        return view('Activiter')->with('title', $titre)
                                ->with('emprunt', $emprunt)
                                ->with('depot', $depot)
                                ->with('livre', $livrePosseder);
    }

    public function empruntLivre(request $request)
    {
        $titre = 'Emprunter';
        $db = new livre();
        $exemplaire = $request->input('id_exemplaire');
        $isbn = $request->input('isbn');
        $db->emprunterLivre($exemplaire, $isbn);
        $pseudo = $request->input('pseudo');
        $livreDetail = $db->detailLivre($exemplaire, $pseudo);
        return view('emprunt')->with('title', $titre)
                              ->with('livreDetail',$livreDetail);
    }
    
    public function obtenirLivre(request $request)
    {
        
        $titre = 'Emprunter';
        $db = new livre();
        $exemplaire = $request->input('id_exemplaire');
        $pseudo = $request->input('pseudo');
        $livreDetail = $db->detailLivre($exemplaire, $pseudo);

        return view('emprunt')->with('title', $titre)
                              ->with('livreDetail',$livreDetail);
    }
}

