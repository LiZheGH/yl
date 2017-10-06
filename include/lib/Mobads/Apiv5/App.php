<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * App message
 */
class App extends \ProtobufMessage
{
    /* Field index constants */
    const APP_ID = 1;
    const CHANNEL_ID = 2;
    const APP_VERSION = 3;
    const APP_PACKAGE = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::APP_ID => array(
            'default' => '',
            'name' => 'app_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CHANNEL_ID => array(
            'name' => 'channel_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::APP_VERSION => array(
            'name' => 'app_version',
            'required' => false,
            'type' => '\Mobads\Apiv5\Version'
        ),
        self::APP_PACKAGE => array(
            'name' => 'app_package',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
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
        $this->values[self::APP_ID] = self::$fields[self::APP_ID]['default'];
        $this->values[self::CHANNEL_ID] = null;
        $this->values[self::APP_VERSION] = null;
        $this->values[self::APP_PACKAGE] = null;
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
     * Sets value of 'app_id' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setAppId($value)
    {
        return $this->set(self::APP_ID, $value);
    }

    /**
     * Returns value of 'app_id' property
     *
     * @return string
     */
    public function getAppId()
    {
        return (string)$this->get(self::APP_ID);
    }

    /**
     * Sets value of 'channel_id' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setChannelId($value)
    {
        return $this->set(self::CHANNEL_ID, $value);
    }

    /**
     * Returns value of 'channel_id' property
     *
     * @return string
     */
    public function getChannelId()
    {
        return (string)$this->get(self::CHANNEL_ID);
    }

    /**
     * Sets value of 'app_version' property
     *
     * @param \Mobads\Apiv5\Version $value Property value
     *
     * @return null
     */
    public function setAppVersion(\Mobads\Apiv5\Version $value=null)
    {
        return $this->set(self::APP_VERSION, $value);
    }

    /**
     * Returns value of 'app_version' property
     *
     * @return \Mobads\Apiv5\Version
     */
    public function getAppVersion()
    {
        return $this->get(self::APP_VERSION);
    }

    /**
     * Sets value of 'app_package' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setAppPackage($value)
    {
        return $this->set(self::APP_PACKAGE, $value);
    }

    /**
     * Returns value of 'app_package' property
     *
     * @return string
     */
    public function getAppPackage()
    {
        return (string)$this->get(self::APP_PACKAGE);
    }
}
}