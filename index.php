<?php require_once __DIR__ . '/app/core/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="assets/styles/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/styles/alertify.min.css">
    <link rel="stylesheet" href="assets/styles/alertify_default.min.css">

    <title>Address Book</title>
</head>

<body>

    <div class="d-flex justify-content-between mt-5 p-5 mb-4">
       <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addNewContact">
            Add Contact
        </button>
        <a href="logout.php" class="btn btn-secondary">
            Logout
        </a>
    </div>
    <div class="table-responsive pl-5 pr-5 mb-5">
        
        <table id="addressbook" class="table table-stripped mt-3"></table>
    </div>




    <!-- Add New Contact Modal -->
    <div class="modal fade" id="addNewContact" tabindex="-1" role="dialog" aria-labelledby="addNewContactLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="create_contact" class="needs-validation" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewContactLabel">Add new contact</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">



                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom01">Name</label>
                                <input type="text" name="name" class="form-control" id="validationCustom01"
                                    placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom02">Surname</label>
                                <input type="text" name="surname" class="form-control" id="validationCustom02"
                                    placeholder="Surname" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom03">City</label>
                                <input type="text" name="city" class="form-control" id="validationCustom03"
                                    placeholder="City" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04">Country</label>
                                <input type="text" name="country" class="form-control" id="validationCustom04"
                                    placeholder="Country" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom05">Phone Number</label>
                                <input type="tel" minlength="10" maxlength="20" name="phone_number" class="form-control" id="validationCustom05"
                                    placeholder="Phone Number" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom06">Email</label>
                                <input type="email" name="email" class="form-control" id="validationCustom06"
                                    placeholder="Email" required>
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="reset" class="reset-form d-none">Reset</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>

                </div>
            </form>
        </div>
    </div>


        <!-- Edit Contact Modal -->
        <div class="modal fade" id="editContact" tabindex="-1" role="dialog" aria-labelledby="editContactLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="update_contact" class="needs-validation" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editContactLabel">Edit contact</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <input type="hidden" name="id" id="contactId">

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="contactName">Name</label>
                                <input type="text" name="name" class="form-control" id="contactName"
                                    placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="contactSurname">Surname</label>
                                <input type="text" name="surname" class="form-control" id="contactSurname"
                                    placeholder="Surname" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="contactCity">City</label>
                                <input type="text" name="city" class="form-control" id="contactCity"
                                    placeholder="City" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="contactCountry">Country</label>
                                <input type="text" name="country" class="form-control" id="contactCountry"
                                    placeholder="Country" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="contactPhoneNumber">Phone Number</label>
                                <input type="tel" minlength="10" maxlength="20" name="phone_number" class="form-control" id="contactPhoneNumber"
                                    placeholder="Phone Number" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="contactEmail">Email</label>
                                <input type="email" name="email" class="form-control" id="contactEmail"
                                    placeholder="Email" required>
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="reset" class="reset-form d-none">Reset</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <!-- Are you sure Modal -->
    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="text-center">Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Yes</button>
                </div>

            </div>
        </div>
    </div>



    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/alertify.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
    (function() {
        load_dataTable();
    })();
    </script>
</body>

</html>