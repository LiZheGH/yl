<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * CopyRight enum embedded in Video message
 */
final class Video_CopyRight
{
    const CR_NONE = 0;
    const CR_EXIST = 1;
    const CR_UGC = 2;
    const CR_OTHER = 3;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'CR_NONE' => self::CR_NONE,
            'CR_EXIST' => self::CR_EXIST,
            'CR_UGC' => self::CR_UGC,
            'CR_OTHER' => self::CR_OTHER,
        );
    }
}
}