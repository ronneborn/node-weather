<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\ContactSubmission;
use App\Core\Response;

class ContactController extends Controller
{
    public function index(): void { $this->view('contact/index'); }

    public function submit(): void
    {
        if (!verify_csrf()) { http_response_code(419); exit('Ogiltig CSRF-token'); }
        (new ContactSubmission())->create([
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'message' => $_POST['message'] ?? '',
            'service_slug' => $_POST['service_slug'] ?? null,
            'location_slug' => $_POST['location_slug'] ?? null,
            'status' => 'new',
        ]);
        Response::redirect('/kontakt?sent=1');
    }
}
