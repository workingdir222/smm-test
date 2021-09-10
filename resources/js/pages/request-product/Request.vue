<template>
  <div>
    <CRow>
      <CCol md="12">
        <CCard>
          <CCardHeader>
            <CIcon name="cil-justify-center"/><strong> List Request </strong>
            <div class="card-header-actions">
              <router-link
                to="/pages/request/add"
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
                href="#"
                active
                class="flex-column align-items-start"
              >
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">List group item heading</h5>
                  <small>3 days ago</small>
                </div>
                <p class="mb-1">
                  Donec id elit non mi porta gravida at eget metus. Maecenas
                  sed diam eget risus varius blandit.
                </p>
                <small>Donec id elit non mi porta.</small>
              </CListGroupItem>
              <CListGroupItem href="#" class="flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">List group item heading</h5>
                  <small class="text-muted">3 days ago</small>
                </div>
                <p class="mb-1">
                  Donec id elit non mi porta gravida at eget metus. Maecenas
                  sed diam eget risus varius blandit.
                </p>
                <small class="text-muted">Donec id elit non mi porta.</small>
              </CListGroupItem>
              <CListGroupItem href="#" disabled class="flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">Disabled List group item</h5>
                  <small class="text-muted">3 days ago</small>
                </div>
                <p class="mb-1">
                  Donec id elit non mi porta gravida at eget metus. Maecenas
                  sed diam eget risus varius blandit.
                </p>
                <small class="text-muted">Donec id elit non mi porta.</small>
              </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  </div>
</template>