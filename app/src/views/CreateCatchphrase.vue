<template>
  <ion-modal
    ref="modal"
    trigger="open-modal"
    :is-open="true"
    :initial-breakpoint="0.75"
    :backdrop-dismiss="true"
    :backdrop-breakpoint="0.75"
  >
    <ion-content class="ion-padding">
      <ion-searchbar
        placeholder="Search"
        @click="$refs.modal.$el.setCurrentBreakpoint(0.75)"
      />
      <ion-list>
        <ion-item>
          <ion-avatar slot="start">
            <img src="https://i.pravatar.cc/300?u=b" />
          </ion-avatar>
          <ion-label>
            <h2>Connor Smith</h2>
            <p>Sales Rep</p>
          </ion-label>
        </ion-item>
      </ion-list>
    </ion-content>
  </ion-modal>
</template>
<script>
export default {
  mounted() {
    console.warn('!!!!!!! kokot')
  },
}

</script>
