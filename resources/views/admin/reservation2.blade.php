<x-app-layout>

</x-app-layout>
<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.admincss')

</head>

<body>
    <div class="container-scroller">
        @include('admin.navbar')
        <div class="container">
            <div class="row">
                <div class="col-12 table-responsive">
                    <br />
                    <h3 align="center">Reservation Datatable</h3>
                    <br />
                    <div align="right">
                        <button type="button" name="create_record" id="create_record" class="btn btn-success"> <i
                                class="bi bi-plus-square"></i> Add</button>
                    </div>
                    <br />
                    <table class="table table-striped table-bordered reservation_datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>name</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>guest</th>
                                <th>time</th>
                                <th>date</th>
                                <th>message</th>
                                <th width="180px">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" id="sample_form" class="form-horizontal">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Add New Record</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <span id="form_result"></span>
                                <div class="form-group">
                                    <label>Name : </label>
                                    <input type="text" name="name" id="name" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Email : </label>
                                    <input type="email" name="email" id="email" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Phone : </label>
                                    <input type="number" name="phone" id="phone" maxlength="10" class="form-control" />
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label>No Of Guest : </label>
                                <div class="col-md-6 col-sm-12">
                                    <fieldset>
                                        <select value="guest" name="guest" id="number-guests" required>
                                            {{--  <option value="" selected disabled>Number Of Guests</option>  --}}
                                            <option name="1" id="1">1</option>
                                            <option name="2" id="2">2</option>
                                            <option name="3" id="3">3</option>
                                            <option name="4" id="4">4</option>
                                            <option name="5" id="5">5</option>
                                            <option name="6" id="6">6</option>
                                            <option name="7" id="7">7</option>
                                            <option name="8" id="8">8</option>
                                            <option name="9" id="9">9</option>
                                            <option name="10" id="10">10</option>
                                            <option name="11" id="11">11</option>
                                            <option name="12" id="12">12</option>
                                        </select>
                                    </fieldset>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label>Date (yyyy-mm-dd): </label>
                                    <input name="date" id="date" type="text" class="form-control"
                                placeholder="yyyy-mm-dd" required>
                                </div>
                                <div class="form-group">
                                    <label>Time : </label>
                                    <input name="time" id="time" type="time" class="form-control"
                                 required>
                                <div class="form-group">
                                    <label>Message : </label>
                                    <div class="col-lg-6">
                                        <fieldset>
                                            <textarea name="message" rows="6" id="message" placeholder="Message" required=""></textarea>
                                        </fieldset>
                                    </div>
                                </div>
                                <input type="hidden" name="action" id="action" value="Add" />
                                <input type="hidden" name="hidden_id" id="hidden_id" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="action_button" id="action_button" value="Add"
                                    class="btn btn-info" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" id="sample_form" class="form-horizontal">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" name="ok_button" id="ok_button"
                                    class="btn btn-danger">OK</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
</body>

@include('admin.adminscript')

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('.reservation_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('reservation.rview') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'guest',
                    name: 'guest'
                },
                {
                    data: 'time',
                    name: 'time'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'message',
                    name: 'message'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#create_record').click(function(){
            $('.modal-title').text('Add New Record');
            $('#action_button').val('Add');
            $('#action').val('Add');
            $('#form_result').html('');

            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function(event){
            event.preventDefault();
            var action_url = '';

            if($('#action').val() == 'Add')
            {
                action_url = "{{ route('reservation.rstore') }}";
            }

            if($('#action').val() == 'Edit')
            {
                action_url = "{{ route('reservation.rupdate') }}";
            }

            $.ajax({
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: action_url,
                data:$(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    console.log('success: '+data);
                    var html = '';
                    if(data.errors)
                    {
                        html = '<div class="alert alert-danger">';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if(data.success)
                    {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        //$('#user_table').DataTable().ajax.reload();
                        window.location.reload();

                    }
                    $('#form_result').html(html);
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });

        // Delete User Data
        var user_id;

        $(document).on('click', '.delete', function() {
            user_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function() {
            $.ajax({
                url: "reservation/rdestroy/" + user_id,
                beforeSend: function() {
                    $('#ok_button').text('Deleting...');
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        //$('#user_table').DataTable().ajax.reload();
                        window.location.reload();
                        alert('Data Deleted');
                    }, 2000);
                }
            })
        });
    });

    $(document).on('click', '.edit', function(event) {
        event.preventDefault();
        var id = $(this).attr('id');
        //alert(id);
        $('#form_result').html('');



        $.ajax({
            url: "/reservation/redit/" + id + "/",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function(data) {
                console.log('success: ' + data);
                $('#name').val(data.result.name);
                $('#email').val(data.result.email);
                $('#phone').val(data.result.phone);
                //$("#guest").val(data.result.guest);

                $("#guest").get().forEach(x => {
                    if (data.result.label == guest) {
                        data.result.selected = true;
                    }
                });
                $('#time').val(data.result.time);
                $('#date').val(data.result.date);
                $('#message').val(data.result.message);
                $('#hidden_id').val(id);
                $('.modal-title').text('Edit Record');
                $('#action_button').val('Update');
                $('#action').val('Edit');
                $('.editpass').hide();
                $('#formModal').modal('show');
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }
        })
    });
</script>

</html>
