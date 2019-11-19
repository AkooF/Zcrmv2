<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use zcrmsdk\oauth\ZohoOAuthClient;
use zcrmsdk\crm\setup\restclient\ZCRMRestClient;
use zcrmsdk\oauth\ZohoOAuth;
use zcrmsdk\crm\crud\ZCRMModule;
use zcrmsdk\crm\crud\ZCRMRecord;

class PotentialsController extends Controller
{   
    
    public static function index(){
                //нужно перенести в модель
        $configuration =array("client_id"=>"1000.PNONXBBGGW8QYXK3B2U3GMRMXT68TH","client_secret"=>"4994e2b5080f014995a680ae03d9c4e1cc462e245e","redirect_uri"=>"http://zoho.gimnaziya9.zp.ua/","currentUserEmail"=>"papay1000@gmail.com","token_persistence_path"=>"/var/www/b1439230/data/www/zoho.gimnaziya9.zp.ua/TokenStorage");
        ZCRMRestClient::initialize($configuration);
        $oAuthClient = ZohoOAuth::getClientInstance();        
        $refreshToken = "1000.91771ee53e0d065d9ca4149a078c2dc2.e51c2591e69ee330d54ae491eb7693d0";
        $oAuthTokens = $oAuthClient->generateAccessTokenFromRefreshToken($refreshToken,$configuration['currentUserEmail']);
        $rest=ZCRMRestClient::getInstance();
        
        $users=$rest->getCurrentUser()->getData();//to get the users in form of ZCRMUser instances array
        //Если несколько пользователей, можно перебрать каждого
        $userId = $users[0]->getId();
        
        $zcrmModuleIns = ZCRMModule::getInstance("deals");
        $bulkAPIResponse=$zcrmModuleIns->getRecords();
        $recordsArray = $bulkAPIResponse->getData(); 
       
        foreach ($recordsArray as $record){
            
            $deal['entityId']       = $record->getEntityId();
            $deal['ownerName']      = $record->getOwner()->getName();
            $deal['ownerId']        = $record->getOwner()->getId();
            $deal['accountName']    = $record->getFieldValue('Account_Name')->getLookupLabel();
           // $deal['contactName']    = $record->getFieldValue('Contact_Name')->getLookupLabel();
            $deal['amount']         = $record->getFieldValue('Amount');
            $deal['closingDate']    = $record->getFieldValue('Closing_Date');
            $deal['stage']          = $record->getFieldValue('Stage');
            
            $deals[] = $deal;
        }
        
        
        
        //$zcrmModuleIns = ZCRMModule::getInstance("Deals");
        //$apiResponse= $zcrmModuleIns->getAllRelatedLists();
        //$relatedLists =$apiResponse->getData();
        
        //$zcrmRecordIns = ZCRMRecord::getInstance("Deals", $deals[2]['entityId']);
        //$bulkAPIResponse=$zcrmRecordIns->getRelatedListRecords("Tasks");
        //$relatedRecordsList=$bulkAPIResponse;
        
        //dd($relatedRecordsList);
        
    
        
        return view('potentials',['deals' => $deals]);
    }
    
    public static function show(){
                //нужно перенести в модель
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
        
        return view('newDeals',['fullName' => $fullname, 'userId' => $userId]);
    }
    
    public static function store(Request $request){
        $param = $request->all();
        
        
                //нужно перенести в модель или еще куда-то
        $configuration =array("client_id"=>"1000.PNONXBBGGW8QYXK3B2U3GMRMXT68TH","client_secret"=>"4994e2b5080f014995a680ae03d9c4e1cc462e245e","redirect_uri"=>"http://zoho.gimnaziya9.zp.ua/","currentUserEmail"=>"papay1000@gmail.com","token_persistence_path"=>"/var/www/b1439230/data/www/zoho.gimnaziya9.zp.ua/TokenStorage");
        ZCRMRestClient::initialize($configuration);
        $oAuthClient = ZohoOAuth::getClientInstance();        
        $refreshToken = "1000.91771ee53e0d065d9ca4149a078c2dc2.e51c2591e69ee330d54ae491eb7693d0";
        $oAuthTokens = $oAuthClient->generateAccessTokenFromRefreshToken($refreshToken,$configuration['currentUserEmail']);
        
        $rest=ZCRMRestClient::getInstance()->getModuleInstance("Deals");
        
        
        //получаем ZCRMUser для Owner
        $restUser=ZCRMRestClient::getInstance()->getOrganizationInstance();
        $users=$restUser->getUser($param['Owner'])->getData();
        
        
        //Без валидации данных.. понимаю, не хорошо
        $record=ZCRMRecord::getInstance("Deals",null);
        $record->setOwner($users);
        $record->setCreatedBy($users);
        $record->setFieldValue('Account_Name', $param['Account_Name']);
        $record->setFieldValue('Deal_Name', $param['Deal_Name']);
        $record->setFieldValue('Type', $param['Type']);
        $record->setFieldValue('Stage', $param['Stage']);
        $record->setFieldValue('Probability', $param['Probability']);
        $record->setFieldValue('Amount', $param['Amount']);
        $record->setFieldValue('Closing_Date', $param['Closing_Date']);
        $records = array();
        array_push($records, $record);
        $responseIn=$rest->createRecords($records);
        
        //dd($responseIn);
        return redirect('/potential');
        
    }
    
    
}
