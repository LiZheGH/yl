<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * AdSlot message
 */
class AdSlot extends \ProtobufMessage
{
    /* Field index constants */
    const ADSLOT_ID = 1;
    const ADSLOT_SIZE = 2;
    const TOPICS = 3;
    const VIDEO = 4;
    const CTKEY = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ADSLOT_ID => array(
            'name' => 'adslot_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ADSLOT_SIZE => array(
            'name' => 'adslot_size',
            'required' => false,
            'type' => '\Mobads\Apiv5\Size'
        ),
        self::TOPICS => array(
            'name' => 'topics',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::VIDEO => array(
            'name' => 'video',
            'required' => false,
            'type' => '\Mobads\Apiv5\Video'
        ),
        self::CTKEY => array(
            'name' => 'ctkey',
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
        $this->values[self::ADSLOT_ID] = null;
        $this->values[self::ADSLOT_SIZE] = null;
        $this->values[self::TOPICS] = array();
        $this->values[self::VIDEO] = null;
        $this->values[self::CTKEY] = null;
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
     * Sets value of 'adslot_id' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setAdslotId($value)
    {
        return $this->set(self::ADSLOT_ID, $value);
    }

    /**
     * Returns value of 'adslot_id' property
     *
     * @return string
     */
    public function getAdslotId()
    {
        return (string)$this->get(self::ADSLOT_ID);
    }

    /**
     * Sets value of 'adslot_size' property
     *
     * @param \Mobads\Apiv5\Size $value Property value
     *
     * @return null
     */
    public function setAdslotSize(\Mobads\Apiv5\Size $value=null)
    {
        return $this->set(self::ADSLOT_SIZE, $value);
    }

    /**
     * Returns value of 'adslot_size' property
     *
     * @return \Mobads\Apiv5\Size
     */
    public function getAdslotSize()
    {
        return $this->get(self::ADSLOT_SIZE);
    }

    /**
     * Appends value to 'topics' list
     *
     * @param string $value Value to append
     *
     * @return null
     */
    public function appendTopics($value)
    {
        return $this->append(self::TOPICS, $value);
    }

    /**
     * Clears 'topics' list
     *
     * @return null
     */
    public function clearTopics()
    {
        return $this->clear(self::TOPICS);
    }

    /**
     * Returns 'topics' list
     *
     * @return string[]
     */
    public function getTopics()
    {
        return $this->get(self::TOPICS);
    }

    /**
     * Returns 'topics' iterator
     *
     * @return \ArrayIterator
     */
    public function getTopicsIterator()
    {
        return new \ArrayIterator($this->get(self::TOPICS));
    }

    /**
     * Returns element from 'topics' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return string
     */
    public function getTopicsAt($offset)
    {
        return $this->get(self::TOPICS, $offset);
    }

    /**
     * Returns count of 'topics' list
     *
     * @return int
     */
    public function getTopicsCount()
    {
        return $this->count(self::TOPICS);
    }

    /**
     * Sets value of 'video' property
     *
     * @param \Mobads\Apiv5\Video $value Property value
     *
     * @return null
     */
    public function setVideo(\Mobads\Apiv5\Video $value=null)
    {
        return $this->set(self::VIDEO, $value);
    }

    /**
     * Returns value of 'video' property
     *
     * @return \Mobads\Apiv5\Video
     */
    public function getVideo()
    {
        return $this->get(self::VIDEO);
    }

    /**
     * Sets value of 'ctkey' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setCtkey($value)
    {
        return $this->set(self::CTKEY, $value);
    }

    /**
     * Returns value of 'ctkey' property
     *
     * @return string
     */
    public function getCtkey()
    {
        return (string)$this->get(self::CTKEY);
    }
}
}