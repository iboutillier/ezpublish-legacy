<?php
//
// Created on: <18-Apr-2002 10:04:48 amos>
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ publish
// SOFTWARE RELEASE: 3.8.x
// COPYRIGHT NOTICE: Copyright (C) 1999-2006 eZ systems AS
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
// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

include_once( 'kernel/common/template.php' );

/*!
 Reads the doxygen generated HTML file and replaces hrefs and CSS classes
 with eZ publish&trade; SDK related ones.
*/
function &referenceReadFile( $file, $htmlRoot, $base )
{
    include_once( "lib/ezutils/classes/ezsys.php" );

    // Settings for NVH setup
    $pathPrepend = eZSys::wwwDir();
    $indexPathPrepend = eZSys::indexDir();

    $fd = fopen( $file, "rb" );
    $data = fread( $fd, filesize( $file ) );
    fclose( $fd );
    $pos = strpos( $data, "<hr>" );
    if ( $pos !== false )
    {
        $data = substr( $data, $pos + 4 );
    }
    $id = "[a-zA-Z0-9_]+";
    $data = preg_replace( array( "/class=\"([^\"]+)\"/",
                                 "/<h1/",
                                 "/<caption/",
                                 "/<body/",
                                 "/src=\"(class($id)\.png)\"/",
                                 "/href=\"class($id)-members\.html(#$id)?\"/",
                                 "/href=\"class($id)\.html(#$id)?\"/",
                                 "/href=\"group__($id)\.html(#$id)?\"/",
                                 "/href=\"deprecated\.html(#$id)?\"/",
                                 "/href=\"todo\.html(#$id)?\"/",
                                 "/href=\"($id)_8php\.html(#$id)?\"/",
                                 "/href=\"($id)_8php-source\.html(#$id)?\"/"
                                 ),
                          array( "class=\"dox_$1\"",
                                 "<h1 class=\"dox\"",
                                 "<caption class=\"dox\"",
                                 "<body class=\"dox\"",
                                 "src=\"$pathPrepend/$htmlRoot/$1\"",
                                 "href=\"$indexPathPrepend$base/members/$1$2\"",
                                 "href=\"$indexPathPrepend$base/class/$1$2\"",
                                 "href=\"$indexPathPrepend$base/module/$1$2\"",
                                 "href=\"$indexPathPrepend$base/deprecated$1\"",
                                 "href=\"$indexPathPrepend$base/todo$1\"",
                                 "href=\"$indexPathPrepend$base/file/$1$2\"",
                                 "href=\"$indexPathPrepend$base/source/$1$2\""
                                 ),
                          $data );
    return $data;
}

