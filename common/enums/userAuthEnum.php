<?php 
enum AUTH {
    case SUCCESS;
    case INVALID_CREDENTIALS;
    case USER_BLOCKED;
    case EMAIL_NOT_FOUND;
}
?>