<?php

namespace App\Http\Controllers;

use App\Application;
use App\AppUser;
use App\Category;
use App\Platform;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @description : Charge la page welcome.blade.php en fournissant les données des applications
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $apps = Application::all(); // :: = SELECT * FROM applications
        $categories = Category::all();
        $plateformes = Platform::all();

        return view('welcome')->with(compact('apps', 'categories', 'plateformes')); // Manière d'emballer toutes les données pour l'envoyer à la vue
    }

    /**
     * @description : Charge la page details.blade.php et apporte les données en fonction de l'application
     * @param $id : id de l'application
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id) {
        $app= Application::find($id); //Recherche de l'id par Eloquent
        return view('details')->with(compact('app')); // Création de l'objet app contenant tout l'id
    }

    /**
     * @description Prise en compte des valeurs mise dans le formulaire lors du submit
     * @param Request $request, indication du type de la variable avec du type hinting
     */
    public function newapp(Request $request) { // Pas nécessaire de donner les types des variables en PHP
        $appname = $request->input('newname');
        $categoryid = $request->input( 'category');

        $newapp = new Application(); // Création d'une nouvelle instance, objet en mémoire
        $newapp->name = $appname;
        $newapp->description =("var description (à compléter)");
        $newapp->category_id = $categoryid;
        $newapp->save(); // Termine le processus en mémoire pour l'enregistrer dans la bdd ( méthode save du eloquent)

        return $this->index();
    }

}
