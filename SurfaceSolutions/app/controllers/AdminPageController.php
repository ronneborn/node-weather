<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Models\Page;

class AdminPageController extends Controller
{
    public function index(): void { $pages = (new Page())->all(); $this->view('admin/pages/index', compact('pages'), 'admin'); }
    public function create(): void { $this->view('admin/pages/form', ['page'=>null], 'admin'); }
    public function store(): void { if(!verify_csrf()) exit('csrf'); (new Page())->create($_POST + ['slug'=>make_slug($_POST['slug'] ?: $_POST['title'])]); Response::redirect('/admin/pages'); }
    public function edit(array $p): void { $page=(new Page())->find((int)$p['id']); $this->view('admin/pages/form', compact('page'), 'admin'); }
    public function update(array $p): void { if(!verify_csrf()) exit('csrf'); (new Page())->update((int)$p['id'], $_POST + ['slug'=>make_slug($_POST['slug'] ?: $_POST['title'])]); Response::redirect('/admin/pages'); }
    public function delete(array $p): void { if(!verify_csrf()) exit('csrf'); (new Page())->delete((int)$p['id']); Response::redirect('/admin/pages'); }
    public function duplicate(array $p): void { if(!verify_csrf()) exit('csrf'); $m=new Page(); $o=$m->find((int)$p['id']); if($o){unset($o['id']);$o['title'].=' (kopia)';$o['slug']=make_slug($o['title']);$m->create($o);} Response::redirect('/admin/pages'); }
}