function eZReferenceDocument( &$module, $referenceBaseURI, $referenceType, $parameters )
{
    $content = "";

//     $baseURI = $Params["base_uri"];
    $baseURI = $referenceBaseURI;
    $ReferenceType = false;
    if ( isset( $parameters[0] ) )
        $ReferenceType = $parameters[0];
    $ReferenceName = "";
    if ( isset( $parameters[1] ) )
        $ReferenceName = $parameters[1];

    $error = false;

    $result = array();

    $htmlRoot = 'doc/generated/html';

    switch ( $ReferenceType )
    {
        case "modules":
        {
            $refFile = "$htmlRoot/modules.html";
            if ( file_exists( $refFile ) )
            {
                $refData =& referenceReadFile( $refFile, $htmlRoot, $baseURI );
                $content .= $refData;
            }
            else
                $error = true;
        } break;
        case "module":
        {
            $refFile = "$htmlRoot/group__" . $ReferenceName . ".html";
            if ( file_exists( $refFile ) )
            {
                $refData =& referenceReadFile( $refFile, $htmlRoot, $baseURI );
                $content .= $refData;
            }
            else
                $error = true;
        } break;
        case "file":
        {
            $refFile = "$htmlRoot/" . $ReferenceName . "_8php.html";
            if ( file_exists( $refFile ) )
            {
                $refData =& referenceReadFile( $refFile, $htmlRoot, $baseURI );
                $content .= $refData;
            }
            else
                $error = true;
        } break;
        case "source":
        {
            $refFile = "$htmlRoot/" . $ReferenceName . "_8php-source.html";
            if ( file_exists( $refFile ) )
            {
                $refData =& referenceReadFile( $refFile, $htmlRoot, $baseURI );
                $content .= $refData;
            }
            else
                $error = true;
        } break;
        case "todo":
        {
            $refFile = "$htmlRoot/todo.html";
            if ( file_exists( $refFile ) )
            {
                $refData =& referenceReadFile( $refFile, $htmlRoot, $baseURI );
                $content .= $refData;
            }
            else
                $error = true;
        } break;
        case "deprecated":
        {
            $refFile = "$htmlRoot/deprecated.html";
            if ( file_exists( $refFile ) )
            {
                $refData =& referenceReadFile( $refFile, $htmlRoot, $baseURI );
                $content .= $refData;
            }
            else
                $error = true;
        } break;
        case "hierarchy":
        {
            $refFile = "$htmlRoot/hierarchy.html";
            if ( file_exists( $refFile ) )
            {
                $refData =& referenceReadFile( $refFile, $htmlRoot, $baseURI );
                $content .= $refData;
            }
            else
                $error = true;
        } break;
        case "annotated":
        {
            $refFile = "$htmlRoot/annotated.html";
            if ( file_exists( $refFile ) )
            {
                $refData =& referenceReadFile( $refFile, $htmlRoot, $baseURI );
                $content .= $refData;
            }
            else
                $error = true;
        } break;
        case "files":
        {
            $refFile = "$htmlRoot/files.html";
            if ( file_exists( $refFile ) )
            {
                $refData =& referenceReadFile( $refFile, $htmlRoot, $baseURI );
                $content .= $refData;
            }
            else
                $error = true;
        } break;
        case "functions":
        {
            $refFile = "$htmlRoot/functions.html";
            if ( file_exists( $refFile ) )
            {
                $refData =& referenceReadFile( $refFile, $htmlRoot, $baseURI );
                $content .= $refData;
            }
            else
                $error = true;
        } break;
        case "related":
        {
            $refFile = "$htmlRoot/pages.html";
            if ( file_exists( $refFile ) )
            {
                $refData =& referenceReadFile( $refFile, $htmlRoot, $baseURI );
                $content .= $refData;
            }
            else
                $error = true;
        } break;
        case "class":
        {
            $refFile = "$htmlRoot/class" . $ReferenceName . ".html";
            if ( file_exists( $refFile ) )
            {
                $refData =& referenceReadFile( $refFile, $htmlRoot, $baseURI );
                $content .= $refData;
            }
            else
                $error = true;
        } break;
        case "members":
        {
            $refFile = "$htmlRoot/class" . $ReferenceName . "-members.html";
            if ( file_exists( $refFile ) )
            {
                $refData =& referenceReadFile( $refFile, $htmlRoot, $baseURI );
                $content .= $refData;
            }
            else
                $error = true;
        } break;
        case "globals":
        {
            $refFile = "$htmlRoot/globals.html";
            if ( file_exists( $refFile ) )
            {
                $refData =& referenceReadFile( $refFile, $htmlRoot, $baseURI );
                $content .= $refData;
            }
            else
                $error = true;
        } break;
        default:
        {
            $tpl =& templateInit();
            $content =& $tpl->fetch( "design:reference/view/$referenceType/intro.tpl" );
        } break;
    }

    if ( $error )
    {
        $tpl =& templateInit();
        $content =& $tpl->fetch( "design:reference/view/$referenceType/error.tpl" );
//         return $module->handleError( EZ_ERROR_KERNEL_NOT_FOUND, 'kernel' );
    }

    $result["content"] = $content;
    return $result;
}

?>