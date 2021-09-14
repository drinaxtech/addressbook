'use strict';

jQuery.validator.addMethod("username", function(value, element) {
  let username = value;
  const res = /^[a-z0-9_\.]+$/.exec(username);
  const valid = !!res;
  return valid;
}, "Please enter a valid username!" );

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

 $("#register").validate({
  errorClass: "text-danger border-danger",
  rules: {
    username: {
      required: true,
      username: true,
    },
    confirm_password: {
      equalTo: '#password'
    }
  },
  submitHandler: function(form) {
    let data = new FormData(form);
    register(serializeData(data));
  }
 });

 $("#login").validate({
  errorClass: "text-danger border-danger",
  submitHandler: function(form) {
    let data = new FormData(form);
    login(serializeData(data));
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

            let newData = {
              id: data.id,
              name: data.name.replace(/'/g, '&apos;'),
              surname: data.surname.replace(/'/g, '&apos;'),
              city: data.city.replace(/'/g, '&apos;'),
              country: data.country.replace(/'/g, '&apos;'),
              phone_number: data.phone_number.replace(/'/g, '&apos;'),
              email: data.email.replace(/'/g, '&apos;')
            };
            
            let stringifyData = JSON.stringify(newData);

            return '<button type="button" class="btn btn-primary" data-stringify=\''+stringifyData+'\' onclick="editModal(this)">Edit</button>';
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

function register(data){
  $.post('app/API/register.php', data, function(response){
      let data = JSON.parse(response);
      alertify[data.status](data.message);
      if(data.status == 'success'){
        setTimeout(() => {
          window.location.href = 'login.php';
        }, 2000);
        
        return ;
      }
      
  });
}

function login(data){
$.post('app/API/login.php', data, function(response){
  let data = JSON.parse(response);
  
  if(data.status == 'success'){
    window.location.href = 'index.php';
    return ;
  }
  alertify[data.status](data.message);
  
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

function editModal(el){

  let data = JSON.parse($(el).attr('data-stringify'));

  $('#contactId').val(data.id);
  $('#contactName').val(data.name);
  $('#contactSurname').val(data.surname);
  $('#contactCity').val(data.city);
  $('#contactCountry').val(data.country);
  $('#contactPhoneNumber').val(data.phone_number);
  $('#contactEmail').val(data.email);
  $('#editContact').modal('show');
}
