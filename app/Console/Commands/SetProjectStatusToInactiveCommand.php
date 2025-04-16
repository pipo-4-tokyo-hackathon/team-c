<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class SetProjectStatusToInactiveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:set-status-to-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set project status to inactive if they are outdated';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $projects = Project::all();
        foreach ($projects as $project) {
            if ($project->updated_at < now()->subWeeks(2)) {
                Model::withoutTimestamps(function () use ($project) {
                    $project->status = 'inactive';
                    $project->update();
                });
            }
        }
    }
}
