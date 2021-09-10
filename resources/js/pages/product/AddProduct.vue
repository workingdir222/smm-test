<template>
  <div>
    <CRow>
      <CCol sm="12">
        <CCard>
          <CCardHeader>
            <strong>Add Product </strong> <small>Form</small>
            <div class="card-header-actions">
              <router-link
                to="/pages/product"
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
                    <CCol sm="6">
                        <CInput
                        v-model="name"
                        label="Name"
                        placeholder="Enter your name"
                        />
                    </CCol>
                    <CCol sm="6">
                        <CInput
                        v-model="category"
                        label="Category"
                        placeholder="Enter your category"
                        />
                    </CCol>
                    </CRow>
                    <CRow>
                    <CCol sm="12">
                        <CTextarea
                        v-model="description"
                        label="Description"
                        placeholder="Enter your description"
                        />
                    </CCol>
                    </CRow>
                    <CRow>
                    <CCol sm="4">
                        <CInput
                        v-model="sku"
                        label="Sku"
                        placeholder="Enter your sku"
                        />
                    </CCol>
                    <CCol sm="4">
                        <CInput
                        v-model="harga_pokok"
                        @keypress="isNumber($event)"
                        label="Harga Pokok"
                        placeholder="Enter your harga pokok"
                        />
                    </CCol>
                    <CCol sm="4">
                        <CInput
                        v-model="harga_jual"
                        @keypress="isNumber($event)"
                        label="Harga Jual"
                        placeholder="Enter your harga jual"
                        />
                    </CCol>
                    </CRow>
                    <CRow>
                    <CCol sm="3">
                        <CInput
                        v-model="satuan"
                        label="Satuan"
                        placeholder="Enter your satuan"
                        />
                    </CCol>
                    <CCol sm="3">
                        <CInput
                        v-model="stok"
                        @keypress="isNumber($event)"
                        label="Stok"
                        placeholder="Enter your stok"
                        />
                    </CCol>
                    <CCol sm="3">
                        <CInput
                        v-model="berat"
                        @keypress="isNumber($event)"
                        label="Berat"
                        placeholder="Enter your berat"
                        />
                    </CCol>
                    <CCol sm="3">
                        <CInput
                        v-model="lokasi"
                        label="Lokasi"
                        placeholder="Enter your lokasi"
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
    name: 'AddProduct',
    data () {
        return {
            errors: [],
            name: null,
            category: null,
            description: null,
            sku: null,
            harga_pokok: null,
            harga_jual: null,
            satuan: null,
            stok: null,
            berat: null,
            lokasi: null
        }
    },
    mounted () {
    },
    methods: {
    checkForm: function (e) {
      this.errors = [];

      if (!this.name) {
        this.errors.push("Name required.");
      }

      if (!this.errors.length) {

        let dataPost = {}

        dataPost["name"] = this.name
        dataPost["category"] = this.category
        dataPost["description"] = this.description
        dataPost["sku"] = this.sku
        dataPost["harga_pokok"] = this.harga_pokok
        dataPost["harga_jual"] = this.harga_jual
        dataPost["satuan"] = this.satuan
        dataPost["stok"] = this.stok
        dataPost["berat"] = this.berat
        dataPost["lokasi"] = this.lokasi

        fetch('/api/product', {
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
            this.$router.push("/pages/product")
          } else {
            this.errors.push(res.error);
          }
        });

      }

      e.preventDefault();
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
  }
}
</script>