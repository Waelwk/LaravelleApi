<?php

namespace App\Http\Controllers;
use App\Models\personne;
use Illuminate\Http\Request;

class personneControleur extends Controller
{
      public function index()
{
    // On récupère tous les utilisateurs
    $pers = personne::all();

    // On retourne les informations des utilisateurs en JSON
    return response()->json($pers);
}
public function show($id)
{
    $per = personne::find($id);
    return response()->json($per, 200);

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
    $per = personne::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
         'email' => $request->email,
        
    ]);
    
    
    // On retourne les informations du nouvel utilisateur en JSON
    return response()->json($per, 201);
}
public function update(Request $request, $id)
{
    //La validation de données
    $this->validate($request, [
        'nom' => 'required',
        'prenom' => 'required',
         'email' => 'required',
       
    ]);

    // On modifie les informations de l'utilisateur

        $per = personne::findOrFail($id);

    $per->update([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
         'email' => $request->email,
    ]);

    // On retourne la réponse JSON
     return response()->json($per, 200);
}

public function destroy($id)
{
    // On supprime l'utilisateur
    personne::destroy($id);

    // On retourne la réponse JSON
       return response()->json(["res" => "ok"], 201);
}
}
