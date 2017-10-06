<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * MobadsResponse message
 */
class MobadsResponse extends \ProtobufMessage
{
    /* Field index constants */
    const REQUEST_ID = 1;
    const ERROR_CODE = 2;
    const ADS = 3;
    const EXPIRATION_TIME = 4;
    const SEARCH_KEY = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::REQUEST_ID => array(
            'name' => 'request_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ERROR_CODE => array(
            'name' => 'error_code',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ADS => array(
            'name' => 'ads',
            'repeated' => true,
            'type' => '\Mobads\Apiv5\Ad'
        ),
        self::EXPIRATION_TIME => array(
            'name' => 'expiration_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SEARCH_KEY => array(
            'name' => 'search_key',
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
        $this->values[self::REQUEST_ID] = null;
        $this->values[self::ERROR_CODE] = null;
        $this->values[self::ADS] = array();
        $this->values[self::EXPIRATION_TIME] = null;
        $this->values[self::SEARCH_KEY] = null;
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
     * Sets value of 'error_code' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setErrorCode($value)
    {
        return $this->set(self::ERROR_CODE, $value);
    }

    /**
     * Returns value of 'error_code' property
     *
     * @return integer
     */
    public function getErrorCode()
    {
        return (integer)$this->get(self::ERROR_CODE);
    }

    /**
     * Appends value to 'ads' list
     *
     * @param \Mobads\Apiv5\Ad $value Value to append
     *
     * @return null
     */
    public function appendAds(\Mobads\Apiv5\Ad $value)
    {
        return $this->append(self::ADS, $value);
    }

    /**
     * Clears 'ads' list
     *
     * @return null
     */
    public function clearAds()
    {
        return $this->clear(self::ADS);
    }

    /**
     * Returns 'ads' list
     *
     * @return \Mobads\Apiv5\Ad[]
     */
    public function getAds()
    {
        return $this->get(self::ADS);
    }

    /**
     * Returns 'ads' iterator
     *
     * @return \ArrayIterator
     */
    public function getAdsIterator()
    {
        return new \ArrayIterator($this->get(self::ADS));
    }

    /**
     * Returns element from 'ads' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Mobads\Apiv5\Ad
     */
    public function getAdsAt($offset)
    {
        return $this->get(self::ADS, $offset);
    }

    /**
     * Returns count of 'ads' list
     *
     * @return int
     */
    public function getAdsCount()
    {
        return $this->count(self::ADS);
    }

    /**
     * Sets value of 'expiration_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setExpirationTime($value)
    {
        return $this->set(self::EXPIRATION_TIME, $value);
    }

    /**
     * Returns value of 'expiration_time' property
     *
     * @return integer
     */
    public function getExpirationTime()
    {
        return (integer)$this->get(self::EXPIRATION_TIME);
    }

    /**
     * Sets value of 'search_key' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setSearchKey($value)
    {
        return $this->set(self::SEARCH_KEY, $value);
    }

    /**
     * Returns value of 'search_key' property
     *
     * @return string
     */
    public function getSearchKey()
    {
        return (string)$this->get(self::SEARCH_KEY);
    }
}
}