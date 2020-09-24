<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use Log;

class TestMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test mail.';

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
     * @return mixed
     */
    public function handle()
    {
        Log::info('Cron Job Started');
        $student = Student::find(1);
        $student->sendTestMail($student);
        // $this->info('Run successfully!');
    }
}
