<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * RequestProtocolType enum embedded in MobadsRequest message
 */
final class MobadsRequest_RequestProtocolType
{
    const UNKNOWN_PROTOCOL_TYPE = 0;
    const HTTP_PROTOCOL_TYPE = 1;
    const HTTPS_PROTOCOL_TYPE = 2;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'UNKNOWN_PROTOCOL_TYPE' => self::UNKNOWN_PROTOCOL_TYPE,
            'HTTP_PROTOCOL_TYPE' => self::HTTP_PROTOCOL_TYPE,
            'HTTPS_PROTOCOL_TYPE' => self::HTTPS_PROTOCOL_TYPE,
        );
    }
}
}