<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(Request $request){
        
        $users = User::all();   
        
        foreach ($users as $user) {
            // atribui para cada objeto, o novo formato
            $user->data_formatada = Carbon::parse($user->date)->format('d/m/Y');
        }
    
        return view('home', ['users' => $users]);
    }

    public function search(Request $request){

        $data = $request->input('search');  
        
        
        if($data){ // existe? execute
            $users = User::where('name', 'like', '%'.$data.'%')
                       ->orWhere('email', 'like', '%'.$data.'%')                       
                       ->get();       
        return view('home', ['users' => $users]);
        
        }else{ // retorne
            
            $users = User::all();   
        
            foreach ($users as $user) {
                // atribui para cada objeto, o novo formato
                $user->data_formatada = Carbon::parse($user->date)->format('d/m/Y');
            }
        
            return view('home', ['users' => $users]);
        }
        
        
    }
}
