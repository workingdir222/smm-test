<template>
  <div>
    <CRow>
      <CCol sm="12">
        <CCard>
          <CCardHeader>
            <strong>Add Request </strong> <small>Form</small>
            <div class="card-header-actions">
              <CButton type="submit" color="success"><CIcon name="cil-check-circle"/> Submit</CButton>
              <router-link
                to="/pages/request"
                class="btn btn-warning"
              >
                <CIcon name="cil-ban"/> Back
              </router-link>
            </div>
          </CCardHeader>
          <CCardBody>
            <CRow>
              <CCol sm="4">
                <label for="nik" class="">NIK Peminta </label>
                <select 
                    id="nik" 
                    v-model="nik"
                    class="form-control"
                    @change="onChangeNik($event)"
                >                                            
                    <option v-for="user in usersData" :key="user.id" :value="user.id">{{user.nik}}</option>
                </select>
              </CCol>
              <CCol sm="4">
                <CInput
                  label="Name"
                  v-model="name"
                  placeholder="Enter your name"
                  disabled
                />
              </CCol>
              <CCol sm="4">
                <CInput
                  label="Departemen"
                  v-model="departemen"
                  placeholder="Enter your departemen"
                  disabled
                />
              </CCol>
            </CRow>
            <CRow>
              <CCol sm="4">
                <CInput
                label="Tanggal Permintaan"
                type="date"
              />
              </CCol>
              <CCol sm="8">
                  <CButton @click="addProductList()" type="button" color="success float-right mt-4">Add Product</CButton>
              </CCol>
            </CRow>
            <CRow v-if="listProduct.length !== 0">
                <CCol sm="12">
                    <CDataTable
                    class="mb-0 table-outline"
                    hover
                    :items="listProduct"
                    :fields="tableFields"
                    head-color="light"
                    no-sorting
                    >
                    <td slot="barang" slot-scope="{item}">
                        <select 
                            id="nik" 
                            v-model="item.barang.barangVal"
                            class="form-control"
                            @change="onChangeProduct($event)"
                        >                                            
                            <option v-for="product in productData" :key="product.id" :value="product.id">{{product.name}}</option>
                        </select>
                    </td>
                    <td slot="lokasi" slot-scope="{item}">
                        <CInput
                        v-model="item.lokasi.lokasiVal"
                        disabled
                        />
                    </td>
                    <td slot="stok" slot-scope="{item}">
                        <CInput
                        v-model="item.stok.stokVal"
                        disabled
                        />
                    </td>
                    <td slot="kuantiti" slot-scope="{item}">
                        <CInput
                        v-model="item.kuantiti.kuantitiVal"
                        @keypress="validateStok($event, item.stok.stokVal, item.kuantiti.kuantitiVal)"
                        />
                    </td>
                    <td slot="satuan" slot-scope="{item}">
                        <CInput
                        v-model="item.satuan.satuanVal"
                        disabled
                        />
                    </td>
                    <td slot="keterangan" slot-scope="{item}">
                        <CInput
                        v-model="item.keterangan.keteranganVal"
                        />
                    </td>
                    </CDataTable>
                </CCol>
            </CRow>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  </div>
</template>

<script>
export default {
    name: 'AddProductRequest',
    data () {
        return {
            errors: [],
            usersData: [],
            productData: [],
            nik: null,
            name: null,
            departemen: null,
            requestDate: null,
            listProduct: [],
            tableItems: [{
                barang: { count: 0, barangVal: '' },
                lokasi: { count: 0, lokasiVal: '' },
                stok: { count: 0, stokVal: '' },
                kuantiti: { count: 0, kuantitiVal: '' },
                satuan: { count: 0, satuanVal: '' },
                keterangan: { count: 0, keteranganVal: '' }
            }],
            tableFields: [
                { key: 'barang' },
                { key: 'lokasi' },
                { key: 'stok' },
                { key: 'kuantiti' },
                { key: 'satuan' },
                { key: 'keterangan' },
            ]
        }
    },
    mounted () {
        fetch('/api/users')
        .then(response => response.json())
        .then(data => {
            if (data && data.message == "List data users") {
                this.usersData = data.data
            }
        });
        fetch('/api/product')
        .then(response => response.json())
        .then(data => {
            if (data && data.message == "List data product") {
                this.productData = data.data
            }
        });
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
    onChangeNik: function(event) {
        const findUser = this.usersData.find(item => {
            return item.id == event.target.value
        })

        this.name = findUser.name
        this.departemen = findUser.departemen
    },
    onChangeProduct: function(event) {
        const findList = this.listProduct.find(item => {
            return item.barang.barangVal == event.target.value
        })
        const findProduct = this.productData.find(item => {
            return item.id == event.target.value
        })
  
        this.listProduct[findList.barang.count].lokasi.lokasiVal = findProduct.lokasi
        this.listProduct[findList.stok.count].stok.stokVal = findProduct.stok
        this.listProduct[findList.satuan.count].satuan.satuanVal = findProduct.satuan
    },
    addProductList: function() {

        if (this.listProduct.length < this.productData.length) {
            let countList = 0
            if (this.listProduct.length !== 0) {
                countList = this.listProduct[this.listProduct.length -1].count +1
            }

            this.listProduct.push({
                barang: { count: countList, barangVal: '' },
                lokasi: { count: countList, lokasiVal: '' },
                stok: { count: countList, stokVal: '' },
                kuantiti: { count: countList, kuantitiVal: '' },
                satuan: { count: countList, satuanVal: '' },
                keterangan: { count: countList, keteranganVal: '' }
            })
        }
    },
    validateStok: function(evt, stok, qty) {

        evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        evt.preventDefault();;
      } else {
        if (qty > stok) {
            evt.preventDefault();;
        } else {
            return true;
        }
      }
    },
  }
}
</script>