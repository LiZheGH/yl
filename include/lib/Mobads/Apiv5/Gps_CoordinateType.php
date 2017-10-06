<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * CoordinateType enum embedded in Gps message
 */
final class Gps_CoordinateType
{
    const WGS84 = 1;
    const GCJ02 = 2;
    const BD09 = 3;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'WGS84' => self::WGS84,
            'GCJ02' => self::GCJ02,
            'BD09' => self::BD09,
        );
    }
}
}