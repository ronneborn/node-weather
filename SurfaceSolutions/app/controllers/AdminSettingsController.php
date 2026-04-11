<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Response;

class AdminSettingsController extends Controller
{
    public function index(): void
    {
        $settings = Database::getInstance()->query('SELECT `key`,`value` FROM settings')->fetchAll();
        $map=[]; foreach($settings as $s){$map[$s['key']]=$s['value'];}
        $this->view('admin/settings/index', compact('map'), 'admin');
    }

    public function save(): void
    {
        if(!verify_csrf()) exit('csrf');
        $db = Database::getInstance();
        foreach ($_POST as $k => $v) {
            if ($k === '_token') continue;
            $stmt = $db->prepare('INSERT INTO settings(`key`,`value`,created_at,updated_at) VALUES(:k,:v,NOW(),NOW()) ON DUPLICATE KEY UPDATE `value`=:v2,updated_at=NOW()');
            $stmt->execute(['k' => $k, 'v' => $v, 'v2' => $v]);
        }
        Response::redirect('/admin/settings');
    }
}
