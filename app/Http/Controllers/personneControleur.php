<?php

namespace App\Http\Controllers;
use App\Models\personne;
use Illuminate\Http\Request;

class personneControleur extends Controller
{
      public function index()
{
    // On récupère tous les utilisateurs
    $users = personne::all();

    // On retourne les informations des utilisateurs en JSON
    return response()->json($users);
}
public function show($id)
{
    $user = personne::find($id);
    return response()->json($user, 200);

}
public function store(Request $request)
{
    // La validation de données
    $this->validate($request, [
        'nom' => 'required',
        'prenom' => 'required',
        'email' => 'email',
       
    ]);

    // On crée un nouvel utilisateur
    $user = personne::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
         'email' => $request->email,
        
    ]);
    
    
    // On retourne les informations du nouvel utilisateur en JSON
    return response()->json($user, 201);
}
public function update(Request $request,personne $user)
{
    //La validation de données
    $this->validate($request, [
        'nom' => 'required',
        'prenom' => 'required',
         'email' => 'required',
       
    ]);

    // On modifie les informations de l'utilisateur

    $user->update([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
         'email' => $request->email,
    ]);

    // On retourne la réponse JSON
    return response()->json();
}

public function destroy(personne $user)
{
    // On supprime l'utilisateur
    $user->delete();

    // On retourne la réponse JSON
    return response()->json();
}
}
