<?php
/**
 * Author: rick
 * Date: 31/10/2013
 * Time: 15:36
 */

namespace Craft\LocationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @MongoDB\EmbeddedDocument
 */
class OpeningTimes
{

    /** @MongoDB\EmbedOne(targetDocument="OpeningHours") */
    protected $mon;
    /** @MongoDB\EmbedOne(targetDocument="OpeningHours") */
    protected $tue;
    /** @MongoDB\EmbedOne(targetDocument="OpeningHours") */
    protected $wed;
    /** @MongoDB\EmbedOne(targetDocument="OpeningHours") */
    protected $thu;
    /** @MongoDB\EmbedOne(targetDocument="OpeningHours") */
    protected $fri;
    /** @MongoDB\EmbedOne(targetDocument="OpeningHours") */
    protected $sat;
    /** @MongoDB\EmbedOne(targetDocument="OpeningHours") */
    protected $sun;


    /**
     * Set mon
     *
     * @param Craft\LocationBundle\Document\OpeningHours $mon
     * @return self
     */
    public function setMon(\Craft\LocationBundle\Document\OpeningHours $mon)
    {
        $this->mon = $mon;
        return $this;
    }

    /**
     * Get mon
     *
     * @return Craft\LocationBundle\Document\OpeningHours $mon
     */
    public function getMon()
    {
        return $this->mon;
    }

    /**
     * Set tue
     *
     * @param Craft\LocationBundle\Document\OpeningHours $tue
     * @return self
     */
    public function setTue(\Craft\LocationBundle\Document\OpeningHours $tue)
    {
        $this->tue = $tue;
        return $this;
    }

    /**
     * Get tue
     *
     * @return Craft\LocationBundle\Document\OpeningHours $tue
     */
    public function getTue()
    {
        return $this->tue;
    }

    /**
     * Set wed
     *
     * @param Craft\LocationBundle\Document\OpeningHours $wed
     * @return self
     */
    public function setWed(\Craft\LocationBundle\Document\OpeningHours $wed)
    {
        $this->wed = $wed;
        return $this;
    }

    /**
     * Get wed
     *
     * @return Craft\LocationBundle\Document\OpeningHours $wed
     */
    public function getWed()
    {
        return $this->wed;
    }

    /**
     * Set thu
     *
     * @param Craft\LocationBundle\Document\OpeningHours $thu
     * @return self
     */
    public function setThu(\Craft\LocationBundle\Document\OpeningHours $thu)
    {
        $this->thu = $thu;
        return $this;
    }

    /**
     * Get thu
     *
     * @return Craft\LocationBundle\Document\OpeningHours $thu
     */
    public function getThu()
    {
        return $this->thu;
    }

    /**
     * Set fri
     *
     * @param Craft\LocationBundle\Document\OpeningHours $fri
     * @return self
     */
    public function setFri(\Craft\LocationBundle\Document\OpeningHours $fri)
    {
        $this->fri = $fri;
        return $this;
    }

    /**
     * Get fri
     *
     * @return Craft\LocationBundle\Document\OpeningHours $fri
     */
    public function getFri()
    {
        return $this->fri;
    }

    /**
     * Set sat
     *
     * @param Craft\LocationBundle\Document\OpeningHours $sat
     * @return self
     */
    public function setSat(\Craft\LocationBundle\Document\OpeningHours $sat)
    {
        $this->sat = $sat;
        return $this;
    }

    /**
     * Get sat
     *
     * @return Craft\LocationBundle\Document\OpeningHours $sat
     */
    public function getSat()
    {
        return $this->sat;
    }

    /**
     * Set sun
     *
     * @param Craft\LocationBundle\Document\OpeningHours $sun
     * @return self
     */
    public function setSun(\Craft\LocationBundle\Document\OpeningHours $sun)
    {
        $this->sun = $sun;
        return $this;
    }

    /**
     * Get sun
     *
     * @return Craft\LocationBundle\Document\OpeningHours $sun
     */
    public function getSun()
    {
        return $this->sun;
    }

    /**
     * @param \DateTime $date
     * @return bool
     */
    public function isOpen(\DateTime $date = null)
    {
        if ($date === null) {
            $date = new \DateTime();
        }

        $week = $this->toArray();
        $day = strtolower($date->format('w'));
        /** @var OpeningHours $today */
        $today = $week[$day];

        if (!$today->getClosed()) {
            $opening = clone $date;
            $closing = clone $date;
            $opening->modify('today ' . $today->getOpens());
            $closing->modify('today ' . $today->getCloses());

            if ($closing < $opening) {
                $closing->modify('+1 day');
            }

            if ($date >= $opening && $date < $closing) {
                return true;
            }
        }

        if ($day - 1 < 0) {
            /** @var OpeningHours $yesterday */
            $today = $week[6];
        } else {
            $today = $week[$day - 1];
        }

        if (!$today->getClosed()) {
            $opening = clone $date;
            $closing = clone $date;
            $opening->modify('yesterday ' . $today->getOpens());
            $closing->modify('yesterday ' . $today->getCloses());

            if ($closing < $opening) {
                $closing->modify('+1 day');
            }

            if ($date >= $opening && $date < $closing) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [$this->sun, $this->mon, $this->tue, $this->wed, $this->thu, $this->fri, $this->sat];
    }

    /**
     * @param $number
     */
    public function getDayFromNumber($number)
    {
        $week = $this->toArray();
    }

    public function opensIn(\DateTime $date)
    {
        if ($this->isOpen($date)) {
            return false;
        }

        //TODO
    }

    public function closesIn(\DateTime $date)
    {
        //TODO
    }
}
