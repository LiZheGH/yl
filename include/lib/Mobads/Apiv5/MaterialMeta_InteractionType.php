<?php
/**
 * Auto generated from baidu_mobads_api_5_php.proto at 2016-09-13 16:08:23
 *
 * mobads.apiv5 package
 */

namespace Mobads\Apiv5 {
/**
 * InteractionType enum embedded in MaterialMeta message
 */
final class MaterialMeta_InteractionType
{
    const NO_INTERACTION = 0;
    const SURFING = 1;
    const DOWNLOAD = 2;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'NO_INTERACTION' => self::NO_INTERACTION,
            'SURFING' => self::SURFING,
            'DOWNLOAD' => self::DOWNLOAD,
        );
    }
}
}