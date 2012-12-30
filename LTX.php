<?php
/*
  LTX (Link Tags Extended)
  Version: 0.9
  Author: Mac Conin - http://conin.de
  
  Other Contributors:
  Based on an idea of Greg Smart http://www.gregorysmart.com
  and Craig McCoy http://www.captaincodemonkey.com/blog/
  
  Description: generates SEO optimized quick-links
  
  MODx Versions:
  Revolution - All versions. But not tested

  Installation:
  Create a new Snippet and name it LTX
  Copy the content of this file into the empty snippet.

  Parameters:
  [[LTX? &id=`1` ]]
  generates: <a href="/" title="longtitle-of-doc" alt="pagetitle-of-doc">menutitle-of-doc</a>

  [[LTX? &id=`1`
         &title=`this way`
         &alt=`follow this link`
         &link=`readmore`
         &class=`css-class`
         &follow=`nofollow`]]
  
  Version History:
    0.9 first version
*/

/**********Variables***********/

$doc = $modx->getObject('modResource', $id);
if (!($doc instanceof modResource)) { return 'doc not found'; }

$published = $doc->get('published');
if ($published == 0) { return 'doc not yet published'; }

$output = '';

/**longtitle --> title**/
if ($title == '') $title = $doc->get('longtitle');

/**pagetitle --> alt**/
if ($alt == '') $alt = $doc->get('pagetitle');

/**menutitle --> link**/
if ($link == '') $link = $doc->get('menutitle');

/**css class**/
if ($class != '')
  $class="class=\"".$class."\""; 

/**should I folow oder go ;) **/
if ($follow != '')
  $follow=" rel=\"".$follow."\""; 


if(!empty($doc))

$output = "<a ".$class.$follow." alt=\"".$alt."\" title=\"".$title."\" href=\"".$modx->makeUrl($id, '', '', 'full')."\">".$link."</a>";

return $output;