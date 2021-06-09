<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Ville;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        
        
        $db = new Ville();
        $id_ville = $db->getIdVille($input['code_postal'],$input['ville']);

        Validator::make($input, [
            'pseudo' => ['required', 'alpha', 'max:255'],
            'name' => ['required', 'alpha', 'max:255'],
            'firstname' => ['required', 'alpha', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'code_postal' => ['regex:/^\d{5}$/'],
        ])->validate();

        return User::create([
            'pseudo' => $input['pseudo'],
            'name' => $input['name'],
            'firstname' => $input['firstname'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'code_postal' => $input['code_postal'],
            'id_ville' => $id_ville[0]->id_ville,
            'date_naissance' => $input['date_naissance'],
        ]);
    }
}
