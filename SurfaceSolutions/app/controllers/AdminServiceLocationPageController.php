<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Models\ServiceLocationPage;
use App\Models\Service;
use App\Models\Location;

class AdminServiceLocationPageController extends Controller
{
    public function index(): void { $items=(new ServiceLocationPage())->all(); $this->view('admin/service_location_pages/index',compact('items'),'admin'); }
    public function create(): void { $item=null; $services=(new Service())->all(); $locations=(new Location())->all(); $this->view('admin/service_location_pages/form',compact('item','services','locations'),'admin'); }
    public function store(): void { if(!verify_csrf()) exit('csrf'); $d=$_POST; $d['slug']=make_slug($d['slug'] ?: ($d['service_slug'].'-'.$d['location_slug'])); (new ServiceLocationPage())->create($d); Response::redirect('/admin/service-location-pages'); }
    public function edit(array $p): void { $item=(new ServiceLocationPage())->find((int)$p['id']); $services=(new Service())->all(); $locations=(new Location())->all(); $this->view('admin/service_location_pages/form',compact('item','services','locations'),'admin'); }
    public function update(array $p): void { if(!verify_csrf()) exit('csrf'); $d=$_POST; $d['slug']=make_slug($d['slug'] ?: ($d['service_slug'].'-'.$d['location_slug'])); (new ServiceLocationPage())->update((int)$p['id'],$d); Response::redirect('/admin/service-location-pages'); }
    public function generate(): void { if(!verify_csrf()) exit('csrf'); $service=$_POST['service_slug'];$location=$_POST['location_slug'];$slug="$service-$location"; (new ServiceLocationPage())->create(['service_id'=>(int)$_POST['service_id'],'location_id'=>(int)$_POST['location_id'],'service_slug'=>$service,'location_slug'=>$location,'slug'=>$slug,'title'=>ucfirst(str_replace('-',' ',$service)).' i '.ucfirst($location),'h1'=>ucfirst(str_replace('-',' ',$service)).' '.ucfirst($location),'intro'=>'Lokal expertis i '.ucfirst($location).'.','content'=>'SurfaceSolutions hjälper dig med '.str_replace('-',' ',$service).' i '.ucfirst($location).'.','meta_title'=>ucfirst(str_replace('-',' ',$service)).' '.ucfirst($location).' | SurfaceSolutions','meta_description'=>'Boka '.str_replace('-',' ',$service).' i '.ucfirst($location).' med snabb offert.','status'=>'published']); Response::redirect('/admin/service-location-pages'); }
}
