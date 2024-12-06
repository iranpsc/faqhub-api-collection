<?php

namespace App\Console\Commands;

use App\Models\MostLikeQuestion;
use App\Models\Question;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateMostLikedQuestions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-most-liked-questions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating Data Started at : ' . now()->format('Y-m-d H:i:s'));
        $this->info('Truncating at :' . now()->format('Y-m-d H:i:s'));
        MostLikeQuestion::truncate();
        $this->info('Transfer started at :' . now()->format('Y-m-d H:i:s'));
        DB::transaction(function () {
            $questions = Question::withCount(['votes' => function ($query) {
                $query->where('vote_type', 1);
            }])
                ->orderByDesc('votes_count')
                ->take(12)
                ->get();
            $this->info('Data Fetched at ' . now()->format('Y-m-d H:i:s'));

            if ($questions->isEmpty()) {
                $this->info('No questions found.');
                return;
            }


            $topQuestionIds = $questions->pluck('id')->toArray();


            $dataToInsert = $questions->map(function ($question) {
                return [
                    'question_id' => $question->id,
                    'title' => $question->title,
                    'slug' => $question->slug,
                    'category_name' => $question->category->name,
                    'user_name' => $question->user->name,
                    'created_at' => $question->created_at,
                ];
            })->toArray();
            $this->info('Data is updating at: ' . now()->format('Y-m-d H:i:s'));
            MostLikeQuestion::upsert($dataToInsert, ['question_id'], ['title', 'slug', 'category_name', 'user_name', 'created_at']);
            $this->info('Data Updated');
            $this->info('Delete Additional Data');

            MostLikeQuestion::whereNotIn('question_id', $topQuestionIds)->delete();
        });

        $this->info('Most liked questions updated successfully at : ' . now()->format('Y-m-d H:i:s'));
    }

}
