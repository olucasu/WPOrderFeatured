<?php
namespace WPOrderFeatured;

use WPOrderFeatured\ACF;

/**
 * WPOrderFeatured class
 * 
 * - Add ACF pro fields to the post
 * - Add action to ordenate featured post
 * 
 * Uses ACF PRO
 * - make sure do have ACF PRO Plugin in your Wordpress project
 *  
 */
class WPOrderFeatured
{
  /**
   * Post type
  */
  public $post_type = 'post';
  /**
   * ACF field ID that defines if the post is featured
  */
  private $acf_post_is_featured;
  /**
   * ACF field ID that defines the post position
  */
  private $acf_position;

  public function update_featured() 
  {
    global $post;
    
    $destaque = $_POST['acf'][$this->getAcfPostIsFeatured()];
    if($destaque === 'sim') {
      $position = $_POST['acf'][$this->getAcfPosition()];
      $args = [
        'post_type'   => $this->getPostType(),
        'meta_query'  => [
          array(
            'key' => 'featured_position',
            'value' => $position,
            'compare' => '=='
          ),
        ]
      ];
  
      $query = new \WP_Query($args);
  
      if($query->have_posts()) {
        foreach ($query->posts as $posts) {
          if($posts->ID !== $post->ID) {
            delete_field('posicao_destaque', $posts->ID); 
            update_field('is_slide_destaque', 'nao', $posts->ID); 
          };
        };
      };
    };
  }
  
  private function setAcfPostIsFeatured($acfId) 
  {
    $this->acf_post_is_featured = $acfId;
  }

  private function setAcfPosition($acfId) 
  {
    $this->acf_position = $acfId;
  }

  private function getAcfPostIsFeatured() 
  {
    return $this->acf_post_is_featured;
  }

  private function getAcfPosition() 
  {
    return $this->acf_position;
  }

  private function addAction() 
  {
    add_action( 'save_post', array( $this , 'update_featured' ) );
  }

  private function getPostType()
  {
    return $this->post_type;
  }

  public static function bootstrap($acf_post_is_featured = 'field_57cd780e5ac23', $acf_position = 'field_5a58d70aeb9b5' )
  {
    ACF::config();
    $wpOrderFeatured = new WPOrderFeatured();
    $wpOrderFeatured->setAcfPostIsFeatured($acf_post_is_featured);
    $wpOrderFeatured->setAcfPosition($acf_position);
    $wpOrderFeatured->addAction();
  }
}
