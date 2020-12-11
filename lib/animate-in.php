<?php


// Adds class of .module to the .site-tagline-right widget.
add_filter('genesis_attr_site-tagline-left', 'add_class_to_tagline_left');
add_filter('genesis_attr_site-tagline-right', 'add_class_to_tagline_right');


function add_class_to_tagline_left($attributesOne)
{
  
  $attributesOne['class'] = $attributesOne['class'] . ' module-one';
  return $attributesOne;
  
}

function add_class_to_tagline_right($attributesTwo)
{
  
  $attributesTwo['class'] = $attributesTwo['class'] . ' module-two';
  return $attributesTwo;
  
}


