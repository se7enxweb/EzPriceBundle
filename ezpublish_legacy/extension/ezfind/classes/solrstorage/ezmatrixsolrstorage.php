<?php

/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @author pb
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 2.7.0
 * @package ezfind
 *
 */

class ezmatrixSolrStorage extends ezdatatypeSolrStorage
{

    /**
     * Returns the content of the matrix to be stored in Solr
     *
     * @param eZContentObjectAttribute $contentObjectAttribute the attribute to serialize
     * @param eZContentClassAttribute $contentClassAttribute the content class of the attribute to serialize
     * @return array
     */
    public static function getAttributeContent( eZContentObjectAttribute $contentObjectAttribute, eZContentClassAttribute $contentClassAttribute )
    {
        $rows = $contentObjectAttribute->content()->attribute( 'rows' );
        $target = array(
            'has_rendered_content' => false,
            'rendered' => null,
            'content' => array()
        );
        foreach( $rows['sequential'] as $elt )
        {
            $target['content'][] = $elt['columns'];
        }
        return $target;
    }

}


?>