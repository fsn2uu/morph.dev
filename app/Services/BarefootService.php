<?php

namespace App\Services;

use SoapFault;
use SoapClient;
use App\Models\Pic;
use App\Models\Unit;
use SimpleXMLElement;
use Illuminate\Support\Str;
use App\Models\Neighborhood;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ImportPropertiesJob;

class BarefootService
{
    protected $client;
    protected $auth;
    protected $barefootAccount;

    public function __construct()
    {
        $this->barefootAccount = 'v3csug1007';
        $this->auth = [
            'username' => 'sug1128f',
            'password' => '#f$s1007',
            'barefootAccount' => $this->barefootAccount,
        ];
        $this->client = new SoapClient("https://portals.barefoot.com/barefootwebservice/BarefootService.asmx?wsdl",$this->auth);
    }

    public function getAllProperties()
    {
        try {
            //$result = $client->GetProperty(array('username' => 'sug1128f','password' => '#f$s1007','barefootAccount' => 'v3csug1007'));

            $response = $this->client->__soapCall('GetProperty', [$this->auth]);
            $properties = new SimpleXMLElement($response->GetPropertyResult);
            return $properties;
        } catch (SoapFault $e) {
            // Handle any errors that occur during the SOAP request
            throw new \Exception("Error fetching properties: " . $e->getMessage());
        }
    }

    public function getAllPropertyPicsXML($propID)
    {
        try {
            $this->auth['propertyId'] = $propID;
            $response = $this->client->__soapCall('GetPropertyAllImgsXML', [$this->auth]);
            // dd($response);
            $pics = new SimpleXMLElement($response->GetPropertyAllImgsXMLResult);
            // dd($pics);
            return $pics;
        } catch (SoapFault $e) {
            // Handle any errors that occur during the SOAP request
            throw new \Exception("Error fetching pics: " . $e->getMessage());
        }
    }

    public function importProperties()
    {
        dispatch(new ImportPropertiesJob(Auth::user()->company->id));

        return redirect()->route('admin.dashboard');
    }
}
