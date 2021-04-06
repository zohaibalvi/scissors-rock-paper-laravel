<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Point;

class RpsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('rps.mainScreen');
    }
    public function mainScreen()
    {
        return view('rps.index');
    }
    public function playAsAGuest()
    {
        Auth::logout();
        return view('rps.mainScreen');
    }
    function generate_computer_choice()
    {
        $computer = rand(0, 90);
        if ($computer < 30) {
            $computer_choice = "rock";
            return $computer_choice;
        } elseif ($computer > 29 && $computer < 60) {
            $computer_choice = "paper";
            return $computer_choice;
        } else {
            $computer_choice = "scissors";
            return $computer_choice;
        }
    }

    function compare_choices($player_choice, $computer_choice)
    {
        // -1 = player wins
        //  0 = tie
        //  1 = computer wins
        if ($player_choice == $computer_choice) {
            return 0;
        } elseif ($player_choice == "rock" && $computer_choice == "scissors") {
            return -1;
        } elseif ($player_choice == "scissors" && $computer_choice == "paper") {
            return -1;
        } elseif ($player_choice == "paper" && $computer_choice == "rock") {
            return -1;
        } else {
            return 1;
        }
    }

    function display_results($result, $player_choice, $computer_choice)
    {
        $user = "Guest";
        if (Auth::check()) {
            $user = Auth::user();
            $data['id'] = $user['id'];
            $user = $user['name'];
        }
        $data = [
            'status' => $result,
            'player_choice' => $player_choice,
            'computer_choice' => $computer_choice,
            'user_name' => $user,
        ];
        echo json_encode($data);
    }

    public function rps(Request $request)
    {
        $player_choice = $request->choice;
        $computer_choice = $this->generate_computer_choice();

        $result = $this->compare_choices($player_choice, $computer_choice);
        $this->display_results($result, $player_choice, $computer_choice);
    }
    public function savePointRecords(Request $request)
    {
        if (!Auth::check())
            return  response()->json(true);

        $user = Auth::user();

        $data = [
            'u_id' => $user['id'],
            'computer_points' => (int)$request->data['computer_count'],
            'player_points' => (int)$request->data['player_count']
        ];
        Point::create($data);
        return  response()->json($data);
    }
}
