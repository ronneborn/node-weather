<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Models\Location;

class AdminLocationController extends Controller
{
    public function index(): void { $items=(new Location())->all(); $this->view('admin/locations/index',compact('items'),'admin'); }
    public function create(): void { $this->view('admin/locations/form',['item'=>null],'admin'); }
    public function store(): void { if(!verify_csrf()) exit('csrf'); $d=$_POST; $d['slug']=make_slug($d['slug'] ?: $d['name']); (new Location())->create($d); Response::redirect('/admin/locations'); }
    public function edit(array $p): void { $item=(new Location())->find((int)$p['id']); $this->view('admin/locations/form',compact('item'),'admin'); }
    public function update(array $p): void { if(!verify_csrf()) exit('csrf'); $d=$_POST; $d['slug']=make_slug($d['slug'] ?: $d['name']); (new Location())->update((int)$p['id'],$d); Response::redirect('/admin/locations'); }
}
