<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Models\BlogPost;

class AdminBlogController extends Controller
{
    public function index(): void { $items=(new BlogPost())->all(); $this->view('admin/blog/index',compact('items'),'admin'); }
    public function create(): void { $item=null; $this->view('admin/blog/form',compact('item'),'admin'); }
    public function store(): void { if(!verify_csrf()) exit('csrf'); $d=$_POST; $d['slug']=make_slug($d['slug'] ?: $d['title']); (new BlogPost())->create($d); Response::redirect('/admin/blog'); }
    public function edit(array $p): void { $item=(new BlogPost())->find((int)$p['id']); $this->view('admin/blog/form',compact('item'),'admin'); }
    public function update(array $p): void { if(!verify_csrf()) exit('csrf'); $d=$_POST; $d['slug']=make_slug($d['slug'] ?: $d['title']); (new BlogPost())->update((int)$p['id'],$d); Response::redirect('/admin/blog'); }
}
