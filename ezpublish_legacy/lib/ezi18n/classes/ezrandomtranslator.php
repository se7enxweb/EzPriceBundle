<?php
/**
 * File containing the eZRandomTranslator class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package lib
 */

/*!
  \class eZRandomTranslator eztranslatorgroup.php
  \ingroup eZTranslation
  \brief Translates text by picking randomly among it's sub handlers

*/

class eZRandomTranslator extends eZTranslatorGroup
{
    /*!
     Constructor
    */
    function eZRandomTranslator( $is_key_based )
    {
        $this->eZTranslatorGroup( $is_key_based );
        mt_srand();
    }

    /*!
     Returns a random pick from the registered handlers.
    */
    function keyPick( $key )
    {
        if ( $this->handlerCount() == 0 )
            return -1;
        return mt_rand( 0, $this->handlerCount() - 1 );
    }

    /*!
     Returns a random pick from the registered handlers.
    */
    function pick( $context, $source, $comment )
    {
        if ( $this->handlerCount() == 0 )
            return -1;
        return mt_rand( 0, $this->handlerCount() - 1 );
    }

    /*!
     \private
     Generates a seed usable for srand() and returns it.
     DEPRECATED: as of eZ Publish 4.2 (seeding is not needed as of PHP 4.2.0)
    */
    function makeSeed()
    {
        $seed = microtime( true ) * 100000;
        return $seed;
    }
}

?>