<?php
function zero_preprocess_html(&$vars) {
    /*
    * Add a sensible default viewport attribute for responsive sites.
    */
    $metaViewport = array(
        '#tag' => 'meta',
        '#attributes' => array(
        'name' => 'viewport',
        'content' => 'width=device-width, initial-scale=1.0',
      ),
        '#weight' => -2,
    );
    drupal_add_html_head($metaViewport, 'meta_viewport');
}

/*
 * HTML5-ify content type meta tag and weight the meta tags
 */
function zero_html_head_alter(&$head_elements) {
    $head_elements['system_meta_content_type']['#attributes'] = array(
        'charset' => 'utf-8'
    );
    /* Some weighting is required to group the elements together */
    $head_elements['system_meta_generator']['#weight'] = -1;
}

/*
 * Remove extraneous XHTML attributes and CDATA tags
 */
function zero_preprocess_html_tag(&$vars) {
    $el = &$vars['element'];
    
    // Remove type="..." and CDATA prefix/suffix.
    unset($el['#attributes']['type'], $el['#value_prefix'], $el['#value_suffix']);
    
    // Remove media="all" but leave others unaffected.
    if (isset($el['#attributes']['media']) && $el['#attributes']['media'] === 'all') {
        unset($el['#attributes']['media']);
    }
}