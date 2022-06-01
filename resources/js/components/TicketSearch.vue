<template>
    <div class="ticket-search">
        <div id="ticketCloseMsg" class="alert alert-danger" role="alert" v-if="closeMessage">
            {{ closeMessage }}
        </div>
        <form id="form" name="form" class="form-horizontal" @submit.prevent="submit">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <!-- <input type="text" name="select_date" id="datepicker" class="form-control input-sm dt_pick" placeholder="Select Date" autocomplete="off"/> -->
                                <datepicker :format="customFormatter" name="select_date" placeholder="Select date" input-class="form-control"></datepicker>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="number" v-model="data.ticket_id" name="ticket_id" id="ticket_id" class="form-control input-sm" placeholder="Enter Ticket Id" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select name="ticket_type" class="form-control" v-model="data.ticket_type">
                                <option :value="null" disabled selected>Select Ticket Type</option>
                                <option value="NEW">NEW</option>
                                <option value="WIP">Work In Progress</option>
                                <option value="ANSWERED">ANSWERED</option>
                            </select>
                            <!-- {{ Form::select('ticket_type',['NEW' => 'NEW', 'WIP' => 'Work In Progress', 'ANSWERED' => 'ANSWERED'], null, array('class'=>'form-control selectTwo','id' => 'ticket_type','placeholder'=>'Select Ticket Type', 'required')) }} -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary center-align" style="padding: 5px 65px;"> Search </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <hr style="margin-top: 0px;">
        <div id="ticket_info">
            <table id= "table" class="table table-bordered" style="width:100%">
                <thead>
                    <th>Ticket Id</th>
                    <th>Agent</th>
                    <th>Customer Name</th>
                    <th>Remarks</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </thead>
                <tbody v-if="oldTickets">
                    <tr v-for="(oldTicket, index) in oldTickets" :key="oldTicket.id">
                        <td>{{ oldTicket.id }}</td>
                        <td>{{ oldTicket.crm.agent_name }}</td>
                        <td>{{ oldTicket.crm.customer_name }}</td>
                        <td>{{ oldTicket.crm.verbatim }}</td>
                        <td>{{ oldTicket.status }}</td>
                        <td>{{ oldTicket.created_at }}</td>
                        <td>
                            <!-- <button class="btn btn-info" @click.prevent="showDetails(oldTicket.id)">Show</button> -->
                            <a href="#reject" role="button" class="btn btn-primary" @click.prevent="showDetails(oldTicket.id)">Show</a>
                            <button v-if="oldTicket.status != 'CLOSED'" class="btn btn-dark" @click.prevent="closeTicket(oldTicket.id, index)">Close</button>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td align="center" colspan="7">No data available in table</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- <a href="#reject" role="button" class="btn btn-primary" @click="toggle()">Launch modal</a> -->
            <div :class="modalClasses" class="fade" id="reject" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ticket Details</h4>
                            <button type="button" class="close" @click="toggle()">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <table id= "showTable1" class="table table-bordered">
                                        <thead class="text-center">
                                            <span class="badge badge-warning">Customer Info</span>
                                        </thead>
                                        <tbody v-if="oldTicketDetails">
                                            <tr>
                                                <td><label>Crm Id</label></td>
                                                <td v-if="oldTicketDetails.crm_id">{{ oldTicketDetails.crm_id }}</td>
                                            </tr>
                                            <tr>
                                                <td><label>Customer Name</label></td>
                                                <td v-if="oldTicketDetails.crm.customer_name">{{ oldTicketDetails.crm.customer_name }}</td>
                                            </tr>
                                            <tr>
                                                <td><label>Phone no</label></td>
                                                <td v-if="oldTicketDetails.crm.customer_contact">{{ oldTicketDetails.crm.customer_contact }}</td>
                                            </tr>
                                            <tr>
                                                <td><label>Division</label></td>
                                                <td v-if="oldTicketDetails.crm.district.division.name">{{ oldTicketDetails.crm.district.division.name }}</td>
                                            </tr>
                                            <tr>
                                                <td><label>District</label></td>
                                                <td v-if="oldTicketDetails.crm.district.name">{{ oldTicketDetails.crm.district.name }}</td>
                                            </tr>
                                            <tr>
                                                <td><label>Address</label></td>
                                                <td v-if="oldTicketDetails.crm.address">{{ oldTicketDetails.crm.address }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table id= "showTable2" class="table table-bordered">
                                        <thead class="text-center">
                                            <span class="badge badge-warning">Ticket Details</span>
                                        </thead>
                                        <tbody v-if="oldTicketDetails">
                                            <tr>
                                                <td><label>Ticket Id</label></td>
                                                <td v-if="oldTicketDetails.id">{{ oldTicketDetails.id }}</td>
                                            </tr>
                                            <tr>
                                                <td><label>Call Type</label></td>
                                                <td v-if="oldTicketDetails.crm.call_type">{{ oldTicketDetails.crm.call_type }}</td>
                                            </tr>
                                            <tr>
                                                <td><label>Query Type</label></td>
                                                <td v-if="oldTicketDetails.crm.query_type.name">{{ oldTicketDetails.crm.query_type.name }}</td>
                                            </tr>
                                            <tr>
                                                <td><label>Complain Type</label></td>
                                                <td v-if="oldTicketDetails.crm.complain_type.name">{{ oldTicketDetails.crm.complain_type.name }}</td>
                                            </tr>
                                            <tr>
                                                <td><label>Department</label></td>
                                                <td v-if="oldTicketDetails.crm.department.name">{{ oldTicketDetails.crm.department.name }}</td>
                                            </tr>
                                            <tr>
                                                <td><label>Ticket Status</label></td>
                                                <td v-if="oldTicketDetails.status">{{ oldTicketDetails.status }}</td>
                                            </tr>
                                            <tr>
                                                <td><label>Customer Query</label></td>
                                                <td v-if="oldTicketDetails.crm.verbatim">{{ oldTicketDetails.crm.verbatim }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <label><strong>Comments</strong></label>
                            <div class="comment-section" id="comment-section" v-if="oldTicketDetails.ticket_response">
                                <div class="container-fluid mt-1">
                                    <div  v-if="oldTicketDetails.ticket_response.length != 0">
                                        <div class="row" v-for="comment in oldTicketDetails.ticket_response" :key="comment.id">
                                            <div class="col-sm-2">
                                                <div class="user_avatar">
                                                    <img :src="getImgUrl()" alt="profile">
                                                </div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="comment_body">
                                                    {{comment.response}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else>
                                        No Comment
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" @click="toggle()">Close</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import moment from 'moment';

export default {

    components: {
        Datepicker
    },

    data(){
        return{
            format: 'yyyy-MM-dd',
            modal: true,
            modalClasses: ['modal','fade'],
            data: {
                ticket_id: null,
                ticket_type: null,
                created_at: null
            },
            oldTickets: "",
            oldTicketDetails: "",
            closeMessage: "",
            imageUrl: null,
        }
    },
    mounted(){
        var pathname = window.location.pathname;
        pathname = pathname.split("/");
        console.log('http://'+window.location.host+'/'+pathname[1]+'/'+pathname[2]+'/img/profile.png');

    },
    methods: {
        getImgUrl(){
            var pathname = window.location.pathname;
            pathname = pathname.split("/");
            console.log(pathname[1]+'/'+pathname[2]);
            return 'http://'+window.location.host+'/'+pathname[1]+'/'+pathname[2]+'/img/profile.png'
        },
        async showDetails(id){
            var data = {
                ticket_id: id
            }

            var pathname = window.location.pathname;
            pathname = pathname.split("api");
            var url = window.location.host + pathname[0]

            await axios.post('http://'+url+'/api/ticket-by-ajax-by-id', data)
                    .then(response => {
                        this.oldTicketDetails = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            this.toggle();
        },
        toggle() {
            document.body.className += ' modal-open'
            let modalClasses = this.modalClasses

            if (modalClasses.indexOf('d-block') > -1) {
                modalClasses.pop()
                modalClasses.pop()

                //hide backdrop
                let backdrop = document.querySelector('.modal-backdrop')
                document.body.removeChild(backdrop)
            }
            else {
                modalClasses.push('d-block')
                modalClasses.push('show')

                //show backdrop
                let backdrop = document.createElement('div')
                backdrop.classList = "modal-backdrop fade show"
                document.body.appendChild(backdrop)
            }
        },
        closeTicket(id, index){
            var result = confirm("Want to close?");
            if(result){

                var data = {
                    ticket_id: id,
                    action: 'Send to close'
                }

                var pathname = window.location.pathname;
                pathname = pathname.split("api");
                var url = window.location.host + pathname[0]

                axios.post('http://'+url+'/api/ticket-close-by-ajax', data)
                    .then(response => {
                        this.oldTickets.splice(index, 1);
                        this.closeMessage = "Success ! Ticket Closed successfully";

                    })
                    .catch( error => {
                        this.closeMessage = "Error ! Something went wrong";
                    })
            }
        },
        submit(){
            var dataString ='';

            var i = 0;
            for (var key in this.data) {

                if(this.data[key] != null && i != 0){
                    dataString += '&'+key+'='+ this.data[key];
                }
                if(this.data[key] != null && i === 0){
                    dataString += key+'='+ this.data[key];
                    i++;
                }
            }

            if (this.data.created_at == null && this.data.ticket_type == null && this.data.ticket_id == null) {
                alert("Please Enter At Least One Value");
            } else {

                var pathname = window.location.pathname;
                pathname = pathname.split("api");
                var url = window.location.host + pathname[0]

                axios.post('http://'+url+'/api/ticket-by-ajax', dataString)
                        .then(response => {
                            this.oldTickets = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        })
            }
        },
        customFormatter(date){
            this.data.created_at = moment(date).format('YYYY-MM-DD');
            return this.data.created_at;
        }
    }

}
</script>
