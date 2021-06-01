<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NewFicheLivre extends Model
{
    use HasFactory;

    public function formulaireLivre($newIsbn, $newtitreLivre, $newGenre, $newAuteur1, $newEditeur, $newAdressseEditeur, 
                                  $newCodePostalEditeur, $newNombrePage , $newIntegriteDuLivre, $newImage, $newCommentaire, $NewResume, $newAuteur2 = null)
    {
        // test si nomediteur exist dans bdd

        $editeurExiste = DB::select('SELECT nom_e FROM editeur WHERE nom_e = (?)', [$newEditeur]);

        // si nomediteur n'existe pas insert le dans la table editeur

        if ($editeurExiste == NUll) 
        {
            $idVille = DB::select('SELECT id_ville FROM ville WHERE code_postal = (?)', [$newCodePostalEditeur]);

            DB::insert('INSERT INTO editeur (nom_e, adresse_e, id_ville) VALUES (?,?,?)', [$newEditeur,$newAdressseEditeur,$idVille[0]->id_ville]);
        }

        // recupere-moi id Editeur correspondant a nomediteur

        $idEditeur = DB::select('SELECT ID_Editeur FROM editeur WHERE nom_e = (?) ', [$newEditeur]);

        //===============================================================================================================================================

        // test si nom auteur exist dans bdd
        list($prenom, $nom) = explode(" ", $newAuteur1);
        
        
        $auteurExiste = $this->rechercheAuteur($nom, $prenom);
        
        // si nom auteur n'existe pas insert le dans la table auteur

        if (!$auteurExiste) 
        {         
            DB::insert('INSERT INTO auteur (nom_a, prenom_a) VALUES (?,?)', [ $nom, $prenom]);
        }
         
        if ($newAuteur2 != null) 
        {
            list($prenom2, $nom2) = explode(" ", $newAuteur2);

            $auteur2Existe = $this->rechercheAuteur($nom2, $prenom2);
            
    
            // si nom auteur n'existe pas insert le dans la table auteur
    
            if (!$auteur2Existe)
            {
                DB::insert('INSERT INTO auteur (nom_a, prenom_a) VALUES (? , ?)', [ $nom2, $prenom2]);
            }
        }

        // recupere-moi id auteur correspondant a nom_a
        $idAuteur = DB::select('SELECT id_auteur FROM auteur WHERE nom_a = (?)  AND prenom_a = (?)', [$nom, $prenom ]);

        if ($newAuteur2 != null) 
        {
            list($prenom2, $nom2) = explode(" ", $newAuteur2);
            $idAuteur2 = DB::select('SELECT id_auteur FROM auteur WHERE nom_a = (?)  AND prenom_a = (?)', [$nom2, $prenom2]);
        }
         
        //===============================================================================================================================================

        // récupération de l'id genre

        $idGenre = DB::select('SELECT id_genre FROM genre WHERE nom_genre = (?)', [$newGenre]);

        //===============================================================================================================================================

        // test si livre exist dans bdd

        $livreExiste = DB::select('SELECT isbn FROM livre WHERE isbn = (?)', [$newIsbn]);

        // si nom livre n'existe pas insert le dans la table livre
        

        if ($livreExiste == NULL) 
        {
            DB::insert('INSERT INTO livre(isbn, titre_livre, nombre_page, resume, image, ID_Editeur, id_genre) VALUES(?,?,?,?,?,?,?)', 
            [$newIsbn, $newtitreLivre, $newNombrePage, $NewResume, $newImage, $idEditeur[0]->ID_Editeur, $idGenre[0]->id_genre]);
            
            //===============================================================================================================================================
    
            // insertion écrits

            DB::insert('INSERT INTO ecrit(isbn, id_auteur) VALUES(?,?)', [ $newIsbn,$idAuteur[0]->id_auteur]);
            if ($newAuteur2 != null) 
            {
                DB::insert('INSERT INTO ecrit(isbn, id_auteur) VALUES(?,?)', [ $newIsbn,$idAuteur2[0]->id_auteur]);
            }
            
        }
        
        //===============================================================================================================================================

        // insertion exemplaire

        DB::insert('INSERT INTO exemplaire(integrite_du_livre, isbn) VALUES(?,?)', [$newIntegriteDuLivre, $newIsbn]);
        $idExemplaire = DB::select('SELECT id_exemplaire FROM exemplaire WHERE isbn = (?) ', [$newIsbn]);

        //===============================================================================================================================================

        // insertion donner_un_avis

        DB::insert('INSERT INTO donner_un_avis(id, isbn, avis) VALUES(?,?,?)', [ auth()->user()->id,$newIsbn,$newCommentaire]);

        //===============================================================================================================================================

        // insertion posseder

        DB::insert('INSERT INTO posseder(id, isbn, id_exemplaire, date_retour) VALUES(?,?,?,?)', [ auth()->user()->id, $newIsbn, $idExemplaire[0]->id_exemplaire, now()]);


        // insertion jeton

        DB::update('UPDATE users SET nombre_jeton = nombre_jeton +1 WHERE id = (?)', [auth()->user()->id]);
    }

    public function rechercheAuteur( string $nom, string $prenom)
    {
        if (DB::select('SELECT id_auteur FROM auteur WHERE nom_a = ?  AND prenom_a = ?', [ $nom, $prenom])) 
        {
            return true;
        }
        else
        {
            return false;

        }
        
    }

}
