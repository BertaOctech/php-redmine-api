<?php
/**
 * Membership API test
 *
 * PHP version 5.4
 *
 * @author     Malte Gerth <mail@malte-gerth.de>
 * @copyright  2014 Malte Gerth
 * @license    MIT
 * @link       https://github.com/kbsali/php-redmine-api
 * @since      2014-06-01
 */

namespace Redmine\Tests\Api;

use Redmine\Api\Membership;

/**
 * Membership API test
 *
 * @coversDefaultClass Redmine\Api\Membership
 *
 * @author     Malte Gerth <mail@malte-gerth.de>
 * @copyright  2014 Malte Gerth
 * @license    MIT
 * @link       https://github.com/kbsali/php-redmine-api
 * @since      2014-06-01
 */
class MembershipTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test all()
     *
     * @covers ::all
     * @test
     *
     * @return void
     */
    public function testAllReturnsClientGetResponseWithProject()
    {
        // Test values
        $getResponse = 'API Response';

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('get')
            ->with(
                $this->stringStartsWith('/projects/5/memberships.json')
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Membership($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->all(5));
    }

    /**
     * Test all()
     *
     * @covers ::all
     * @test
     *
     * @return void
     */
    public function testAllReturnsClientGetResponseWithParametersAndProject()
    {
        // Test values
        $parameters = array('not-used');
        $getResponse = array('API Response');

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->any())
            ->method('get')
            ->with(
                $this->logicalAnd(
                    $this->stringStartsWith('/projects/5/memberships.json'),
                    $this->stringContains('not-used')
                )
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Membership($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->all(5, $parameters));
    }

    /**
     * Test remove()
     *
     * @covers ::delete
     * @covers ::remove
     * @test
     *
     * @return void
     */
    public function testRemoveCallsDelete()
    {
        // Test values
        $getResponse = 'API Response';

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('delete')
            ->with(
                $this->logicalAnd(
                    $this->stringStartsWith('/memberships/5'),
                    $this->logicalXor(
                        $this->stringEndsWith('.json'),
                        $this->stringEndsWith('.xml')
                    )
                )
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Membership($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->remove(5));
    }

    /**
     * Test create()
     *
     * @covers ::create
     * @expectedException Exception
     * @test
     *
     * @return void
     */
    public function testCreateThrowsExceptionWithEmptyParameters()
    {
        // Test values
        $getResponse = 'API Response';

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();

        // Create the object under test
        $api = new Membership($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->create(5));
    }

    /**
     * Test create()
     *
     * @covers ::create
     * @expectedException Exception
     * @test
     *
     * @return void
     */
    public function testCreateThrowsExceptionIfRoleIdsAreMissingInParameters()
    {
        // Test values
        $getResponse = 'API Response';

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();

        // Create the object under test
        $api = new Membership($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->create(5, array('user_id' => 4)));
    }

    /**
     * Test create()
     *
     * @covers ::create
     * @covers ::post
     * @test
     *
     * @return void
     */
    public function testCreateCallsPost()
    {
        // Test values
        $getResponse = 'API Response';
        $parameters = array(
            'user_ids' => 1,
            'user_id' => 1,
            'role_ids' => 1
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('post')
            ->with(
                $this->logicalAnd(
                    $this->stringStartsWith('/projects/5/memberships'),
                    $this->stringEndsWith('.xml')
                ),
                $this->logicalAnd(
                    $this->stringStartsWith('<?xml version="1.0"?>' . PHP_EOL . '<membership>'),
                    $this->stringEndsWith('</membership>' . PHP_EOL)
                )
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Membership($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->create(5, $parameters));
    }

    /**
     * Test update()
     *
     * @covers ::update
     * @expectedException Exception
     * @test
     *
     * @return void
     */
    public function testUpdateThrowsExceptionIfRoleIdsAreMissingInParameters()
    {
        // Test values
        $getResponse = 'API Response';

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();

        // Create the object under test
        $api = new Membership($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->update(5, array('user_id' => 4)));
    }

    /**
     * Test update()
     *
     * @covers ::put
     * @covers ::update
     * @test
     *
     * @return void
     */
    public function testUpdateCallsPut()
    {
        // Test values
        $getResponse = 'API Response';
        $parameters = array(
            'role_ids' => 1
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('put')
            ->with(
                $this->logicalAnd(
                    $this->stringStartsWith('/memberships/5'),
                    $this->logicalXor(
                        $this->stringEndsWith('.json'),
                        $this->stringEndsWith('.xml')
                    )
                )
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Membership($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->update(5, $parameters));
    }
}
