<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * MobadsRequest message
 */
class MobadsRequest extends \ProtobufMessage
{
    /* Field index constants */
    const REQUEST_ID = 1;
    const API_VERSION = 2;
    const APP = 3;
    const DEVICE = 4;
    const NETWORK = 5;
    const GPS = 6;
    const ADSLOT = 7;
    const IS_DEBUG = 8;
    const REQUEST_PROTOCOL_TYPE = 9;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::REQUEST_ID => array(
            'name' => 'request_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::API_VERSION => array(
            'name' => 'api_version',
            'required' => false,
            'type' => '\Mobads\Apiv5\Version'
        ),
        self::APP => array(
            'name' => 'app',
            'required' => false,
            'type' => '\Mobads\Apiv5\App'
        ),
        self::DEVICE => array(
            'name' => 'device',
            'required' => false,
            'type' => '\Mobads\Apiv5\Device'
        ),
        self::NETWORK => array(
            'name' => 'network',
            'required' => false,
            'type' => '\Mobads\Apiv5\Network'
        ),
        self::GPS => array(
            'name' => 'gps',
            'required' => false,
            'type' => '\Mobads\Apiv5\Gps'
        ),
        self::ADSLOT => array(
            'name' => 'adslot',
            'required' => false,
            'type' => '\Mobads\Apiv5\AdSlot'
        ),
        self::IS_DEBUG => array(
            'default' => false,
            'name' => 'is_debug',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::REQUEST_PROTOCOL_TYPE => array(
            'default' => \Mobads\Apiv5\MobadsRequest_RequestProtocolType::HTTP_PROTOCOL_TYPE,
            'name' => 'request_protocol_type',
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
        $this->values[self::REQUEST_ID] = null;
        $this->values[self::API_VERSION] = null;
        $this->values[self::APP] = null;
        $this->values[self::DEVICE] = null;
        $this->values[self::NETWORK] = null;
        $this->values[self::GPS] = null;
        $this->values[self::ADSLOT] = null;
        $this->values[self::IS_DEBUG] = self::$fields[self::IS_DEBUG]['default'];
        $this->values[self::REQUEST_PROTOCOL_TYPE] = self::$fields[self::REQUEST_PROTOCOL_TYPE]['default'];
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
     * Sets value of 'request_id' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setRequestId($value)
    {
        return $this->set(self::REQUEST_ID, $value);
    }

    /**
     * Returns value of 'request_id' property
     *
     * @return string
     */
    public function getRequestId()
    {
        return (string)$this->get(self::REQUEST_ID);
    }

    /**
     * Sets value of 'api_version' property
     *
     * @param \Mobads\Apiv5\Version $value Property value
     *
     * @return null
     */
    public function setApiVersion(\Mobads\Apiv5\Version $value=null)
    {
        return $this->set(self::API_VERSION, $value);
    }

    /**
     * Returns value of 'api_version' property
     *
     * @return \Mobads\Apiv5\Version
     */
    public function getApiVersion()
    {
        return $this->get(self::API_VERSION);
    }

    /**
     * Sets value of 'app' property
     *
     * @param \Mobads\Apiv5\App $value Property value
     *
     * @return null
     */
    public function setApp(\Mobads\Apiv5\App $value=null)
    {
        return $this->set(self::APP, $value);
    }

    /**
     * Returns value of 'app' property
     *
     * @return \Mobads\Apiv5\App
     */
    public function getApp()
    {
        return $this->get(self::APP);
    }

    /**
     * Sets value of 'device' property
     *
     * @param \Mobads\Apiv5\Device $value Property value
     *
     * @return null
     */
    public function setDevice(\Mobads\Apiv5\Device $value=null)
    {
        return $this->set(self::DEVICE, $value);
    }

    /**
     * Returns value of 'device' property
     *
     * @return \Mobads\Apiv5\Device
     */
    public function getDevice()
    {
        return $this->get(self::DEVICE);
    }

    /**
     * Sets value of 'network' property
     *
     * @param \Mobads\Apiv5\Network $value Property value
     *
     * @return null
     */
    public function setNetwork(\Mobads\Apiv5\Network $value=null)
    {
        return $this->set(self::NETWORK, $value);
    }

    /**
     * Returns value of 'network' property
     *
     * @return \Mobads\Apiv5\Network
     */
    public function getNetwork()
    {
        return $this->get(self::NETWORK);
    }

    /**
     * Sets value of 'gps' property
     *
     * @param \Mobads\Apiv5\Gps $value Property value
     *
     * @return null
     */
    public function setGps(\Mobads\Apiv5\Gps $value=null)
    {
        return $this->set(self::GPS, $value);
    }

    /**
     * Returns value of 'gps' property
     *
     * @return \Mobads\Apiv5\Gps
     */
    public function getGps()
    {
        return $this->get(self::GPS);
    }

    /**
     * Sets value of 'adslot' property
     *
     * @param \Mobads\Apiv5\AdSlot $value Property value
     *
     * @return null
     */
    public function setAdslot(\Mobads\Apiv5\AdSlot $value=null)
    {
        return $this->set(self::ADSLOT, $value);
    }

    /**
     * Returns value of 'adslot' property
     *
     * @return \Mobads\Apiv5\AdSlot
     */
    public function getAdslot()
    {
        return $this->get(self::ADSLOT);
    }

    /**
     * Sets value of 'is_debug' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setIsDebug($value)
    {
        return $this->set(self::IS_DEBUG, $value);
    }

    /**
     * Returns value of 'is_debug' property
     *
     * @return boolean
     */
    public function getIsDebug()
    {
        return (boolean)$this->get(self::IS_DEBUG);
    }

    /**
     * Sets value of 'request_protocol_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRequestProtocolType($value)
    {
        return $this->set(self::REQUEST_PROTOCOL_TYPE, $value);
    }

    /**
     * Returns value of 'request_protocol_type' property
     *
     * @return integer
     */
    public function getRequestProtocolType()
    {
        return (integer)$this->get(self::REQUEST_PROTOCOL_TYPE);
    }
}
}