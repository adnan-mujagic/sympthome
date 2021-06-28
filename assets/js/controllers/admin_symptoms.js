
class AdminSymptoms{
  static init(){
    $("#add-symptom-form").validate({
      submitHandler: function(form, event) {
        event.preventDefault();
        var data = Utils.jsonize($(form));
        if(!data.id){
          AdminSymptoms.addSymptom(data);
        }
        else{
          AdminSymptoms.updateSymptom(data);
        }
      }
     });
    AdminSymptoms.getSymptoms();

  }


  static addSymptom(form){
    RestClient.post("api/admin/symptoms", form, function(data){
      toastr.success("Symptom has been added!");
      AdminSymptoms.getSymptoms();
      $("#add-symptom-form").trigger("reset");
      $('#add-symptom-form-modal').modal("hide");
    });
  }

  static updateSymptom(form){
    RestClient.put("api/admin/symptoms/"+form.id,form, function(data){
      toastr.success("Disease has been updated!");
      AdminSymptoms.getSymptoms();
      $("#add-symptom-form").trigger("reset");
      $("#add-symptom-form *[name='id']").val("");
      $('#add-symptom-form-modal').modal("hide");
    })
  }

  static getSymptoms(){
      $("#admin-symptom-container").DataTable({
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
        url: "api/symptoms",
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
                return '<span class="badge">'+data+'</span><a class="pull-right admin-stuff" style="font-size: 15px; cursor: pointer;" onclick="AdminSymptoms.openEditSymptomModal('+data+')"><i class="fa fa-edit"></i></a>';
              }
            },
            { "data": "name" }
        ],

    });
  }

  static openEditSymptomModal(id){
    RestClient.get("api/admin/symptoms/"+id, function(data){
      $("#add-symptom-form *[name='id']").val(data.id);
      $("#add-symptom-form *[name='name']").val(data.name);
      $("#add-symptom-form-modal").modal("show");
      console.log(data);
    })
  }
}
