<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Ratchet\Client\Connector;
use Ratchet\Client\WebSocket;
use React\EventLoop\Loop;
use App\Helpers\TradeHelper;
use App\Models\SmartApiUser;
use Illuminate\Support\Facades\Log;

class TradeSocketListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'angelone:websocket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Connect to Angel One WebSocket and handle messages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $currentTime = \Carbon\Carbon::now('Asia/Kolkata');
            $marketStartTime = \Carbon\Carbon::createFromTime(9, 00, 0, 'Asia/Kolkata');
            $marketEndTime = \Carbon\Carbon::createFromTime(16, 00, 0, 'Asia/Kolkata');
            if ($currentTime->between($marketStartTime, $marketEndTime)) {
                $smartUser = SmartApiUser::latest()->first();
                $feedToken = $smartUser->feed_token;
                if (!empty($smartUser)) {
                    $clientCode = env('SMART_API_CLIENT_CODE');  // Set in .env
                    $apiKey = env('SMART_API_KEY');             // Set in .env
                    $socketUrl = "wss://smartapisocket.angelone.in/smart-stream?clientCode=$clientCode&feedToken=$feedToken&apiKey=$apiKey";

                    // Create an event loop using React\Loop directly
                    $loop = Loop::get();

                    // Create WebSocket client using Pawl's Connector
                    $connector = new Connector($loop);

                    // Use the connector to connect to the WebSocket server
                    $connector($socketUrl)->then(
                        function (WebSocket $connection) use ($loop) {
                            $this->info("Connected to WebSocket server.");

                            // Listen for incoming messages
                            $connection->on('message', function ($data) {
                                // Check if data is binary or text
                                if ($data == 'pong') {
                                    $this->info("Received text: " . $data);
                                } else {
                                    $decodedMessage = $this->decodeBinaryMessage($data);
                                    TradeHelper::tradeExecution(json_encode($decodedMessage));
                                    $this->info("Received data for script " . json_encode($decodedMessage));
                                    event(new \App\Events\AngelOneDataReceived(json_encode($decodedMessage)));
                                }
                            });

                            // Handle connection errors
                            $connection->on('error', function ($error) {
                                $this->error("Error: " . $error->getMessage());
                            });

                            // Close connection
                            $connection->on('close', function () {
                                $this->info("Connection closed.");
                            });

                            $loop->addPeriodicTimer(30, function () use ($connection) {
                                $connection->send('ping');
                                $this->info("Sent ping to WebSocket server.");
                            });

                            $loop->addPeriodicTimer(3, function () use ($connection) {
                                    $subscriptionRequest = [
                                        'action' => 1,
                                        'params' => [
                                            'mode' => 1,
                                            'tokenList' => [
                                                [
                                                    'exchangeType' => 1,
                                                    'tokens' => ['99926000','99926009']
                                                ]
                                            ]
                                        ]
                                    ];
                                    $connection->send(json_encode($subscriptionRequest));
                                    $this->info("Sent ping to WebSocket server.");
                            });
                        },
                        function (Exception $e) {
                            $this->error("Connection failed: " . $e->getMessage());
                            Log::info("Connection failed: " . $e->getMessage());
                        }
                    );

                    // Run the event loop
                    $loop->run();
                } else {
                    Log::info('$smartUser not found.');
                }
            } else {
                Log::info('Market hour closed.');
                
            }
        } catch (Exception $e) {
            Log::info('TradeSocketListener CATCH Error : ', [$e]);
        }
    }

    private function decodeBinaryMessage($message)
    {
        $data = unpack('C*', $message); // Unpack the binary string into an array of bytes

        // Extract TOKEN
        $tokenBytes = array_slice($data, 2, 25);

        // Convert the byte array to a string
        $token = '';
        foreach ($tokenBytes as $byte) {
            $token .= chr($byte); // Convert each byte to its character representation
        }

        // Trim any null characters or whitespace
        $token = rtrim($token, "\0");


        // Extract LTP
        $ltpBytes = array_slice($data, 43, 4);
        $ltpValue = 0;
        foreach ($ltpBytes as $index => $byte) {
            $ltpValue += $byte * pow(256, $index);
        }
        $ltp = $ltpValue / 100;

        // Extract Volume
        $volumeBytes = array_slice($data, 47, 4);
        $volumeValue = 0;
        foreach ($volumeBytes as $index => $byte) {
            $volumeValue += $byte * pow(256, $index);
        }

        // Extract Open Price
        $openPriceBytes = array_slice($data, 51, 4);
        $openPriceValue = 0;
        foreach ($openPriceBytes as $index => $byte) {
            $openPriceValue += $byte * pow(256, $index);
        }
        $openPrice = $openPriceValue / 100;

        // Extract Symbol (assuming it's a null-terminated string)
        $symbolBytes = array_slice($data, 55, 10);
        $symbol = '';
        foreach ($symbolBytes as $byte) {
            if ($byte === 0)
                break; // Stop at null terminator
            $symbol .= chr($byte);
        }

        // Return all decoded values
        return [
            'token' => $token,
            'ltp' => $ltp,
            'volume' => $volumeValue,
            'open_price' => $openPrice,
            'symbol' => $symbol,
        ];
    }
}
