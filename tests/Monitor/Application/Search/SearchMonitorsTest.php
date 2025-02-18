<?php

namespace MarioDevv\Uptime\Tests\Monitor\Application\Search;

use CodelyTv\Criteria\Criteria;
use MarioDevv\Uptime\Monitoring\Application\Search\SearchMonitors;
use MarioDevv\Uptime\Tests\Monitor\Domain\MonitorMother;
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
            $this->assemble($monitor);
        }

        ($this->searchMonitors)($expectedCriteria);

        $this->assertCount(count($expectedMonitors), $expectedMonitors);
    }

    private function randomMonitors(): array
    {

        $array = [];

        for ($i = 0; $i < 10; $i++) {
            $array[] = MonitorMother::random();
        }

        return $array;

    }

}
