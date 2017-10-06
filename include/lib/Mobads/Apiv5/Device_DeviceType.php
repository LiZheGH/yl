<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * DeviceType enum embedded in Device message
 */
final class Device_DeviceType
{
    const PHONE = 1;
    const TABLET = 2;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'PHONE' => self::PHONE,
            'TABLET' => self::TABLET,
        );
    }
}
}