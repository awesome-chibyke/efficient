<?php

namespace App\Models;

use App\Http\Controllers\Faqs\FaqsController;
use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faqs extends Model
{
    use HasFactory, SoftDeletes, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;

    function createNewFaqs($request){
        $Faqs = new Faqs();
        $Faqs->unique_id = $this->createUniqueId('faqs', 'unique_id');
        $Faqs->question = $request->question;
        $Faqs->answer = $request->answers;
        $Faqs->save();
        return $Faqs;
    }

    function updateFaqs($request){
        $Faqs = Faqs::find($request->unique_id);
        $Faqs->question = $request->question ?? $Faqs->question;
        $Faqs->answer = $request->answer ?? $Faqs->answer;
        $Faqs->save();
        return $Faqs;
    }

    function getSingleRow($uniqueId){

        return Faqs::find($uniqueId);

    }

    function getAllRows($orderColumn = 'created_at', $orderType = 'desc'){

        return Faqs::orderBy($orderColumn, $orderType)->get();

    }

    function Faqs($conditions, $orderColumn = 'created_at', $orderType = 'desc'){

        return InvestmentReward::where($conditions)->orderBy($orderColumn, $orderType)->get();

    }
}
