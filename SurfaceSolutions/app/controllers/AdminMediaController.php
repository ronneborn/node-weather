<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Models\Media;

class AdminMediaController extends Controller
{
    public function index(): void
    {
        $media = (new Media())->all();
        $this->view('admin/media/index', compact('media'), 'admin');
    }

    public function upload(): void
    {
        if(!verify_csrf()) exit('csrf');
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) Response::redirect('/admin/media');
        $allowed = ['image/jpeg','image/png','image/webp'];
        if (!in_array(mime_content_type($_FILES['file']['tmp_name']), $allowed, true)) Response::redirect('/admin/media');
        $name = time() . '-' . preg_replace('/[^a-zA-Z0-9.-]/', '-', $_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], __DIR__ . '/../../public/uploads/' . $name);
        (new Media())->create(['file_name'=>$name,'file_path'=>'/uploads/'.$name,'alt_text'=>$_POST['alt_text'] ?? '']);
        Response::redirect('/admin/media');
    }
}
