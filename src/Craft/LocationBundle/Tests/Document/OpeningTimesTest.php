<?php
/**
 * Author: rick
 * Date: 06/11/2013
 * Time: 16:10
 */
namespace Craft\LocationBundle\Tests\Document;

use \Craft\LocationBundle\Document\OpeningTimes;
use \Craft\LocationBundle\Document\OpeningHours;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OpeningTimesTest extends WebTestCase
{

    /** @var  \Craft\LocationBundle\Document\OpeningTimes */
    protected $openingTimes;

    public function setUp()
    {
        $o = new OpeningTimes();

        $mon = new OpeningHours();
        $mon->setClosed(true);

        $tue = new OpeningHours();
        $tue->setOpens('16:00');
        $tue->setCloses('23:30');

        $wed = clone $tue;

        $thu = clone $tue;

        $fri = new OpeningHours();
        $fri->setOpens('14:00');
        $fri->setCloses('02:00');

        $sat = new OpeningHours();
        $sat->setOpens('12:00');
        $sat->setCloses('01:00');

        $sun = new OpeningHours();
        $sun->setOpens('12:00');
        $sun->setCloses('00:00');

        $o->setMon($mon)
            ->setTue($tue)
            ->setWed($wed)
            ->setThu($thu)
            ->setFri($fri)
            ->setSat($sat)
            ->setSun($sun);

        $this->openingTimes = $o;


    }

    public function testNormal()
    {
        $date = new \DateTime();
        $date->modify('Tuesday 18:30');
        $this->assertTrue($this->openingTimes->isOpen($date));

        $date->modify('Tuesday 23:45');
        $this->assertFalse($this->openingTimes->isOpen($date));
    }

    public function testClosed()
    {
        $date = new \DateTime();
        $date->modify('Monday 19:00');
        $this->assertFalse($this->openingTimes->isOpen($date));
    }

    public function testLateNight()
    {
        $date = new \DateTime();
        $date->modify('Saturday 01:30');
        $this->assertTrue($this->openingTimes->isOpen($date));
        $date->modify('Saturday 02:30');
        $this->assertFalse($this->openingTimes->isOpen($date));
        $date->modify('Friday 01:30');
        $this->assertFalse($this->openingTimes->isOpen($date));
    }

    public function testAfternoon()
    {
        $date = new \DateTime();
        $date->modify('Tuesday 17:30');
        $this->assertTrue($this->openingTimes->isOpen($date));
    }

    public function testClosingTime()
    {
        $date = new \DateTime();
        $date->modify('Sunday 23:59');
        $this->assertTrue($this->openingTimes->isOpen($date));

        $date->modify('Monday 00:00');
        $this->assertFalse($this->openingTimes->isOpen($date));
    }

} 