<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Livre extends Model
{
    use HasFactory;

    public function livreDisponible($recherche = false) 
    { /** 
        *retourne tout les livres disponible
        */ 
        
        if ($recherche == false || $recherche == null ) 
        {
            return DB::select('SELECT DISTINCT image, nombre_page, nom_genre, code_postal, ville, titre_livre, id_exemplaire, pseudo, isbn FROM livreDispo WHERE integrite_du_livre <> "Detruit"'); 
           
        }
        else
        {
            return DB::select('SELECT DISTINCT image, nombre_page, nom_genre, code_postal, ville, titre_livre FROM livreDispo WHERE integrite_du_livre <> "Detruit" AND isbn = (?) ', [$recherche]); 
        }
    }

    public function rechercheLivreDisponible($recherche) 
    { /** 
        * recherche livres disponible
        */ 

        if ( is_numeric($recherche)) 
        {
            return  DB::select('SELECT DISTINCT * FROM livreDispo WHERE integrite_du_livre <> "Detruit" AND id_auteur IN (?) ', [$recherche]);
        }
        elseif ($recherche == 'bon' || $recherche == "tres bon" || $recherche == 'moyen' || $recherche == 'mauvais') 
        {
            return  DB::select('SELECT DISTINCT * FROM livreDispo WHERE integrite_du_livre <> "Detruit" AND integrite_du_livre IN (?) ', [$recherche]); 
        }
        else 
        {      
            return  DB::select('SELECT DISTINCT * FROM livreDispo WHERE integrite_du_livre <> "Detruit" AND nom_genre IN (?) ', [$recherche]);      
        }
        
    }

    public function listeGenre()
    {
        return DB::select('SELECT nom_genre FROM genre ORDER BY nom_genre asc');
    }

    public function listeEtat()
    {
        return DB::select('SELECT DISTINCT integrite_du_livre FROM exemplaire WHERE integrite_du_livre <> "Detruit"');
    }

    public function listeAuteur()
    {
        return DB::select('SELECT * FROM auteur');
    }

    public function listeIsbn()
    {
        return DB::select('SELECT isbn FROM livre');
    }

    public function localisationLivre() 
    { /** 
        * recherche la ville où se situe le livre
        */ 
        
        return DB::select('SELECT * FROM posseder p JOIN users u ON p.id = u.id JOIN ville v ON v.id_ville =  u.id_ville'); 
    
    }

    public function getAllLivrePosseder() 
    { /** 
        * Utilisation de la façade DB::select
        */ 
        
        return DB::select('SELECT * FROM posseder WHERE id = (?)', [auth()->user()->id]); 
    
    }

    public function loginRechercheLivre($ville)
    {
        return DB::select('SELECT * FROM livreDispo WHERE integrite_du_livre <> "Detruit" AND ville = (?)', [$ville]); 
    }

    public function detailLivre($idExemplaire, $pseudo)
    {
        
        return DB::select('SELECT * FROM detailLivre WHERE id_exemplaire =(?) AND pseudo = (?)', [$idExemplaire, $pseudo]);
    }

    public function detailAllBooks()
    {
        return DB::select('SELECT * FROM detailLivre');
    }


    public function listeCommentaire($isbn)
    {
       return DB::select('SELECT * FROM commentaire WHERE isbn = (?)', [$isbn]);
    }

    public function ajoutCommentaire($commentaire, $isbn)
    {
        DB::insert('INSERT INTO donner_un_avis (id, isbn, avis) VALUES (?,?,?)', [auth()->user()->id, $isbn, $commentaire]);
    }

    public function livreUsers()
    {
        return DB::select('SELECT * FROM posseder p JOIN livre l ON p.isbn = l.isbn JOIN genre g ON g.id_genre = l.id_genre WHERE p.id = ? AND p.date_retour IS NULL', [auth()->user()->id]);
    }

    public function emprunterLivre($idExemplaire, $isbn)
    {       
        DB::update('INSERT INTO posseder(id, isbn, id_exemplaire, date_emprunt, date_retour) VALUES(?,?,?,?,?)', [auth()->user()->id,$isbn, $idExemplaire, now(), null]);

        DB::update('UPDATE users SET nombre_jeton = nombre_jeton - 1 WHERE id = (?)', [auth()->user()->id]);
    }

    public function deposerLivre($id_exemplaire)
    {
        DB::update('UPDATE posseder 
        SET date_retour = (?) 
        WHERE id_exemplaire = (?) AND id = (?) ', [now(), $id_exemplaire, auth()->user()->id]);

        DB::update('UPDATE users SET nombre_jeton = nombre_jeton + 1 WHERE id = (?)', [auth()->user()->id]);
    }

    public function livrePopulaire()
    {
        return DB::select('SELECT DISTINCT  * FROM detaillivrepopulaire dlp JOIN livrepopulaire lp ON dlp.id_exemplaire = lp.id_exemplaire');
    }

    public function livreRecent()
    {
        return DB::select('SELECT DISTINCT * FROM detaillivrepopulaire WHERE id_exemplaire in (SELECT id_exemplaire FROM livrerecent)');
    }

}
