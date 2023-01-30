<?php

namespace Indianic\Newsletters\Console;

use Illuminate\Console\Command;

/**
 * Class NewsletterCommand
 *
 * @package Indianic\Newsletters\Console
 */
class NewsletterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:newsletter';

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
     */
    public function handle()
    {
        $this->info('Publishing Configuration...');

        $this->call('migrate', [
            '--path' => 'database/migrations/2023_01_17_113136_create_newsletters_table.php'
        ]);

        $this->info('Publishing Configuration Successfully Completed.');
    }
}
