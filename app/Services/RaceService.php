<?php

namespace App\Services;

use App\Models\Ship;
use App\Models\User;
use App\Models\Team;
use App\Models\Athlete;
use App\Models\Upgrade;
use App\Models\Stage;
use App\Models\WeatherEffect;
use App\Models\Race;

class RaceService extends Service
 {
    public function createRace( $stageId, $wathers, $raceDate )
 {
        $stage = Stage::findOrFail( $stageId );
        foreach ( $wathers as $weather ) {
            $weather = WeatherEffect::findOrFail( $weather );
            $stage->weatherEffects->attach( $wather );
        }
        $stage->save();

        $race = new Race();
        $race->stage_id = $stageId;
        $race->race_date = $raceDate;
        $race->result = '';
        $race->save();

        return $this->OkResult( $race );
    }

    public function getAll()
 {
        $races = Race::with( 'stage' )->with( 'stage.weatherEffects' )->get();
        return $this->OkResult( $races );
    }

    public function simulateRaceByDate( $raceDate ) {

        $race = Race::where( 'race_date', '<=', $raceDate )->with( 'stage' )->with( 'stage.weatherEffects' )->first();
        $race->results = 'simulated';
        $race->race_finished = true;
        $race->save();

        return $this->OkResult( $race );
    }

    public function simulateRaceById( $raceId ) {
        $race = Race::findOrFail( $raceId )->with( 'stage' )->with( 'stage.weatherEffects' )->first();
        $raceResult = $this->_simulateRace( $race );

        return $this->OkResult( $raceResult );
    }

    public function raceResultById( $raceId ) {

    }

    private function _simulateRace( $race ) {
        $teams = Team::with('users')->get();
        $users = User::with( 'ship' )->with( 'ship.upgrades' )->with( 'ship.athletes' )->get();
        $stage = $race->stage;
        $weatherEffects = $stage->weatherEffects;

        $raceTimes = [];
        foreach ( $users as $user ) {
            $this->_calculateShipSpeedAndAcceleration( $user->ship, $weatherEffects );
            $time = intval( $stage->distance / $user->ship->speed + $user->ship->acceleration );

            if ( count( $raceTimes )>0 && array_key_exists( $time, $raceTimes ) ) {
                $raceTimes[ $time ][] = $user;

            } else {
                $raceTimes[ $time ] = [ $user ];
            }
        }

        $totalPrize = $stage->total_prize;
        $remainingPrize = $totalPrize;
        $position = 1;

        ksort( $raceTimes );

        $raceUserResults = [];
        foreach ( $raceTimes as $key => $users ) {
            if ( $position === 1 ) {
                $prize = floor( $remainingPrize * 0.4 );
            } else {
                $prize = floor( $remainingPrize * 0.4 );
            }
            if ( $remainingPrize < 1 ) {
                $prize = 0;
            }
            foreach ( $users as $user ) {
                $ship = $user->ship;
                $userPrize = $prize;
                // Apply prize multiplier upgrade if present

                $prizeMultiplierUpgrade = $ship->upgrades->where( 'upgrade_type', 'prize' )->first();
                if ( $prizeMultiplierUpgrade ) {
                    $userPrize *= ( $prizeMultiplierUpgrade->value / 100 );
                }
                $points = $this->_calculatePositionPoints($position);

                $user->money += $userPrize;
                $user->points += $points;
                $user->save();

                $raceUserResults[] = [
                    'position' => $position,
                    'user' => $user->name,
                    'team_id' => $user->team_id,
                    'time' => $key,
                    'points'=>$points
                ];
            }
            $remainingPrize -= $prize;
            $position++;
        }
        $raceTeamResults = [];
        //team points
        foreach($teams as $team){            
            $total_users = $team->users()->count();
            $total_points = 0;
            foreach($raceUserResults as $uResult){
                $team_id = $uResult['team_id'];
                if($team_id==$team->id){
                    $total_points += $uResult['points'];
                }
            }
            $teamRacePoints = ($total_points/$total_users);
            $raceTeamResults [] =[
                'team_id'=>$team->id,
                'team'=>$team->name,
                'team_logo'=>$team->logo,
                'points'=>$teamRacePoints
            ];
            $team->total_points += $teamRacePoints;
            $team->save();
        }
        $raceResults = [];
        $raceResults =[
            'teams'=>$raceTeamResults,
            'users'=>$raceUserResults
        ];
        $race->results = json_encode( $raceResults );
        $race->race_finished = true;
        $race->save();

        return $raceResults;
    }

    private function _calculateShipSpeedAndAcceleration( $ship, $weatherEffects )
 {
        $upgrades = $ship->upgrades;
        $crew = $ship->athletes;

        foreach ( $upgrades as $upgrade ) {
            if ( $upgrade->upgrade_type === 'speed' ) {
                $ship->speed += $ship->speed * ( $upgrade->value / 100 );
            } elseif ( $upgrade->upgrade_type === 'acceleration' ) {
                $ship->acceleration += $ship->acceleration * ( $upgrade->value / 100 );
            }
        }

        $minimumExperience = 0;
        $speedReductionPercentage = 0;
        $accelerationReductionPercentage = 0;

        foreach ( $weatherEffects as $weatherEffect ) {
            if ( $weatherEffect->effect_type === 'state_of_sea' ) {
                $minimumExperience = $weatherEffect->value;
            } elseif ( $weatherEffect->effect_type === 'wind' ) {
                $speedReductionPercentage = $weatherEffect->value / 100;
            } elseif ( $weatherEffect->effect_type === 'current' ) {
                $accelerationReductionPercentage = $weatherEffect->value / 100;
            }
        }

        $athletes = $crew->where( 'experience', '>=', $minimumExperience );
        $maxStrength = $athletes->sum( 'strength' );
        $maxStamina = $athletes->sum( 'stamina' );

        $crewSpeed = $maxStrength / 100;
        $crewAccel = $maxStamina / 100;

        $ship->speed += $ship->speed * $crewSpeed;
        $ship->acceleration += $ship->acceleration * $crewAccel;

        // Apply the reductions
        $ship->speed -= $ship->speed * $speedReductionPercentage;
        $ship->acceleration -= $ship->acceleration * $accelerationReductionPercentage;
    }

    private function _calculatePositionPoints( $position )
 {
        $pointsMap = [
            1 => 40, 2 => 36, 3 => 33, 4 => 28, 5 => 26,
            6 => 24, 7 => 22, 8 => 20, 9 => 18, 10 => 16,
            11 => 14, 12 => 12, 13 => 10, 14 => 8, 15 => 6,
            16 => 5, 17 => 4, 18 => 3, 19 => 2, 20 => 1,
        ];

        return $pointsMap[ $position ] ?? 0;
    }

}
