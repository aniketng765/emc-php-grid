@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Customers</div>

                <div class="card-body">
                    <div id="grid_array" ></div>

                </div>
            </div>
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

        var obj = {showTitle: true,                 title: "Customers List",resizable:false,draggable:false };
        obj.colModel = [
        { title: "Customer Name", width: 200, dataType: "string" },
        { title: "StoreNumber", width: 150, dataType: "string", align: "right" },
        { title: "Chain", width: 150, dataType: "string", align: "right" },
        { title: "AddressLine", width: 150, dataType: "string", align: "right" },
        { title: "City", width: 150, dataType: "string", align: "right" },
        { title: "ZipCode", width: 150, dataType: "string", align: "right" },
        { title: "Customer Name", width: 200, dataType: "string" },
        { title: "StoreNumber", width: 150, dataType: "string", align: "right" },
        { title: "Chain", width: 150, dataType: "string", align: "right" },
        { title: "AddressLine", width: 150, dataType: "string", align: "right" },
        { title: "City", width: 150, dataType: "string", align: "right" },
        { title: "ZipCode", width: 150, dataType: "string", align: "right" },
        { title: "Customer Name", width: 200, dataType: "string" },
        { title: "StoreNumber", width: 150, dataType: "string", align: "right" },
        { title: "Chain", width: 150, dataType: "string", align: "right" },
        { title: "AddressLine", width: 150, dataType: "string", align: "right" },
        { title: "City", width: 150, dataType: "string", align: "right" },
        { title: "ZipCode", width: 150, dataType: "string", align: "right" },
        { title: "Customer Name", width: 200, dataType: "string" },
        { title: "StoreNumber", width: 150, dataType: "string", align: "right" },
        { title: "Chain", width: 150, dataType: "string", align: "right" },
        { title: "AddressLine", width: 150, dataType: "string", align: "right" },
        { title: "City", width: 150, dataType: "string", align: "right" },
        { title: "ZipCode", width: 150, dataType: "string", align: "right" },
        { title: "Customer Name", width: 200, dataType: "string" },
        { title: "StoreNumber", width: 150, dataType: "string", align: "right" },
        { title: "Chain", width: 150, dataType: "string", align: "right" },
        { title: "AddressLine", width: 150, dataType: "string", align: "right" },
        { title: "City", width: 150, dataType: "string", align: "right" },
        { title: "ZipCode", width: 150, dataType: "string", align: "right" },
        { title: "Customer Name", width: 200, dataType: "string" },
        { title: "StoreNumber", width: 150, dataType: "string", align: "right" },
        { title: "Chain", width: 150, dataType: "string", align: "right" },
        { title: "AddressLine", width: 150, dataType: "string", align: "right" },
        { title: "City", width: 150, dataType: "string", align: "right" },
        { title: "ZipCode", width: 150, dataType: "string", align: "right" },
        { title: "Customer Name", width: 200, dataType: "string" },
        { title: "StoreNumber", width: 150, dataType: "string", align: "right" },
        { title: "Chain", width: 150, dataType: "string", align: "right" },
        { title: "AddressLine", width: 150, dataType: "string", align: "right" },
        { title: "City", width: 150, dataType: "string", align: "right" },
        { title: "ZipCode", width: 150, dataType: "string", align: "right" },
        { title: "Customer Name", width: 200, dataType: "string" },
        { title: "StoreNumber", width: 150, dataType: "string", align: "right" },
        { title: "Chain", width: 150, dataType: "string", align: "right" },
        { title: "AddressLine", width: 150, dataType: "string", align: "right" },
        { title: "City", width: 150, dataType: "string", align: "right" },
        { title: "ZipCode", width: 150, dataType: "string", align: "right" },
        { title: "State", width: 150, dataType: "string", align: "right"}];
        obj.dataModel = { data: data };
        $("#grid_array").pqGrid(obj);

    });
        
</script>    
@endsection
