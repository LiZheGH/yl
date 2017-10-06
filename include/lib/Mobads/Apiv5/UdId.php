<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * UdId message
 */
class UdId extends \ProtobufMessage
{
    /* Field index constants */
    const IDFA = 1;
    const IMEI = 2;
    const MAC = 3;
    const IMEI_MD5 = 4;
    const ANDROID_ID = 5;
    const BAIDUID = 6;
    const CUID = 7;
    const IDFA_MD5 = 8;
    const ANDROIDID_MD5 = 9;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::IDFA => array(
            'default' => '',
            'name' => 'idfa',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::IMEI => array(
            'default' => '',
            'name' => 'imei',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::MAC => array(
            'default' => '',
            'name' => 'mac',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::IMEI_MD5 => array(
            'default' => '',
            'name' => 'imei_md5',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ANDROID_ID => array(
            'default' => '',
            'name' => 'android_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::BAIDUID => array(
            'default' => '',
            'name' => 'baiduid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CUID => array(
            'default' => '',
            'name' => 'cuid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::IDFA_MD5 => array(
            'default' => '',
            'name' => 'idfa_md5',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ANDROIDID_MD5 => array(
            'default' => '',
            'name' => 'androidid_md5',
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
        $this->values[self::IDFA] = self::$fields[self::IDFA]['default'];
        $this->values[self::IMEI] = self::$fields[self::IMEI]['default'];
        $this->values[self::MAC] = self::$fields[self::MAC]['default'];
        $this->values[self::IMEI_MD5] = self::$fields[self::IMEI_MD5]['default'];
        $this->values[self::ANDROID_ID] = self::$fields[self::ANDROID_ID]['default'];
        $this->values[self::BAIDUID] = self::$fields[self::BAIDUID]['default'];
        $this->values[self::CUID] = self::$fields[self::CUID]['default'];
        $this->values[self::IDFA_MD5] = self::$fields[self::IDFA_MD5]['default'];
        $this->values[self::ANDROIDID_MD5] = self::$fields[self::ANDROIDID_MD5]['default'];
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
     * Sets value of 'idfa' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setIdfa($value)
    {
        return $this->set(self::IDFA, $value);
    }

    /**
     * Returns value of 'idfa' property
     *
     * @return string
     */
    public function getIdfa()
    {
        return (string)$this->get(self::IDFA);
    }

    /**
     * Sets value of 'imei' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setImei($value)
    {
        return $this->set(self::IMEI, $value);
    }

    /**
     * Returns value of 'imei' property
     *
     * @return string
     */
    public function getImei()
    {
        return (string)$this->get(self::IMEI);
    }

    /**
     * Sets value of 'mac' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMac($value)
    {
        return $this->set(self::MAC, $value);
    }

    /**
     * Returns value of 'mac' property
     *
     * @return string
     */
    public function getMac()
    {
        return (string)$this->get(self::MAC);
    }

    /**
     * Sets value of 'imei_md5' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setImeiMd5($value)
    {
        return $this->set(self::IMEI_MD5, $value);
    }

    /**
     * Returns value of 'imei_md5' property
     *
     * @return string
     */
    public function getImeiMd5()
    {
        return (string)$this->get(self::IMEI_MD5);
    }

    /**
     * Sets value of 'android_id' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setAndroidId($value)
    {
        return $this->set(self::ANDROID_ID, $value);
    }

    /**
     * Returns value of 'android_id' property
     *
     * @return string
     */
    public function getAndroidId()
    {
        return (string)$this->get(self::ANDROID_ID);
    }

    /**
     * Sets value of 'baiduid' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setBaiduid($value)
    {
        return $this->set(self::BAIDUID, $value);
    }

    /**
     * Returns value of 'baiduid' property
     *
     * @return string
     */
    public function getBaiduid()
    {
        return (string)$this->get(self::BAIDUID);
    }

    /**
     * Sets value of 'cuid' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setCuid($value)
    {
        return $this->set(self::CUID, $value);
    }

    /**
     * Returns value of 'cuid' property
     *
     * @return string
     */
    public function getCuid()
    {
        return (string)$this->get(self::CUID);
    }

    /**
     * Sets value of 'idfa_md5' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setIdfaMd5($value)
    {
        return $this->set(self::IDFA_MD5, $value);
    }

    /**
     * Returns value of 'idfa_md5' property
     *
     * @return string
     */
    public function getIdfaMd5()
    {
        return (string)$this->get(self::IDFA_MD5);
    }

    /**
     * Sets value of 'androidid_md5' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setAndroididMd5($value)
    {
        return $this->set(self::ANDROIDID_MD5, $value);
    }

    /**
     * Returns value of 'androidid_md5' property
     *
     * @return string
     */
    public function getAndroididMd5()
    {
        return (string)$this->get(self::ANDROIDID_MD5);
    }
}
}