<?php

namespace App\Console\Commands;

use App\Models\Translation;
use Illuminate\Console\Command;

class PopulateTranslations extends Command
{
    protected $signature = 'db:populate-translations {count=100000}';
    protected $description = 'Populate the translations table with a specified number of records';

    public function handle(): int
    {
        $count = $this->argument('count');
        $this->info("Populating translations table with {$count} records...");

        Translation::factory()->count($count)->create();

        $this->info('Population complete!');
        return Command::SUCCESS;
    }
}