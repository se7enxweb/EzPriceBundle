<?php
/**
 * File containing the eZImageFactory class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package lib
 */

/*!
  \class eZImageFactory ezimagefactory.php
  \brief Base class for image factories

  The image factory is responsible for producing image handlers
  when requested. This class must be inherited by specific
  factories to create specific handlers.
*/

class eZImageFactory
{
    /*!
     Initializes the factory with the name \a $name.
    */
    function eZImageFactory( $name )
    {
        $this->Name = $name;
    }

    /*!
     \return the name of the factory, this is the name referenced in the INI file.
    */
    function name()
    {
        return $this->Name;
    }

    /*!
     \pure
     Creates a new image handler from the INI group \a $iniGroup and optionally INI file \a $iniFilename.
     \note The default implementation returns \c null.
    */
    static function produceFromINI( $iniGroup, $iniFilename = false )
    {
        $imageHandler = null;
        return $imageHandler;
    }

    /// \privatesection
    public $Name;
}

?>