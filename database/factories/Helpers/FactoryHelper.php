<?php

namespace Database\Factories\Helpers;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class FactoryHelper
{
    /**
     * This function will get a random model id from database.
     * @param string | HasFactory Model
     */
    public static function getRandomModelId(string $model){
        $count = $model::query()->count() ;

        if($count ===0){
            return $model::factory()->create()->id ;
        }else{
            return rand(1,$count) ;
        }
    }

}
