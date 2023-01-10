<?php

namespace App\Http\Controllers\TestReview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestReviewController extends Controller
{
    public function index()
    {
        return view('user.test-review.test-review');
    }

    public function questionConceptReview()
    {
        return view('user.test-review.question_concepts_review');
    }
}
