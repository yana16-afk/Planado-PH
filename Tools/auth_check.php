<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    $current_page = $_SERVER['REQUEST_URI'];
    
    $current_page = ltrim($current_page, '/');
    $current_page = strtok($current_page, '?');
    
    $script_dir = dirname($_SERVER['SCRIPT_NAME']);
    $levels_up = substr_count($script_dir, '/');
    
    $root_path = str_repeat('../', $levels_up);
    
    $redirect_url = $root_path . 'login.php?redirect=' . urlencode($current_page);
    
    header('Location: ' . $redirect_url);
    exit();
}
?>