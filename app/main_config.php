<?php
try{
ob_start();
session_start();
include("inc/config.php");
include("inc/functions.php");
include("inc/CSRF_Protect.php");
include("inc/con_desem_consultor_rel.php");
$csrf = new CSRF_Protect();
$cdcr = new ConDesemConsultorRel();

$error_message = '';
$success_message = '';
$error_message1 = '';
$success_message1 = '';

$CUR_PAGE = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 

define('DEFAULT_PHOTO_USER','user-0.png');
define('USER_SUPER_ADMIN','2,4');

$statement = $pdo->query('SHOW TABLES');
$LIST_TABLES = $statement->fetchAll(PDO::FETCH_COLUMN);
if(isset($_SESSION['user'])) {
    $PHOTO_USER= $_SESSION['user']['photo'];
    $statement = $pdo->prepare("SELECT status_session FROM tbl_user WHERE id=?");
    $statement->execute(array($_SESSION['user']['id']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
    foreach ($result as $row) {
        if ($row['status_session']==0){
            unset($_SESSION['user']);
            header("location: login.php");    
        }
    }
}

$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
    $LOGO = $row['logo']."?".rand();
    $FAVICON = $row['favicon'];
    $COMPANY_NAME = $row['company_name'];
    $COMPANY_ID = $row['company_id'];
    $COMPANY_NIT = $row['company_nit'];
}

$V_ACTION = array(ADD, EDIT, DELETE);
$V_ACTION_VALUE = array(0, 0, 0);
$V_ACTION_ICO_CHECK = array(' <i class="fa fa-plus i-scale"></i>','<i class="fa fa-edit i-scale"></i>','<i class="fa fa-trash-o i-scale"></i>');
$V_ACTION_ICO = array(' <i class="fa fa-plus "></i>','<i class="fa fa-pencil"></i>','<i class="fa fa-trash-o"></i>');

$ON_OFF=array(NO, YES);

$DEFAULT_URL = 'con_desempenho.php';


}catch (Exception $e) {
    echo $e->getMessage();
}

function AAD_LOG($table_name='',$col_value='', $col_where='', $file_name='', $event_id=0){
    $pdo=$GLOBALS["pdo"];
    if (isset($_SESSION['user'])){
        $statement = $pdo->prepare("INSERT INTO tbl_log (user_id, table_name, col_value, col_where, file_name, event_id) VALUES (?,?,?,?,?,?)");
        $statement->execute(array($_SESSION['user']['id'],$table_name,$col_value, $col_where, $file_name, $event_id));    
    }
}


function ASSING_POST($v, $vd=''){
    $r=$vd;
    if (isset($_POST[$v])){
        $r=$_POST[$v]==''?$vd:trim($_POST[$v]);
    }
    return $r;
}


function GET_ROLES($file_current, $rol_id=""){
    $pdo=$GLOBALS["pdo"];
    $ck_rol=0; $ck_add=0; $ck_edit=0; $ck_del=0; $id_r=1;
    if (isset($_SESSION['user'])):
        $roles=$_SESSION['user']['roles'];
        $roles_action=$_SESSION['user']['roles_action'];

        $vroles=explode('|', $roles);
        $vroles_action=explode('|', $roles_action);
        
        $run=1;
        $aux="";
        if ($rol_id!=""){
            
            $idx=array_search($rol_id, $vroles);
            //$role=$vroles[$idx];
            //$action=$vroles_action[$idx];
            if ($idx!=false){
                
                $vroles=array($vroles[$idx]);
                $vroles_action=array($vroles_action[$idx]);
                $aux=count($vroles);
            }else{
                $run=0;
            }
        }
        
        if ($run==1) {
            for ($i=0; $i < count($vroles) ; $i++) { 
                $statement = $pdo->prepare("SELECT * FROM tbl_roles WHERE id_r=? ORDER BY id_r");
                $statement->execute(array($vroles[$i]));
                $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
                $ck_rol=0; $ck_add=0; $ck_edit=0; $ck_del=0; $id_r=1;
                
                foreach ($result as $row) {
                    $id_r=$row['id_r'];
                    if (strpos($row['file_r'], ',')){
                        $t='';
                        $vfile_r =explode(',', $row['file_r'])  ;
                        for ($j=0; $j < count($vfile_r) ; $j++) {

                            //$t.=$file_current.'='.trim($vfile_r[$j]) . '=>';

                            if($file_current==trim($vfile_r[$j])){


                                $vaction=explode(',', $vroles_action[$i]);
                                $ck_rol=1;
                                $ck_add=$vaction[0];
                                $ck_edit=$vaction[1];
                                $ck_del=$vaction[2];
                                break;
                            }
                        } 
                    }else{
                        if($file_current==trim($row['file_r'])){
                            $aux="ch";
                            $vaction=explode(',', $vroles_action[$i]);
                            $ck_rol=1;
                            $ck_add=$vaction[0];
                            $ck_edit=$vaction[1];
                            $ck_del=$vaction[2];
                        }
                    }                 
                }

                if ($ck_rol==1)
                    break;
            }
        }
    endif;

    $roles = array($ck_rol, $ck_add, $ck_edit, $ck_del, $id_r);
    return $roles; 
}
/*break_end DETERMINA SI EL BUCLE SALE EN LA ULTIMA INTERACCIÓN O EN LA PRIMERA*/

function GET_ROLES_ALL($break_end=1){
    $pdo=$GLOBALS["pdo"];
    $o=$break_end== 1 ? " ORDER BY id_r DESC" : "";

    $f='';
    $f2='';
    if (isset($_SESSION['user'])):
    $statement = $pdo->prepare("SELECT * FROM tbl_roles {$o}");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
    
    $name="";
    foreach ($result as $row) {
        if (strpos($row['file_r'], ',')){
            $vfile_r =explode(',', $row['file_r']) ;
            for ($j=0; $j < count($vfile_r) ; $j++) {
                $f=trim($vfile_r[$j]);
                $v = GET_ROLES($f);
                if($v[0]==1){
                    $f2=$f;
                    break;
                }
            } 
        }else{
            $f=trim($row['file_r']);
            $v = GET_ROLES($f);
            if($v[0]==1){
                $f2=$f;
                break;
            }
        }                 
        if ($v[0]==1)
            break;
    }
    endif;

    if ($f2 =='')
        $f2='profile-edit.php';
    return $f2; 
}

function DUC($v, $n=1){
    if ($v!='')
        $v=substr($v, 0, strlen($v)-$n);
    return $v;
}

function SUST($v, $v2='---'){
    if ($v=='')
        $v=$v2;
    return $v;
}


?>