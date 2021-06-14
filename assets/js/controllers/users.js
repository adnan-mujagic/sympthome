class Users{
  static init(){
    $("#add-user-form").validate({
      submitHandler: function(form, event) {
        event.preventDefault();
        var data = Utils.jsonize($(form));

        if(!data.id){
          Users.addUser(data);
        }
        else{
          Diseases.updateUser(data);
        }

      }
     });
    Users.getUsers();
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
}
