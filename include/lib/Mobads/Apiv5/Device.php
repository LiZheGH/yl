<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * Device message
 */
class Device extends \ProtobufMessage
{
    /* Field index constants */
    const DEVICE_TYPE = 1;
    const OS_TYPE = 2;
    const OS_VERSION = 3;
    const VENDOR = 4;
    const MODEL = 5;
    const UDID = 6;
    const SCREEN_SIZE = 7;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DEVICE_TYPE => array(
            'name' => 'device_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::OS_TYPE => array(
            'name' => 'os_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::OS_VERSION => array(
            'name' => 'os_version',
            'required' => false,
            'type' => '\Mobads\Apiv5\Version'
        ),
        self::VENDOR => array(
            'default' => '',
            'name' => 'vendor',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::MODEL => array(
            'default' => '',
            'name' => 'model',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::UDID => array(
            'name' => 'udid',
            'required' => false,
            'type' => '\Mobads\Apiv5\UdId'
        ),
        self::SCREEN_SIZE => array(
            'name' => 'screen_size',
            'required' => false,
            'type' => '\Mobads\Apiv5\Size'
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
        $this->values[self::DEVICE_TYPE] = null;
        $this->values[self::OS_TYPE] = null;
        $this->values[self::OS_VERSION] = null;
        $this->values[self::VENDOR] = self::$fields[self::VENDOR]['default'];
        $this->values[self::MODEL] = self::$fields[self::MODEL]['default'];
        $this->values[self::UDID] = null;
        $this->values[self::SCREEN_SIZE] = null;
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
     * Sets value of 'device_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDeviceType($value)
    {
        return $this->set(self::DEVICE_TYPE, $value);
    }

    /**
     * Returns value of 'device_type' property
     *
     * @return integer
     */
    public function getDeviceType()
    {
        return (integer)$this->get(self::DEVICE_TYPE);
    }

    /**
     * Sets value of 'os_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setOsType($value)
    {
        return $this->set(self::OS_TYPE, $value);
    }

    /**
     * Returns value of 'os_type' property
     *
     * @return integer
     */
    public function getOsType()
    {
        return (integer)$this->get(self::OS_TYPE);
    }

    /**
     * Sets value of 'os_version' property
     *
     * @param \Mobads\Apiv5\Version $value Property value
     *
     * @return null
     */
    public function setOsVersion(\Mobads\Apiv5\Version $value=null)
    {
        return $this->set(self::OS_VERSION, $value);
    }

    /**
     * Returns value of 'os_version' property
     *
     * @return \Mobads\Apiv5\Version
     */
    public function getOsVersion()
    {
        return $this->get(self::OS_VERSION);
    }

    /**
     * Sets value of 'vendor' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setVendor($value)
    {
        return $this->set(self::VENDOR, $value);
    }

    /**
     * Returns value of 'vendor' property
     *
     * @return string
     */
    public function getVendor()
    {
        return (string)$this->get(self::VENDOR);
    }

    /**
     * Sets value of 'model' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setModel($value)
    {
        return $this->set(self::MODEL, $value);
    }

    /**
     * Returns value of 'model' property
     *
     * @return string
     */
    public function getModel()
    {
        return (string)$this->get(self::MODEL);
    }

    /**
     * Sets value of 'udid' property
     *
     * @param \Mobads\Apiv5\UdId $value Property value
     *
     * @return null
     */
    public function setUdid(\Mobads\Apiv5\UdId $value=null)
    {
        return $this->set(self::UDID, $value);
    }

    /**
     * Returns value of 'udid' property
     *
     * @return \Mobads\Apiv5\UdId
     */
    public function getUdid()
    {
        return $this->get(self::UDID);
    }

    /**
     * Sets value of 'screen_size' property
     *
     * @param \Mobads\Apiv5\Size $value Property value
     *
     * @return null
     */
    public function setScreenSize(\Mobads\Apiv5\Size $value=null)
    {
        return $this->set(self::SCREEN_SIZE, $value);
    }

    /**
     * Returns value of 'screen_size' property
     *
     * @return \Mobads\Apiv5\Size
     */
    public function getScreenSize()
    {
        return $this->get(self::SCREEN_SIZE);
    }
}
}