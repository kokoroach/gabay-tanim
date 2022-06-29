<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$wrapper_start = '
<!DOCTYPE html>
    <html lang="en">
';
$wrapper_end = '</html>';
$header = 'templates/header';
if(!empty($header_2) && $header_2 == true) 
{
    $header = 'templates/header_2';
}

// Load templated view
echo $wrapper_start;
$this->load->view($header, $title=NULL);
$this->load->view($body);
if (!empty($view_type) && ($view_type != 'no_footer'))
{
    $this->load->view('templates/footer');
}
echo $wrapper_end;
