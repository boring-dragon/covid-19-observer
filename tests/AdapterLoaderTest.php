<?php

class AdapterLoaderTest extends \PHPUnit\Framework\TestCase
{
    public function testIfAdapterLoaderReturnsAnInstanceOfAnAdapter()
    {
        $adapterloader  = Jinas\Covid19\Statistics::LoadAdapter(new \Jinas\Covid19\Adapters\JohnHopkins);

        $this->assertEquals($adapterloader, new \Jinas\Covid19\Adapters\JohnHopkins);
    }
}