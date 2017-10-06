<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * Size message
 */
class Size extends \ProtobufMessage
{
    /* Field index constants */
    const WIDTH = 1;
    const HEIGHT = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::WIDTH => array(
            'default' => 0,
            'name' => 'width',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::HEIGHT => array(
            'default' => 0,
            'name' => 'height',
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
        $this->values[self::WIDTH] = self::$fields[self::WIDTH]['default'];
        $this->values[self::HEIGHT] = self::$fields[self::HEIGHT]['default'];
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
     * Sets value of 'width' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setWidth($value)
    {
        return $this->set(self::WIDTH, $value);
    }

    /**
     * Returns value of 'width' property
     *
     * @return integer
     */
    public function getWidth()
    {
        return (integer)$this->get(self::WIDTH);
    }

    /**
     * Sets value of 'height' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setHeight($value)
    {
        return $this->set(self::HEIGHT, $value);
    }

    /**
     * Returns value of 'height' property
     *
     * @return integer
     */
    public function getHeight()
    {
        return (integer)$this->get(self::HEIGHT);
    }
}
}