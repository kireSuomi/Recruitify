<?php

//Enqueue Style
add_action( 'wp_enqueue_scripts', 'load_css' );
function load_css() {
  wp_enqueue_style( 'blankslate-style', get_stylesheet_uri() );
  
  $path =  get_stylesheet_directory_uri(  )  . '/assets/css/index.css';
  wp_enqueue_style('theme-override', $path , array(), '0.1.0', 'all');

  $path =  get_stylesheet_directory_uri(  )  . '/assets/js/index.js';
  wp_enqueue_script('theme-override-script', $path , array(), '0.1.0', 'all');
}


//Add ACF options page
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Loginpage Settings',
		'menu_title'	=> 'Login/Registrer',
		'parent_slug'	=> 'theme-general-settings',
	));
	

}

//Change excerpt from [...] to ...
function new_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more', 999);

//Change excerpt length
function custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//Customize login page
function my_login_logo() {
  $bgImage = get_field('background_image', 'options')['url'];
  $logo =  get_field('logo', 'options')['url'];
  ?>
  
  <style type="text/css">
      .login {
          position: relative;
          background-image: url(<?php echo $bgImage ?>);
          background-size: cover;
          background-position: center !important;
       
      }
       #wp-submit {
        border: 1px solid black;
        padding: 10px;
        background: none !important;
        color: black !important;
        display: block;
        text-transform: uppercase;
        max-width: 200px;
        margin: 0 auto;
        font-family: Helvetica;
        line-height: 1 !important;
        transition: 0.2s ease-in;
      }

      #wp-submit:hover {
        background: #3a3a3a !important;
        color: white !important;
      }

      h2, .acf-field  {
        display: none;
      }

      .login::after {
        position: absolute;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100%;
        content: "";
        display: block;
        background: rgba(1, 1, 1, 0.5);
        z-index: -1;
      }


      #login h1 a, .login h1 a {
        background-image: url(<?php echo $logo ?>) !important;
        height:65px;
        width:320px;
        background-size: 320px 65px;
        background-repeat: no-repeat;
        padding-bottom: 30px;
      }

      #nav a, #backtoblog a, #nav {
        color :white !important;
      }
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) {
     return '/';
}


//Add custom css to admin page
add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
  //Hide repeater of applicants for the job post (theese are shown under a different tab on the admin page)
  echo '<style>
  .acf-field-60c25939fa937 {
    display: none;
  }


  .candidates {
    display: flex;
    flex-wrap: wrap;  
    gap: 10px;
  }

  .backend-user {
    display: flex;
    flex-direction: column;
    text-align: center;
    width: 250px;
    background: white;
    box-shadow: 3px 3px 3px rgba(1,1,1,0.2);
    gap: 10px;
    padding-bottom: 22px;
    margin-top: 1em;
  }
  .backend-user p {
    margin: 0;
  }

  .backend-user img {
    wdith: 250px;
    height: 250px;
    object-fit: cover;
    display: block;
  }
  </style>';
}



add_action( 'rest_api_init', function () {
  register_rest_route( 'job', 'apply', array(
    'methods' => 'POST',
    'callback' => function($req) {
      $data = json_decode( $req->get_body(), false);
      $id = intval($data->id);
      $value =  [
        'field_60c2597efa938' => $id
      ];
      $res = add_row('field_60c25939fa937', $value, intval($data->postID));
      echo true;
    },
  ) );
} );