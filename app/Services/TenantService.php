<?php

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TenantService
{

   private static $tenant;
   private static $domain;
   private static $database;
   public static function switchToTenant(Tenant $tenant)
   {
      if (!$tenant instanceof Tenant) {
         // throw error or tenant class 
         throw ValidationException::withMessages(['field_name' => 'This value is incorrect']);
      }
      DB::purge('system');
      DB::purge('tenant');
      Config::set('database.connections.tenant.database', $tenant->database);
      Config::set('database.connections.tenant.username', $tenant->username);
      Config::set('database.connections.tenant.password', $tenant->password);

      Self::$tenant = $tenant;
      Self::$domain = $tenant->domain;
      Self::$database = $tenant->database;
      DB::connection('tenant')->reconnect();
      DB::setDefaultConnection('tenant');
   }

   public static function switchToDefaultTenant()
   {

      DB::purge('system');
      DB::purge('tenant');
      DB::connection('system')->reconnect();
      DB::setDefaultConnection('system');
   }

   public static function getTenant()
   {
      return Self::$tenant;
   }

   /**
    * @return mixed
    */
   public static function getDomain()
   {
      return self::$domain;
   }

   /**
    * @param mixed $domain 
    */
   public static function setDomain($domain)
   {
      self::$domain = $domain;
      return;
   }

   /**
    * @return mixed
    */
   public static function getDatabase()
   {
      return self::$database;
   }

   /**
    * @param mixed $database 
    */
   public static function setDatabase($database)
   {
      self::$database = $database;
      return;
   }
}
