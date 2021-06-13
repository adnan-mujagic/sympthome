class Medicines{
  static init(){
    $("#add-medicine-form").validate({
      submitHandler: function(form, event) {
        event.preventDefault();
        var data = Utils.jsonize($(form));

        if(!data.id){
          Medicines.addMedicine(data);
        }
        else{
          Medicines.updateMedicine(data);
        }
      }
     });
     Medicines.getMedicines();
     Medicines.removeAdminStuff();
  }


     static removeAdminStuff(){
       var user_info = Utils.parse_jwt(localStorage.getItem("token"));
       if(user_info.role!="ADMIN"){
         $(".admin-stuff").remove();
       }
     }

     static updateMedicine(form){
       RestClient.put("api/admin/medicines/"+form.id, form , function(data){
         toastr.success("Medicine successfully updataed!");
         Medicines.getMedicines();
         $("#add-medicine-form").trigger("reset");
         $("#add-medicine-form *[name='id']").val("");
         $('#add-medicine-form-modal').modal("hide");
       });
     }

     static addMedicine(form){
       RestClient.post("api/admin/medicines", form, function(data){
         toastr.success("Medicine has been added!");
         Medicines.getMedicines();
         $("#add-medicine-form").trigger("reset");
         $('#add-medicine-form-modal').modal("hide");
         console.log(data);
       });
     }

     static openEditMedicineModal(id){
       RestClient.get("api/medicines/"+id, function(data){
         $("#add-medicine-form *[name='id']").val(data.id);
         $("#add-medicine-form *[name='name']").val(data.name);
         $("#add-medicine-form *[name='instruction']").val(data.instruction);
         $("#add-medicine-form *[name='warning']").val(data.warning);
         $("#add-medicine-form *[name='side_effects']").val(data.side_effects);
         $("#add-medicine-form *[name='requires_prescription']").val(data.requires_prescription);
         $("#add-medicine-form-modal").modal("show");
         console.log(data);
       });
     }


     static getMedicines(){
        $("#medicine-container").DataTable({
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
          url: "api/medicines",
          type: "GET",
          beforeSend: function(xhr){
            xhr.setRequestHeader('Authentication', localStorage.getItem("token"));
          },
          dataSrc: function(resp){
            //console.log(resp);
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
            //console.log(d);
          }
        },
        columns: [
              { "data": "id",
                "render": function ( data, type, row, meta ) {
                  return '<span class="badge">'+data+'</span><a class="pull-right" style="font-size: 15px; cursor: pointer;" onclick="Medicines.openEditMedicineModal('+data+')"><i class="fa fa-edit"></i></a>';
                }
              },
              { "data": "name" },
              { "data": "instruction" },
              { "data": "warning" },
              { "data": "side_effects" },
              { "data": "date_added" }
          ],
      });
      }

}
