<?php

namespace MarioDevv\Uptime\Tests\Monitoring\Application\Count;

use CodelyTv\Criteria\Criteria;
use MarioDevv\Uptime\Monitoring\Application\Count\CountMonitors;
use MarioDevv\Uptime\Tests\Monitoring\Domain\Model\Monitor\MonitorUnitTestHelper;

class CountMonitorsTest extends MonitorUnitTestHelper
{

    private CountMonitors $countMonitors;

    public function setUp(): void
    {
        parent::setUp();

        $this->countMonitors = new CountMonitors(
            $this->repository()
        );
    }

    /** @test */
    public function it_should_count_monitors(): void
    {

        $criteria = Criteria::withFilters([]);
        $count    = 1;

        $this->countByCriteria($criteria, $count);

        ($this->countMonitors)($criteria);

    }

}
