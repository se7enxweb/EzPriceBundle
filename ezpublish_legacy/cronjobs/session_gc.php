<?php
//
// Definition of Session_GC Cronjob
/**
 * File containing the session_gc.php cronjob
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * Cronjob to garbage collect expired sessions as defined by site.ini[Session]SessionTimeout
 * (the expiry time is calculated when session is created / updated)
 * These are normally automatically removed by the session gc in php, but on some linux distroes
 * based on debian this does not work because the custom way session gc is handled.
 *
 * Also make sure you run basket_cleanup if you use the shop!
 *
 * @package eZCronjob
 * @see eZsession
 */


// Functions for session to make sure baskets are cleaned up
function eZSessionBasketGarbageCollector( $db, $time )
{
    eZBasket::cleanupExpired( $time );
}

// Fill in hooks
eZSession::addCallback( 'gc_pre', 'eZSessionBasketGarbageCollector');

eZSession::garbageCollector();

?>