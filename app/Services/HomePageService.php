<?php

namespace App\Services;

use App\Http\Resources\MostLikedQuestions;
use App\Models\Category;
use App\Models\MostLikeQuestion;
use App\Models\MostViewQuestion;
use App\Models\Question;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomePageService
{
    /**
     * @param null $category
     * @return Collection
     */
    public function getPinnedQuestions($category = null): Collection
    {
        if ($category === null) {
            return Question::where('is_pinned', 1)
                ->with('activity')
                ->leftJoin('questions_activity', 'questions.id', '=', 'questions_activity.question_id')
                ->orderBy('questions_activity.last_activity', 'desc')
                ->select('questions.*')
                ->get();
        } else {
            $questions = Question::where('is_pinned', 1)
                ->where('category_id', $category)
                ->with('activity')
                ->leftJoin('questions_activity', 'questions.id', '=', 'questions_activity.question_id')
                ->orderBy('questions_activity.last_activity', 'desc')
                ->select('questions.*')
                ->get();
            return $questions;
        }
    }

    /**
     * @param null $category
     * @return mixed
     */
    public function getLatestQuestions($category = null): mixed
    {
        if ($category === null) {
            return Question::where('is_pinned', 0)
                ->with('activity')
                ->leftJoin('questions_activity', 'questions.id', '=', 'questions_activity.question_id')
                ->orderBy('questions_activity.last_activity', 'desc')
                ->select('questions.*')
                ->take(5)
                ->get();
        } else {
            $questions = Question::where('is_pinned', 0)
                ->where('category_id', $category)
                ->with('activity')
                ->leftJoin('questions_activity', 'questions.id', '=', 'questions_activity.question_id')
                ->orderBy('questions_activity.last_activity', 'desc')
                ->select('questions.*')
                ->take(5)
                ->get();
            return $questions;
        }
    }

    /**
     * @return mixed
     */

    public function getLatestCategories(): mixed
    {
        return Category::select('categories.*', DB::raw('MAX(categories_activity.last_activity) as last_activity'))
            ->join('categories_activity', 'categories.id', '=', 'categories_activity.category_id')
            ->where('categories.status', 'active')
            ->groupBy('categories.id')
            ->orderByDesc('last_activity')
            ->limit(12)
            ->get();
    }

    /**
     * @return mixed
     */
    public function getMostLikedQuestions(): mixed
    {
        return Cache::remember('most_liked_questions', 600, function () {
            return MostLikeQuestion::all();
        });
    }

    /**
     * @return mixed
     */
    public function getMostViewedQuestions(): mixed
    {
        return Cache::remember('most_viewed_questions', 600, function () {
            return MostViewQuestion::all();
        });
    }

    /**
     * @return mixed
     */
    public function getActiveUsers(): mixed
    {
        return Cache::remember('active_users', 600, function () {
            return User::select('users.name', 'users.id', 'users.last_name', 'users.score')
                ->orderBy('score', 'desc')
                ->take(5)
                ->get();
        });
    }

    public function getStatistics()
    {
        return Cache::remember('statistics', 600, function () {
            return Statistic::all();
        });
    }
}
