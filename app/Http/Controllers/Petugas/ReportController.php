<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $years = Buku::getYearsData();
        return view('petugas/reports.index', compact('years'));
    }

    public function filterReports(Request $request)
    {
        $reportType = $request->get('report_type');
        $filterType = $request->get('filter_type');

        if ($filterType == 'month') {
            return $this->printReportByMonth($request);
        } else {
            return $this->printReportByYear($request);
        }
    }

    private function printReportByMonth(Request $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');
        $books = Buku::getBooksByMonth($month, $year);

        if ($books->isEmpty()) {
            return redirect()->back()->with('error', 'No data found for the selected month and year.');
        }

        $monthName = date('F', mktime(0, 0, 0, $month, 10));
        $title = "Report Buku Bulan $monthName $year";

        $pdf = PDF::loadView('petugas/reports.monthly', compact('title', 'month', 'year', 'books'));
        return $pdf->download('Report_Buku_Bulanan.pdf');
    }

    private function printReportByYear(Request $request)
    {
        $year = $request->get('year');
        $books = Buku::getBooksByYear($year);

        if ($books->isEmpty()) {
            return redirect()->back()->with('error', 'No data found for the selected year.');
        }

        $title = "Report Buku Tahun $year";

        $pdf = PDF::loadView('petugas/reports.yearly', compact('title', 'year', 'books'));
        return $pdf->download('Report_Buku_Tahunan.pdf');
    }
}
