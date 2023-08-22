<?php

namespace App\Http\Controllers;

use App\Services\TeamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Team;

class TeamController extends Controller
{
    private $TeamService;

    public function __construct(TeamService $teamService)
    {
        $this->TeamService = $teamService;
    }

    public function GetAll(){
        $result = $this->TeamService->getAll();
        return response()->json($result,200);
    }
}
