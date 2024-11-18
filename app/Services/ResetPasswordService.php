<?php

namespace App\Services;

use App\Http\ApiResponseTrait;
use App\Models\PasswordResetToken;
use App\Models\User;
use App\Notifications\PasswordResetNotification;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;

class ResetPasswordService
{
   use ApiResponseTrait;

   public function generateVerificationLink($email): string
   {

      try {
         $checkIfTokenExists = PasswordResetToken::where('email', $email)->first();
         if ($checkIfTokenExists)
            $checkIfTokenExists->delete();
         $token = Str::uuid();
         $currentDomain = Request::getSchemeAndHttpHost();
         $url = /* config('app.url') */   $currentDomain . "/api/ResetPasswordLoad" . "?token=" . $token . "&email=" . $email . "&verify_password=" . "2FPFIZefWzuMh9eyzqSvfnOCfitoa9e2rBjKsR2fpboU4ACW7V0odLrsLJZni2IMlMZ2biXRKFLjjKWyhZtmtqVqZXiLtwMN5rQEP9bXIr2DXdG";
         $saveToken = PasswordResetToken::create([
            "email" => $email,
            "token" => $token,
            "expired_at" => now()->addMinutes(60)

         ]);
         return $url;
      } catch (Exception $ex) {
         return $this->returnError($ex->getMessage(), $ex->getMessage());
      }
   }


   public function sendResetPasswordLink(object $user)
   {
      try {
         Notification::send($user, new PasswordResetNotification($this->generateVerificationLink($user->email)));
      } catch (Exception $ex) {
         return $this->returnError($ex->getMessage(), $ex->getMessage());
      }
   }


   public function resetPasswordLoad($email, $token)

   {
      $token = PasswordResetToken::where('email', $email)->where('token', $token)->first();
      if ($token) {
         if ($token->expired_at >= now()) {
            // TODO: return view with form to allow user to add new password
            $user = User::where('email', $email)->first();
            return view('resetpassword', compact('user'));
         } else {
            $token->delete();
            return '<p>This email link is expired, please try again from your app</p>';
         }
      } else {
         return '<p>This email link is invalid, please try again from your app</p>';
      }
   }
}
