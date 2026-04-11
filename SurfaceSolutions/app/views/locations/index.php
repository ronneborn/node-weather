<div class="container"><h1>Områden</h1><ul><?php foreach($locations as $l): ?><li><a href="/<?=e($l['slug'])?>"><?=e($l['name'])?></a></li><?php endforeach; ?></ul></div>
