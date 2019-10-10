<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    public $timestamps = false; // Désactiver une fonctionnalité que l'on utilise pas mtn

    /**
     * @return Retourne toutes les applications liées à la plateforme
     */
    public function applications(){
        return $this->belongsToMany(Application::class);
    }
}
