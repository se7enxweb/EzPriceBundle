<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$Module = $Params['Module'];
$NodeID = $Params['NodeID'];

$curNode = eZContentObjectTreeNode::fetch( $NodeID );
if ( !$curNode )
    return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );

if ( !$curNode->attribute( 'can_hide' ) )
    return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );

if ( eZOperationHandler::operationIsAvailable( 'content_hide' ) )
{
    $operationResult = eZOperationHandler::execute( 'content',
                                                    'hide',
                                                     array( 'node_id' => $NodeID ),
                                                     null, true );
}
else
{
    eZContentOperationCollection::changeHideStatus( $NodeID );
}


$hasRedirect = eZRedirectManager::redirectTo( $Module, false );
if ( !$hasRedirect )
{
    // redirect to the parent node
    if( ( $parentNodeID = $curNode->attribute( 'parent_node_id' ) ) == 1 )
        $redirectNodeID = $NodeID;
    else
        $redirectNodeID = $parentNodeID;
    return $Module->redirectToView( 'view', array( 'full', $redirectNodeID ) );
}

?>