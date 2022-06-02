
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