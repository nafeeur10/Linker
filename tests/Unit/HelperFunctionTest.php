<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

include_once __DIR__ . '/../../app/helpers.php';

class HelperFunctionTest extends TestCase
{
    public function testGetMainDomain()
    {
        $url = 'https://www.example.com/path';
        $result = getMainDomain($url);
        $this->assertEquals('https://www.example.com', $result);
    }

    public function testGetMainDomainWithDifferentSchemes()
    {
        $url = 'http://www.example.com';
        $result = getMainDomain($url);
        $this->assertEquals('http://www.example.com', $result);

        $url = 'ftp://www.example.com';
        $result = getMainDomain($url);
        $this->assertEquals('ftp://www.example.com', $result);
    }

    public function testGetMainDomainReturnsEmptyStringForInvalidUrls()
    {
        $url = 'invalid_url';
        $expected = '';

        $this->assertEquals($expected, getMainDomain($url));
    }
}
