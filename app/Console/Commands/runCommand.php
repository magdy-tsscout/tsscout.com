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
        $result= \App\Models\Blog::where('author_id')->update(['author_id' => 4]);
        dump($result);

        return self::SUCCESS;
    }
}
