
        // $(document).ready(function(){
          //     $('#submit').click(function(e){
          //        e.preventDefault();
          //        $.ajaxSetup({
          //           headers: {
          //               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          //           }
          //       });
          //       var url = "{{ asset('/division/store') }}"
          //        $.ajax({
          //           url: url,
          //           method: 'post',
          //           data: {
          //              name: $('#division_name').val(),
          //              type: $('#active').val(),
          //             //  price: $('#country').val()
          //           },
          //           success: function(data){
          //           		$.each(data.errors, function(key, value){
          //           			$('.alert-danger').show();
          //           			$('.alert-danger').append('<p>'+value+'</p>');
          //           		});
          //         	}
                      
          //           });
          //        });
          //     });
  

          



    //         dx = $('#saveform')
    //         test = '@csrf';
    //   token = $(test).val();
    //   Swal.fire({
    //       title: 'Data Berhasil Disimpan!',
    //     icon: 'success',
    //     // showCancelButton: true,
    //     confirmButtonColor: 'green',
    //     // cancelButtonColor: '#3085d6',
    //     confirmButtonText: 'Yes!'
    //   }).then((result) => {
    //       if (result.isConfirmed) {
    //           var url = "{{ asset('/division/store') }}/" + idx;
    //           $.ajax({
    //               url: url,
    //               type: "post",
    //               data: {
    //                     id : idx,
    //                     _token: token,
    //                     undeleted : 1
    //                 },
    //                 success: function (response) {
    //                     Swal.fire({
    //                         icon: 'success',
    //                         title: 'Undeleted',
    //                         html:'Your file has been <b>Undeleted</b>. Please Reload to update data <br><button onclick="reloadpg()" class="btn btn-warning btn-sm">Reload Data</button>'
    //                     });
    //                 },
    //                 error: function(jqXHR, textStatus, errorThrown) {
    //                     console.log(textStatus, errorThrown);
    //                 }
    //             });

    //         }
    //     })



     $('#contactForm').on('submit',function(e){
        e.preventDefault();

        let name = $('#name').val();
        let email = $('#email').val();
        let mobile_number = $('#mobile_number').val();
        let subject = $('#subject').val();
        let message = $('#message').val();

        $.ajax({
          url: "/contact-form",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            name:name,
            email:email,
            mobile_number:mobile_number,
            subject:subject,
            message:message,
          },
          success:function(response){
            console.log(response);
            if (response) {
              $('#success-message').text(response.success); 
              $("#contactForm")[0].reset(); 
            }
          },
          error: function(response) {
            $('#name-error').text(response.responseJSON.errors.name);
            $('#email-error').text(response.responseJSON.errors.email);
            $('#mobile-number-error').text(response.responseJSON.errors.mobile_number);
            $('#subject-error').text(response.responseJSON.errors.subject);
            $('#message-error').text(response.responseJSON.errors.message);
           }
         });
        });


        {{-- Skript gak kepake --}}
        // $("#daterangepicker").val(getndate + ' - ' + getndate );
        // $(".datepicker").val(getndate);
        // $('.datepicker').daterangepicker({
        //     singleDatePicker: true,
        //     timePicker: false,
        //     locale: {
        //     format: "DD/MM/YYYY"
        //             }});

        // $("#daterangepicker").daterangepicker({
        //     timePicker: false,
        //     locale: {
        //     format: "DD/MM/YYYY"
        // }});




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
  
  function reloaddata(){
  $('#divisionTable').DataTable().ajax.url(url).load();
  }
  

  <div class="modal-body ">
    {{-- <div class="mb-3">
        <label for="division_name" class="form-label">Jabatan</label>
        <input type="text" class="form-control" id="division_name" name="division_name" placeholder="Jabatan">

      </div> --}}
    <input type="text" name="division_name" required id="division_name" placeholder="Jabatan">
    {{-- <input type="radio" class="active" name="message_pri" value="1" /> Active 
    <input type="radio" class="active" name="message_pri" value="0" /> Not Active  --}}
    <input type="text" name="active" required>
</div>









{{-- sisisiis --}}
<?php use App\Http\Controllers\HelpersController as Helpers; 

    $haveaccessadd = Helpers::checkaccess('divisions', 'add');
    $haveaccessadd = Helpers::checkaccess('divisions', 'delete');
    $haveaccessdelete = Helpers::checkaccess('users', 'delete');

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<title>{{ $title }}</title>

