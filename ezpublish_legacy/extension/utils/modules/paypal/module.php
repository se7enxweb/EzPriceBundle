<?php
//
// Created on: <16-Feb-2010 12:46:15 carlos.revillo@tantacom.com>
//
// SOFTWARE NAME: eZ Publish
// SOFTWARE RELEASE: 4.2.0
// BUILD VERSION: 24182
// COPYRIGHT NOTICE: Copyright (C) 1999-2009 eZ Systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//

$Module = array( "name" => "paypal",
                 "variable_params" => true );

$ViewList = array();
$ViewList['cancel'] = array(
    'functions' => array( 'paypal' ),
    'script' => 'cancel.php',
    );

$ViewList['complete'] = array(
    'functions' => array( 'paypal' ),
    'script' => 'complete.php',
	'params' => array( 'OrderID'  )
    );
    
$ViewList['ipn'] = array(
    'functions' => array( 'paypal' ),
    'script' => 'ipn.php',
	'params' => array( 'OrderID'  )
    );

$FunctionList = array();
$FunctionList['paypal'] = array( );
?>