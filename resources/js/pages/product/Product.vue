<template>
  <div>
    <CRow>
      <CCol md="12">
        <CCard>
          <CCardHeader>
            <CIcon name="cil-justify-center"/><strong> List Product </strong>
            <div class="card-header-actions">
              <router-link
                to="/pages/product/add"
                tag="button"
                class="btn btn-primary"
              >
                <CIcon name="cil-lightbulb"/> Add
              </router-link>
            </div>
          </CCardHeader>
          <CCardBody>
            <CListGroup>
              <CListGroupItem
                v-for="user in productData"
                :key="user.id"
                class="flex-column align-items-start"
              >
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1 text-capitalize">{{ user.name }}</h5>
                  <small class="text-capitalize">{{ user.category }}</small>
                </div>
                <p class="mb-1">
                  Harga: {{ user.harga_jual }}
                </p>
                <small>{{ user.description }}</small>
              </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  </div>
</template>

<script>
export default {
    name: 'ListProduct',
    data () {
        return {
            productData: [],
        }
    },
    mounted () {
        fetch('/api/product')
        .then(response => response.json())
        .then(data => {
            if (data && data.message == "List data product") {
                this.productData = data.data
            }
        });
    }
}
</script>