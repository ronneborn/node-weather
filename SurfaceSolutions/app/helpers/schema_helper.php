<?php
function json_ld(array $schema): string
{
    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) . '</script>';
}
