'use strict';


$("#create_contact").validate({
  errorClass: "text-danger border-danger",
  submitHandler: function(form) {
    let data = new FormData(form);
    create_contact(serializeData(data));
  }
 });

 $("#update_contact").validate({
  errorClass: "text-danger border-danger",
  submitHandler: function(form) {
    let data = new FormData(form);
    update_contact(serializeData(data))
  }
 });


$('.modal').on('hidden.bs.modal', function () {
  $('.was-validated').removeClass('was-validated');
  $('.reset-form').click();
});

function load_dataTable() {

    var table = $("#addressbook").DataTable({
      processing: true,
      lengthMenu: [
        [5, 10, 20, 50, 100, 200, 500, -1],
        [5, 10, 20, 50, 100, 200, 500, "All"],
      ],
      pageLength: 5,
      ajax: {
        type: "get",
        url: "app/API/get_contacts.php",
        dataSrc: "",
      },
      columns: [
        {
          title: "ID",
          data: "id"
        },
        {
          title: "Name",
          data: "name"
        },
        {
          title: "Surname",
          data: "surname"
        },
        {
          title: "City",
          data: null, 
          "render": function(data, type, row ){
            return data.city
          }
        },
        {
            title: "Country",
            data: "country"
        },
        {
            title: "Phone Number",
            data: "phone_number"
        },
        {
            title: "Email",
            data: "email"
        },
        {
          title: "Edit",
          data: null, 
          "render": function(data, type, row ){
            let stringifyData = JSON.stringify(data);
            return '<button type="button" class="btn btn-primary" onclick=\'editModal('+stringifyData+')\'>Edit</button>'
          }
        },
        {
            title: "Delete",
            data: null, 
            "render": function(data, type, row ){
              return '<button type="button" class="btn btn-danger" onclick="deleteModal('+data.id+')" data-toggle="modal" data-target="#confirmDelete">Delete</button>'
            }
        }
        
      ]
    });
  
  
}

function create_contact(data){
    $.post('app/API/create_contact.php', data, function(response){
        let data = JSON.parse(response);
        alertify[data.status](data.message);
        $("#addressbook").DataTable().ajax.reload();
        $('.close').click();
    });
}

function update_contact(data){
  $.post('app/API/update_contact.php', data, function(response){
    let data = JSON.parse(response);
    alertify[data.status](data.message);
    $("#addressbook").DataTable().ajax.reload();
    $('.close').click();
  });
}

function delete_contact(id){
  $.post('app/API/delete_contact.php', {id: id}, function(response){
    let data = JSON.parse(response);
    alertify[data.status](data.message);
    $("#addressbook").DataTable().ajax.reload();
    $('#confirmDelete').modal('hide');
});
}

function serializeData (data) {
	let obj = {};
	for (let [key, value] of data) {
		if (obj[key] !== undefined) {
			if (!Array.isArray(obj[key])) {
				obj[key] = [obj[key]];
			}
			obj[key].push(value);
		} else {
			obj[key] = value;
		}
	}
	return obj;
}

function deleteModal(id){
    $('#confirmDeleteBtn').attr('onclick', 'delete_contact('+id+')');
}

function editModal(data){
  $('#contactId').val(data.id);
  $('#contactName').val(data.name);
  $('#contactSurname').val(data.surname);
  $('#contactCity').val(data.city);
  $('#contactCountry').val(data.country);
  $('#contactPhoneNumber').val(data.phone_number);
  $('#contactEmail').val(data.email);
  $('#editContact').modal('show');
}
