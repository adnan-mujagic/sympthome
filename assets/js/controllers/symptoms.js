class Symptoms{
  static init(){
    Symptoms.getAllSymptoms();
    Symptoms.getUserSymptoms();
    Symptoms.getUserDiseases();
  }


  static getAllSymptoms(){

    $("#all-symptoms-container").DataTable({
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
              return '<span class="badge">'+data+'</span><a class="pull-right" style="font-size: 20px; cursor: pointer;" onclick="Symptoms.addSymptom('+data+')"><i class="fas fa-plus-circle"></i></a>';
            }
          },
          { "data": "name"}
      ],

  });

  }

  static addSymptom(id){
    let info = {
      "symptom_id":id,
    }

    RestClient.post("api/users/symptoms",info, function(data) {
      toastr.success("Symptom has been added!");
      getUserSymptoms();
      getUserDiseases();
    });
  }

  static deleteSymptom(id){
    let info = {
      "symptom_id":id
    }

    RestClient.put("api/users/symptoms", info,function(data) {
      toastr.success("Symptom has been deleted!");
      getUserSymptoms();
      getUserDiseases();
    });
  }

  static getUserSymptoms(){

    $("#user-symptoms-container").DataTable({
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
      url: "api/users/symptoms",
      type: "GET",
      beforeSend: function(xhr){xhr.setRequestHeader('Authentication', localStorage.getItem("token"));},
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
              return '<span class="badge">'+data+'</span><a class="pull-right" style="font-size: 20px; cursor: pointer;" onclick="Symptoms.deleteSymptom('+data+')"><i class="far fa-trash-alt"></i></a>';
            }
          },
          { "data": "name"}
      ],

  });

  }

  static getUserDiseases(){

    $("#user-diseases-container").DataTable({
    processing: true,
    serverSide: true,
    bDestroy: true,
    pagingType: "simple",
    preDrawCallback: function( settings ) {
      if ( settings.jqXHR){
       settings._iRecordsTotal = settings.jqXHR.getResponseHeader('total-records');
       settings._iRecordsDisplay = settings.jqXHR.getResponseHeader('total-records');
      }
    },
    ajax: {
      url: "api/users/diseases",
      type: "GET",
      beforeSend: function(xhr){xhr.setRequestHeader('Authentication', localStorage.getItem("token"));},
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

          { "data": "name"},
          { "data": "description"},
          { "data": "treatment_description"},

      ],

  });

  }



}
