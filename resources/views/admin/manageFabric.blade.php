@extends('layout.admin')
@section('content')
<!-- Quick Stats -->
<div class="row text-center">
<div class="col-sm-6 col-lg-6">
    <a href="#" data-toggle="modal" data-target="#exampleModal2" class="widget widget-hover-effect2">
        <div class="widget-extra themed-background-success">
            <h4 class="widget-content-light"><strong>Add New</strong> Fabric</h4>
        </div>
        <div class="widget-extra-full"><span class="h2 text-success animation-expandOpen"><i class="fa fa-plus"></i></span></div>
    </a>
</div>
<div class="col-sm-6 col-lg-6">
    <a href="javascript:void(0)" class="widget widget-hover-effect2">
        <div class="widget-extra themed-background-dark">
            <h4 class="widget-content-light"><strong>Total</strong> Fabric</h4>
            
        </div>
    <div class="widget-extra-full"><span class="h2 themed-color-dark animation-expandOpen">{{count($silhouette)}}</span></div>
    </a>
</div>
</div>
<div class="block full">
<!-- All Products Title -->
<div class="block-title">
    <h2><strong>All</strong> Fabric</h2>
    @if(Session::has('success'))
    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
    @endif
    @if(Session::has('error'))
    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
    @endif
    @if ($errors->has('email')) <p style="color:red;">{{ $errors->first('email') }}</p> @endif
    @if ($errors->has('password')) <p style="color:red;">{{ $errors->first('password') }}</p> @endif
    @if ($errors->has('fabric')) <p style="color:red;">{{ $errors->first('fabric') }}</p> @endif
    @if ($errors->has('first')) <p style="color:red;">{{ $errors->first('first') }}</p> @endif
</div>
<table id="ecom-products" class="table table-bordered table-striped table-vcenter">
    <thead>
        <tr>
            <th class="text-center">Fabric Name</th>
            <th class="text-center">Fabric Image</th>
            <th class="text-center">Added</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($silhouette) > 0)
        @foreach($silhouette as $row)
        <tr>
            <td class="text-center">{{$row->name}}</td>
            <td class="text-center">
                <img alt="" class="category_image" style="width: 100px; height: 100px;" src="{{ asset('images/'.$row->image) }}">
            </td>
          
            <td class="text-center">{{$row->created_at}}</td>
            <td class="text-center">
                <div class="btn-group btn-group-xs">
                    <a href="{{route('editFabric',array('id' => $row->id))}}" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                    <a href="{{route('deleteFabric', array('id' => $row->id))}}" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <p>No Fabric stored</p>
        @endif
    </tbody>
</table>
<!-- END All Products Content -->
</div>
<!-- END All Products Block -->
</div>
<!-- END Page Content -->

<!-- Footer -->

<!-- END Footer -->
</div>
<!-- END Main Container -->
</div>
<!-- END Page Container -->
</div>
<!-- END Page Wrapper -->

<!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
<a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
<div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<!-- Modal Header -->
<div class="modal-header text-center">
<h2 class="modal-title"><i class="fa fa-pencil"></i> Settings</h2>
</div>
<!-- END Modal Header -->

<!-- Modal Body -->
<div class="modal-body">
<form action="{{route('adminEmail')}}" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
@csrf
<fieldset>
<legend>Email Update</legend>
<div class="form-group">
<label class="col-md-4 control-label">Username</label>
<div class="col-md-8">
<p class="form-control-static"> {{Auth::user()->email}}</p>
</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="user-settings-email">Email</label>
<div class="col-md-8">
<input type="email" id="user-settings-email" name="email" class="form-control" value="{{Auth::user()->email}}">
</div>
</div>
<div class="form-group" style="display: none">
<div class="col-md-8">
<input type="number" id="user-settings-repassword" name="id" class="form-control" value="{{Auth::user()->id}}">
</div>
</div>
<center>
<button type="submit" name="update" value="update" class="btn btn-sm btn-primary">Update Email</button>
</center>
</form>
{{-- <div class="form-group">
<label class="col-md-4 control-label" for="user-settings-notifications">Email Notifications</label>
<div class="col-md-8">
<label class="switch switch-primary">
<input type="checkbox" id="user-settings-notifications" name="user-settings-notifications" value="1" checked>
<span></span>
</label>
</div>
</div> --}}
</fieldset>
<form action="{{route('adminPassword')}}" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
@csrf
<fieldset>
<legend>Password Update</legend>
<div class="form-group">
<label class="col-md-4 control-label" for="user-settings-password">New Password</label>
<div class="col-md-8">
<input type="password" id="user-settings-password" name="password" class="form-control" placeholder="Please choose a complex one..">
@if ($errors->has('password')) <p style="color:red;">{{ $errors->first('password') }}</p> @endif
</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="user-settings-repassword">Confirm New Password</label>
<div class="col-md-8">
<input type="password" id="user-settings-repassword" name="repassword" class="form-control" placeholder="..and confirm it!">
</div>
</div>
<div class="form-group" style="display: none">
<div class="col-md-8">
<input type="number" id="user-settings-repassword" name="id" class="form-control" value="{{Auth::user()->id}}">
</div>
</div>
</fieldset>
<div class="form-group form-actions">
<div class="col-xs-12 text-right">
<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
<button type="submit" name="update" value="update" class="btn btn-sm btn-primary">Update Password</button>
</div>
</div>
</form>
</div>
<!-- END Modal Body -->
</div>
</div>
</div>

<!-- END User Settings -->

<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
<script src="js/vendor/jquery.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/app.js"></script>

<!-- Load and execute javascript code used only in this page -->
<script src="js/pages/ecomProducts.js"></script>
<script>$(function(){ EcomProducts.init(); });</script>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Fabric</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
    <form action="{{route('fabric')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
    <div class="form-group">
    <label class="col-md-4 control-label"> Enter New Fabric <span style="color: red"> * </span></label>
    <div class="col-md-8">
    <input type="text" placeholder="Enter Fabric" name="fabric" class="form-control" required>
    </div>
    </div>
    </div>
    <div class="row">
    <div class="form-group">
        <label class="col-md-4 control-label">Fabric Image <span style="color: red"> * </span></label>
        <div class="col-md-8">
        <input type="file" name="first" class="form-control-file btn btn-success" required>
        </div>
        </div>
    </div>
    <div class="modal-footer">
    <input type="button" class="btn btn-secondary" value="Close" data-dismiss="modal">
    <input type="submit" name="sendCategory" value="Submit" class="btn btn-primary"> 
    </form>
    </div>
    </div>
    </div>
 </div>


 <script>
    $('#top_type').change(function()
    {
        var type=$(this).val();
        if(type == 'retailer')
        {
        $('#top_search').attr('placeholder','Registration Number');
        }
    
        if(type == 'product')
        {
        $('#top_search').attr('placeholder','Product style#');
        }
    
        if(type == 'category')
        {
        $('#top_search').attr('placeholder','Category Name');
        }
    
    
    });
    $('.product').attr('class','active');
    </script>

@endsection