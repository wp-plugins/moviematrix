<?php
/*
Plugin Name: MyMovieMatrix Widget
Plugin URI: http://mymoviematrix.com
Description: MyMovieMatrix: Smartest Desi Recommender
Author: anadahalli [Ashwath Nadahalli] <ashwath@moviematrix.in>
Version: 1.0
Author URI: http://mymoviematrix.com
*/

class MyMovieMatrix extends WP_Widget {
  function __construct() {
    parent::__construct(
      'MyMovieMatrix',
      __('MyMovieMatrix', 'text_domain'),
      array('description' => __('Smartet Desi Recommender', 'text_domain'), )
    );
  }

  public function widget($args, $instance) {
    if (array_key_exists('before_widget', $args)) echo $args['before_widget'];
    echo '<div id="mmx-widget"></div>';
    wp_enqueue_script('mymoviematrix', 'http://mymoviematrix.com/static/js/widget.js', array(), '1.0.0', true);
    if (array_key_exists('after_widget', $args)) echo $args['after_widget'];
  } 

  public function form($instance) {
    if (isset($instance['title'])) {
      $title = $instance['title'];
    }
    else {
      $title = __('MyMovieMatrix', 'text_domain');
    }
?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" 
        name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" 
        value="<?php echo esc_attr( $title ); ?>">
  </p> 
<?php
  }

  public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    return $instance;
  }
}

add_action('widgets_init', function(){
  register_widget('MyMovieMatrix');
}); 

?>
