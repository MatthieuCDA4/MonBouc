<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ville extends Model
{
    use HasFactory;

    public function  getIdVille($cp, $v)
    {
         return DB::select('SELECT id_ville FROM ville WHERE code_postal = ? AND ville = ?', [$cp ,$v]);
    }
}
