<?php 
enum REGESTRATION{
    case SUCCESS;
    case DBFAILURE;
    case INVALID_PASSWORD;
    case INVALID_NAME;
    case INVALID_EMAIL;
    case EMAIL_TOKEN;
}
?>