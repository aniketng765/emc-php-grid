@extends('layouts.app')

@section('content')
<style type="text/css">
    .pq-delete
    {
        background: red !important;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Customers</div>

                <div class="card-body">
                    <div id="grid_array" ></div>

                </div>
                
            </div>
            <input type="button" name="" value="save" id="savebtn" >
        </div>
    </div>
</div>
<script>
    jQuery(function () {
        var data = [];

        var dataModel = {
            location: "remote",
            url: "/Content/orders.json",
            getData: function(response){                
                var data = response.data.slice(0, 2);
                //add some empty rows.
                for(var i=0; i< 100; i++){
                    data.push({});
                }
                return {data: data};
            }
        }

        var obj = {
            showTitle: true,
            title: "Customers List",
            resizable:false,
            draggable:false,
        };
        obj.colModel = [
        { title: "CustomerAccountId", width: 200, dataType: "string" },
        { title: "PartyId", width: 150, dataType: "string", align: "right" },
        { title: "LastUpdateDate", width: 150, dataType: "string", align: "right" },
        { title: "AccountNumber", width: 150, dataType: "string", align: "right" },
        { title: "LastUpdatedBy", width: 150, dataType: "string", align: "right" },
        { title: "CreationDate", width: 150, dataType: "string", align: "right" },
        { title: "CreatedBy", width: 200, dataType: "string" },
        { title: "OrigSystemReference", width: 150, dataType: "string", align: "right" },
        { title: "Status", width: 150, dataType: "string", align: "right" },
        { title: "CustomerType", width: 150, dataType: "string", align: "right" },
        { title: "CustomerClassCode", width: 150, dataType: "string", align: "right" },
        { title: "AccountEstablishedDate", width: 150, dataType: "string", align: "right" },
        { title: "AccountTerminationDate", width: 200, dataType: "string" },
        { title: "HoldBillFlag", width: 150, dataType: "string", align: "right" },
        { title: "AccountName", width: 150, dataType: "string", align: "right" },
        { title: "CreatedByModule", width: 150, dataType: "string", align: "right" },
        { title: "CustomerAccountRoleId", width: 150, dataType: "string", align: "right" },
        { title: "RoleType", width: 150, dataType: "string", align: "right" },
        { title: "RelationshipId", width: 200, dataType: "string" },
        { title: "ContactPersonId", width: 150, dataType: "string", align: "right" },
        { title: "ResponsibilityId", width: 150, dataType: "string", align: "right" },
        { title: "ResponsibilityType", width: 150, dataType: "string", align: "right" },
        { title: "OrigSystemReferenceId", width: 150, dataType: "string", align: "right" },
        { title: "OrigSystem", width: 150, dataType: "string", align: "right" },
        { title: "OrigSystemReference", width: 200, dataType: "string" },
        { title: "OwnerTableName", width: 150, dataType: "string", align: "right" },
        { title: "RelatedCustomerAccountId", width: 150, dataType: "string", align: "right" },
        { title: "CustomerAccountRelateId", width: 150, dataType: "string", align: "right" },
        { title: "SetId", width: 150, dataType: "string", align: "right" },
        { title: "SetCode", width: 150, dataType: "string", align: "right" },
        { title: "CustomerAccountSiteId", width: 200, dataType: "string" },
        { title: "PartySiteId", width: 150, dataType: "string", align: "right" },
        { title: "OrigSystemReference", width: 150, dataType: "string", align: "right" },
        { title: "SiteUseId", width: 150, dataType: "string", align: "right" },
        { title: "BillToSiteUseId", width: 150, dataType: "string", align: "right"},
        { title: "Upload Status", width: 150, dataType: "string", align: "right", dataIndx: 'status',},];
        obj.dataModel = { data: data };
        var grid = $("#grid_array").pqGrid(obj);

    });
        
    $(document).on('click', '#savebtn', function(){
        // $('#pq-grid-table tr').each(function(index, tr) {
        //     console.log(tr);
        var list = []; 
        var indexList = []; 
        $(".pq-grid-table tbody").each(function(i) {
            if ( i === 0 ) {
                       
                $(this).find('tr.pq-grid-row').each (function(j) {
                    var rowData = $("#grid_array").pqGrid( "getRowData", {rowIndxPage: j} );
                    indexList.push(j);
                    list.push(rowData);
                    console.log( list.length);
                    if(list.length == 10){
                        console.log(list);                                
                        // ajax post
                        // saveToDatabase(list,indexList) ;
                        while (list.length > 0) {
                            list.pop();
                            indexList.pop();
                        }
                    }
                });        
            }
            // // Within tr we find the last td child element and get content
            // v = $(this).find("td:last-child").html();
            // return v;
        });
        while (list.length > 0) {
            // ajax post
            console.log(list);
            // saveToDatabase(list,indexList) ;

        }

    });

    function saveToDatabase(argument,indexList) {
        // body...
        // console.log(indexList);
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr("content")},
            url: 'addCustomer',
            data: {'data': argument},
            dataType: "html",
            beforeSend : function () {
                indexList.forEach(function(entry) {
                    console.log(entry);
                    $("#grid_array").pqGrid( "addClass", {rowIndx: entry, dataIndx: 'status', cls: ' pq-delete '} );

                });
                // alert('sending data');
            },
            success: function (response) {
                console.log(response);
            }
        });
    }


</script>    
@endsection
