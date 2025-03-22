<?php

namespace App\Console\Commands;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Console\Command;

class UpdateStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates App Statistics Every Hour';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $askedQuestionsCount = Question::query()->count();
        $solvedQuestionsCount = Answer::query()->where('is_correct_answer', 1)->count();
        $allAnswersCount = Answer::query()->count();
        $allUsersCount = User::query()->count();

        $askedQuestionsStatistics = Statistic::query()->where('key','asked_questions')->update([
            'value' => $askedQuestionsCount,
        ]);

        $solvedQuestionsStatistics = Statistic::query()->where('key','solved_questions')->update([
            'value' => $solvedQuestionsCount,
        ]);

        $allAnswersStatistics = Statistic::query()->where('key','answered_questions')->update([
            'value' => $allAnswersCount,
        ]);

        $allUsersStatistics = Statistic::query()->where('key','users_count')->update([
            'value' => $allUsersCount,
        ]);
    }
}
