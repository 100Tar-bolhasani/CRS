<?php

namespace App\Console\Commands;

use App\Facade\SmsService;
use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Modules\Game\Entities\League;
use Modules\Game\Entities\Rank;
use Modules\Wallet\Traits\CoinTrait;

class Birthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'find:guest';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find Guests who their birthday is in next month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    { 
        $nextMonth = Carbon::now()->addMonth(1);

        $guests = Guest::whereHas('profile', function ($profile) use ($nextMonth){
            $profile->whereBetween('birthday', [$nextMonth->firstOfMonth(), $nextMonth->lastOfMonth()]);
        });

        SmsService::sendBirthDateSms($guests);
    }
}
