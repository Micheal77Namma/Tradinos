<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\Notify;

class sendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'end:flag';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'flag the task as end task automatically';

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
        $tasks = Task::all();

        foreach ($tasks as $task) {
            if ($task->deadline == time() ){
            $task->update(['end_flag' => 'task ended']);
            }
        }
    }
}
