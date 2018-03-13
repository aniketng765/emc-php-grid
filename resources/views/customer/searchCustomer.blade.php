@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
        	<div class="card">
                <div class="card-header">Find Customers</div>
                
                <div class="card-body">
	                <form id="searchCust">
		            	Party ID : <input class="col-sm-2" type="text" name="partyid" value="" id="partyid" placeholder="enter partyId" >
		            	Customer Account Id : <input class="col-sm-2" type="text" name="CustomerAccountId" value="" id="CustomerAccountId" placeholder="enter partyId" >

		            	<input class="col-sm-2" type="button" name="" value="Search" id="savebtn" onclick="getCustomer();" >	
		            </form>
                </div>
                <div id="grid_array" ></div>
            </div>
            
    	</div>
	</div>
</div>

<style type="text/css">
	#loading {
		position: fixed;
		width: 100%;
		height: 100vh;
		background: #fff url({{ asset('public/css/images/Loading_icon.gif') }}) no-repeat center center;
		z-index: 9999;
	    top: 0px;
    	opacity: 0.5;
	}
</style>

<script type="text/javascript">
	// jQuery(function () {
	
        var colModel = [
        { title: "AccountEstablishedDate", width: 200, dataType: "string", dataIndx: "AccountEstablishedDate"  },
        { title: "PartyId", width: 200, dataType: "string", dataIndx: "PartyId" },
        { title: "AccountNumber", width: 150, dataType: "string", align: "right" , dataIndx: "AccountNumber" },
        { title: "CreatedBy", width: 150, dataType: "string", align: "right", dataIndx :"CreatedBy" },
        { title: "CreationDate", width: 150, dataType: "string", align: "right", dataIndx: "CreationDate" },
        { title: "CustomerAccountId", width: 150, dataType: "string", align: "right",dataIndx: "CustomerAccountId", },
        { title: "CustomerClassCode", width: 200, dataType: "string", dataIndx: "CustomerClassCode" },
        { title: "LastUpdatedBy", width: 200, dataType: "string", dataIndx: "LastUpdatedBy" },
        { title: "OrigSystemReference", width: 200, dataType: "string", dataIndx: "OrigSystemReference" },
        { title: "AccountTerminationDate", width: 150, dataType: "string", align: "right", dataIndx: "AccountTerminationDate" },
        { title: "CustomerType", width: 150, dataType: "string", align: "right", dataIndx: "CustomerType"}];
	

	
// });

	function getCustomer(){
		$("#loading").show();
		// $("#grid_array").pqGrid('refresh' );
		// $("#grid_array").pqGrid( "refreshDataAndView" );
		$.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr("content")},
            url: 'getCustomer',
            data: {'partyid': $("#partyid").val(), CustomerAccountId : $("#CustomerAccountId").val()},
            dataType: "json",
            success: function (response) {
            	$("#loading").hide();
        		var grid1 = $("#grid_array").pqGrid({ 
		            dataModel:{data:response.Value} ,
		            bottomVisible: false,
             	 	// dataModel.data : cust ,
		            colModel: colModel,            
		            title: "Customers List"
		        });
        		grid1.pqGrid( "refreshDataAndView" );

            }
        });
	}

</script>


@endsection