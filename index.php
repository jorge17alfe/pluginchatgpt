<?php
/*
Plugin Name: ChatGPT
Description: This is amazon plugin
Version: 1.00
*/

require_once "app/controller/chatgptController.php";
require_once "app/controller/adminController.php";

function Active()
{
    $a =   new adminController;
    $a->Active();
}
register_activation_hook(__FILE__, 'Active');


function Desactive()
{
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'Desactive');


function CreateMenu()
{
    $a =   new adminController;
    $a->CreateMenu(plugin_dir_path(__FILE__) . 'public/view/index.php');
}
add_action('admin_menu', 'CreateMenu');



function RegisterBootstrapJS($hook)
{
    // echo "<script>console.log('$hook')</script>";
    if ($hook != "chatgpt/public/view/index.php") {
        return;
    }
    wp_enqueue_script('bootstrapJs', plugins_url('public/assets/bootstrap-5.2.3-dist/js/bootstrap.bundle.js', __FILE__), array('jquery'));
}
add_action('admin_enqueue_scripts', 'RegisterBootstrapJS');


function RegisterBootstrapCSS($hook)
{
    // echo "<script>console.log('$hook')</script>";
    if ($hook != "chatgpt/public/view/index.php") {
        return;
    }
    wp_enqueue_style('bootstrapCss', plugins_url('public/assets/bootstrap-5.2.3-dist/css/bootstrap.min.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'RegisterBootstrapCSS');



// //Register js own

function RegisterJsChatgpt($hook)
{
    if ($hook != "chatgpt/public/view/index.php") {
        return;
    }
    wp_enqueue_script('JsExternal', plugins_url('public/assets/js/index.js', __FILE__), array('jquery'), '1', true);
    wp_localize_script('JsExternal', 'PetitionAjax', [
        'url' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('seg')
    ]);
}
add_action('admin_enqueue_scripts', 'RegisterJsChatgpt');



// // savedata 

function SaveDataUserAdminchatgpt()
{
    $a =   new adminController;
    if($_GET){
        echo $a->GetDataUserAdminchatgpt();
        return;
    }
    echo  $a->SaveDataUserAdminchatgpt();
}

add_action('wp_ajax_nopriv_save_data_user_chatgpt', 'SaveDataUserAdminchatgpt');
add_action('wp_ajax_save_data_user_chatgpt', 'SaveDataUserAdminchatgpt');


function SaveCreatePageIA()
{
    
    $a =   new chatgptController;
    echo  $a->SaveCreatePageIA();
}

add_action('wp_ajax_nopriv_save_create_page_IA', 'SaveCreatePageIA');
add_action('wp_ajax_save_create_page_IA', 'SaveCreatePageIA');

function GetAllPages()
{
   
    if($_POST){
        if(!isset($_POST["data"]["since"] )|| $_POST["data"]["since"] < 0){

            $since= 0;
        }else{
            $since= $_POST["data"]["since"];

        }
        $total_rows= $_POST["data"]["total_rows"];
    }else if($_GET){
        $since= 0;
        $total_rows= 5;
    }
    $a =   new chatgptController;
    echo  $a->GetAllPages(($since*$total_rows),$total_rows);
}

add_action('wp_ajax_nopriv_get_all_pages', 'GetAllPages');
add_action('wp_ajax_get_all_pages', 'GetAllPages');


function GetShortCode($atts)
{
    $a =   new chatgptController;
    return $a->GetShortCode($atts);
}
add_shortcode("CHATGPT", "GetShortCode");

