<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public $timestamps = false; // Désactiver une fonctionnalité que l'on utilise pas mtn

    /**
     * @description : Permet de récupérer les informations liée à l'application concernant la catégorie
     * @return Toutes les catégories à laquelle appartient une application
     */
    public function category()
    {
        return $this->belongsTo(Category::class); //Une application appartient à une catégorie
    }

    /**
     * @description :
     * @return Retourne toutes les plateformes à laquelle appartient une application, en plus de leurs version minimale ainsi que de l'installer
     */
    public function platforms()
    {
        return $this->belongsToMany(Platform::class)->withPivot('minversion', 'installer');
    }

    /**
     * @return Retourne les utilisateurs de l'application avec leurs rôles
     */
    public function users()
    {
        return $this->belongsToMany(AppUser::class, 'application_supplier', 'application_id', 'user_id')->withPivot('role_id');
    }

}
