<?php

namespace App\Console\Commands;

use App\Mail\SendOptionalReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class SendOptionalReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send-optional';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send optional reminder to fill document';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = Http::withHeaders([
            'Authorization' => 'Bearer cbsy2u5kdph8c0go85ycc7ab6',
        ])->get('https://api.adalo.com/v0/apps/d166b586-8a30-40c0-ba02-148a2c04ea57' .
            '/collections/t_8cfcc2c7c65240ba9bdaaf948ce016c6')->collect()['records'];

        foreach ($users as $user) {
            Mail::send(new SendOptionalReminder($user['Email']));
        }
    }
}
