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
        $properties = $this->getAllProperties();

        foreach($properties->Property as $property)
        {
            //check if there's a neighborhood named $property->a6
            $neighborhood = Neighborhood::where('name', 'LIKE', "%$property->a6%")->first();
            
            $unit = Unit::updateOrCreate([
                'barefoot_id' => $property->PropertyID,
            ],[
                'company_id' => Auth::user()->company->id,
                'neighborhood_id' => $neighborhood->id ?? null,
                'name' => $property->name,
                'slug' => Str::slug($property->name, '-'),
                'address' => $property->street,
                'address2' => $property->street2,
                'city' => $property->city,
                'state' => $property->state,
                'zip' => $property->zip,
                'beds' => ($property->a56*1) ?? 1,
                'baths' => 1,
                'sleeps' => ($property->SleepsBeds*1) ?? 1,
                'description' => strip_tags($property->description, '<p><b><i>'),
                'status' => $property->status,
                'barefoot_id' => $property->PropertyID,
                // 'latitude' => $property->latitude,
                // 'longitude' => $property->longitude,
            ]);
            
            $pics = $this->getAllPropertyPicsXML($property->PropertyID);

            foreach($pics as $pic)
            {
                $url = $pic->imagepath;
                $cleanUrl = strstr($url, '?', true);
                if ($cleanUrl === false) {
                    $cleanUrl = $url; // If no query parameter is present, use the original URL
                }

                $ch = curl_init($cleanUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $contents = curl_exec($ch);
                curl_close($ch);

                $name = substr($cleanUrl, strrpos($cleanUrl, '/') + 1);
                //$name = preg_replace('/[^\w.-]/', '', $name); // Sanitize the filename
                $path = 'units/'.$unit->id.'/'.$name;
                Storage::put($path, $contents, 'public');


                $picModel = new Pic([
                    'company_id' => Auth::user()->company_id,
                    'filename' => 'storage/'.$path,
                    'order' => $pic->imageNo,
                    'alt' => 'Picture of ' . $unit->name,
                    'title' => 'Picture of ' . $unit->name,
                ]);
                $unit->pics()->save($picModel);
            }
        }
    }
}
