<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class TaskUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::query()->delete();
        User::query()->delete();

        User::Create([
            'username' => 'admin',
            'full_name' => 'Alex Administrator',
            'email' => 'alex@gmail.com',
            'created_at' => now()
        ]);

        $today = Carbon::today();

        $tasks = [
            [
                'title'     =>  'Technical Summative 1',
                'status'    =>  'pending',
                'task_date' =>  $today->copy()->toDateString()
            ],
            [
                'title'     =>  'Technical Summative 2',
                'status'    =>  'pending',
                'task_date' =>  $today->copy()->toDateString()
            ],
            [
                'title'     =>  'Project',
                'status'    =>  'pending',
                'task_date' =>  $today->copy()->toDateString()
            ],
            [
                'title'     =>  'Summative 1',
                'status'    =>  'pending',
                'task_date' =>  $today->copy()->subDays(1)->toDateString()
            ],
            [
                'title'     =>  'Midterm Exam 1',
                'status'    =>  'pending',
                'task_date' =>  $today->copy()->subDays(1)->toDateString()
            ],
            [
                'title'     =>  'Final Exam 1',
                'status'    =>  'pending',
                'task_date' =>  $today->copy()->addDays(1)->toDateString()
            ],
            [
                'title'     =>  'Final Exam 2',
                'status'    =>  'pending',
                'task_date' =>  $today->copy()->addDays(1)->toDateString()
            ],
            [
                'title'     =>  'Final Exam 3',
                'status'    =>  'pending',
                'task_date' =>  $today->copy()->addDays(2)->toDateString()
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
