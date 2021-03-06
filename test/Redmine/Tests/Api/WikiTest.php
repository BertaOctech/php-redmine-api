<?php
/**
 * Wiki API test
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

use Redmine\Api\Wiki;

/**
 * Wiki API test
 *
 * @coversDefaultClass Redmine\Api\Wiki
 *
 * @author     Malte Gerth <mail@malte-gerth.de>
 * @copyright  2014 Malte Gerth
 * @license    MIT
 * @link       https://github.com/kbsali/php-redmine-api
 * @since      2014-06-03
 */
class WikiTest extends \PHPUnit_Framework_TestCase
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
            ->with('/projects/5/wiki/index.json')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Wiki($client);

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
                    $this->stringStartsWith('/projects/5/wiki/index.json'),
                    $this->stringContains('offset=10'),
                    $this->stringContains('limit=2')
                )
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Wiki($client);

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
    public function testShowWithNumericIdsReturnsClientGetResponse()
    {
        // Test values
        $getResponse = 'API Response';

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('get')
            ->with('/projects/5/wiki/test.json')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Wiki($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->show(5, 'test'));
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
    public function testShowWithIdentifierReturnsClientGetResponse()
    {
        // Test values
        $getResponse = 'API Response';

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('get')
            ->with('/projects/test/wiki/example.json')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Wiki($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->show('test', 'example'));
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
    public function testShowWithNumericIdsAndVersionReturnsClientGetResponse()
    {
        // Test values
        $getResponse = 'API Response';

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('get')
            ->with('/projects/5/wiki/test/22.json')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Wiki($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->show(5, 'test', 22));
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
    public function testShowWithIdentifierAndVersionReturnsClientGetResponse()
    {
        // Test values
        $getResponse = 'API Response';

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('get')
            ->with('/projects/test/wiki/example/22.json')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Wiki($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->show('test', 'example', 22));
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
            ->with('/projects/5/wiki/test.xml')
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Wiki($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->remove(5, 'test'));
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

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('put')
            ->with(
                '/projects/5/wiki/test.xml',
                '<?xml version="1.0"?>' . PHP_EOL . '<wiki_page/>' . PHP_EOL
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Wiki($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->create(5, 'test'));
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
    public function testCreateWithParametersCallsPost()
    {
        // Test values
        $getResponse = 'API Response';
        $parameters = array(
            'title'     => 'Test Wikipage',
            'comments'  => 'Initial Edit',
            'text'  => 'Some page text',
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('put')
            ->with(
                '/projects/5/wiki/test.xml',
                $this->logicalAnd(
                    $this->stringStartsWith('<?xml version="1.0"?>' . PHP_EOL . '<wiki_page>'),
                    $this->stringEndsWith('</wiki_page>' . PHP_EOL),
                    $this->stringContains('<title>Test Wikipage</title>'),
                    $this->stringContains('<comments>Initial Edit</comments>'),
                    $this->stringContains('<text>Some page text</text>')
                )
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Wiki($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->create(5, 'test', $parameters));
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

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('put')
            ->with(
                '/projects/5/wiki/test.xml',
                '<?xml version="1.0"?>' . PHP_EOL . '<wiki_page/>' . PHP_EOL
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Wiki($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->update(5, 'test'));
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
    public function testUpdateWithParametersCallsPut()
    {
        // Test values
        $getResponse = 'API Response';
        $parameters = array(
            'title'     => 'Test Wikipage',
            'comments'  => 'Initial Edit',
            'text'  => 'Some page text',
        );

        // Create the used mock objects
        $client = $this->getMockBuilder('Redmine\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
            ->method('put')
            ->with(
                '/projects/5/wiki/test.xml',
                $this->logicalAnd(
                    $this->stringStartsWith('<?xml version="1.0"?>' . PHP_EOL . '<wiki_page>'),
                    $this->stringEndsWith('</wiki_page>' . PHP_EOL),
                    $this->stringContains('<title>Test Wikipage</title>'),
                    $this->stringContains('<comments>Initial Edit</comments>'),
                    $this->stringContains('<text>Some page text</text>')
                )
            )
            ->willReturn($getResponse);

        // Create the object under test
        $api = new Wiki($client);

        // Perform the tests
        $this->assertSame($getResponse, $api->update(5, 'test', $parameters));
    }
}
