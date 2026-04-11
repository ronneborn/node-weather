<?php
function make_slug(string $text): string
{
    $text = mb_strtolower(trim($text), 'UTF-8');
    $map = ['å'=>'a','ä'=>'a','ö'=>'o'];
    $text = strtr($text, $map);
    $text = preg_replace('/[^a-z0-9]+/u', '-', $text);
    return trim($text, '-') ?: 'sida';
}
