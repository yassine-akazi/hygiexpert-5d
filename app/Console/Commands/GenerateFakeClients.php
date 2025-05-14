<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Client;

class GenerateFakeClients extends Command
{
    protected $signature = 'generate:fakeclients {count=10}';  // Default to 10 clients
    protected $description = 'Generate fake clients';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $count = $this->argument('count');  // Get the number of clients to create
        $this->info("Generating {$count} fake clients...");

        \App\Models\Client::factory($count)->create();  // Create the fake clients using the factory

        $this->info("{$count} fake clients generated successfully.");
    }
}