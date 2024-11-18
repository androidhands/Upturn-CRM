<?php

namespace App\Services;

use App\Http\ApiResponseTrait;
use App\Models\EmailVerificationToken;
use App\Models\Admin;
use App\Notifications\AdminEmailVerificationNotification;
use App\Notifications\EmailVerificationNotification;

use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;

class AdminEmailVerificationService
{
   use ApiResponseTrait;
   /**Generate verification link */

   public function generateAdminVerificationLink($email): string
   {


      try {
         $checkIfTokenExists = EmailVerificationToken::where('email', $email)->first();
         if ($checkIfTokenExists)
            $checkIfTokenExists->delete();
         $token = Str::uuid();
         $currentDomain = Request::getSchemeAndHttpHost();
         $url = $currentDomain . "/api/VerifyAdminEmailAddress" . "?token=" . $token . "&email=" . $email . "&verify_password=" . "2FPFIZefWzuMh9eyzqSvfnOCfitoa9e2rBjKsR2fpboU4ACW7V0odLrsLJZni2IMlMZ2biXRKFLjjKWyhZtmtqVqZXiLtwMN5rQEP9bXIr2DXdG";
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

   public function sendAdminVerificationLink(object $admin)
   {
      try {
         Notification::send($admin, new AdminEmailVerificationNotification($this->generateAdminVerificationLink($admin->email)));
      } catch (Exception $ex) {
         return $this->returnError($ex->getMessage(), $ex->getMessage());
      }
   }

   public function verifyAdminToken($email, $token)

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

   public function checkIfAdminEmailIsVerified($admin)
   {
      if ($admin->email_verified_at) {
         $this->returnError('422', 'Email has already been verified')->send();
         exit;
      }
   }

   public function verifyAdminEmail($email, $token)
   {
      $admin = Admin::where('email', $email)->first();
      if (!$admin) {
         $this->returnError('422', 'User not found')->send();
         exit;
      }
      $this->checkIfAdminEmailIsVerified($admin);
      $verifiedToken = $this->verifyAdminToken($email, $token);
      if ($admin->markEmailAsVerified()) {
         $verifiedToken->delete();
         return "<p>Email has been verified successfully</p>";
      } else {
         $this->returnError('422', 'Email verification failed, please try again later')->send();
         exit;
      }
   }
}
