<?php use App\Http\Controllers\HelpersController as Helpers; 

$haveaccessadd = Helpers::checkaccess('users', 'add');
$haveaccessdelete = Helpers::checkaccess('users', 'delete');

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight hetf2"><i class="fa fa-users"></i>
            {{ __('Users') }} <?php if($haveaccessadd): ?> <a href="{{URL::to('/users/create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add User</a> <?php endif; ?>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   <?php foreach($datas as $data) {
                        // var_dump($data);
                   }?>

                   <div class="table-responsive">
                        <table id="userstable" class="table text-start table-striped align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="name" name="name"></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="username" name="username"></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="email" name="email"></td>
                                    <td>
                                        <select name="division" id="division" class="form-control input-sm src_class_user" onchange="searcAjax(this, 1)">
                                          <option value="">-- Division --</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="role" id="role" class="form-control input-sm src_class_user" onchange="searcAjax(this, 1)">
                                          <option value="">-- Role --</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control input-sm src_class_user" placeholder="mobile" autocomplete="off" onkeyup="searcAjax(this)" name="mobile"></td>
                                    <td>
                                        <select name="active" class="form-control input-sm src_class_user" onchange="searcAjax(this, 1)">
                                          <option value="">-- Status Active --</option>
                                          <option value="1">Active</option>
                                          <option value="0">Not Active</option>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th><input type="checkbox" class="checkall" name="checkall"></th>
                                    <th class="align-center">Name</th>
                                    <th class="align-center">Username</th>
                                    <th class="align-center">Email</th>
                                    <th class="align-center">Division</th>
                                    <th class="align-center">Role</th>
                                    <th class="align-center">Mobile</th>
                                    <th class="align-center">Active</th>
                                    <th class="align-center">Action</th>
                                </tr>
                                
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th class="align-center">Name</th>
                                    <th class="align-center">Username</th>
                                    <th class="align-center">Email</th>
                                    <th class="align-center">Division</th>
                                    <th class="align-center">Role</th>
                                    <th class="align-center">Mobile</th>
                                    <th class="align-center">Active</th>
                                    <th class="align-center">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- view modal -->
<div class="modal fade" id="viewUser" tabindex="-1" role="dialog" aria-labelledby="viewUserTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h6>
        <span id="titleNameUser" class="btn-sm btn btn-success"><i class="fa fa-user me-2"></i> Andi</span>
        <span id="titleDivisionUser" class="btn-sm btn btn-warning"><i class="fa fa-user-md me-2"></i> Marketing</span>
      </h6>
    </div>

    <div class="modal-body">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Main Info</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Product Access</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Branch Access</button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              
<dl class="row mb-0">
    <dt class="col-sm-4">Name</dt>
    <dd class="col-sm-8">: Alex</dd>

    <dt class="col-sm-4">Username</dt>
    <dd class="col-sm-8">: alexherca</dd>

    <dt class="col-sm-4">Password</dt>
    <dd class="col-sm-8">: xxx</dd>

    <dt class="col-sm-4">Email</dt>
    <dd class="col-sm-8">: alex@hercaweb.com</dd>

    <dt class="col-sm-4">Name</dt>
    <dd class="col-sm-8">: Alex</dd>

    <dt class="col-sm-4">Username</dt>
    <dd class="col-sm-8">: alexherca</dd>

    <dt class="col-sm-4">Password</dt>
    <dd class="col-sm-8">: xxx</dd>

    <dt class="col-sm-4">Email</dt>
    <dd class="col-sm-8">: alex@hercaweb.com</dd>
</dl>

          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
not available
          </div>
          <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
not available         
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button id="closeModalViewUser" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      @if ($haveaccessadd) :
        <a href="{{URL::to('/users/edit/')}}" data-attrref="{{URL::to('/users/edit/')}}" id="addvbtn" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit User</a>
      @endif

      @if ($haveaccessdelete) :
        <button onClick="deleteyesshow()" data-attid="" data-deleteval="1" id="deletevbtn" class="btn btn-danger btn-sm"></a>
      @endif
    </div>
    </div>
  </div>
</div>

@section('script')
<script type="text/javascript">
    var url = "{{ asset('/api/users/getdata') }}";
    function searcAjax(a, skip = 0){
        if($(a).val().length > global_length_src || skip == 1) {
            var getparam = getAllClassAndVal("src_class_user"); // helpers
            $('#userstable').DataTable().ajax.url(url+"?"+getparam).load();
        }
    }

    $(document).ready(function(){
        var getndate = getNowdate(); // helpers
        $("#daterangepicker").val(getndate + ' - ' + getndate );
        $(".datepicker").val(getndate);
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            timePicker: false,
            locale: {
              format: "DD/MM/YYYY"
            }
        });

        $("#daterangepicker").daterangepicker({
            timePicker: false,
            locale: {
              format: "DD/MM/YYYY"
            }
        });


        var table = $('#userstable').DataTable({
            ajax: url,
            columnDefs: [
                 {
                   'targets': 8,
                   'searchable':false,
                   'orderable':false,
                   'className': 'dt-body-center',
                   'render': function (data, type, full, meta){
                       return '<span class="btn btn-info btn-sm" onclick="showdetail('+full[8]+')">details</span>';
                   }
                }, {
                   'targets': 0,
                   'searchable':false,
                   'orderable':false,
                   'className': 'dt-body-center',
                   'render': function (data, type, full, meta){
                       return '<input type="checkbox" class="ckc" name="checkid['+full[8]+']" value="' + $('<div/>').text(data).html() + '">';
                   }
                }, {
                   'targets': 7,
                   'className': 'dt-body-center',
                   'render': function (data, type, full, meta){
                        if(full[7] == 0)
                            return '<span class="btn btn-danger btn-sm">not active</span>';
                        else 
                            return '<span class="btn btn-success btn-sm">active</span>';
                   }
                }
            ],
            searching: false,
        }); 


        $("#closeModalViewUser").click(function(){
          $("#viewUser").modal('hide');
        });


        appendDivisionOption();
        appendRoleOption();
        

    });

    function showdetail(idx){
      var addurl = $('#addvbtn').attr('data-attrref')+'/'+idx;
      $('#addvbtn').attr('href', addurl);
      $('#deletevbtn').attr('data-attid', idx);
      $('#deletevbtn').html('<i class="fa fa-trash"></i> Delete User');

      $('#viewUser').modal('show');
    }


    function appendDivisionOption(){
        // add division
        var url = "{{ asset('/api/getdivision') }}";
        $.ajax({
            url: url,
            type: "get",
            success: function (response) {
              $.each(response.data, function (i, item) {
                  $('#division').append($('<option>', { 
                      value: item.id_division,
                      text : item.division_name 
                  }));
              });
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
    }

    function appendRoleOption(){
        // add division
        var url = "{{ asset('/api/getrole') }}";
        $.ajax({
            url: url,
            type: "get",
            success: function (response) {
              $.each(response.data, function (i, item) {
                  $('#role').append($('<option>', { 
                      value: item.id_role,
                      text : item.role_name 
                  }));
              });
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
    }

    function deleteyesshow(){
      idx = $('#deletevbtn').attr('data-attid');
      test = '@csrf';
      token = $(test).val();
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
            if (result.isConfirmed) {
                var url = "{{ asset('/users/delete') }}/" + idx;
                $.ajax({
                    url: url,
                    type: "post",
                    data: {
                        id : idx,
                        _token: token
                    },
                    success: function (response) {
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

            }
      })
    }

    
</script>

@endsection    
</x-app-layout>


