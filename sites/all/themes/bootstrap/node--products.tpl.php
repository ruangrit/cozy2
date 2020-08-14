<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup templates
 */
?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php if ((!$page && !empty($title)) || !empty($title_prefix) || !empty($title_suffix) || $display_submitted): ?>
  <header>
    <?php print render($title_prefix); ?>
    <?php if (!$page && !empty($title)): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if ($display_submitted): ?>
    <span class="submitted">
      <?php print $user_picture; ?>
      <?php print $submitted; ?>
    </span>
    <?php endif; ?>
  </header>
  <?php endif; ?>
  <?php
    // Hide comments, tags, and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);
    //print render($content);


    
  ?>

  
  <div class="row">
    <div class="col-xs-8">
      <?php 
        print '<div class="code16 l25">'.render($content['field_product_code']).'</div>'; 
        print '<div class="title18 l25">'.$node->title.'</div>';
        print '<div class="l25 product-node-detail-1">'.render($content['group_product_details']['field_product_material']).'</div>';
        print '<div class="l25 product-node-detail-1">'.render($content['group_product_details']['field_product_color']).'</div>';
        print '<div class="l25 product-node-detail-1">'.render($content['field_product_supplier']).'</div>';
      ?>

    </div>
    <div class="col-xs-4">
        <?php print render($content['field_product_feature_image']);?>
    </div>
    <div class="border-line marb20">&nbsp;</div>
  </div>

  <div class="row product-node-detail">
    <div class="col-xs-4">
        <div class="title16">Size</div>
        <?php print render($content['group_product_details']['group_size']);?>
    </div>
    <div class="col-xs-4">
        <div class="title16">Price</div>
        <?php  print render($content['group_product_details']['field_product_price']);?>
        <?php  print render($content['group_product_details']['field_product_cost']);?>
    </div>
    <div class="col-xs-4">
        <div class="title16">Quantity</div>
        <?php print render($content['group_product_details']['group_quantity']);?>
    </div>

    <div class="border-line marb20">&nbsp;</div>
  </div>

    
 
    <div class="row">
      <div class="col-xs-4">
        <?php print render($content['field_product_shop']);?>
      </div>
      <div class="col-xs-4">

        <span class="title16">Category - </span>
        <span class="normal16">
        <?php
            ///dpm($node);
            $parent_term = taxonomy_get_parents($node->field_product_category['und'][0]['tid']);
            if ($parent_term) {
              foreach ($parent_term as $value) {
                print $value->name;
              }
              
            }
            else {
                print $node->field_product_category['und'][0]['taxonomy_term']->name;
            }

        ?>
        </span>
      </div>
      <div class="col-xs-4 marb20">
        <span class="title16">Sub Category - </span>
        <span class="normal16">
        <?php
          
          if ($parent_term) {
            print $node->field_product_category['und'][0]['taxonomy_term']->name;
          }
          else {
            print '-no sub catagory-';
          }
        ?>
        </span>
      </div>

    </div>  

  <div class="row">
   <div class="col-xs-12 title16">Description</div>
   <div class="col-xs-12 normal16"><?php print render($content['body']);?></div>
  </div>

  <?php
    // Only display the wrapper div if there are tags or links.
    $field_tags = render($content['field_tags']);
    $links = render($content['links']);
    if ($field_tags || $links):
  ?>
   <footer>
     <?php print $field_tags; ?>
     <?php print $links; ?>
  </footer>
    <?php endif; ?>
  <?php print render($content['comments']); ?>
</article>


<style>
.page-header {
  display: none;
}
</style>

