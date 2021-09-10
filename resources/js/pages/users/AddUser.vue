<template>
  <div>
    <CRow>
      <CCol sm="12">
        <CCard>
          <CCardHeader>
            <strong>Add User </strong> <small>Form</small>
            <div class="card-header-actions">
              <router-link
                to="/pages/users"
                class="btn btn-warning"
              >
                <CIcon name="cil-ban"/> Back
              </router-link>
            </div>
          </CCardHeader>
          <CCardBody>
            <form
            id="app"
            @submit="checkForm"
            method="post"
            >
                <CRow>
                    <CCol sm="12">
                        <CInput
                        v-model="name"
                        label="Name"
                        placeholder="Enter your name"
                        />
                    </CCol>
                </CRow>
                <CRow>
                    <CCol sm="6">
                        <CInput
                        v-model="nik"
                        @keypress="isNumber($event)"
                        label="NIK"
                        placeholder="Enter your NIK"
                        />
                    </CCol>
                    <CCol sm="6">
                        <CInput
                        v-model="departemen"
                        label="Departemen"
                        placeholder="Enter your departemen"
                        />
                    </CCol>
                </CRow>
                <CRow>
                    <CCol sm="4">
                        <CInput
                        v-model="phone"
                        @keypress="isNumber($event)"
                        label="Phone"
                        placeholder="Enter your phone"
                        />
                    </CCol>
                    <CCol sm="4">
                        <CInput
                        v-model="email"
                        label="Email"
                        placeholder="Enter your email"
                        />
                    </CCol>
                    <CCol sm="4">
                        <label for="gender" class="">Gender </label>
                        <select 
                            id="gender" 
                            v-model="gender"
                            class="form-control"
                        >                                            
                            <option value="pria">Pria</option>
                            <option value="wanita">Wanita</option>
                        </select>
                    </CCol>
                </CRow>
                <CRow>
                    <CCol sm="4">
                        <label for="province" class="">Province </label>
                        <select 
                            id="province" 
                            v-model="province"
                            class="form-control"
                            @change="onChangeProvince($event)"
                        >                                            
                            <option v-for="prov in provinceData" :key="prov.province_id" :value="prov.province_id">{{prov.province}}</option>
                        </select>
                    </CCol>
                    <CCol sm="4">
                        <label for="city" class="">City </label>
                        <select 
                            id="city" 
                            v-model="city"
                            class="form-control"
                            @change="onChangeCity($event)"
                        >                                            
                            <option v-for="cty in cityData" :key="cty.city_id" :value="cty.city_id">{{cty.city_name}} {{cty.type}}</option>
                        </select>
                    </CCol>
                    <CCol sm="4">
                        <label for="subdistrict" class="">Subdistrict </label>
                        <select 
                            id="subdistrict" 
                            v-model="subdistrict"
                            class="form-control"
                            @change="onChangeSubdistrict($event)"
                        >                                            
                            <option v-for="dist in subdistrictData" :key="dist.subdistrict_id" :value="dist.subdistrict_id">{{dist.subdistrict_name}}</option>
                        </select>
                    </CCol>
                </CRow>
                <CRow>
                    <CCol sm="12">
                        <CInput
                        v-model="address"
                        label="Address"
                        placeholder="Enter your address"
                        />
                    </CCol>
                </CRow>
                <CButton type="submit" color="success"><CIcon name="cil-check-circle"/> Submit</CButton>
            </form>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  </div>
</template>

<script>
export default {
    name: 'AddUser',
    data () {
        return {
            provinceData: [],
            cityData: [],
            subdistrictData: [],
            errors: [],
            name: null,
            nik: null,
            departemen: null,
            phone: null,
            email: null,
            gender: null,
            province: null,
            city: null,
            subdistrict: null,
            address: null
        }
    },
    mounted () {
        fetch('/api/region/province')
        .then(response => response.json())
        .then(data => {
            this.provinceData = data.rajaongkir.results
        });
    },
    methods: {
    checkForm: function (e) {
      this.errors = [];

      if (!this.name) {
        this.errors.push("Name required.");
      }
      if (!this.email) {
        this.errors.push('Email required.');
      } else if (!this.validEmail(this.email)) {
        this.errors.push('Valid email required.');
      }

      if (!this.errors.length) {

        let dataPost = {}

        dataPost["name"] = this.name
        dataPost["nik"] = this.nik
        dataPost["departemen"] = this.departemen
        dataPost["phone"] = this.phone
        dataPost["email"] = this.email
        dataPost["gender"] = this.gender
        dataPost["province"] = this.province
        dataPost["city"] = this.city
        dataPost["subdistrict"] = this.subdistrict
        dataPost["address"] = this.address

        fetch('/api/users', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(dataPost),
        })
        .then(res => res.json())
        .then(res => {
            console.log(res)
          if (res.data) {
            this.$router.push("/pages/users")
          } else {
            this.errors.push(res.error);
          }
        });

      }

      e.preventDefault();
    },
    validEmail: function (email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    isNumber: function(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        evt.preventDefault();;
      } else {
        return true;
      }
    },
    onChangeProvince: function (event) {
         fetch('/api/region/city', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({key: event.target.value}),
        })
        .then(response => response.json())
        .then(data => {
            this.cityData = data.rajaongkir.results
        });
    },
    onChangeCity: function (event) {
         fetch('/api/region/subdistrict', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({key: event.target.value}),
        })
        .then(response => response.json())
        .then(data => {
            this.subdistrictData = data.rajaongkir.results
        });
    },
    onChangeSubdistrict: function (event) {
         console.log(event.target.value)
    }
  }
}
</script>