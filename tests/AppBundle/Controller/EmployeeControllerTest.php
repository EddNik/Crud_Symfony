<?php

namespace Tests\AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class EmployeeControllerTest extends WebTestCase
{
    public function createApplication()
    {
        return require __DIR__ . 'EmployeeControllerTest.php';
    }
    public function testIndexAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/employee/');
        $this->assertTrue($client->getResponse()->isOk());
        $client->followRedirects();
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
        $crawler = $client->request('GET', '/employee/');
        $url = $crawler->selectLink('delete')->link();
        $crawler = $client->click($url);
        $form['name'] = 'delete';
        $form = $crawler->selectButton('delete_employee[save]')->form();
        $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $client->followRedirect();
        $this->assertTrue($client->getResponse()->isOk());
    }
    public function testNewAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/employee/');
        $url = $crawler->selectLink('insert')->link();
        $crawler = $client->click($url);
        $form['name'] = 'edit';
        $form = $crawler->selectButton('edit_employee[save]')->form(array(
            'edit_employee[firstName]' => 'testFirstName',
            'edit_employee[lastName]' => 'testLastName',
            'edit_employee[hireDate][date][year]' => '2012',
            'edit_employee[hireDate][date][month]' => '1',
            'edit_employee[hireDate][date][day]' => '1',
            'edit_employee[hireDate][time][hour]' => '1',
            'edit_employee[hireDate][time][minute]' => '0',
            'edit_employee[age]' => '120',
        ));
        $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $client->followRedirect();
        $this->assertTrue($client->getResponse()->isOk());
    }
    public function testEditAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/employee/');
        $url = $crawler->selectLink('update')->link();
        $crawler = $client->click($url);
        $form['name'] = 'employee';
        $form = $crawler->selectButton('edit_employee[save]')->form(array(
            'edit_employee[firstName]' => 'double_testFirstName',
            'edit_employee[lastName]' => 'double_testLastName',
            'edit_employee[hireDate][date][year]' => '2017',
            'edit_employee[hireDate][date][month]' => '12',
            'edit_employee[hireDate][date][day]' => '12',
            'edit_employee[hireDate][time][hour]' => '12',
            'edit_employee[hireDate][time][minute]' => '24',
            'edit_employee[age]' => '1',
            ));
        $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $client->followRedirect();
        $this->assertTrue($client->getResponse()->isOk());
    }
}
