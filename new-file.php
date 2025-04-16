
<?php

$html = file_get_contents('https://staging-wp231482.wpdns.ca/');
libxml_use_internal_errors(true);
$dom = new DOMDocument();
$dom->loadHTML($html);
libxml_clear_errors();
$heads = $dom->getElementsByTagName('head');
echo $headHTML.'<link rel="stylesheet" href="style-static.min.css">';
$headHTML = '';
if($heads->length > 0) {
    $head = $heads->item(0);
    $headHTML = $dom->saveHTML($head);
    $head->parentNode->removeChild($head);
}
$headers = $dom->getElementsByTagName('header');
$headerHTML = '';
if($headers->length > 0) {
    $header = $headers->item(0);
    $headerHTML = $dom->saveHTML($header);
    $header->parentNode->removeChild($header);
}
$footers = $dom->getElementsByTagName('footer');
$footerHTML = '';
if($footers->length > 0) {
    $footer = $footers->item(0);
    $footerHTML = $dom->saveHTML($footer);
    $footer->parentNode->removeChild($footer);
}
echo $headHTML;
echo $headerHTML;
$xpath = new DOMXPath($dom);
$elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' elementor-6722 ')]");
foreach($elements as $element) {
    $children = [];
    foreach($element->childNodes as $child) {
        if($child->nodeType === XML_ELEMENT_NODE) {
            $children[] = $child;
        }
    }
    foreach($children as $child) {
        if(strpos($child->getAttribute('class'), 'bannerHome') !== false) {
            foreach($children as $otherChild) {
                if($otherChild !== $child) {
                    $element->removeChild($otherChild);
                }
            }
            echo $dom->saveHTML($element);
            break;
        }else {
            $element->removeChild($child);
        }
    }
}
include 'addplan-new-colo.php';
echo $footerHTML;
?>
<style>

@font-face {
    font-family: ETmodules;
    src: url(../amanah_tech/lib/featherlight/assets/fonts/modules.woff);
  }
.elementor-6722{margin-top:115px;}
.et-waypoint:not(.et_pb_counters){
    opacity: 1;
}
</style>