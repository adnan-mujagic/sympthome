class Users{
  static init(){
    $("#add-user-form").validate({
      submitHandler: function(form, event) {
        event.preventDefault();
        var data = Utils.jsonize($(form));
        console.log(data);

        if(!data.id){
          delete(data.id);
          Users.addUser(data);
        }
        else{
          //We need to check if password field is empty and if it is we mustn't update it!
          if(data.password==""){
            delete(data.password);
          }
          Users.updateUser(data);
        }

      }
     });
    Users.getUsers();
  }

  static addUser(form){
    RestClient.post("api/register", form, function(data){
      toastr.success("User has been added!");
      Users.getUsers();
      $("#add-user-form").trigger("reset");
      $('#add-user-form-modal').modal("hide");
      console.log(data);
    });
  }

  static updateUser(form){
    RestClient.put("api/admin/users/"+form.id,form, function(data){
      toastr.success("User has been updated!");
      Users.getUsers();
      $("#add-user-form").trigger("reset");
      $("#add-user-form *[name='id']").val("");
      $('#add-user-form-modal').modal("hide");
    })
  }

  static getUsers(){
      $("#users-container").DataTable({
      processing: true,
      serverSide: true,
      bDestroy: true,
      //pagingType: "simple",
      preDrawCallback: function( settings ) {
        if ( settings.jqXHR){
         settings._iRecordsTotal = settings.jqXHR.getResponseHeader('total-records');
         settings._iRecordsDisplay = settings.jqXHR.getResponseHeader('total-records');
        }
      },
      ajax: {
        url: "api/admin/users",
        type: "GET",
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authentication', localStorage.getItem("token"));
        },
        dataSrc: function(resp){
          console.log(resp);
          return resp;
        },
        data: function ( d ) {
          d.offset=d.start;
          d.limit=d.length;
          d.search = d.search.value;
          d.order = encodeURIComponent((d.order[0].dir == 'asc' ? "-" : "+")+d.columns[d.order[0].column].data);

          delete d.start;
          delete d.length;
          delete d.columns;
          delete d.draw;
          console.log(d);
        }
      },
      columns: [
            { "data": "id",
              "render": function ( data, type, row, meta ) {
                return '<span class="badge">'+data+'</span><a class="pull-right admin-stuff" style="font-size: 15px; cursor: pointer;" onclick="Users.openEditUserModal('+data+')"><i class="fa fa-edit"></i></a>';
              }
            },
            { "data": "first_name" },
            { "data": "last_name" },
            { "data": "age" },
            { "data": "email" },
            { "data": "type" },
        ],

    });
  }

  static openEditUserModal(id){
    RestClient.get("api/admin/users/"+id, function(data){
      $("#add-user-form *[name='id']").val(data.id);
      $("#add-user-form *[name='first_name']").val(data.first_name);
      $("#add-user-form *[name='last_name']").val(data.last_name);
      $("#add-user-form *[name='age']").val(data.age);
      $("#add-user-form *[name='email']").val(data.email);
      $("#add-user-form-modal").modal("show");
      console.log(data);
    })
  }
}
