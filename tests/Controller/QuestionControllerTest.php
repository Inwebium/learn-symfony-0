<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class QuestionControllerTest extends WebTestCase
{
    private $client;
    
    public function __construct($name = null, $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        
        $this->client = static::createClient();

    }
    
    public function testList()
    {   
        $this->client->request('GET', '/question/list');
        
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        
        $this->client->request('GET', '/questions');
        
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
    
    public function testDetail()
    {   
        $this->client->request('GET', '/question/81312066-d6b5-4996-8213-3dca9e379ac4');
        
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        
        $this->client->request('GET', '/question/00000000-aaaa-0000-0000-aaaaaaaaaaaa');
        
        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }
}