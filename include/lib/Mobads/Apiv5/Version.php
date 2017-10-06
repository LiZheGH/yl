<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * Version message
 */
class Version extends \ProtobufMessage
{
    /* Field index constants */
    const MAJOR = 1;
    const MINOR = 2;
    const MICRO = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::MAJOR => array(
            'default' => 0,
            'name' => 'major',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MINOR => array(
            'default' => 0,
            'name' => 'minor',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MICRO => array(
            'default' => 0,
            'name' => 'micro',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::MAJOR] = self::$fields[self::MAJOR]['default'];
        $this->values[self::MINOR] = self::$fields[self::MINOR]['default'];
        $this->values[self::MICRO] = self::$fields[self::MICRO]['default'];
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'major' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMajor($value)
    {
        return $this->set(self::MAJOR, $value);
    }

    /**
     * Returns value of 'major' property
     *
     * @return integer
     */
    public function getMajor()
    {
        return (integer)$this->get(self::MAJOR);
    }

    /**
     * Sets value of 'minor' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMinor($value)
    {
        return $this->set(self::MINOR, $value);
    }

    /**
     * Returns value of 'minor' property
     *
     * @return integer
     */
    public function getMinor()
    {
        return (integer)$this->get(self::MINOR);
    }

    /**
     * Sets value of 'micro' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMicro($value)
    {
        return $this->set(self::MICRO, $value);
    }

    /**
     * Returns value of 'micro' property
     *
     * @return integer
     */
    public function getMicro()
    {
        return (integer)$this->get(self::MICRO);
    }
}
}