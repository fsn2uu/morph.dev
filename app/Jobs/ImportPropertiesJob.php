<?php

namespace App\Jobs;
use SoapFault;
use SoapClient;
use App\Models\Pic;
use App\Models\Unit;
use SimpleXMLElement;
use App\Scopes\MineScope;
use Illuminate\Support\Str;
use App\Models\Neighborhood;
use Illuminate\Bus\Queueable;
use App\Services\BarefootService;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ImportPropertiesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 90;

    protected $client;
    protected $auth;
    protected $barefootAccount;
    protected $company_id;

    /**
     * Create a new job instance.
     */
    public function __construct($company_id)
    {
        $this->company_id = $company_id;
        $this->barefootAccount = 'v3csug1007';
        $this->auth = [
            'username' => 'sug1128f',
            'password' => '#f$s1007',
            'barefootAccount' => $this->barefootAccount,
        ];
        $this->client = new SoapClient("https://portals.barefoot.com/barefootwebservice/BarefootService.asmx?wsdl",$this->auth);
    }

    /**
     * Execute the job.
     */
    public function handle(BarefootService $barefootService): void
    {
        $properties = $barefootService->getAllProperties();
        $comp_id = $this->company_id;

        foreach($properties->Property as $property)
        {
            //check if there's a neighborhood named $property->a6
            
            $unit = DB::table('units')->updateOrInsert(
                [
                    'barefoot_id' => $property->PropertyID,
                ],
                [
                    'company_id' => $comp_id,
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
                ]
            );

            $unit = DB::table('units')->where('barefoot_id', $property->PropertyID)->first();
            
            $pics = $barefootService->getAllPropertyPicsXML($property->PropertyID);

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

                DB::table('pics')->insert([
                    'company_id' => $comp_id,
                    'picable_id' => $unit->id,
                    'picable_type' => 'App\Models\Unit',
                    'filename' => 'storage/'.$path,
                    'order' => $pic->imageNo,
                    'alt' => 'Picture of ' . $unit->name,
                    'title' => 'Picture of ' . $unit->name,
                ]);
            }
        }
    }
}
