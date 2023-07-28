<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

use App\Services\MailService; 
use App\Services\ShipService; 

class AuthService
{
    private $MailService;
    private $ShipService;

    public function __construct(MailService $mailService, ShipService $shipService)
    {
        $this->MailService = $mailService;
        $this->ShipService = $shipService;
    }

    public function register($name, $email, $password, $teamId)
    {
        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => \Hash::make($password),
        ]);

        $user->save();

        $this->sendDoubleOptinEmail($user, $teamId);
    }

    public function login($email, $password)
    {
        $credentials = ['email' => $email, 'password' => $password];

        if (!$token = auth()->attempt($credentials)) {
            return false;
        }
        $user = $this->me();
        $result =
        [
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
        return $result;
    }

    public function refreshToken(){
        $token = auth()->refresh();
        $result =
        [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
        return $result;
    }

    public function logout(){
        auth()->logout();        
    }

    public function me(){
        return auth()->user();        
    }

    

    public function verifyDoubleOptin($token)
    {
        $decrypted = Crypt::decryptString($token);
        list($email,$teamId, $createdAt) = explode('|', $decrypted);

        if ($this->isTokenExpired($createdAt)) {
            return false;
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }
        
            $user->team_id = $teamId;
            $user->email_verified_at = now();
            $user->save();
            
            $this->ShipService->createShip($user);
            
            return true;        
    }

    public function requestPasswordReset($email)
    {
        $user = User::where('email', $email)->first();

        if ($user) {            
            $this->sendPasswordResetEmail($user);
        }
    }

    public function resetPassword($token, $password)
    {
        try {
            $decrypted = Crypt::decryptString($token);
            list($userId, $createdAt) = explode('|', $decrypted);

            if ($this->isTokenExpired($createdAt)) {
                return false;
            }

            $user = User::find($userId);

            if (!$user) {
                return false;
            }

            $user->password = Hash::make($password);
            $user->save();

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    private function isTokenExpired($createdAt)
    {
        $expiresAt = Carbon::parse($createdAt)->addMinutes(5);

        return now()->greaterThan($expiresAt);
    }

    private function generateVerificationToken(User $user, $team_id)
    {
        $token = Crypt::encryptString("{$user->email}|{$team_id}|{$user->created_at}");

        return urlencode($token);
    }

    private function generatePasswordResetToken($userId)
    {
        $token = Crypt::encryptString("{$userId}|".now());

        return urlencode($token);
    }

    private function sendDoubleOptinEmail(User $user, $team_Id)
    {
        $token = $this->generateVerificationToken($user,$team_Id);        
        
        // Code to send double-optin email to the user with the $verificationToken
        $this->MailService->sendDoubleOptinEmail($user->email, $token);
    }

    private function sendPasswordResetEmail(User $user)
    {
        $token = $this->generatePasswordResetToken($user->id);
        // Code to send password reset email to the user with the $token
    }
}
