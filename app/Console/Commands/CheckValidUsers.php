<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckValidUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check valid user tokens';

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $now = Carbon::now()->format('Y-m-d');

        $users = User::query()
            ->where('token_valid_until', '<', $now)
            ->where('token_active', true)
            ->get();

        foreach ($users as $user) {
            $user->update([
                'token_active' => false,
            ]);
        }
    }
}
