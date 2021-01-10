<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfGame extends Model
{
    use HasFactory, Generics;
    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;

    //get list of all type of game
    function getAllModel($columnNameForOrder = 'id', $order = 'desc'){
        return TypeOfGame::orderBy($columnNameForOrder, $order)->get();
    }

    function insertGameTypeIntoModel($request){
        //unique_id type_of_game deleted_at 	created_at 	updated_at
        $GameType = new TypeOfGame;
        $GameType->unique_id = $this->createUniqueId('type_of_games', 'unique_id');
        $GameType->type_of_game = $request->type_of_game;
        $GameType->save();
        return $GameType;
    }
}
