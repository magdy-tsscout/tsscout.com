<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class runCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-command';

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
        $result= \App\Models\User::where('id',"!=", 4)->update([
            'author_name'=> "Scout Admin",

        ])->updateRaw('author_slug= CONCAT("scout-admin-", id)');
        dump($result->toArray());

        return self::SUCCESS;
    }
}
