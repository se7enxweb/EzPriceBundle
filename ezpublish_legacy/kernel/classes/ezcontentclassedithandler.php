<?php
/**
 * File containing the eZContentClassEditHandler class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * Handler for content class editing.
 */
class eZContentClassEditHandler
{

    /**
     * Store the modification made to an eZContentClass.
     *
     * @param eZContentClass Content class to be stored.
     * @param array[eZContentClassAttribute] Attributes of the new content class.
     * @param array Unordered view parameters
     */
    public function store( eZContentClass $class, array $attributes, array &$unorderedParameters )
    {
        $oldClassAttributes = $class->fetchAttributes( $class->attribute( 'id' ), true, eZContentClass::VERSION_STATUS_DEFINED );
        // Delete object attributes which have been removed.
        foreach ( $oldClassAttributes as $oldClassAttribute )
        {
            $attributeExists = false;
            $oldClassAttributeID = $oldClassAttribute->attribute( 'id' );
            foreach ( $class->fetchAttributes( ) as $newClassAttribute )
            {
                if ( $oldClassAttributeID == $newClassAttribute->attribute( 'id' ) )
                {
                    $attributeExists = true;
                    break;
                }
            }
            if ( !$attributeExists )
            {
                foreach ( eZContentObjectAttribute::fetchSameClassAttributeIDList( $oldClassAttributeID ) as $objectAttribute )
                {
                    $objectAttribute->removeThis( $objectAttribute->attribute( 'id' ) );
                }
            }
        }
        $class->storeDefined( $attributes );

        // Add object attributes which have been added.
        foreach ( $attributes as $newClassAttribute )
        {
            $attributeExists = false;
            $newClassAttributeID = $newClassAttribute->attribute( 'id' );
            foreach ( $oldClassAttributes as $oldClassAttribute )
            {
                if ( $newClassAttributeID == $oldClassAttribute->attribute( 'id' ) )
                {
                    $attributeExists = true;
                    break;
                }
            }
            if ( !$attributeExists )
            {
                $newClassAttribute->initializeObjectAttributes( $objects );
            }
        }
    }
}

?>