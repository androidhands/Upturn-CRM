<?php

namespace App\Services;

use App\Http\ApiResponseTrait;
use App\Models\EmailVerificationToken;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;

use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;

class EmailVerificationService
{
   use ApiResponseTrait;
   /**Generate verification link */

   public function generateVerificationLink($email): string
   {

      try {
         $checkIfTokenExists = EmailVerificationToken::where('email', $email)->first();
         if ($checkIfTokenExists)
            $checkIfTokenExists->delete();
         $token = Str::uuid();
         $currentDomain = Request::getSchemeAndHttpHost();
         $url = /* config('app.url') */ $currentDomain . "/api/VerifyEmailAddress" . "?token=" . $token . "&email=" . $email . "&verify_password=" . "2FPFIZefWzuMh9eyzqSvfnOCfitoa9e2rBjKsR2fpboU4ACW7V0odLrsLJZni2IMlMZ2biXRKFLjjKWyhZtmtqVqZXiLtwMN5rQEP9bXIr2DXdG";
         $saveToken = EmailVerificationToken::create([
            "email" => $email,
            "token" => $token,
            "expired_at" => now()->addHours(2)
         ]);
         return $url;
      } catch (Exception $ex) {
         return $this->returnError($ex->getMessage(), $ex->getMessage());
      }
   }

   /** Send verification link  */

   public function sendVerificationLink(object $user)
   {
      try {
         Notification::send($user, new EmailVerificationNotification($this->generateVerificationLink($user->email)));
      } catch (Exception $ex) {
         return $this->returnError($ex->getMessage(), $ex->getMessage());
      }
   }

   public function verifyToken($email, $token)

   {
      $token = EmailVerificationToken::where('email', $email)->where('token', $token)->first();
      if ($token) {
         if ($token->expired_at >= now()) {
            return $token;
         } else {
            $token->delete();
            $this->returnError('401', 'Token is expired')->send();
            exit;
         }
      } else {
         $this->returnError('401', 'Invalid token')->send();
         exit;
      }
   }

   public function checkIfEmailIsVerified($user)
   {
      if ($user->email_verified_at) {
         $this->returnError('422', 'Email has already been verified')->send();
         exit;
      }
   }

   public function verifyEmail($email, $token)
   {
      $user = User::where('email', $email)->first();
      if (!$user) {
         $this->returnError('422', 'User not found')->send();
         exit;
      }
      $this->checkIfEmailIsVerified($user);
      $verifiedToken = $this->verifyToken($email, $token);
      if ($user->markEmailAsVerified()) {
         $verifiedToken->delete();
         return "<p>Email has been verified successfully</p>"; //$this->customApiReponse('Email has been verified successfully', null, true);
      } else {

         $this->returnError('422', 'Email verification failed, please try again later')->send();
         exit;
      }
   }

   /*  public function resendEmailVerificationLink($email)
   {
      $user = User::where('email', $email)->first();
      if ($user) {
         $this->checkIfEmailIsVerified($user);
         $this->sendVerificationLink($user);
         exit;
      } else {
         $this->returnError('422', 'User not found')->send();
         exit;
      }
   } */
}
