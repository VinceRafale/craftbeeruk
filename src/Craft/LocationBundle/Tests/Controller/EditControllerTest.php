<?php

namespace Craft\LocationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EditControllerTest extends WebTestCase
{
    public function testGeneral()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/general');
    }

    public function testDrinks()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/drinks');
    }

    public function testFood()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/food');
    }

    public function testOpening()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/opening');
    }

}
