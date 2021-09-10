<template>
  <div>
    <CRow>
      <CCol md="12">
        <CCard>
          <CCardHeader>
            <CIcon name="cil-justify-center"/><strong> List User </strong>
            <div class="card-header-actions">
              <router-link
                to="/pages/users/add"
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
                v-for="user in usersData"
                :key="user.id"
                class="flex-column align-items-start"
              >
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1 text-capitalize">{{ user.name }}</h5>
                  <small class="text-capitalize">{{ user.departemen }}</small>
                </div>
                <p class="mb-1">
                  Address: {{ user.address }}
                </p>
                <small>NIK: {{ user.nik }}</small>
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
    name: 'ListUser',
    data () {
        return {
            usersData: [],
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
    }
}
</script>