<?php
/**
 * File containing the eZSetupFunctionCollection class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/*!
  \class eZSetupFunctionCollection ezsetupfunctioncollection.php
  \brief The class eZSetupFunctionCollection does

*/

class eZSetupFunctionCollection
{
    /*!
     Constructor
    */
    function eZSetupFunctionCollection()
    {
    }


    function fetchFullVersionString()
    {
        return array( 'result' => eZPublishSDK::version() );
    }

    function fetchMajorVersion()
    {
        return array( 'result' => eZPublishSDK::majorVersion() );
    }

    function fetchMinorVersion()
    {
        return array( 'result' => eZPublishSDK::minorVersion() );
    }

    function fetchRelease()
    {
        return array( 'result' => eZPublishSDK::release() );

    }

    function fetchState()
    {
        return array( 'result' => eZPublishSDK::state() );
    }

    function fetchIsDevelopment()
    {
        return array( 'result' => eZPublishSDK::developmentVersion() ? true : false );
    }

    function fetchDatabaseVersion( $withRelease = true )
    {
        return array( 'result' => eZPublishSDK::databaseVersion( $withRelease ) );
    }

    function fetchDatabaseRelease()
    {
        return array( 'result' => eZPublishSDK::databaseRelease() );
    }
}

?>