<?php

namespace MarioDevv\Uptime\Tests\Monitor\Application\Search;

use CodelyTv\Criteria\Criteria;
use MarioDevv\Uptime\Monitor\Application\PaginatedMonitorDTO;
use MarioDevv\Uptime\Monitor\Application\Search\SearchMonitors;
use MarioDevv\Uptime\Monitor\Domain\Monitor;
use MarioDevv\Uptime\Tests\Monitor\MonitorUnitTestHelper;

class SearchMonitorsTest extends MonitorUnitTestHelper
{

    private SearchMonitors $searchMonitors;

    protected function setUp(): void
    {
        parent::setUp();
        $this->searchMonitors = new SearchMonitors(
            $this->repository(),
            $this->assembler()
        );
    }

    /** @test */
    public function it_should_search_monitors_by_criteria()
    {

        $expectedCriteria = Criteria::withFilters([]);

        $expectedMonitors = $this->randomMonitors();

        $this->matching($expectedCriteria, $expectedMonitors);

        foreach ($expectedMonitors as $monitor) {

            $expectedDto = new PaginatedMonitorDTO($monitor);

            $expectedArray = [
                'id'        => $monitor->id(),
                'url'       => $monitor->url()->value(),
                'status'    => $monitor->state()->value(),
                'lastCheck' => $monitor->lastCheck()->format(),
            ];

            $this->assemble($monitor, $expectedDto);

            $this->assertEquals($expectedArray, $expectedDto->json());


        }

        ($this->searchMonitors)($expectedCriteria);

        $this->assertCount(count($expectedMonitors), $expectedMonitors);
    }

    private function randomMonitors(): array
    {

        $array = [];

        for ($i = 0; $i < 10; $i++) {

            $monitor = Monitor::create($i + 1, 'https://www.google.com', 60, 1);

            $array[] = $monitor;

        }

        return $array;

    }

}
