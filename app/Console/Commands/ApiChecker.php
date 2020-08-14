<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ApiChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This checks all APIs';

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
        file_put_contents("a.txt", date('Y-m-d H:i:s'), FILE_APPEND);
        $controller = new \App\Http\Controllers\ApiManageController();
        $controller->checkApis();
    }
}
