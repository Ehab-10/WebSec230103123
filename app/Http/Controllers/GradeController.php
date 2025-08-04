<?php
namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        // جلب الدرجات مجمعة حسب term
        $gradesByTerm = Grade::orderBy('term')->get()->groupBy('term');

        // تحضير بيانات الحساب
        $termsData = [];

        $totalCreditHoursAllTerms = 0;
        $totalQualityPointsAllTerms = 0;

        foreach ($gradesByTerm as $term => $grades) {
            $totalCH = $grades->sum('credit_hours');
            $totalQualityPoints = $grades->sum(function($grade) {
                return $grade->credit_hours * $grade->grade_point;
            });

            $gpa = $totalCH > 0 ? round($totalQualityPoints / $totalCH, 2) : 0;

            $termsData[$term] = [
                'grades' => $grades,
                'totalCH' => $totalCH,
                'gpa' => $gpa,
            ];

            // للجمع التراكمي
            $totalCreditHoursAllTerms += $totalCH;
            $totalQualityPointsAllTerms += $totalQualityPoints;
        }

        $cgpa = $totalCreditHoursAllTerms > 0 ? round($totalQualityPointsAllTerms / $totalCreditHoursAllTerms, 2) : 0;

        return view('grades.index', compact('termsData', 'cgpa', 'totalCreditHoursAllTerms'));
    }

    public function create()
    {
        return view('grades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'term' => 'required|integer|min:1',
            'credit_hours' => 'required|integer|min:1',
            'grade_point' => 'required|numeric|min:0|max:4',
        ]);

        Grade::create($request->all());

        return redirect()->route('grades.index')->with('success', 'Grade added successfully!');
    }

    public function edit(Grade $grade)
    {
        return view('grades.edit', compact('grade'));
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'term' => 'required|integer|min:1',
            'credit_hours' => 'required|integer|min:1',
            'grade_point' => 'required|numeric|min:0|max:4',
        ]);

        $grade->update($request->all());

        return redirect()->route('grades.index')->with('success', 'Grade updated successfully!');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully!');
    }
}
