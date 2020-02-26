<?php

namespace FeedReader\Tests\DataProvider;

use FeedReader\Dataprovider\DataSourceMapper;
use FeedReader\Dataprovider\Assortment\DataSource\IMapper;
use PHPUnit\Framework\TestCase;

class DataSourceMapperTest extends TestCase
{
    private $mapper;

    public function setUp()
    {
        $mapperMock = $this->getMockBuilder(IMapper::class)
            ->getMock();

        $mapperMock
            ->expects($this->once())
            ->method('getMapping')
            ->willReturn(["id" => "id", "email" => "Email"]);

        $mapperMock
            ->expects($this->once())
            ->method('getMappingFunctionSet')
            ->willReturn(["email" => function($v) {return md5($v);}, "id" => function($v) {return "NN" . $v;}])
            ->getMatcher()

            ;

        $this->mapper = new DataSourceMapper($mapperMock);
    }

    public function testDataSourceMapperMapNotFullInput()
    {
        $input = ['id' => 5];

        $this->expectException(\Exception::class);
        $this->mapper->map($input);
    }

    public function testDataSourceMappedToDestinationCorrectly()
    {
        $input = ['id' => 5, 'Email' => 'test@test.com'];

        $expected = [
            'id' => "NN5",
            'email' => 'b642b4217b34b1e8d3bd915fc65c4452',
        ];

        $this->assertEquals($expected, $this->mapper->map($input));
    }

    public function testRedundantInputWillBeCutted()
    {
        $input = ['id' => 5, 'Email' => 'test@test.com', 'ddd' => 3434];

        $expected = [
            'id' => "NN5",
            'email' => 'b642b4217b34b1e8d3bd915fc65c4452',
        ];

        $this->assertEquals($expected, $this->mapper->map($input));
    }
}
