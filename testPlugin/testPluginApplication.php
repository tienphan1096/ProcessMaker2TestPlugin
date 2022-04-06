<?php
/**
 * welcome.php for plugin testPlugin
 *
 *
 */
G::LoadClass( 'derivation' );
require_once ("classes/model/Task.php");
require_once ("classes/model/AppDelegation.php");

try {
  $derivation['APP_UID'] = '6214508375dee9513779199027634423';
  $derivation['DEL_INDEX'] = 13;
  // $derivation['USER_UID'] = '7621312415734a550009767006494966';
  $derivation['USER_UID'] = '84168335652a5154bb56076047220785';



  $derivationClass = new Derivation();
  $temp = $derivationClass->prepareInformation($derivation);

  $derivation['TAS_UID'] = '2330483975519e903811332003584774';
  $derivation['ROU_CONDITION'] = ''; // assuming sequential
  $derivation['ROU_NEXT_TASK'] = '47721251557dc7e25c42034032051029'; // 0412 Confirm Project Details
  $derivation['ROU_TYPE'] = 'SEQUENTIAL'; 
  

  $task = new Task();
  $derivation['NEXT_TASK'] = $task->load($derivation['ROU_NEXT_TASK']);
  $derivation['NEXT_TASK']['TAS_PARENT'] = '';

  $derivation['NEXT_TASK']['USER_ASSIGNED'] = $derivationClass->getNextAssignedUser($derivation);

  $currentDelegation = array(
    'APP_UID' => $derivation['APP_UID'],
    'DEL_INDEX' => $derivation['DEL_INDEX'],
    'APP_STATUS' => 'TO_DO',
    'TAS_UID' => $derivation['TAS_UID'],
    'ROU_TYPE' => $derivation['ROU_TYPE']
  );

  $oAppDel = new AppDelegation();
  $appdel = $oAppDel->Load($derivation['APP_UID'], $derivation['DEL_INDEX']);

  $nextDelegations = array();
  $nextDelegations['TAS_UID'] = $derivation['NEXT_TASK']['TAS_UID'];
  $nextDelegations['USR_UID'] = $derivation['NEXT_TASK']['USER_ASSIGNED']['USR_UID'];
  $nextDelegations['TAS_ASSIGN_TYPE'] = $derivation['NEXT_TASK']['TAS_ASSIGN_TYPE'];
  $nextDelegations['TAS_DEF_PROC_CODE'] = $derivation['NEXT_TASK']['TAS_DEF_PROC_CODE'];
  $nextDelegations['DEL_PRIORITY'] = $appdel['DEL_PRIORITY'];
  $nextDelegations['TAS_PARENT'] = $derivation['NEXT_TASK']['TAS_PARENT'];

  $derivationClass->derivate($currentDelegation, array($nextDelegations));



} catch (Exception $e) {
  echo '<pre>';
  var_dump($e);
  echo '</pre>';
}

// try {



//   /* Render page */
//   $oHeadPublisher = &headPublisher::getSingleton();
  
//   $G_MAIN_MENU        = "processmaker";
//   $G_ID_MENU_SELECTED = "ID_TESTPLUGIN_MNU_01";
//   //$G_SUB_MENU             = "setup";
//   //$G_ID_SUB_MENU_SELECTED = "ID_TESTPLUGIN_02";

//   $config = array();
//   $config["pageSize"] = 15;
//   $config["message"] = "Hello world!";

//   $oHeadPublisher->addContent("testPlugin/testPluginApplication"); //Adding a html file .html
//   $oHeadPublisher->addExtJsScript("testPlugin/testPluginApplication", false); //Adding a javascript file .js
//   $oHeadPublisher->assign("CONFIG", $config);

//   G::RenderPage("publish", "extJs");
// } catch (Exception $e) {
//   $G_PUBLISH = new Publisher;
  
//   $aMessage["MESSAGE"] = $e->getMessage();
//   $G_PUBLISH->AddContent("xmlform", "xmlform", "testPlugin/messageShow", "", $aMessage);
//   G::RenderPage("publish", "blank");
// }
?>