//
// Created on: <14-Jul-2004 14:18:58 dl>
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ Publish
// SOFTWARE RELEASE: 4.1.x
// COPYRIGHT NOTICE: Copyright (C) 1999-2012 eZ Systems AS
// SOFTWARE LICENSE: eZ Business Use License Agreement eZ BUL Version 2.1
// NOTICE: >
//   This source file is part of the eZ Publish CMS and is
//   licensed under the terms and conditions of the eZ Business Use
//   License v2.1 (eZ BUL).
// 
//   A copy of the eZ BUL was included with the software. If the
//   license is missing, request a copy of the license via email
//   at license@ez.no or via postal mail at
//  	Attn: Licensing Dept. eZ Systems AS, Klostergata 30, N-3732 Skien, Norway
// 
//   IMPORTANT: THE SOFTWARE IS LICENSED, NOT SOLD. ADDITIONALLY, THE
//   SOFTWARE IS LICENSED "AS IS," WITHOUT ANY WARRANTIES WHATSOEVER.
//   READ THE eZ BUL BEFORE USING, INSTALLING OR MODIFYING THE SOFTWARE.

// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

/*! \file ezjslibdomsupport.js
*/

/*!
    \brief

    Functions which works with HTMLElements:
        ezjslib_findHTMLChildTextNode,
        ezjslib_setTextToHTMLChildTextNode,
        ezjslib_removeHTMLChildTextNode,
        ezjslib_createHTMLChildTextNode,
        ezjslib_setHTMLNodeClassStyle,
        ezjslib_appendHTMLNodeClassStyle,
        ezjslib_getHTMLNodeById,
        ezjslib_getHTMLChildNodeByTag,
        ezjslib_getHTMLChildNodeByProperty,
        ezjslib_getStyleObject.
*/

/*!
    Finds the text of \a node
*/
function ezjslib_findHTMLChildTextNode( node )
{
    return ezjslib_findHTMLChildNodeByType( node, 3 );
}

/*!
    Finds the image of \a node
*/
function ezjslib_findHTMLChildImageNode( node )
{
    return ezjslib_findHTMLChildNodeByType( node, 1 );
}

/*!
    Finds child node of \a node by \a type
*/
function ezjslib_findHTMLChildNodeByType( node, type )
{
    if ( node )
    {
        for ( var i = 0; i < node.childNodes.length; i++ )
        {
            if ( node.childNodes[i].nodeType == type )
            {
                return node.childNodes[i];
            }
        }
    }

    return null;
}

/*!
    Finds the text of \a node and replaces it with \a text
*/
function ezjslib_setTextToHTMLChildTextNode( node, text )
{
    var textNode = ezjslib_findHTMLChildTextNode( node );
    if ( textNode != null )
    {
        textNode.data = text;
    }
}

/*!
*/
function ezjslib_setImageSourceToHTMLChildImageNode( node, imageSource )
{
    var imageNode = ezjslib_findHTMLChildImageNode( node );
    if ( imageNode != null )
    {
        imageNode.src = imageSource;
    }
}

/*!
    Finds text of \a node and removes it
*/
function ezjslib_removeHTMLChildTextNode( node )
{
    ezjslib_removeHTMLChildNodeByType( node, 3 );
}

/*!
    Finds image of \a node and removes it
*/
function ezjslib_removeHTMLChildImageNode( node )
{
    ezjslib_removeHTMLChildNodeByType( node, 1 );
}

/*!
    Finds a child of \a node by \a type and removes it
*/
function ezjslib_removeHTMLChildNodeByType( node, type )
{
    var textNode = ezjslib_findHTMLChildNodeByType( node, type );
    if ( textNode != null )
    {
        node.removeChild( textNode );
    }
}

/*!
    Creates and appends child text node with text \a text to node \a node
*/
function ezjslib_createHTMLChildTextNode( node, text )
{
    if ( node != null )
    {
        var textNode = document.createTextNode( text );
        node.appendChild( textNode );
    }
}

