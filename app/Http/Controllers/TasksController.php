<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use zcrmsdk\oauth\ZohoOAuthClient;
use zcrmsdk\crm\setup\restclient\ZCRMRestClient;
use zcrmsdk\oauth\ZohoOAuth;
use zcrmsdk\crm\crud\ZCRMModule;
use zcrmsdk\crm\crud\ZCRMRecord;

class TasksController extends Controller
{
    public static function show(){
        
        return view('tasks');
    }
    
    public static function create($id){
        
       
        [
            'Task_owner'    => 'Owner',
            'Subject'       => 'Subject',
            'DueDate'       => 'Due_Date',
            'Contact'       => 'Who_Id',
            'Account'       => '',
            'Status'        => 'Status',
            'Priority'      => 'Priority',
            'Reminder'      => '',
            'Repeat'        => '',
            'Description'   => 'Description'
        ];
        
        //нужно перенести в модель или другое место
        $configuration =array("client_id"=>"1000.PNONXBBGGW8QYXK3B2U3GMRMXT68TH","client_secret"=>"4994e2b5080f014995a680ae03d9c4e1cc462e245e","redirect_uri"=>"http://zoho.gimnaziya9.zp.ua/","currentUserEmail"=>"papay1000@gmail.com","token_persistence_path"=>"/var/www/b1439230/data/www/zoho.gimnaziya9.zp.ua/TokenStorage");
        ZCRMRestClient::initialize($configuration);
        $oAuthClient = ZohoOAuth::getClientInstance();        
        $refreshToken = "1000.91771ee53e0d065d9ca4149a078c2dc2.e51c2591e69ee330d54ae491eb7693d0";
        $oAuthTokens = $oAuthClient->generateAccessTokenFromRefreshToken($refreshToken,$configuration['currentUserEmail']);
        $rest=ZCRMRestClient::getInstance()->getOrganizationInstance();
        
        //костыль.. тут нужно UserId получать, а не просто вставлять
        
        $userId = '4288906000000242013';
        $users=$rest->getUser($userId)->getData();
        $fullname = $users->getFullname();
        
        //contacts
        $zcrmModuleIns = ZCRMModule::getInstance("contacts");
        $bulkAPIResponse=$zcrmModuleIns->getRecords();
        $recordsArray = $bulkAPIResponse->getData(); 
        foreach ($recordsArray as $record){
            $contact['Who_Id'] = $record->getEntityId();
            $contact['FullName'] = $record->getFieldValue('Full_Name');
            
            $contacts[] = $contact;
        }
        
        
        //dd($contacts);
        return view('newTask',['fullName' => $fullname, 'userId' => $userId, 'contacts' => $contacts, 'id' => $id]);
    }
    
    public static function store(Request $request){
        $param = $request->all();
         
            //нужно перенести в модель или еще куда-то
        $configuration =array("client_id"=>"1000.PNONXBBGGW8QYXK3B2U3GMRMXT68TH","client_secret"=>"4994e2b5080f014995a680ae03d9c4e1cc462e245e","redirect_uri"=>"http://zoho.gimnaziya9.zp.ua/","currentUserEmail"=>"papay1000@gmail.com","token_persistence_path"=>"/var/www/b1439230/data/www/zoho.gimnaziya9.zp.ua/TokenStorage");
        ZCRMRestClient::initialize($configuration);
        $oAuthClient = ZohoOAuth::getClientInstance();        
        $refreshToken = "1000.91771ee53e0d065d9ca4149a078c2dc2.e51c2591e69ee330d54ae491eb7693d0";
        $oAuthTokens = $oAuthClient->generateAccessTokenFromRefreshToken($refreshToken,$configuration['currentUserEmail']);
        
        $rest=ZCRMRestClient::getInstance()->getModuleInstance("Tasks");
        
        
        //получаем ZCRMUser для Owner
        $restUser=ZCRMRestClient::getInstance()->getOrganizationInstance();
        $users=$restUser->getUser($param['Owner'])->getData();
        
        
        //Без валидации данных.. понимаю, не хорошо
        $record=ZCRMRecord::getInstance("Tasks",null);
        $record->setOwner($users);
        $record->setCreatedBy($users);
        $record->setFieldValue('What_Id', $param['What_Id']);
        $record->setFieldValue('Subject', $param['Subject']);
        $record->setFieldValue('Who_Id', $param['Who_Id']);
        $record->setFieldValue('Status', $param['Status']);
        $record->setFieldValue('Priority', $param['Priority']);
        $record->setFieldValue('Due_Date', $param['Due_Date']);
        $record->setFieldValue('Description', $param['Description']);
        $record->setFieldValue('$se_module', 'Deals');
        $records = array();
        
        //dd($record);
        array_push($records, $record);
        $responseIn=$rest->createRecords($records);
        
        
       
        return redirect('/potential');
    }
}
