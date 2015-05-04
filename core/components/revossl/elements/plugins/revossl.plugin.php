<?php
/*
 * Title:           RevoSSL
 * Author:          Joshua Gulledge
 * Created:         5/5/2011
 * Updated:         4/11/2013
 * Version:         1.0.4pl
 * Description:     Allow users to make a page SSL and the Manager SSL
 * 
 * Based on Evo plugin:
 * Title:      SSL
 * Desc:        Plugin triggered OnWebPageInit
            Manages switching between https:// and http:// pages
            Sets site-wide custom placeholders for secure/insecure server paths and base href
*/
$makeSSL = false; 
$enable = false;
switch($modx->event->name) {
    /* on the manager load */
    case 'OnBeforeManagerPageInit':
    case 'OnManagerPageInit':
    case 'OnManagerLoginFormPrerender':
        $enable = $modx->getOption('revoSSL.enableManager',$scriptProperties, false);
        
        // get a system setting - revoSSL.manager
        $makeSSL = $modx->getOption('revoSSL.manager',$scriptProperties,false);
        if ( $makeSSL == 'Yes' || $makeSSL == 'Y' ) {
            $makeSSL = true;
        }
        break;
    /* On web page loads */
    case 'OnWebPageInit':
        $enable = $modx->getOption('revoSSL.enableWeb',$scriptProperties, false);
        
        // if a property set is defined:
        $makeSSL = $modx->getOption('makeSSL', $scriptProperties, 0);
        if ( $makeSSL == 'Yes' || $makeSSL == 'Y' ) {
            $makeSSL = true;
        }
        $id = $modx->resourceIdentifier;
        if ( $id > 0 ){
            $resource = $modx->getObject('modResource', array('id' => $id ) );
            // now if a TV is defined:
            if (is_object($resource) ){
                // http://forums.modx.com/thread/83816/revossl---pretty-severe-bug
                if ($resource->get('published') == false || $resource->get('deleted')) {
                    if ( !$modx->hasPermission('view_unpublished') ) {
                        return;
                    }
                }
                // END
                $tmpSSL = $resource->getTVValue('makeSSL');
                if ( empty($tmpSSL)){
                    
                } elseif ( $tmpSSL == 'Yes' || $tmpSSL == 'Y' || $tmpSSL ) {
                    $makeSSL = true;
                } else if ( $tmpSSL == 'No' || $tmpSSL == 'N' || !$tmpSSL ) {
                    $makeSSL = false;
                }
            }
        }
            
        break;
}

if ( $enable == 'No' || $enable == 'n' || !$enable ) {
    // Do not continue
    return;
}
// is the current page in SSL?
if( $_SERVER['HTTPS'] == 1 || $_SERVER['HTTPS'] == 'on' || $_SERVER['SERVER_PORT'] == 443) {
    $ssl = true;
} else {
    $ssl = false;
}

$force_redirect = false;
$host = $_SERVER['HTTP_HOST'];
// force www or no www
$force_www = $modx->getOption('revoSSL.forceWWW', $scriptProperties, false);
if ( strpos($_SERVER['HTTP_HOST'], 'www.') === false && $force_www ) {
    // no WWW
     $host = 'www.'.$_SERVER['HTTP_HOST'];
     $force_redirect = true;
}

// the current URL of the page
$url = $host.$_SERVER['REQUEST_URI'];//$_SERVER['PHP_SELF'];
// http://rtfm.modx.com/display/revolution20/modX.sendRedirect

// switch between http / https if necessary
if ( $makeSSL && !$ssl ) {
    // if SSL off and we are about to access a secure page then redirect
    $modx->sendRedirect('https://'.$url);
} elseif (!$makeSSL && $ssl ) {
    // if SSL is on and we are about to acccess an unsecure page then redirect
    $modx->sendRedirect('http://'.$url);
} elseif ( $force_redirect ) {
    // if SSL is on and we are about to acccess an unsecure page then redirect
    if ( $makeSSL ) {
        $modx->sendRedirect('https://'.$url);
    } else {
        $modx->sendRedirect('http://'.$url);
    }
}

return;