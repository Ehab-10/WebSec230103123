<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // عرض كل الأسئلة
    public function index()
    {
        $questions = Question::all();
        return view('questions.index', compact('questions'));
    }

    // عرض صفحة إنشاء سؤال جديد
    public function create()
    {
        return view('questions.create');
    }

    // تخزين سؤال جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'option1' => 'required|string',
            'option2' => 'required|string',
            'option3' => 'required|string',
            'option4' => 'required|string',
            'correct_option' => 'required|integer|between:1,4',
        ]);

        Question::create($validated);

        return redirect()->route('questions.index')->with('success', 'Question created successfully!');
    }

    // عرض صفحة تعديل السؤال
    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    // تحديث السؤال
    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'option1' => 'required|string',
            'option2' => 'required|string',
            'option3' => 'required|string',
            'option4' => 'required|string',
            'correct_option' => 'required|integer|between:1,4',
        ]);

        $question->update($validated);

        return redirect()->route('questions.index')->with('success', 'Question updated successfully!');
    }

    // حذف السؤال
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully!');
    }

    // دالة submit يجب أن تكون داخل نفس الكلاس
   public function submit(Request $request)
{
    $answers = $request->input('answers', []); // لو ما وصلش شيء نستخدم مصفوفة فارغة

    $score = 0;
    $total = count($answers);

    foreach ($answers as $question_id => $selected_option) {
        $question = Question::find($question_id);
        if ($question && $question->correct_option == (int)$selected_option) {
            $score++;
        }
    }

    $percentage = $total > 0 ? round(($score / $total) * 100, 2) : 0;

    return view('questions.result', compact('score', 'total', 'percentage'));
}
}
