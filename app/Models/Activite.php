<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Activite extends Model
{
    use HasFactory;
    public function activiteEmpruntUsers()
    {
        return DB::select('SELECT p.date_emprunt, l.titre_livre FROM posseder p JOIN livre l ON p.isbn = l.isbn WHERE p.id = (?)  ORDER BY date_emprunt desc', [auth()->user()->id]);
    }

    public function activiteDepotUsers()
    {
        return DB::select('SELECT p.date_retour, l.titre_livre FROM posseder p JOIN livre l ON p.isbn = l.isbn WHERE p.id = (?) AND p.date_retour IS NOT NULL ORDER BY date_retour desc', [auth()->user()->id]);
    }
}
