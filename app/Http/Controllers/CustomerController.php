<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;
use SoapClient;
use Vyuldashev\XmlToArray\XmlToArray;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function addCustomer(Request $input){
        $request = $input->all();
        $Customer = new Customers;


        // unset($request['pq_cellselect']);
        foreach ($request['data'] as $key => $value) {
            // print_r($value);
            unset($value['status']);
            unset($value['pq_cellselect']);
            unset($value['pq_cellcls']);
            // print_r($value);

            $s = $value[2] ;
            $date = strtotime($s);
            $LastUpdateDate =  date('Y-m-d H:i:s', $date);
            $CreationDate =  date('Y-m-d H:i:s', strtotime($value[5]));
            $AccountEstablishedDate =  date('Y-m-d H:i:s', strtotime($value[11]));
            $AccountTerminationDate =  date('Y-m-d H:i:s', strtotime($value[12]));

            $dataSet = [
                    'CustomerAccountId'  => $value[0],
                    'PartyId'=> $value[1],
                    'LastUpdateDate' =>  $LastUpdateDate ,
                    'AccountNumber' =>   $value[3],
                    'LastUpdatedBy' =>  $value[4] ,
                    'CreationDate' =>  $CreationDate,
                    'CreatedBy' =>   $value[6],
                    'OrigSystemReference' => $value[7]  ,
                    'Status' =>  $value[8] ,
                    'CustomerType' =>  $value[9] ,
                    'CustomerClassCode' =>  $value[10] ,
                    'AccountEstablishedDate' =>  $AccountEstablishedDate,
                    'AccountTerminationDate' =>  $AccountTerminationDate ,
                    'HoldBillFlag' =>  $value[13] ,
                    'AccountName' =>  $value[14] ,
                    'CreatedByModule' =>   $value[15],
                    'CustomerAccountRoleId' => $value[16]  ,
                    'RoleType' =>  $value[17] ,
                    'RelationshipId' =>  $value[18] ,
                    'ContactPersonId' =>  $value[19] ,
                    'ResponsibilityId' =>  $value[20] ,
                    'ResponsibilityType' =>  $value[21] ,
                    'OrigSystemReferenceId' => $value[22]  ,
                    'OrigSystem' =>  $value[23] ,
                    'OrigSystemReference1' => $value[24]  ,
                    'OwnerTableName' =>  $value[25] ,
                    'RelatedCustomerAccountId' => $value[26]  ,
                    'CustomerAccountRelateId' =>  $value[28] ,
                    'SetId' =>  $value[29] ,
                    'SetCode' =>  $value[30] ,
                    'CustomerAccountSiteId' => $value[31]  ,
                    'PartySiteId' =>  $value[32] ,
                    'OrigSystemReference2' =>  $value[33] ,
                    'SiteUseId' =>  $value[34] ,
                    'BillToSiteUseId' => ''
                ];

            // DB::table('customers')->insert($dataSet);
            // DB::table('customers')->save();
                       // foreach ($subArr as $key => $value) {
               // if ($key == '1') {
               //  unset($subArr[$key]);
               // }
           // }
                Customers::insert($dataSet);
        }
        // print_r($dataSet); 
        // Customers::insert($dataSet);
        // print_r($request); 
        die;

    }

    public function searchCustomer()
    {
        return view('customer.searchCustomer');
    }

    public  function getCustomer(Request $input)
    {
        $request = $input->all();
        // print_r($request );
        $WSDL_username = env('WSDL_username');
        $WSDL_password = env('WSDL_password');
        $WSDL_client = env('WSDL_client');

        try {
            $grp = array();
            if(isset($request['partyid'])){
               $party = array(
                                'upperCaseCompare' => 'false',
                                'excludeAttribute' => 'false',
                                'attribute' => 'PartyId',
                                'operator'  => '=',
                                'value' => $request['partyid']
                            );
                array_push($grp, $party);
            }
            if(isset($request['CustomerAccountId'])){
               $cust = array(
                                'upperCaseCompare' => 'false',
                                'excludeAttribute' => 'false',
                                'attribute' => 'CustomerAccountId',
                                'operator'  => '=',
                                'value' => $request['CustomerAccountId']
                            );
                array_push($grp, $cust);
            }
            
            $client = new SoapClient($WSDL_client, 
                    array('trace' => 1,
                        'login' => $WSDL_username,
                        'password' => $WSDL_password)
                    );
                    // Construct the payload to be used to invoke the service.
            $params = array(
                        'findCriteria' => array(
                            'upperCaseCompare' => 'false',
                            'excludeAttribute' => 'false',
                            'fetchStart' => '0',
                            'fetchSize' => '-1',
                            'filter' => array(
                                'group' =>array(
                                    'upperCaseCompare' => 'false',
                                    'excludeAttribute' => 'false',
                                    'item' => $grp
                                 )
                            ),
                            'excludeAttribute' => 'false',
                            'upperCaseCompare' => 'false',
                            'childFindCriteria' => array(
                               // 'upperCaseCompare' => 'false',
                                'excludeAttribute' => 'false',
                                'fetchStart' => '0',
                                'fetchSize' => '-1',
                                'childAttrName' => 'CustomerAccountSite',
                                'filter' => array(
                                    'upperCaseCompare' => 'false',
                                    'excludeAttribute' => 'false',
                                    'group' => array(
                                        'upperCaseCompare' => 'false',
                                        'excludeAttribute' => 'false',
                                        'item' => array(
                                            'conjunction' => 'And',
                                            'upperCaseCompare' => 'false',
                                            'excludeAttribute' => 'false',
                                            'attribute' => 'CustomerAccountSiteUse',
                                            'operator' => 'CONTAINS',
                                            'nested' => array(
                                                //'upperCaseCompare' => 'false',
                                                 'excludeAttribute' => 'false',
                                                'group' => array(
                                                    'upperCaseCompare' => 'false',
                                                     'excludeAttribute' => 'false',
                                                    'item' => array(
                                                        //'upperCaseCompare' => 'false',
                                                         'excludeAttribute' => 'false',
                                                        'attribute' => 'SiteUseCode',
                                                        'operator' => '=',
                                                        'value' => 'SHIP_TO'                                                                
                                                    ),
                                                     'item' => array(
                                                        // 'upperCaseCompare' => 'false',
                                                          'excludeAttribute' => 'false',
                                                        'attribute' => 'Status',
                                                        'operator' => '=',
                                                        'value' => 'A'                                                                
                                                    ),
                                                     'item' => array(
                                                         'upperCaseCompare' => 'false',
                                                          'excludeAttribute' => 'false',
                                                        'attribute' => 'Location',
                                                        'operator' => '=',
                                                        'value' => 'Target0003 Crystal, MN-SHIP'                                                                
                                                    )
                                                )
                                            )

                                        )
                                    )
                                )
                            )    
                        ),
                        'findControl' => array(
                            'retrieveAllTranslations' => 'false'
                        )
                    );
            // print_r($params); die;                
            // Invoke the service
            $response = $client->findCustomerAccount($params);
            $res = $client->__getLastResponse();

            $clean_xml = str_ireplace(['env:','ns0:', 'wsa:', 'ns2:', 'ns0:', 'ns4:', 'ns8:', 'ns4:', 'ns2:', 'ns3:', 'ns5:', 'ns6:', 'ns7:', 'ns9:' ], '', $res);
            $xml = simplexml_load_string($clean_xml);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);  

            // $result['0'] = array();

            // print_r(count($array['Body']['findCustomerAccountResponse']['result']['Value']));die;

            if(!isset($array['Body']['findCustomerAccountResponse']['result']['Value'][0])){
                $result['Value'][0] = $array['Body']['findCustomerAccountResponse']['result']['Value'];
            }
            else{
                $result = $array['Body']['findCustomerAccountResponse']['result'];
            }
// print_r($result);  die;

            return json_encode($result) ;
        } catch (Exception $e) {
                print "Exception: " . $e->getMessage();
        }
    }

}
