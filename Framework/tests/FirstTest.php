<?php

//namespace myProject\Framework\Tests;


class FirstTest extends PHPUnit_Framework_TestCase
{

    public function testOnePlusOneEqualTwo()
    {
        $this->assertEquals(1 + 1, 2, 'Le calcule n\'est pas égal à deux');
    }

}