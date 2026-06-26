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
        $result= \App\Models\Blog::first();
        dump($result->toArray());

        return self::SUCCESS;
    }
}
