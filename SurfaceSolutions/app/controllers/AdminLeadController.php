<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\ContactSubmission;

class AdminLeadController extends Controller
{
    public function index(): void
    {
        $leads = (new ContactSubmission())->all();
        $this->view('admin/leads/index', compact('leads'), 'admin');
    }

    public function exportCsv(): void
    {
        $leads = (new ContactSubmission())->all();
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=leads.csv');
        $out = fopen('php://output', 'w');
        fputcsv($out, ['Namn', 'E-post', 'Telefon', 'Meddelande', 'Skapad']);
        foreach ($leads as $l) fputcsv($out, [$l['name'],$l['email'],$l['phone'],$l['message'],$l['created_at']]);
        fclose($out);
        exit;
    }
}
