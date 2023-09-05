<?php

namespace App\Http\Controllers\StudentCard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
   
    public function __invoke(Request $request) : View
    {
        return view('student_cards.store');
    }
}
