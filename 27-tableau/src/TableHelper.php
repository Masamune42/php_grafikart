<?php

namespace App;

class TableHelper
{
    const SORT_KEY = 'sort';
    const DIR_KEY = 'dir';
    public static function sort($sortKey, $label, $data)
    {
        $sort = isset($data[self::SORT_KEY]) ? $data[self::SORT_KEY] : null;
        $direction = isset($data[self::DIR_KEY]) ? $data[self::DIR_KEY] : null;
        $icon = "";
        if ($sort === $sortKey) {
            $icon = $direction === 'asc' ? "^" : "v";
        }
        $url = URLHelper::withParams($data, [
            'sort' => $sortKey,
            'dir' => $direction === 'asc' && $sort === $sortKey ? 'desc' : 'asc'
        ]);
        return <<<HTML
        <a href="?$url">$label $icon</a>
HTML;
    }
}
