<?php

namespace App\Console\Commands;

use App\Models\MostViewQuestion;
use App\Models\Question;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateMostViewQuestions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:most-view-questions';

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
        $this->info('Most viewed questions updated successfully.');
        // شروع تراکنش
        DB::transaction(function () {
            // گرفتن ۱۲ سوال با بیشترین بازدید
            $questions = Question::with('category')
                ->orderByDesc('views')
                ->take(12)
                ->get();

            $topQuestionIds = $questions->pluck('id')->toArray();

            // گرفتن question_id های موجود در جدول
            $existingQuestionIds = MostViewQuestion::pluck('question_id')->toArray();

            // پیدا کردن رکوردهایی که باید حذف شوند
            $questionsToDelete = array_diff($existingQuestionIds, $topQuestionIds);

            // حذف رکوردهایی که دیگر در لیست ۱۲ سوال برتر نیستند
            MostViewQuestion::whereIn('question_id', $questionsToDelete)->delete();

            // به‌روزرسانی یا درج رکوردها
            foreach ($questions as $question) {
                MostViewQuestion::updateOrCreate(
                    ['question_id' => $question->id],
                    [
                        'title' => $question->title,
                        'slug' => $question->slug,
                        'views' => $question->views,
                        'category_name' => $question->category->name,
                        'created_at' => $question->created_at,
                    ]
                );
            }
        });

        $this->info('Most viewed questions updated successfully.');
    }
}
