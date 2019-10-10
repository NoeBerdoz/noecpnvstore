<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    public $timestamps = false; // Désactiver une fonctionnalité que l'on utilise pas mtn

    /**
     * @return Retourne toutes les appplications à laquelle la catégorie appartient
     */
    public function applications() {

        return $this->hasMany(Application::class);
    }
}
