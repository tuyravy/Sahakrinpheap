<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/* user*/

$route['session'] = 'Login/index';
$route['logout'] = 'Login/logout';


/*---------------Create User------------*/


//$route['Create']='setting/Create_users';
$route['User_set']='setting/User_set';
$route['Validate']='setting/Uservalide';

/*---------------Staff-------------------*/

/*------------------------------------*/
$route['UserRole']='User/index';
/*------------------------------------*/

/*
----------------Daily Report----------
*/
$route['cmrconsoildate']='daily/cmr';
$route['bybranch']='daily/cmrbybranch';
$route['daily/activeBorrower']='daily/activeBorrower';
$route['loanPortfolio']='daily/loanPortfolio';
$route['loanDisbInMonth']='daily/loanDisbInMonth';
$route['repaymentinmonth']='daily/repaymentinmonth';
$route['writtenoff']='daily/writtenoff';
$route['dailycheck']='setting/dailychecking';

//---------------route RM------------------------//

$route['daily/active']='daily/active';
$route['loanPort']='daily/loanPort';
$route['loanDisb']='daily/loanDisb';
$route['repayment']='daily/repayment';
$route['writtenoffrm']='daily/writtenoffrm';


//---------------route dceo---------------------//

$route['daily/actived']='daily/actived';
$route['daily/loanPortd']='daily/loanPortd';
$route['daily/loanDisbd']='daily/loanDisbd';
$route['daily/loanDisbdlimit/(:any)']='daily/loanDisbdlimit/$1';
$route['repaymentd']='daily/repaymentd';
$route['dcmrsahakrinpheaceo']='daily/dcmrsahakrinpheaceo';
$route['cmrSummRMCEO']='daily/cmrSummRMCEO';
$route['dcmrPlanVsResult']='daily/dcmrPlanVsResult';
$route['dcmrResultAugVsSep']='daily/dcmrResultAugVsSep';
$route['dcmrResultDailyDisburse']='daily/dcmrResultDailyDisburse';
$route['dailycoperforment']='daily/dailycoperforment';
$route['brancPerforment']='daily/brancPerforment';
$route['AllbranchPerforment']='daily/AllbranchPerforment';
$route['daillyloan']='daily/daillyloan';
$route['daillydisbursebyinterest']='daily/loandisbbyinterest';
$route['daillydisbursebyinterestTest']='daily/daillydisbursebyinterestTest';
$route['writtenoffcollection']='daily/writtenoffcollection';


/*-------------Import attendance------------------*/
$route['imports_attendance']='imports_Controller/imports';
$route['check_data']='imports_Controller/checking_data';
$route['importsfiles']='imports_Controller/importscsv';
$route['eomsystem']='imports_Controller/eom';
$route['totalovertime']='imports_Controller/totalovertime';
$route["get_import_list"]="imports_Controller/get_import_list";
$route["import_delete/(:any)"]="imports_Controller/import_delete/$1";


/*-------------------Admin--------------------------*/


$route['eom']='setting/index';
$route['generatedate']='setting/generateCalendar';
$route['datachecking']='setting/datachecking';

