<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\GlobalSetting;
use App\CountryFormatSetting;
use App\Helper\Reply;
use App\Http\Requests\Country\StoreCountry;
use App\Http\Requests\Country\UpdateCountry;
use App\Traits\CountryExchange;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CountrySettingController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageIcon = 'icon-settings';
        $this->pageTitle = 'app.menu.countrySettings';
    }

    public function index()
    {
        $this->countries = Country::all();
        return view('admin.countries.index', $this->data);
    }

    public function create()
    {
        return view('admin.countries.create', $this->data);
    }

    public function edit($id)
    {
        $this->country = Country::findOrFail($id);

        return view('admin.countries.edit', $this->data);
    }

    public function store(StoreCountry $request)
    {
        $country = new Country();
     
        $country->name = $request->name;
        $country->iso = $request->iso;
        $country->iso3 = $request->iso3;
        $country->phonecode = $request->phonecode;

        $country->save();
        return Reply::redirect(route('admin.country.index'), __('messages.countryAdded'));
    }

    public function update(UpdateCountry $request, $id)
    {
        $country = Country::findOrFail($id);
        $country->name = $request->name;
        $country->iso = $request->iso;
        $country->iso3 = $request->iso3;
        $country->phonecode = $request->phonecode;

        $country->save();
        return Reply::redirect(route('admin.country.index'), __('messages.countryUpdated'));
    }

    public function destroy($id)
    {
               Country::destroy($id);
               return Reply::success(__('messages.countryDeleted'));
    }

    // public function exchangeRate($country)
    // {
    //     $countryApiKey = GlobalSetting::first()->country_converter_key;
    //     $countryApiKeyVersion = GlobalSetting::first()->country_key_version;
    //     $countryApiKey = ($countryApiKey != '' && !is_null($countryApiKey)) ? $countryApiKey : env('CURRENCY_CONVERTER_KEY');

    //     try {
    //         // get exchange rate
    //         $client = new Client();
    //         $res = $client->request('GET', 'https://' . $countryApiKeyVersion . '.currconv.com/api/v7/convert?q=' . $this->global->country->country_code . '_' . $country . '&compact=ultra&apiKey=' . $countryApiKey, ['verify' => false]);
    //         $conversionRate = $res->getBody();
    //         $conversionRate = json_decode($conversionRate, true);
    //         return $conversionRate[strtoupper($this->global->country->country_code) . '_' . $country];
    //     } catch (\Exception $th) {
    //         //throw $th;
    //     }
    // }

    // /**
    //  * @return array
    //  */
    // public function updateExchangeRate()
    // {
    //     try {
    //         $this->updateExchangeRates();
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }
    //     return Reply::success(__('messages.exchangeRateUpdateSuccess'));
    // }

    // /**
    //  * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    //  */
    // public function countryExchangeKey()
    // {
    //     return view('admin.countries.country_exchange_key', $this->data);
    // }

    // /**
    //  * @param Request $request
    //  * @return array
    //  */
    // public function countryExchangeKeyStore(StoreCountryExchangeKey $request)
    // {
    //     $this->global->country_converter_key = $request->country_converter_key;
    //     $this->global->save();
    //     return Reply::success(__('messages.countryConvertKeyUpdated'));
    // }

    // public function countryFormat()
    // {
    //     $this->countryFormatSetting = CountryFormatSetting::first();
    //     $this->defaultFormattedCountry = ($this->countryFormatSetting->sample_data == null) ? '1,234,567.890$' : $this->countryFormatSetting->sample_data;
    //     return view('admin.countries.country-format-setting', $this->data);
           
    // }

    // public function updateCountryFormat(StoreCountryFormat $request)
    // {
    //     $countryFormatSetting = CountryFormatSetting::first();
    //     $countryFormatSetting->country_position = $request->country_position;
    //     $countryFormatSetting->no_of_decimal = $request->no_of_decimal;
    //     $countryFormatSetting->thousand_separator = $request->thousand_separator;
    //     $countryFormatSetting->decimal_separator = $request->decimal_separator;
    //     $countryFormatSetting->sample_data = $request->sample_data;
    //     $countryFormatSetting->save();
    //     session()->forget('country_format_setting');
    //     cache()->forget('country_format_setting');
    //     return Reply::success('Setting Updated');
    // }

}
