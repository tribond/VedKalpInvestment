<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SymbolData;
use Illuminate\Support\Facades\Log;

class UpdateScriptDataWeekByWeek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-script-data-week-by-week';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $json = file_get_contents(public_path('assets/angelone/OpenAPIScripMaster.json'));
        $data = json_decode($json, true);

        $niftyData = [];
        $bankniftyData = [];

        // Separate data for NIFTY and BANKNIFTY
        foreach ($data as $key => $value) {
            if ($value['exch_seg'] == 'NFO') {
                if ($value['name'] == 'NIFTY') {
                    $niftyData[] = $value;
                }
                if ($value['name'] == 'BANKNIFTY') {
                    $bankniftyData[] = $value;
                }
            }
        }

        // Get current timestamp
        $currentDate = time();

        // Function to get nearest expiry contract
        $getNearestContract = function ($contracts) use ($currentDate) {
            // Filter out expired contracts
            $futureContracts = array_filter($contracts, function ($item) use ($currentDate) {
                return strtotime($item['expiry']) >= $currentDate;
            });

            if (empty($futureContracts)) {
                return [];
            }

            // Find the nearest expiry date
            $nearestExpiryDate = min(array_map(function ($item) {
                return strtotime($item['expiry']);
            }, $futureContracts));

            // Get all contracts with the nearest expiry date
            $nearestContracts = array_filter($futureContracts, function ($item) use ($nearestExpiryDate) {
                return strtotime($item['expiry']) == $nearestExpiryDate;
            });

            return $nearestContracts;
        };

        // Get nearest contracts for NIFTY and BANKNIFTY
        $nearestNiftyContracts = $getNearestContract($niftyData);
        $nearestBankNiftyContracts = $getNearestContract($bankniftyData);

        // Merge both contracts and save to the database
        $finalContracts = array_merge($nearestNiftyContracts, $nearestBankNiftyContracts);

        if (!empty($finalContracts)) {
            foreach ($finalContracts as $contract) {
                SymbolData::updateOrCreate(
                    ['token' => $contract['token']], // Ensure no duplicate tokens
                    $contract
                );
            }
        }

        Log::info('Script data updated successfully for NIFTY and BANKNIFTY - ' . date('Y-m-d H:i:s'));
        return true;
    }
}
