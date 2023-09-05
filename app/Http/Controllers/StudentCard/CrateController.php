<?php

declare(strict_type=1);

namespace App\Http\Controllers\StudentCard;

use App\Enums\SchoolEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;


class CrateController extends Controller
{
   
    public function __invoke() : View
    {
        return view('student_cards.create', [
            'users' => User::whereNot('id', auth()->id())->get(),
            'schools' => SchoolEnum::cases(),

        ]);
    }
}
