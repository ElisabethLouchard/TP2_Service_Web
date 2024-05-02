<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Critic;
use App\Repository\CriticRepositoryInterface;
use App\Http\Resources\CriticResource;
use Illuminate\Support\Facades\Auth;
use Exception;

class CriticController extends Controller
{
    private CriticRepositoryInterface $criticRepository;

    public function __construct(CriticRepositoryInterface $criticRepository) 
    {
        $this->criticRepository = $criticRepository;
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'score' => 'required',
            'comment'=> 'required', 
        ]);

        $filmId = $request->input('film_id');
        $existingCritic = Critic::where('user_id', $user->id)
                                ->where('film_id', $filmId)
                                ->first();

        if ($existingCritic) {
            return response()->json(['error' => 'Vous avez déjà critiqué ce film.'], FORBIDDEN);
        }else{
            $critic = $this->criticRepository->create($request->all());
            return (new CriticResource($critic))->response()->setStatusCode(CREATED);
        }      
    }
}
