<?php
/**
 * Version API test
 *
 * PHP version 5.4
 *
 * @author     Malte Gerth <mail@malte-gerth.de>
 * @copyright  2014 Malte Gerth
 * @license    MIT
 * @link       https://github.com/kbsali/php-redmine-api
 * @since      2014-06-03
 */

namespace Redmine\Tests\Api;

use Redmine\Api\Version;

/**
 * Version API test
 *
 * @coversDefaultClass Redmine\Api\Version
 *
 * @author     Malte Gerth <mail@malte-gerth.de>
 * @copyright  2014 Malte Gerth
 * @license    MIT
 * @link       https://github.com/kbsali/php-redmine-api
 * @since      2014-06-03
 */
class VersionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test all()
     *
     * @covers ::all
     * @test
     *
     * @return void
     */
    public function testAllReturnsClientGetResponse()
    {
        // Test values
        $getResponse = 'API Response';

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('get')
            ->with('/projects/5/versions.json')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

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
    public function testAllReturnsClientGetResponseWithParameters()
    {
        // Test values
        $parameters = array(
            'offset' => 10,
            'limit' => 2
        );
        $getResponse = array('API Response');

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->any())
            ->method('get')
            ->with(
                $this->logicalAnd(
                    $this->stringStartsWith('/projects/5/versions.json'),
                    $this->stringContains('offset=10'),
                    $this->stringContains('limit=2')
                )
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->all(5, $parameters));
    }

    /**
     * Test show()
     *
     * @covers ::get
     * @covers ::show
     * @test
     *
     * @return void
     */
    public function testShowWithNumericIdReturnsClientGetResponse()
    {
        // Test values
        $getResponse = 'API Response';

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('get')
            ->with('/versions/5.json')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->show(5));
    }

    /**
     * Test show()
     *
     * @covers ::get
     * @covers ::show
     * @test
     *
     * @return void
     */
    public function testShowWithStringReturnsClientGetResponse()
    {
        // Test values
        $getResponse = 'API Response';

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('get')
            ->with('/versions/test.json')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->show('test'));
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
    public function testRemoveWithNumericIdCallsDelete()
    {
        // Test values
        $getResponse = 'API Response';

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('delete')
            ->with('/versions/5.xml')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->remove(5));
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
    public function testRemoveWithStringCallsDelete()
    {
        // Test values
        $getResponse = 'API Response';

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('delete')
            ->with('/versions/test.xml')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->remove('test'));
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
        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $api->create(5);
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
    public function testCreateThrowsExceptionWithMissingNameInParameters()
    {
        // Test values
        $parameters = array(
            'description' => 'Test version description',
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $api->create(5, $parameters);
    }

    /**
     * Test create()
     *
     * @covers ::create
     * @covers ::validateStatus
     * @expectedException Exception
     * @test
     *
     * @return void
     */
    public function testCreateThrowsExceptionWithInvalidStatus()
    {
        // Test values
        $parameters = array(
            'description' => 'Test version description',
            'status' => 'invalid'
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $api->create('test', $parameters);
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
            'name' => 'Test version',
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('post')
            ->with(
                '/projects/5/versions.xml',
                $this->logicalAnd(
                    $this->stringStartsWith('<?xml version="1.0"?>' . PHP_EOL . '<version>'),
                    $this->stringEndsWith('</version>' . PHP_EOL),
                    $this->stringContains('<name>Test version</name>')
                )
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->create(5, $parameters));
    }

    /**
     * Test create()
     *
     * @covers ::create
     * @covers ::post
     * @covers ::validateStatus
     * @test
     *
     * @return void
     */
    public function testCreateWithValidStatusCallsPost()
    {
        // Test values
        $getResponse = 'API Response';
        $parameters = array(
            'name' => 'Test version',
            'status' => 'locked'
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('post')
            ->with(
                '/projects/5/versions.xml',
                $this->logicalAnd(
                    $this->stringStartsWith('<?xml version="1.0"?>' . PHP_EOL . '<version>'),
                    $this->stringEndsWith('</version>' . PHP_EOL),
                    $this->stringContains('<name>Test version</name>'),
                    $this->stringContains('<status>locked</status>')
                )
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->create(5, $parameters));
    }

    /**
     * Test update()
     *
     * @covers ::update
     * @covers ::validateStatus
     * @expectedException Exception
     * @test
     *
     * @return void
     */
    public function testUpdateThrowsExceptionWithInvalidStatus()
    {
        // Test values
        $parameters = array(
            'description' => 'Test version description',
            'status' => 'invalid'
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $api->update('test', $parameters);
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
            'name' => 'Test version',
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('put')
            ->with(
                '/versions/test.xml',
                $this->logicalAnd(
                    $this->stringStartsWith('<?xml version="1.0"?>' . PHP_EOL . '<version>'),
                    $this->stringEndsWith('</version>' . PHP_EOL),
                    $this->stringContains('<name>Test version</name>')
                )
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->update('test', $parameters));
    }

    /**
     * Test update()
     *
     * @covers ::update
     * @covers ::put
     * @covers ::validateStatus
     * @test
     *
     * @return void
     */
    public function testUpdateWithValidStatusCallsPut()
    {
        // Test values
        $getResponse = 'API Response';
        $parameters = array(
            'name' => 'Test version',
            'status' => 'locked'
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('put')
            ->with(
                '/versions/test.xml',
                $this->logicalAnd(
                    $this->stringStartsWith('<?xml version="1.0"?>' . PHP_EOL . '<version>'),
                    $this->stringEndsWith('</version>' . PHP_EOL),
                    $this->stringContains('<name>Test version</name>'),
                    $this->stringContains('<status>locked</status>')
                )
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->update('test', $parameters));
    }

    /**
     * Test listing()
     *
     * @covers ::listing
     * @test
     *
     * @return void
     */
    public function testListingReturnsNameIdArray()
    {
        // Test values
        $getResponse = array(
            'versions' => array(
                array('id' => 1, 'name' => 'Version 1'),
                array('id' => 5, 'name' => 'Version 5')
            ),
        );
        $expectedReturn = array(
            'Version 1' => 1,
            'Version 5' => 5,
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('get')
            ->with('/projects/5/versions.json')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $this->assertSame($expectedReturn, $api->listing(5));
    }

    /**
     * Test listing()
     *
     * @covers ::listing
     * @test
     *
     * @return void
     */
    public function testListingReturnsIdNameIfReverseIsFalseArray()
    {
        // Test values
        $getResponse = array(
            'versions' => array(
                array('id' => 1, 'name' => 'Version 1'),
                array('id' => 5, 'name' => 'Version 5')
            ),
        );
        $expectedReturn = array(
            1 => 'Version 1',
            5 => 'Version 5'
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('get')
            ->with('/projects/5/versions.json')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $this->assertSame($expectedReturn, $api->listing(5, false, false));
    }

    /**
     * Test listing()
     *
     * @covers ::listing
     * @test
     *
     * @return void
     */
    public function testListingCallsGetOnlyTheFirstTime()
    {
        // Test values
        $getResponse = array(
            'versions' => array(
                array('id' => 1, 'name' => 'Version 1'),
                array('id' => 5, 'name' => 'Version 5')
            ),
        );
        $expectedReturn = array(
            'Version 1' => 1,
            'Version 5' => 5,
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('get')
            ->with('/projects/5/versions.json')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $this->assertSame($expectedReturn, $api->listing(5));
        $this->assertSame($expectedReturn, $api->listing(5));
    }

    /**
     * Test listing()
     *
     * @covers ::listing
     * @test
     *
     * @return void
     */
    public function testListingCallsGetEveryTimeWithForceUpdate()
    {
        // Test values
        $getResponse = array(
            'versions' => array(
                array('id' => 1, 'name' => 'Version 1'),
                array('id' => 5, 'name' => 'Version 5')
            ),
        );
        $expectedReturn = array(
            'Version 1' => 1,
            'Version 5' => 5,
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->exactly(2))
            ->method('get')
            ->with('/projects/5/versions.json')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $this->assertSame($expectedReturn, $api->listing(5, true));
        $this->assertSame($expectedReturn, $api->listing(5, true));
    }

    /**
     * Test getIdByName()
     *
     * @covers ::getIdByName
     * @test
     *
     * @return void
     */
    public function testGetIdByNameMakesGetRequest()
    {
        // Test values
        $getResponse = array(
            'versions' => array(
                array('id' => 5, 'name' => 'Version 5')
            ),
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('get')
            ->with(
                $this->stringStartsWith('/projects/5/versions.json')
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Version($client);

        // Perform the tests
        $this->assertFalse($api->getIdByName(5, 'Version 1'));
        $this->assertSame(5, $api->getIdByName(5, 'Version 5'));
    }
}
