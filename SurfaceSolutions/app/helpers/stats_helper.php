<?php
use App\Models\PageView;
use App\Core\Session;

function track_view(string $type, int $id, string $slug): void
{
    $key = 'view_' . md5($type.$id.$slug.date('Y-m-d-H'));
    if (Session::get($key)) {
        return;
    }
    Session::put($key, true);
    (new PageView())->create([
        'page_type' => $type,
        'page_id' => $id,
        'slug' => $slug,
        'ip_hash' => hash('sha256', $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0'),
        'user_agent_hash' => hash('sha256', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'),
        'referrer' => $_SERVER['HTTP_REFERER'] ?? null,
    ]);
}
