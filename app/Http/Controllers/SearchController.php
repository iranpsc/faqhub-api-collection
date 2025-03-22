<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchTags(Request $request)
    {
        $tags = Tag::query()
            ->where('name', 'like', '%' . $request->get('query') . '%')
            ->select(['id', 'name'])
            ->take(10)
            ->get();

        return response()->json($tags);
    }


    public function searchQuestions(Request $request)
    {
        $query = $request->get('query');
        $questions = Question::query()
            ->with(['category:id,name'])
            ->withCount('answers')
            ->where('title', 'like', '%' . $query . '%')
            ->select(['id', 'title', 'category_id', 'created_at'])
            ->take(10)
            ->get();
        return response()->json($questions);
    }
}
