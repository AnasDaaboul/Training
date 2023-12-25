<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\OtpAttempt;

class PruneOtps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'otp:prune';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prune old OTPs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiryTime = Carbon::now()->subDays(1); // Delete old OTPs
        OtpAttempt::where('created_at', '<', $expiryTime)->delete();
        $this->info('Old OTPs pruned successfully.');
    }
}
