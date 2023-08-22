<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\UpgradeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UpgradeController extends Controller
{
    private $UpgradeService;

    public function __construct(UpgradeService $upgradeService)
    {
        $this->UpgradeService = $upgradeService;
    }

    public function GetAll(){
        $result = $this->UpgradeService->getAll();
        return response()->json($result,200);
    }

}
