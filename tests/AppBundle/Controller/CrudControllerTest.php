<?php

namespace Tests\AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class CrudControllerTest extends WebTestCase
{
    public function createApplication()
    {
        return require __DIR__.'CrudControllerTest.php';
    }
    public function testIndexAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/crud/');
        $this->assertTrue($client->getResponse()->isOk());
        //$client->followRedirects();
        $this->assertContains('Id', $crawler->filter('thead')->text());
        $this->assertContains('Firstname', $crawler->filter('thead')->text());
        $this->assertContains('Lastname', $crawler->filter('thead')->text());
        $this->assertContains('Hiredate', $crawler->filter('thead')->text());
        $this->assertContains('Age', $crawler->filter('thead')->text());
        $this->assertContains('Actions', $crawler->filter('thead')->text());
        $this->assertCount(1, $crawler->filter('h3:contains("Employees list")'));
        $link = $crawler
            ->filter('a:contains("select")')
            ->link();
        $client->click($link);
    }
        public function testDeleteAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/crud/');
        $url = $crawler->selectLink('delete')->link();
        $crawler = $client->click($url);
        $form['name'] = 'delete';
        $form = $crawler->selectButton('delete[save]')->form();
        $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $client->followRedirect();
        $this->assertTrue($client->getResponse()->isOk());
    }
    public function testNewAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/crud/');
        $url = $crawler->selectLink('insert')->link();
        $crawler = $client->click($url);
        $form['name'] = 'crud';
        $form = $crawler->selectButton('crud[save]')->form(array(
            'crud[firstName]' => 'testFirstName',
            'crud[lastName]' => 'testLastName',
            'crud[hireDate][date][year]' => '2012',
            'crud[hireDate][date][month]' => '1',
            'crud[hireDate][date][day]' => '1',
            'crud[hireDate][time][hour]' => '1',
            'crud[hireDate][time][minute]' => '0',
            'crud[age]' => '120',
        ));
        $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $client->followRedirect();
        $this->assertTrue($client->getResponse()->isOk());
    }
    public function testEditAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/crud/');
        $url = $crawler->selectLink('update')->link();
        $crawler = $client->click($url);
        $form['name'] = 'crud';
        $form = $crawler->selectButton('crud[save]')->form(array(
            'crud[firstName]' => 'double_testFirstName',
            'crud[lastName]' => 'double_testLastName',
            'crud[hireDate][date][year]' => '2017',
            'crud[hireDate][date][month]' => '12',
            'crud[hireDate][date][day]' => '12',
            'crud[hireDate][time][hour]' => '12',
            'crud[hireDate][time][minute]' => '24',
            'crud[age]' => '1',
            ));
        $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $client->followRedirect();
        $this->assertTrue($client->getResponse()->isOk());
    }
}
