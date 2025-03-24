<?php 
enum ADDTASK:int {
    case SUCCESS = 0;
    case INVALIDE_TITLE = 1;
    case INVALIDE_DESC = 2;
    case DBFAILUR = 3;
    case UNKNOWN_ERR = 4;
    case NOEVENT = 5; //when nothing happened yet 
}
enum EDITTASK:int {
    case SUCCESS = 0;
    case FAILED = 1;
}

?>