<?php
/**
 * File containing the eZPDFParser class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/*!
  \class eZPDFParser ezpdfparser.php
  \ingroup eZKernel
  \brief The class eZPDFParser handles parsing of PDF files and returns the metadata

*/

class eZPDFParser
{
    function parseFile( $fileName )
    {
        $binaryINI = eZINI::instance( 'binaryfile.ini' );

        $textExtractionTool = $binaryINI->variable( 'PDFHandlerSettings', 'TextExtractionTool' );

        // save the buffer contents
        $buffer = ob_get_contents();
        ob_end_clean();

        // fetch the module printout
        ob_start();
        passthru( "$textExtractionTool $fileName" );
        $metaData = ob_get_contents();
        ob_end_clean();

        // fill the buffer with the old values
        ob_start();
        print( $buffer );

        return $metaData;
    }
}

?>