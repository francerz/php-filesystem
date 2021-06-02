<?php

use Francerz\FileSystem\Path;
use PHPUnit\Framework\TestCase;

class PathTest extends TestCase
{
    public function testNormalizeSlach()
    {
        $actual = Path::normalizeSlash('C:\\Users/user\\Desktop/');
        $this->assertEquals('C:/Users/user/Desktop/', $actual);
    }

    public function testJoin()
    {
        $this->assertEquals('/home/user/docs', Path::join('/home/user', 'docs'));
        $this->assertEquals('/home/user/docs', Path::join('/home','user','docs'));
        $this->assertEquals('/home/user/docs', Path::join('/home','','user','', 'docs'));
        $this->assertEquals('/home/user/docs', Path::join('/home','/','user','/', 'docs'));
        $this->assertEquals('/home/user/docs', Path::join('/home',null,'user',null, 'docs'));
        $this->assertEquals('/home/user/docs', Path::join('/home','','/',null,'user',null,'/','', 'docs'));
        $this->assertEquals('/home/user/docs', Path::join('/home',null, null, null, 'user', 'docs'));
        $this->assertEquals('/home/user/docs', Path::join('/home/','/user/','/docs'));

        $this->assertEquals('/home/user/docs/file.txt', Path::join('/home', ['user','docs','file.txt']));
        $this->assertEquals('/home/user/docs/file.txt', Path::join('/home', ['user'], 'docs', 'file.txt'));
        $this->assertEquals('/home/user/docs/file.txt', Path::join('/home', 'user', ['docs', 'file.txt']));
        $this->assertEquals('/home/user/docs/file.txt', Path::join('/home', ['user', null], [null,'docs'], ['/','file.txt',null]));
    }
}