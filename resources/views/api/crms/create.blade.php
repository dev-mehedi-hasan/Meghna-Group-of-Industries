<!DOCTYPE html>
<html>
<head>
  <title>Ticketing Module - Agent Form</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="#">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/mint-choc/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('asset/css/@fontawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/style.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        .accordion>.card:not(:last-of-type) {
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 5px;
        }
        .card {
            box-shadow: none;
        }

        .card .crm-header input{
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: white;
            background-image: url({{ asset('/img/telephone-auricular-with-cable.png') }});
            background-position: 10px 5px;
            background-repeat: no-repeat;
            padding: 5px 10px 5px 40px;
        }

        .msg{
            padding: 20px;
            background-color: #4BB543;
            color: white;
        }
        .errorMsg{
            padding: 20px;
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="container-fluid">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="row mt-3">
                <div class="col-xl-10 mx-auto">
                    <div class="accordion" id="Accordian">
                        <div class="card">
                            <div class="card-header" id="HeadingOne">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <a class="btn btn-link pull-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Customer Input
                                        </a>
                                    </div>
                                    <div class="col-2 text-right">
                                        <i class="fas fa-chevron-right pull-right"></i>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="HeadingOne" data-parent="#Accordian">
                                <div class="card-body">
                                    <div class="card border-0">
                                        <div class="card-header crm-header text-center bg-transparent border-0">
                                            Phone No:  <input type="text" class="phone_show_input" value="{{ $phoneNumber }}" width="100px" readonly> & Agent: <span class="badge badge-danger">{{ $agent }}</span>
                                        </div>
                                        <div class="card-body">
                                            <crm-create :phone_number="{{ json_encode($phoneNumber) }}" :agent="{{ json_encode($agent) }}"></crm-create>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="HeadingTwo">
                                <div class="row align-items-center">
                                    <div class="col-10">
                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Find Tickets
                                        </a>
                                    </div>
                                    <div class="col-2 text-right">
                                        <i class="fas fa-chevron-right pull-right"></i>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="HeadingTwo" data-parent="#Accordian">
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <ticket-search></ticket-search>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $('.form-prevent-multiple-submits').on('submit', function(){
        $('.button-prevent-multiple-submits').attr('disabled','true');
        $("i").show();
    })
    $(".selectTwo").select2({
        allwClear: true
    });
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd"
    });
    function get_ticket_history(type){
        let values = {
                "ticket_id" : document.getElementById("ticket_id").value,
                "ticket_type" : document.getElementById("ticket_type").value,
                "created_at": document.getElementById("datepicker").value
        };
        var dataString ='';

        var i = 0;
        for (var key in values) {

            if(values[key] != "" && i != 0){
                dataString += '&'+key+'='+ values[key];
            }
            if(values[key] != "" && i === 0){
                dataString += key+'='+ values[key];
                i++;
            }
        }

        if (values.created_at == "" && values.ticket_type == "" && values.ticket_id == "") {
            alert("Please Enter At Least One Value");
        } else {
            $.ajax({
                method: 'POST',
                url: "{{ route('api.ticketByAjax') }}",
                data: dataString,
                cache: false,
                success: function(data) {
                    $('#table tbody').empty();
                        var tr;
                        if(data.length != 0){
                            for (var i = 0; i < data.length; i++) {
                                tr = $('<tr/>');
                                tr.append("<td>" + data[i].id + "</td>");
                                tr.append("<td>" + data[i].crm.agent_name + "</td>");
                                tr.append("<td>" + data[i].crm.customer_name + "</td>");
                                tr.append("<td>" + data[i].crm.verbatim + "</td>");
                                tr.append("<td>" + data[i].status + "</td>");
                                tr.append("<td>" + data[i].created_at + "</td>");
                                tr.append("<td><button class='show_btn' onclick='showModal("+data[i].id+")' type='submit'>Show</button>"+(data[i].status != 'CLOSED' ? "<button class='close_btn' onclick='closeTicket("+data[i].id+")' type='submit' data-id='"+data[i].id+"'>Close</button>" : "")+"</td>");
                                $('#table tbody').append(tr);
                            }
                        }else{
                            tr = $('<tr/>');
                            tr.append("<td>"+' '+"</td>");
                            tr.append("<td>"+' '+"</td>");
                            tr.append("<td>"+' '+"</td>");
                            tr.append("<td>"+'No Data Found'+"</td>");
                            tr.append("<td>"+' '+"</td>");
                            tr.append("<td>"+' '+"</td>");
                            $('#table tbody').append(tr);
                        }

                    }
            });
        }
        return false;
    }

    function showModal(id){
        $.ajax({
                method: 'POST',
                url: "{{ route('api.ticketByAjaxByID') }}",
                data: {ticket_id: id},
                cache: false,
                success: function(data) {
                    console.log(data);
                    $('#showTable1').empty();
                        var tr1;
                        tr1 = $('<tr/>');
                        tr1.append("<tr>" +"<td width='30%'><label>Crm Id</label></td>"+"<td width='30%'>"+data.crm_id+"</td>"+"</tr>");
                        tr1.append("<tr>" +"<td width='30%'><label>Customer Name</label></td>"+"<td width='30%'>"+data.crm.customer_name+"</td>"+"</tr>");
                        tr1.append("<tr>" +"<td width='30%'><label>Phone no</label></td>"+"<td width='30%'>"+data.crm.customer_contact+"</td>"+"</tr>");
                        tr1.append("<tr>" +"<td width='30%'><label>Division</label></td>"+"<td width='30%'>"+data.crm.district.division.name+"</td>"+"</tr>");
                        tr1.append("<tr>" +"<td width='30%'><label>District</label></td>"+"<td width='30%'>"+data.crm.district.name+"</td>"+"</tr>");
                        tr1.append("<tr>" +"<td width='30%'><label>Address</label></td>"+"<td width='30%'>"+data.crm.address+"</td>"+"</tr>");
                    $('#showTable1').append(tr1);

                    $('#showTable2').empty();
                        var tr2;
                        tr2 = $('<tr/>');
                        tr2.append("<tr>" +"<td width='30%'><label>Ticket Id</label></td>"+"<td width='30%'>"+data.id+"</td>"+"</tr>");
                        tr2.append("<tr>" +"<td width='30%'><label>Call Type</label></td>"+"<td width='30%'>"+data.crm.call_type+"</td>"+"</tr>");
                        tr2.append("<tr>" +"<td width='30%'><label>Query Type</label></td>"+"<td width='30%'>"+data.crm.query_type.name+"</td>"+"</tr>");
                        tr2.append("<tr>" +"<td width='30%'><label>Complain Type</label></td>"+"<td width='30%'>"+data.crm.complain_type.name+"</td>"+"</tr>");
                        tr2.append("<tr>" +"<td width='30%'><label>Department</label></td>"+"<td width='30%'>"+data.crm.department.name+"</td>"+"</tr>");
                        tr2.append("<tr>" +"<td width='30%'><label>Ticket Status</label></td>"+"<td width='30%'>"+data.status+"</td>"+"</tr>");
                        tr2.append("<tr>" +"<td width='30%'><label>Customer Query</label></td>"+"<td width='30%'>"+data.crm.verbatim+"</td>"+"</tr>");
                    $('#showTable2').append(tr2);
                    $('#comment-section').empty();
                    if(data.ticket_response.length != 0){
                        for(var j=0 ; j< data.ticket_response.length ; j++){
                            var html = '<div class="container-fluid mt-1">';
                            html += '<div class="row">';
                            html += '<div class="col-sm-1">';
                            html += '<div class="user_avatar">';
                            html += '<img src="{{ asset('/img/profile.png') }}" class="" alt="User Image">';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="col-sm-11">';
                            html += '<div class="comment_body">';
                            html += "<p>"+ data.ticket_response[j].response+"</p>";
                            html += '</div>';
                            html += '<div class="comment_toolbar">';
                            html += '<div class="comment_details">';
                            html += '<ul>';
                            html += "<li>"+"<i class='fa fa-clock mr-1'></i>"+ data.ticket_response[j].created_time+"</li>";
                            html += "<li>"+"<i class='fa fa-calendar mr-1'></i>"+ data.ticket_response[j].created_date+"</li>";
                            html += "<li>"+"<i class='fa fa-pencil mr-1'></i>"+ data.ticket_response[j].user.name+"</li>";
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            $('#comment-section').append(html);
                        }
                    }else{
                        $('#comment-section').append("Nothing to show");
                    }

                }

            });
        $('#ticketDetailsModal').modal("show");
    }

    function closeTicket(id){
        var result = confirm("Want to close?");
        if(result){
            $(document).on('click', '.close_btn', function(){
                $(this).parents('tr').remove();
            });
            $.ajax({
                method: 'POST',
                url: "{{ route('api.ticketCloseByAjax') }}",
                data: {ticket_id: id, action: 'Send to close'},
                cache: false,
                success: function(data) {
                    $('#ticketCloseMsg').html("<div class='msg'><strong>Success!</strong>Ticket closed successfully</div>").fadeIn('slow');
                    $('#ticketCloseMsg').delay(5000).fadeOut('slow');
                }
            });
        }

    }
</script>
</body>
</html>
