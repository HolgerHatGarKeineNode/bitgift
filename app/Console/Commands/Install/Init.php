<?php

namespace App\Console\Commands\Install;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class Init extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $yarnInstall = Process::run('yarn install', function (string $type, string $output) {
            echo $output;
        });
        $yarnBuild = Process::run('yarn build', function (string $type, string $output) {
            echo $output;
        });

        // call touch database/database.sqlite
        $touchDb = Process::run('touch database/database.sqlite');
        if ($touchDb->successful()) {
            $this->info('Created database/database.sqlite');
        } else {
            $this->error('Failed to create database/database.sqlite');
        }

        // migrate fresh
        $this->call('migrate:fresh', ['--force' => true]);

        // create user from .env vars
        $user = User::query()
                    ->updateOrCreate(
                        [
                            'email' => config('app.admin_user.email'),
                        ],
                        [
                            'name'              => config('app.admin_user.name'),
                            'password'          => env('ADMIN_PASSWORD'),
                            'email_verified_at' => now(),
                            'lnbits_url' => env('ADMIN_LNBITS_URL'),
                            'lnbits_admin_api_key' => env('ADMIN_LNBITS_API_KEY'),
                        ]);
        $this->info('Created user '.$user->email);
    }
}
