<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$Module = array( 'name' => 'eZContentObject',
                 'variable_params' => true );

$ViewList['edit'] = array(
    'script' => 'edit.php',
    'functions' => array( 'edit' ),
    'ui_context' => 'edit',
    'default_navigation_part' => 'ezsetupnavigationpart',
    'single_post_actions' => array( 'ExportPDFBrowse' => 'BrowseSource',
                                    'ExportPDFButton' => 'Export',
                                    'DiscardButton'   => 'Discard',
                                    'CreateExport' => 'CreateExport' ),
    'post_action_parameters' => array( 'Export' => array( 'Title' => 'Title',
                                                          'DisplayFrontpage' => 'DisplayFrontpage',
                                                          'IntroText' => 'IntroText',
                                                          'SubText' => 'SubText',
                                                          'SourceNode' => 'SourceNode',
                                                          'ExportType' => 'ExportType',
                                                          'ClassList' => 'ClassList',
                                                          'SiteAccess' => 'SiteAccess',
                                                          'DestinationType' => 'DestinationType',
                                                          'DestinationFile' => 'DestinationFile' ),
                                       'BrowseSource' => array( 'Title' => 'Title',
                                                                'DisplayFrontpage' => 'DisplayFrontpage',
                                                                'IntroText' => 'IntroText',
                                                                'SubText' => 'SubText',
                                                                'ExportType' => 'ExportType',
                                                                'ClassList' => 'ClassList',
                                                                'SiteAccess' => 'SiteAccess',
                                                                'DestinationType' => 'DestinationType',
                                                                'DestinationFile' => 'DestinationFile' ) ),
    'unordered_params' => array( 'language' => 'Language' ),
    'params' => array( 'PDFExportID', 'PDFGenerate' ) );

$ViewList['list'] = array(
    'script' => 'list.php',
    'functions' => array( 'edit' ),
    'default_navigation_part' => 'ezsetupnavigationpart',
    'single_post_actions' => array( 'NewPDFExport' => 'NewExport',
                                    'RemoveExportButton' => 'RemoveExport' ),
    'post_action_parameters' => array( 'RemoveExport' => array( 'DeleteIDArray' => 'DeleteIDArray' ) ),
    'unordered_params' => array( 'language' => 'Language' ) );


$FunctionList = array();
$FunctionList['create'] = array();
$FunctionList['edit'] = array();

?>