<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight hetf2"><i class="bi bi-clipboard-fill"></i>
{{ __('Divisions') }} <?php if($haveaccessadd): ?> <button class="btn btn-success btn-sm" id="btnmodaladd" onclick="BtnAddModal()">Add Divisions</button> <?php endif; ?>
</h2>
</x-slot>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="table-responsive">
                    <table id="divisionTable" class="table text-start table-striped align-middle table-bordered table-hover mb-0">
        <thead>
            <tr>
                <td></td>
                <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="Jabatan" name="division_name"></td>
                <td>
                    <select name="active" class="form-control input-sm src_class_user" onchange="searcAjax(this, 1)">
                      <option value="">-- Status Active --</option>
                      <option value="1">Active</option>
                      <option value="0">Not Active</option>
                    </select>
                </td>
                {{-- <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="email" name="email"></td> --}}
                <td>
                </tr>
                <th><input type="checkbox" class="checkall" name="checkall"></th>
                <th class="align-center">Jabatan</th>
                <th class="align-center">Active</th>
                <th class="align-center">Action</th>
            </tr>
        </thead>
    <tfoot>
            <tr>
                <th></th>
                <th class="align-center">Jabatan</th>
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

<!-- Add modal -->
<form id="addpostmodal">
    @csrf
    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="viewUserTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-start ">
                <i class="bi bi-clipboard-fill modal-title"></i><h5 id="titleaddmodal" class="ms-2 modal-title"></h5>
                    <div class="alert alert-danger" style="display:none"></div>
           
                </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="col-md-6">
                                <label for="division_name" class="form-label">Jabatan</label>
                                <input type="text" class="form-control @error('division_name') is-invalid @enderror" placeholder="Jabatan" name="division_name" id="division_name" aria-describedby="validationServer03Feedback">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                  Please provide a valid city.
                                </div>
                            
                        </div> 
                        </div>
                        <div class="mb-3">
                        <div class="col-md-6">
                        <label for="active" class="form-label">Status Active</label>
                        <br>
                   <input type="radio" value="1" name="active" id="active"> Active
                   <input type="radio" value="0" name="active"> Not-Active
                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" data-attid="" data-deleteval="1" id="saveee" class="btn btn-success">Save</a>
                        </div>
            </div>
        </div>
    </div>
</form>


<!-- Edit view modal -->
<div class="modal" id="detaildivi" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@section('script')
<script type="text/javascript">

// GetData Table
var url = "{{ asset('/api/divi/getdata') }}";

    function searcAjax(a, skip = 0){
        if($(a).val().length > global_length_src || skip == 1) {
             var getparam = getAllClassAndVal("src_class_user"); // helpers
            $('#divisionTable').DataTable().ajax.url(url+"?"+getparam).load();
        }
    }
$(document).ready(function(){
    var getndate = getNowdate(); // helpers
    var table = $('#divisionTable').DataTable({
        ajax: url,
        columnDefs: [
            {
                'targets': 3,
                'searchable':false,
                'orderable':false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    return '<span class="btn btn-info btn-sm" onclick="showdetail('+full[3]+')">details</span>';
                }
            },
            {
                'targets': 0,
                'searchable':false,
                'orderable':false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    return '<input type="checkbox"  class="ckc" name="checkid['+full[0]+']" value="' + $('<div/>').text(data).html() + '">';
                }
            }, 
            {
                'targets': 2,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    if(full[2] == 0)
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

function BtnAddModal(){
    $('#addmodal').modal('show')
    $("#titleaddmodal").html("Add Divisions")
}


        idx = $('#saveee').attr('data-attid');
        test = '@csrf';
        token = $(test).val();
    $(document).ready(function() {
    $('#addpostmodal').submit(function(e){
       
        var url = "{{ asset('/division/store') }}/" + idx;
        test = '@csrf';
        token = $(test).val();
        e.preventDefault();
        var form = $('#addpostmodal');
        var actionUrl = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data){

                    reloaddata();
                    Swal.fire({
                    title: 'Data Berhasil Disimpan!',
                    icon: 'success',
                    confirmButtonColor: 'green',
                    
                })
                $("#addmodal").modal('hide');
                $("#addpostmodal")[0].reset();
            },
            // error: function(jqXHR, textStatus, errorThrown) {
               
        // }

        });

    });
    
    function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }

});

function showdetail(idx){

    $('#detaildivi').modal('show')
    // $("#titleaddmodal").html("Add Divisions")
    // var addurl = $('#addvbtn').attr('data-attrref')+'/'+idx;
    //     $('#addvbtn').attr('href', addurl);
    //     $('#deletevbtn').attr('data-attid', idx);
    //     $('#deletevbtn').html('<i class="fa fa-trash"></i> Delete User');

        // $('#viewUser').modal('show');
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
        });}
    })
}

function reloaddata(){
$('#divisionTable').DataTable().ajax.url(url).load();
}


</script>

@endsection    
</x-app-layout>


