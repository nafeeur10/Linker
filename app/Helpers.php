<?php

function getMainDomain($url): string
{
    $mainDomain = '';
    $parsedUrl = parse_url(str_replace('"', '', $url));
    if (isset($parsedUrl['scheme'], $parsedUrl['host'])) {
        $mainDomain = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
    }
    return $mainDomain;
}