<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Models\AppSettings;
use App\Models\CurrencyRatesModel;
use App\Models\LottoSettings;
use App\Models\TypeOfGame;
use App\Traits\ErrorHelper;
use App\Traits\Generics;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    //
    use ErrorHelper, Generics;

    protected function Validator($request){

        $this->validator = Validator::make($request->all(), [//site_name 	address1 	address2 	email1 	site_url
            'title_of_game' => 'required',
            'type_of_game' => 'required',
            'total_numbers' => 'required',
            'total_numbers_to_select' => 'required',
            'total_numbers_for_result' => 'required',
            'total_number_days_before_draw' => 'required',
            'lowest_stack_amount' => 'required',
            'percentage_win' => 'required',
            'number_of_correct_correct_games' => 'required',
        ]);

    }

    public function create_game()
    {
        $game_type = new TypeOfGame;
        $game_types = $game_type->getAllModel();
        return view('dashboard.create_game', compact('game_types'));
    }

    public function createNewGame(Request $request){
        $data = $request->all();

        try{
            $this->Validator($request);//validate fields

            $unique_id = $this->createUniqueId('lotto_settings', 'unique_id');

            $currencyRate = new CurrencyRatesModel;
            $convertedPrice = $currencyRate->getAmountForDatabase($data['lowest_stack_amount']);

            $newGames = new LottoSettings;
            $newGames->unique_id = $unique_id;
            $newGames->title_of_game = $data['title_of_game'];
            $newGames->type_of_game_unique_id = $data['type_of_game'];
            $newGames->total_numbers = $data['total_numbers'];
            $newGames->total_numbers_to_select = $data['total_numbers_to_select'];
            $newGames->total_numbers_for_result = $data['total_numbers_for_result'];
            $newGames->total_number_days_before_draw = $data['total_number_days_before_draw'];
            $newGames->lowest_stack_amount = $convertedPrice['data']['amount'];
            $newGames->percentage_win = $data['percentage_win'];
            $newGames->number_of_correct_games_for_a_win = $data['number_of_correct_correct_games'];

            if ($newGames->save()){
                return redirect('/create_game')->with('success_message', 'Game Was Created Successfully');
            }else{
                return redirect('/create_game')->with('error_message', 'An Error occurred, Please try Again Later');
            }

        }catch (Exception $exception){

            $errorsArray = $exception->getMessage();
            return  redirect('create_game')->with('error_message', $errorsArray);

        }
    }

    function buildAddGameInterface(){
        $game_title = new AppSettings();
        $game_titles = $game_title->getAllModel();
        return view('dashboard.add_game', compact('game_titles'));
    }
}
