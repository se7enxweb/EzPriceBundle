<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * Function to get template instance, load autoloads (operators) and set default settings.
 *
 * @deprecated Since 4.3, superseded by {@link eZTemplate::factory()}
 *             Will be kept for compatability in 4.x.
 * @param string $name (Not supported as it was prevoisly set on same instance anyway)
 * @return eZTemplate
 */
function templateInit( $name = false )
{
    eZDebug::writeStrict( 'Function templateInit() has been deprecated in 4.3 in favor of eZTemplate::factory()', 'Deprecation' );
    return eZTemplate::factory();
}


?>