<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * OperatorType enum embedded in Network message
 */
final class Network_OperatorType
{
    const UNKNOWN_OPERATOR = 0;
    const CHINA_MOBILE = 1;
    const CHINA_TELECOM = 2;
    const CHINA_UNICOM = 3;
    const OTHER_OPERATOR = 99;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'UNKNOWN_OPERATOR' => self::UNKNOWN_OPERATOR,
            'CHINA_MOBILE' => self::CHINA_MOBILE,
            'CHINA_TELECOM' => self::CHINA_TELECOM,
            'CHINA_UNICOM' => self::CHINA_UNICOM,
            'OTHER_OPERATOR' => self::OTHER_OPERATOR,
        );
    }
}
}