/*!
*/
function  ezjslib_createHTMLChildImageNode( node, imageSource, imageWidth, imageHeight )
{
    if ( node != null )
    {
        var imageNode = document.createElement( 'img' );
        imageNode.src = imageSource;
        if ( imageWidth )
            imageNode.width = imageWidth;
        if ( imageHeight )
            imageNode.height = imageHeight;

        node.appendChild( imageNode );
    }
}

/*!
    \return HTMLElement with id \a node_id
*/
function ezjslib_getHTMLNodeById( node_id )
{
    return document.getElementById( node_id );
}

/*!
    \return a FIRST child HTMLElement of \a node with tag \a tag
*/
function ezjslib_getHTMLChildNodeByTag( node, tag )
{
    for ( var i = 0; i < node.childNodes.length; ++i )
    {
        var child = node.childNodes[i];

        if ( child["tagName"] && child.tagName.toLowerCase() == tag )
        {
            return child;
        }
    }

    return null;
}

/*!
    \return a FIRST child HTMLElement of \a node with property name
    \a attrName and property value \a attrValue
*/
function ezjslib_getHTMLChildNodeByProperty( node, propName, propValue )
{
    if ( node )
    {
        for ( var i = 0; i < node.childNodes.length; ++i )
        {
            var child   = node.childNodes[i];
            var value   = child[propName];

            if ( value && value == propValue )
            {
                return child;
            }
        }
    }

    return null;
}

/*!
    Sets 'className' property of node \a node to value \a styleClassName
*/
function ezjslib_setHTMLNodeClassStyle( node, styleClassName )
{
    if ( node && styleClassName )
    {
        node['className'] = styleClassName;
    }
}

/*!
    Appends to 'className' property of node \a node the value \a styleClassName
*/
function ezjslib_appendHTMLNodeClassStyle( node, styleClassName )
{
    if ( node && styleClassName )
    {
        if ( node['className'] == '' )
            node['className'] = styleClassName;
        else
            node['className'] = node['className'] + ' ' + styleClassName;
    }
}

/*!
  Get the style object for the element with id objID
 */
function ezjslib_getStyleObject( objID )
{
    if ( document.getElementById && document.getElementById( objID ) ) // DOM
    {
        return document.getElementById( objID ).style;
    }
    else if ( document.all && document.all( objID ) ) // IE
    {
        return document.all( objID ).style;
    }
    else if ( document.layers && document.layers[objID] )
    {
        return false; // Netscape 4.x Not currently supported.
    }
    else
    {
        return false;
    }
}

/*!
  Get the properties of the visible screen. Returns an object containing
  .ScrollX - The amount of pixels the page has been scrolled vertically
  .ScrollY - The amount of pixels the page has been scrolled horizontally
  .Height - The height of the browser window
  .Width - The width of the browser window.
*/
function ezjslib_getScreenProperties()
{
  // client width and height
  result = new Array();
  result.ScrollX = 0;
  result.ScrollY = 0;
  result.Height = 0;
  result.Width = 0;

  if ( typeof( window.innerWidth ) == 'number' )
  {
    // all but IE
    result.Width = window.innerWidth;
    result.Height = window.innerHeight;
  }
  else if ( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) )
  {
    // IE 6
    result.Width = document.documentElement.clientWidth;
    result.Height = document.documentElement.clientHeight;
  }
  else if ( document.body && ( document.body.clientWidth || document.body.clientHeight ) )
  {
    // IE 4
    result.Width = document.body.clientWidth;
    result.Height = document.body.clientHeight;
  }

  // offsets
  if ( typeof( window.pageYOffset ) == 'number' )
  {
    // Netscape compliant
    result.ScrollY = window.pageYOffset;
    result.ScrollX = window.pageXOffset;
  }
  else if ( document.body && ( document.body.scrollLeft || document.body.scrollTop ) )
  {
    // DOM
    result.ScrollY = document.body.scrollTop;
    result.ScrollX = document.body.scrollLeft;
  }
  else if ( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) )
  {
    // IE6
    result.ScrollY = document.documentElement.scrollTop;
    result.ScrollX = document.documentElement.scrollLeft;
  }

  return result;
}