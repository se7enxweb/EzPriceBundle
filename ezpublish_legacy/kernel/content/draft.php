<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$Module = $Params['Module'];
$http = eZHTTPTool::instance();

$Offset = $Params['Offset'];
$viewParameters = array( 'offset' => $Offset );

$user = eZUser::currentUser();
if ( !$user->isLoggedIn() )
    return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );

$userID = $user->id();

if ( $http->hasPostVariable( 'RemoveButton' )  )
{
    if ( $http->hasPostVariable( 'DeleteIDArray' ) )
    {
        $deleteIDArray = $http->postVariable( 'DeleteIDArray' );
        $db = eZDB::instance();
        $db->begin();
        foreach ( $deleteIDArray as $deleteID )
        {
            $version = eZContentObjectVersion::fetch( $deleteID );
            if ( $version instanceof eZContentObjectVersion )
            {
                eZDebug::writeNotice( $deleteID, "deleteID" );
                $version->removeThis();
            }
        }
        $db->commit();
    }
}

if ( $http->hasPostVariable( 'EmptyButton' )  )
{
    $versions = eZContentObjectVersion::fetchForUser( $userID );
    $db = eZDB::instance();
    $db->begin();
    foreach ( $versions as $version )
    {
        $version->removeThis();
    }
    $db->commit();
}

$tpl = eZTemplate::factory();

$tpl->setVariable('view_parameters', $viewParameters );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:content/draft.tpl' );
$Result['path'] = array( array( 'text' => ezpI18n::tr( 'kernel/content', 'My drafts' ),
                                'url' => false ) );

?>