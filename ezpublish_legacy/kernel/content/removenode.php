<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$http = eZHTTPTool::instance();

$tpl = eZTemplate::factory();

$Module = $Params['Module'];
$ObjectID = $Params['ObjectID'];

$NodeID = $Params['NodeID'];
if ( !isset( $EditVersion ) )
    $EditVersion = $Params['EditVersion'];

$object = eZContentObject::fetch( $ObjectID );
if ( $object === null )
    return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );

if ( !$object->attribute( 'can_remove' ) )
    return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );

$version = $object->version( $EditVersion );
$node = eZContentObjectTreeNode::fetchNode( $ObjectID, $NodeID );
if ( $node !== null )
    $ChildObjectsCount = $node->subTreeCount();
else
    $ChildObjectsCount = 0;
$ChildObjectsCount .= " ";
if ( $ChildObjectsCount == 1 )
    $ChildObjectsCount .= ezpI18n::tr( 'kernel/content/removenode',
                                  'child',
                                  '1 child' );
else
    $ChildObjectsCount .= ezpI18n::tr( 'kernel/content/removenode',
                                  'children',
                                  'several children' );

if ( $Module->isCurrentAction( 'ConfirmAssignmentRemove' ) )
{
    $nodeID = $http->postVariable( 'RemoveNodeID' ) ;
    $version->removeAssignment( $nodeID );
    $Module->redirectToView( "edit", array( $ObjectID, $EditVersion ) );
}
elseif ( $Module->isCurrentAction( 'CancelAssignmentRemove' ) )
{
    $Module->redirectToView( "edit", array( $ObjectID, $EditVersion ) );
}

$tpl->setVariable( 'object', $object );
$tpl->setVariable( 'edit_version', $EditVersion );
$tpl->setVariable( 'content_version', $version );
$tpl->setVariable( 'ChildObjectsCount', $ChildObjectsCount );
$tpl->setVariable( 'node', $node );


$Result['content'] = $tpl->fetch( 'design:node/removenode.tpl' );

$Result['path'] = array( array( 'text' => $object->attribute( 'name' ),
                                'url' => false ) );

?>