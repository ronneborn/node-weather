<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Models\Service;

class AdminServiceController extends Controller
{
    public function index(): void { $items=(new Service())->all(); $this->view('admin/services/index',compact('items'),'admin'); }
    public function create(): void { $this->view('admin/services/form',['item'=>null],'admin'); }
    public function store(): void { if(!verify_csrf()) exit('csrf'); $d=$_POST; $d['slug']=make_slug($d['slug'] ?: $d['name']); (new Service())->create($d); Response::redirect('/admin/services'); }
    public function edit(array $p): void { $item=(new Service())->find((int)$p['id']); $this->view('admin/services/form',compact('item'),'admin'); }
    public function update(array $p): void { if(!verify_csrf()) exit('csrf'); $d=$_POST; $d['slug']=make_slug($d['slug'] ?: $d['name']); (new Service())->update((int)$p['id'],$d); Response::redirect('/admin/services'); }
}
