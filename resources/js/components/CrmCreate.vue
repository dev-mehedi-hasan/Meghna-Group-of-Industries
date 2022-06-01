<template>
   <form method="post" @submit.prevent="submit">

       <div class="alert alert-success" v-show="successMessage">Saved successfully</div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label for="customer_name" class="col-sm-3 col-form-label">Customer Name</label>
                    <div class="col-sm-9">
                        <input v-model="data.customer_name" type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alternate_number" class="col-sm-3 col-form-label">Alternate Number</label>
                    <div class="col-sm-9">
                        <input v-model="data.alternate_number" type="text" class="form-control" id="alternate_number" name="alternate_number" placeholder="Alternate Customer Number">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="customer_gender" class="col-sm-3 col-form-label ">Customer Gender</label>
                    <div class="col-sm-9">
                        <select v-model="data.customer_gender" name="customer_gender" class="form-control" placeholder="Select Gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="districts" class="col-sm-3 col-form-label ">District</label>
                    <div class="col-sm-9">
                        <select v-model="data.district_id" name="district_id" class="form-control" placeholder="Select District" required>
                            <option v-for="district in districts" :key="district.id" :value="district.id">{{ district.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label ">Address</label>
                    <div class="col-sm-9">
                        <input v-model="data.address" class="form-control" id="address" name="address" placeholder="Address" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="wing_name" class="col-sm-3 col-form-label ">Wing</label>
                    <div class="col-sm-9">
                        <input v-model="data.wing_name" disabled type="text" class="form-control" id="wing_name" name="wing_name" placeholder="Wing Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dealer_division" class="col-sm-3 col-form-label ">Division</label>
                    <div class="col-sm-9">
                        <input v-model="data.dealer_division" disabled type="text" class="form-control" id="dealer_division" name="dealer_division" placeholder="Dealer/Distributor Division">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="area" class="col-sm-3 col-form-label ">Area</label>
                    <div class="col-sm-9">
                        <input v-model="data.area" disabled type="text" class="form-control" id="area" name="area" placeholder="Area">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="territory" class="col-sm-3 col-form-label ">Territory</label>
                    <div class="col-sm-9">
                        <input v-model="data.territory" disabled type="text" class="form-control" id="territory" name="territory" placeholder="Territory">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="region" class="col-sm-3 col-form-label ">Region</label>
                    <div disabled class="col-sm-9">
                        <input v-model="data.region" disabled type="text" class="form-control" id="region" name="region" placeholder="Region">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="designation" class="col-sm-3 col-form-label ">Designation</label>
                    <div class="col-sm-9">
                        <input v-model="data.designation" disabled type="text" class="form-control" id="designation" name="designation" placeholder="Designation">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label for="distributor_name" class="col-sm-3 col-form-label ">Distributor Name</label>
                    <div class="col-sm-9">
                        <input v-model="data.distributor_name" disabled type="text" class="form-control" id="distributor_name" name="distributor_name" placeholder="Distributor Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="proprietor_name" class="col-sm-3 col-form-label ">Proprietor Name</label>
                    <div class="col-sm-9">
                        <input v-model="data.proprietor_name" disabled type="text" class="form-control" id="proprietor_name" name="proprietor_name" placeholder="Proprietor Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="verification_code" class="col-sm-3 col-form-label ">Verification Code</label>
                    <div class="col-sm-9">
                        <input v-model="data.verification_code" disabled type="text" class="form-control" id="verification_code" name="verification_code" placeholder="Verification Code">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="caller_type" class="col-sm-3 col-form-label ">Caller Type</label>
                    <div class="col-sm-9">
                        <select v-model="data.caller_type" name="caller_type" class="form-control" placeholder="Select Caller Type" required>
                            <option value="distributor">Distributor</option>
                            <option value="dealer">Dealer</option>
                            <option value="retailer">Retailer</option>
                            <option value="consumer">Consumer</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="conversation_details" class="col-sm-3 col-form-label ">Conversation Details</label>
                    <div class="col-sm-9">
                        <textarea v-model="data.conversation_details" type="text" class="form-control" id="conversation_details" name="conversation_details" placeholder="Conversation Details" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="query_type" class="col-sm-3 col-form-label ">Query Type</label>
                    <div class="col-sm-9">
                        <select v-model="data.query_type_id" name="query_type_id" class="form-control" required>
                            <option v-for="query_type in query_types" :key="query_type.id" :value="query_type.id">{{ query_type.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="complain_type" class="col-sm-3 col-form-label ">Complain Type</label>
                    <div class="col-sm-9">
                        <select v-model="data.complain_type_id" name="complain_type_id" class="form-control" required>
                            <option v-for="complain_type in complain_types" :key="complain_type.id" :value="complain_type.id">{{ complain_type.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="department" class="col-sm-3 col-form-label ">Department</label>
                    <div class="col-sm-9">
                        <select v-model="data.department_id" name="department_id" class="form-control" required>
                            <option v-for="department in departments" :key="department.id" :value="department.id">{{ department.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="raiseTicket" class="col-sm-3 col-form-label ">Raise Ticket</label>
                    <div class="col-sm-9">
                        <select v-model="data.raiseTicket" name="raiseTicket" class="form-control" required>
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="call_type" class="col-sm-3 col-form-label">Call Type</label>
                    <div class="col-sm-9">
                        <select v-model="data.call_type" name="call_type" class="form-control" required>
                            <option value="inbound">Inbound</option>
                            <option value="outbound">Outbound</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="call_remarks" class="col-sm-3 col-form-label ">Call Remarks</label>
                    <div class="col-sm-9">
                        <select v-model="data.call_remark_id" name="call_remark_id" class="form-control" required>
                            <option v-for="call_remark in call_remarks" :key="call_remark.id" :value="call_remark.id">{{ call_remark.name }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" :disabled="buttonDisabled" ref="btnToggle">
            Submit
        </button>
    </form>
</template>

<script>
export default {
    props: ['phone_number','agent'],
    data(){
        return{
            buttonDisabled : false,
            successMessage: false,
            districts: null,
            query_types: null,
            complain_types: null,
            call_remarks: null,
            departments: null,
            single_customer: null,
            crmLast: null,
            data: {
                customer_contact: null,
                agent_name: null,
                customer_name: null,
                alternate_number: null,
                address: null,
                customer_gender: null,
                district_id: null,
                verification_code: null,
                proprietor_name: null,
                distributor_name: null,
                region: null,
                designation: null,
                territory: null,
                area: null,
                dealer_division: null,
                wing_name: null
            }
        }
    },

    async mounted(){
        this.data.customer_contact = this.phone_number;
        this.data.agent_name = this.agent;

        var pathname = window.location.pathname;
        pathname = pathname.split("api");
        var url = window.location.host + pathname[0]

        await axios.get('http://'+url+'/api/get-crm-data',{
            params:{
                phone_number: this.phone_number,
            }
        })
        .then(response => {
            this.districts = response.data.district,
            this.query_types = response.data.query_types,
            this.complain_types = response.data.complain_types,
            this.call_remarks = response.data.call_remarks,
            this.departments = response.data.departments,
            this.crmLast = response.data.crmLast,
            this.single_customer = response.data.single_customer
        })
        .catch(error =>{
            console.log(error)
        })

        if(this.crmLast != null){
            this.data.customer_name = this.crmLast.customer_name
            this.data.alternate_number = this.crmLast.alternate_number
            this.data.address = this.crmLast.address
            this.data.customer_gender = this.crmLast.customer_gender
            this.data.district_id = this.crmLast.district_id
        }
    },

    methods: {
        async submit(){
            this.buttonDisabled = true;
            this.$refs.btnToggle.innerText = 'Please wait...';
            var pathname = window.location.pathname;
            pathname = pathname.split("api");
            var url = window.location.host + pathname[0]

            await axios.post('http://'+url+'/api/crm-store', this.data)
                    .then(response => {
                        this.data = {};
                        this.successMessage = true;
                        this.$refs.btnToggle.innerText = 'Submit';
                        this.buttonDisabled = false;
                    })
                    .catch( error => {
                        console.log(error)
                    })

        }
    }
}
</script>

<style>

</style>
