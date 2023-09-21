<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SimpleBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SimpleBatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SimpleBatch';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle() {
        Log::info("{$this->description} AP START");
    }
}
