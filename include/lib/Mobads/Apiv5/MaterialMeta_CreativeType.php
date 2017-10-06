<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * CreativeType enum embedded in MaterialMeta message
 */
final class MaterialMeta_CreativeType
{
    const NO_TYPE = 0;
    const TEXT = 1;
    const IMAGE = 2;
    const TEXT_ICON = 3;
    const VIDEO = 4;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'NO_TYPE' => self::NO_TYPE,
            'TEXT' => self::TEXT,
            'IMAGE' => self::IMAGE,
            'TEXT_ICON' => self::TEXT_ICON,
            'VIDEO' => self::VIDEO,
        );
    }
}
}