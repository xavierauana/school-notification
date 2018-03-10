<template>
    <div>
        <div class="form-group">
             <button class="btn-sm btn-primary"
                     @click.prevent="addEmail">Add Email</button>
            <button class="btn-sm btn-primary"
                    @click.prevent="addMobile">Add Mobile</button>
        </div>


        <div v-if="channels.length">

        <component v-for="(channel, index) in channels" :is="channel"
                   :key="index"></component>
        </div>

    </div>
</template>
<script>
    import EmailChannel from "./EmailChannel"
    import MobileChannel from "./MobileChannel"

    export default {

      name      : "channels",
      components: {
        EmailChannel,
        MobileChannel
      },
      data() {
        return {
          channels: []
        }
      },
      methods   : {
        addEmail() {this.channels.push('EmailChannel')},
        addMobile() {this.channels.push('MobileChannel')},
      }
    }
</script>

<style scoped>

</style>