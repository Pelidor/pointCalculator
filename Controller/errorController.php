<?php
class Error extends Controller
{
function __construct()
{
parent::__construct();
//echo '<br>Error construct';
$this->view->render('error/index',null,'Error');
}
}