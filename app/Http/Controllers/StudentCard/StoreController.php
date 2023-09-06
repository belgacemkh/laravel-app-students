<?php

declare(strict_type=1);

namespace App\Http\Controllers\StudentCard;

use App\Http\Requests\StudentCard\StoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\StudentCard;

class StoreController extends Controller
{
   
    public function __invoke(
        StoreRequest $request,
    ){
      
        dd(StudentCard::create($request->validated())); 
    }
}
