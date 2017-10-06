<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * Ad message
 */
class Ad extends \ProtobufMessage
{
    /* Field index constants */
    const ADSLOT_ID = 1;
    const HTML_SNIPPET = 2;
    const MATERIAL_META = 3;
    const AD_KEY = 4;
    const AD_TRACKING = 5;
    const META_GROUP = 6;
    const MOB_ADTEXT = 7;
    const MOB_ADLOGO = 8;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ADSLOT_ID => array(
            'name' => 'adslot_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::HTML_SNIPPET => array(
            'name' => 'html_snippet',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::MATERIAL_META => array(
            'name' => 'material_meta',
            'required' => false,
            'type' => '\Mobads\Apiv5\MaterialMeta'
        ),
        self::AD_KEY => array(
            'name' => 'ad_key',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::AD_TRACKING => array(
            'name' => 'ad_tracking',
            'repeated' => true,
            'type' => '\Mobads\Apiv5\Tracking'
        ),
        self::META_GROUP => array(
            'name' => 'meta_group',
            'repeated' => true,
            'type' => '\Mobads\Apiv5\MaterialMeta'
        ),
        self::MOB_ADTEXT => array(
            'name' => 'mob_adtext',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::MOB_ADLOGO => array(
            'name' => 'mob_adlogo',
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
        $this->values[self::HTML_SNIPPET] = null;
        $this->values[self::MATERIAL_META] = null;
        $this->values[self::AD_KEY] = null;
        $this->values[self::AD_TRACKING] = array();
        $this->values[self::META_GROUP] = array();
        $this->values[self::MOB_ADTEXT] = null;
        $this->values[self::MOB_ADLOGO] = null;
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
     * Sets value of 'html_snippet' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setHtmlSnippet($value)
    {
        return $this->set(self::HTML_SNIPPET, $value);
    }

    /**
     * Returns value of 'html_snippet' property
     *
     * @return string
     */
    public function getHtmlSnippet()
    {
        return (string)$this->get(self::HTML_SNIPPET);
    }

    /**
     * Sets value of 'material_meta' property
     *
     * @param \Mobads\Apiv5\MaterialMeta $value Property value
     *
     * @return null
     */
    public function setMaterialMeta(\Mobads\Apiv5\MaterialMeta $value=null)
    {
        return $this->set(self::MATERIAL_META, $value);
    }

    /**
     * Returns value of 'material_meta' property
     *
     * @return \Mobads\Apiv5\MaterialMeta
     */
    public function getMaterialMeta()
    {
        return $this->get(self::MATERIAL_META);
    }

    /**
     * Sets value of 'ad_key' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setAdKey($value)
    {
        return $this->set(self::AD_KEY, $value);
    }

    /**
     * Returns value of 'ad_key' property
     *
     * @return string
     */
    public function getAdKey()
    {
        return (string)$this->get(self::AD_KEY);
    }

    /**
     * Appends value to 'ad_tracking' list
     *
     * @param \Mobads\Apiv5\Tracking $value Value to append
     *
     * @return null
     */
    public function appendAdTracking(\Mobads\Apiv5\Tracking $value)
    {
        return $this->append(self::AD_TRACKING, $value);
    }

    /**
     * Clears 'ad_tracking' list
     *
     * @return null
     */
    public function clearAdTracking()
    {
        return $this->clear(self::AD_TRACKING);
    }

    /**
     * Returns 'ad_tracking' list
     *
     * @return \Mobads\Apiv5\Tracking[]
     */
    public function getAdTracking()
    {
        return $this->get(self::AD_TRACKING);
    }

    /**
     * Returns 'ad_tracking' iterator
     *
     * @return \ArrayIterator
     */
    public function getAdTrackingIterator()
    {
        return new \ArrayIterator($this->get(self::AD_TRACKING));
    }

    /**
     * Returns element from 'ad_tracking' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Mobads\Apiv5\Tracking
     */
    public function getAdTrackingAt($offset)
    {
        return $this->get(self::AD_TRACKING, $offset);
    }

    /**
     * Returns count of 'ad_tracking' list
     *
     * @return int
     */
    public function getAdTrackingCount()
    {
        return $this->count(self::AD_TRACKING);
    }

    /**
     * Appends value to 'meta_group' list
     *
     * @param \Mobads\Apiv5\MaterialMeta $value Value to append
     *
     * @return null
     */
    public function appendMetaGroup(\Mobads\Apiv5\MaterialMeta $value)
    {
        return $this->append(self::META_GROUP, $value);
    }

    /**
     * Clears 'meta_group' list
     *
     * @return null
     */
    public function clearMetaGroup()
    {
        return $this->clear(self::META_GROUP);
    }

    /**
     * Returns 'meta_group' list
     *
     * @return \Mobads\Apiv5\MaterialMeta[]
     */
    public function getMetaGroup()
    {
        return $this->get(self::META_GROUP);
    }

    /**
     * Returns 'meta_group' iterator
     *
     * @return \ArrayIterator
     */
    public function getMetaGroupIterator()
    {
        return new \ArrayIterator($this->get(self::META_GROUP));
    }

    /**
     * Returns element from 'meta_group' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Mobads\Apiv5\MaterialMeta
     */
    public function getMetaGroupAt($offset)
    {
        return $this->get(self::META_GROUP, $offset);
    }

    /**
     * Returns count of 'meta_group' list
     *
     * @return int
     */
    public function getMetaGroupCount()
    {
        return $this->count(self::META_GROUP);
    }

    /**
     * Sets value of 'mob_adtext' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMobAdtext($value)
    {
        return $this->set(self::MOB_ADTEXT, $value);
    }

    /**
     * Returns value of 'mob_adtext' property
     *
     * @return string
     */
    public function getMobAdtext()
    {
        return (string)$this->get(self::MOB_ADTEXT);
    }

    /**
     * Sets value of 'mob_adlogo' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMobAdlogo($value)
    {
        return $this->set(self::MOB_ADLOGO, $value);
    }

    /**
     * Returns value of 'mob_adlogo' property
     *
     * @return string
     */
    public function getMobAdlogo()
    {
        return (string)$this->get(self::MOB_ADLOGO);
    }
}
}