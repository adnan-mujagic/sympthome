
class Diseases{
  static init(){
    $("#add-disease-form").validate({
      submitHandler: function(form, event) {
        event.preventDefault();
        var data = Utils.jsonize($(form));

        if(!data.id){
          Diseases.addDisease(data);
        }
        else{
          Diseases.updateDisease(data);
        }

      }
     });
    Diseases.getDiseases();
    Diseases.removeAdminStuff();
  }
  static removeAdminStuff(){
    var user_info = Utils.parse_jwt(localStorage.getItem("token"));
    if(user_info.role!="ADMIN"){
      $(".admin-stuff").remove();
    }
  }

  static addDisease(form){
    RestClient.post("api/admin/diseases", form, function(data){
      toastr.success("Disease has been added!");
      Diseases.getDiseases();
      $("#add-disease-form").trigger("reset");
      $('#add-disease-form-modal').modal("hide");
      console.log(data);
    });
  }

  static updateDisease(form){
    RestClient.put("api/admin/diseases/"+form.id,form, function(data){
      toastr.success("Disease has been updated!");
      Diseases.getDiseases();
      $("#add-disease-form").trigger("reset");
      $("#add-disease-form *[name='id']").val("");
      $('#add-disease-form-modal').modal("hide");
    })
  }

  static getDiseases(){
      $("#disease-container").DataTable({
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
        url: "api/diseases",
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
                return '<span class="badge">'+data+'</span><a class="pull-right admin-stuff" style="font-size: 15px; cursor: pointer;" onclick="Diseases.openEditDiseaseModal('+data+')"><i class="fa fa-edit"></i></a>';
              }
            },
            { "data": "name" },
            { "data": "description" },
            { "data": "treatment_description" },
            { "data": "category_id" },
            { "data": "date_added" }
        ],

    });
    Diseases.removeAdminStuff();
  }

  static openEditDiseaseModal(id){
    /*$.ajax({
      url: "api/diseases/"+id,
      type: "GET",
      beforeSend: function(xhr){xhr.setRequestHeader('Authentication', localStorage.getItem("token"));},
      success: function(data) {
        $("#add-disease-form *[name='id']").val(data.id);
        $("#add-disease-form *[name='name']").val(data.name);
        $("#add-disease-form *[name='description']").val(data.description);
        $("#add-disease-form *[name='treatment_description']").val(data.treatment_description);
        $("#add-disease-form *[name='category_id']").val(data.category_id);
        $("#add-disease-form-modal").modal("show");
        console.log(data);
      }
    });*/

    RestClient.get("api/diseases/"+id, function(data){
      $("#add-disease-form *[name='id']").val(data.id);
      $("#add-disease-form *[name='name']").val(data.name);
      $("#add-disease-form *[name='description']").val(data.description);
      $("#add-disease-form *[name='treatment_description']").val(data.treatment_description);
      $("#add-disease-form *[name='category_id']").val(data.category_id);
      $("#add-disease-form-modal").modal("show");
      console.log(data);
    })
  }
}
