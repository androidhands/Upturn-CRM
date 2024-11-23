<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company\StoreCountryRequest;
use App\Http\Requests\Admin\Country\UpdateCountryRequest;
use App\Models\Country;
use App\Repositories\Admin\Country\CountryRepository;

class CountryController extends Controller
{

    protected $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->countryRepository->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->countryRepository->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request)
    {
        return $this->countryRepository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return $this->countryRepository->show($country);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return $this->countryRepository->edit($country);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country) {
        return $this->countryRepository->update($request, $country);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country) {
        return $this->countryRepository->destroy($country);
    }
}
