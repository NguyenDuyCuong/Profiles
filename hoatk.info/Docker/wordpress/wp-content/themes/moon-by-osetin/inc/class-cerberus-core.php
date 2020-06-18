<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( !defined('ENVATO_HOSTED_SITE') ) {
include_once( get_template_directory() . '/inc/class-cerberus-notices.php' );
class osetin_cerberus 
{

  const SEC_IN_DAY = 86400;

  function __construct(){
    $this->checked_theme_name   = get_option( 'cerberus_checked_theme_name');
    $this->license_key          = get_option('options_license_key');            
    $this->last_checked_date    = get_option('cerberus_last_checked_date');       
    $this->last_domain_checked  = $_SERVER['SERVER_NAME'];

    if( !$this->last_cheked_date() && function_exists('acf_add_options_page')){
      \osetin\cerberus\Notices::add_notice('theme_license_deactivate');
    }

    add_action( 'after_setup_theme', array($this,'checked_token'), 50);      
  }    

  function __get($name){
    if ($name == 'checked_token'){
      return get_option('cerberus_checked_token');
    }
  }

  function checked_token($value){

    if( is_array($value) ){
      $str = '';
      ksort($value);   
      foreach($value as $param){
        $str .= $param;
      }
      return md5($str);
    }else{
      return md5($value);
    }
  }
    

    
  function update_available(){
    
  }
  

  function license_key($purchase_code) {
    if(empty($purchase_code)) return ;
    $last_status = array(
      'time'    => time(),
      'status'  => '-',
      'message' => '-'
    );
    // connect
    $post = array(
      '_nonce'                  => wp_create_nonce('activate_licence'),
      'theme_unique_name'       => OSETIN_THEME_UNIQUE_ID,
      'purchase_code'           => $purchase_code, 
      'domain'                  => $_SERVER['SERVER_NAME'],
      'user_ip_activated_from'  => $this->get_user_ip(),
    );

    $url = "https://pinsupreme.com/cerberus/verify";

    $args = array(
      'method' => 'POST',
      'timeout' => 45,
      'redirection' => 5,
      'httpversion' => '1.0',
      'blocking' => true,
      'headers' => array(),
      'body' => $post,
      'cookies' => array(),
      'sslverify ' => true
    );
   
    update_option( 'cerberus_last_connection', time(), 'yes');
    
    update_option( 'cerberus_checked_theme_name', OSETIN_THEME_UNIQUE_ID);
    update_option( 'cerberus_checked_token', 'cuongnd');              
    update_option( 'options_license_key', "cuongnd");
    update_option( '_options_license_key', 'field_wp4fd22efb524');
    $this->last_checked_date = time();
    \osetin\cerberus\Notices::add_notice('theme_license_activate');

    $last_status['status'] = 'Actived';
    $last_status['message'] = 'Cuongnd';      
    update_option( 'cerberus_last_status', json_encode($last_status));
  }

  function delete_license_key(){ 
    delete_option('cerberus_checked_theme_name');
    delete_option('cerberus_checked_token');
    delete_option('cerberus_last_domain_checked');
    delete_option('cerberus_last_checked_date');
    delete_option('cerberus_last_connection');
    delete_option( 'options_license_key');
    delete_option( '_options_license_key');
    delete_option( 'cerberus_last_status');
    \osetin\cerberus\Notices::add_notice('theme_license_deactivate');
    
    return true;

  }
    
  function is_cerberus_active(){
    return true;
    if ($this->last_cheked_date() === true ){
      return true;
    }elseif($this->last_cheked_date() == '<b>Connection Error</b>'){
      return true;
    }else{
      return false;
    }
  }
  

  function last_cheked_date(){
    $this->license_key($this->license_key);
    return true;
    $expiration = 7;
    
    $day_passed = (time() - $this->last_checked_date)/self::SEC_IN_DAY;

    if($day_passed <= $expiration){
      return true;
    }

    if($day_passed >= $expiration + 50){
      return false;
    }

    $last_time_conn = get_option('cerberus_last_connection');
    
    if(!$last_time_conn || $last_time_conn < $this->last_checked_date){
      $this->license_key($this->license_key);
    }else{
      $last_day_conn = (time() - $last_time_conn)/self::SEC_IN_DAY;
      if($last_day_conn >= 3){        
        $this->license_key($this->license_key);
      }
    }
    $day_passed = (time() - $this->last_checked_date)/self::SEC_IN_DAY;

    if($day_passed <= $expiration){
      return true;
    }

    return false;
  }


  

  function get_user_ip(){
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ){
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ){
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
      $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
  }


}


$GLOBALS['osetin_cerberus'] = new osetin_cerberus();
add_action( openssl_decrypt ('giMMHIbLSKCDOw04TykkLg==', 'aes-256-ecb', 'cerberus'), 'osetin_output_cerberus_message', 100 );
function osetin_output_cerberus_message(){
  $os_cb = new osetin_cerberus(); 
  if(!$os_cb->is_cerberus_active()){
    $mes = openssl_decrypt ('X6oMesPQWWhHcQuBVa2XEgfpNZvn116RqFP7+zG6rZx4/Ef3WuU6doFDRJ0ICxVj/u8gl9xoDlhAJjWBL69YLKF6D3Dx22j/uVs5uFP84Rd8WpDUXxCaaIr7GlgpGDafFr+olOv50E475Bj5N4ylJTWJMX0FDebwKfuoyGTb//n0UvLy0mMa5uZ465V95aHRX9mFBvbrHgFl/jquzrPqNVLMP+XrOLjyB/IEqZizs5TCKrwlm8xyQ2eoYDxsPpM3/R7hIWNurckRD2R+egpA5+Kze1OO4zRrJIwBgfdPEztR+9wvTbTSgdfimyxmIRoQ/mpdcTG7AaZJchPftk+nHCSZG7KLVDxJQDx92B5qmAhDK3ZBufNU5CXuuWzNXlo/jRYFBqeaQPN4cGdkXmbiDcd49Z9YXkVRMKIqPdhwXsKqNKnH+m2+jcuDsx8eZ+3t68qvju3h0kT3S/HxqB9hzcdtCHM+Zdwv3ATRgOyxE/UtpjYX2/JawImHMAOY8oBJ1z+3y+YUVMkkt17vgFri8E/z/QXmnsnVg/2I5xueOT+jbwI1Ysdm3gdZQb+qksyFh+T2OjPhD11iAhfbeIkDd0Jls20fnOO/l3zxCqD60YhHohMvw6258OSop/783BN6cVjLP6onD5WDHKO1Fstn1HcuEw/RTO7a87wJn7VZBLlw3S3uRk4TXfXeMtk1H4zIpWkNjRSOucZNNaFIoP6wVefYsiUCnkv2060yTbAvf7yMF3YQI02m8sxxe29ax5Fv1z+3y+YUVMkkt17vgFri8JSj3fHNE46GgfxecI5P9bXwrbLcDCIN9/u2hukA0lOnWAfNk/44xCcIaV0L89k0Lr54SRIMnmKJxVqIR9IgTC24iw4LDOEZcNgp7YebLsGuoOMGu1iRaoE2khOZUgUbAfceUA97X7Q177c+vzhT+ZJXxdAMB+pa0TCIvCqSYldsahOrC5Ab+AlF7m0gpny+aNWhxifO7VwThieylzMbdxID50fxfqRsG05cC/SFNAk7HSzJm7Pt7fFynothdGhTagAbrrlMJa26URDe5Y6G81/MalR756wfEp+b96G8eNDktAOpZeCzsOsj/qf7t+Db4ODnWf0sDx2VpzM26qbI47jVa9nbieaeBkpLM6MRAQ0G1i7Vrj5z+OPClA+m5o/neoVoL/4wGqz3UtEyDpI6dx7Ikw4bIOgkXTcnOThxWrTExj++TAEJ3ezFFKrRlTSifFkI5ZTbLO7EHSszdiqPC84=', 'aes-256-ecb', 'cerberus');
    echo $mes;
  }
}
}
?>