function jsonize(selector){
  var data = $(selector).serializeArray();
  var form_data={};
  for(var i = 0; i<data.length;i++){
    form_data[data[i].name] = data[i].value;
  }
  console.log(form_data);
  return form_data;
}
