<?php
namespace App\Repositories\Admin\Country;

use App\Http\Requests\Admin\Country\StoreCountryRequest;
use App\Http\Requests\Admin\Country\UpdateCountryRequest;
use App\Models\Country;

interface CountryRepositoryInterface{
   public function index();
   public function create();
   public function store(StoreCountryRequest $request);
   public function show(Country $country);
   public function edit(Country $country);
   public function update(UpdateCountryRequest $request, Country $country);
   public function destroy(Country $country);


}