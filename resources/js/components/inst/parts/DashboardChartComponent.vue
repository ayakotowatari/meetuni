<template>
    <v-row>
        <v-col col="12" sm="12" md="6">
            <v-card
                class="mt-4 mx-auto"
                max-width="480"
            >
                <v-sheet
                class="v-sheet--offset mx-auto"
                color="primary"
                elevation="12"
                max-width="calc(100% - 32px)"
                >
                <v-sparkline
                    :labels="labels"
                    :value="value"
                    color="white"
                    line-width="2"
                    padding="16"
                ></v-sparkline>
                </v-sheet>

                <v-card-text class="pt-0">
                <div class="title font-weight-light mb-2">Student Registrations</div>
                <div class="subheading font-weight-light grey--text">Last Campaign Performance</div>
                <v-divider class="my-2"></v-divider>
                <v-icon
                    class="mr-2"
                    small
                >
                    mdi-clock
                </v-icon>
                <span class="caption grey--text font-weight-light">last registration 26 minutes ago</span>
                </v-card-text>
            </v-card>
        </v-col>
        <v-col col="12" sm="12" md="6">
             <v-card
                class="mt-4 mx-auto"
                max-width="480"
            >
                <v-sheet
                class="v-sheet--offset mx-auto"
                color="primary"
                elevation="12"
                max-width="calc(100% - 32px)"
                >
                <v-sparkline
                    :labels="labels"
                    :value="value"
                    color="white"
                    line-width="2"
                    padding="16"
                ></v-sparkline>
                </v-sheet>

                <v-card-text class="pt-0">
                <div class="title font-weight-light mb-2">Latest Followings</div>
                <div class="subheading font-weight-light grey--text">Last Campaign Performance</div>
                <v-divider class="my-2"></v-divider>
                <v-icon
                    class="mr-2"
                    small
                >
                    mdi-clock
                </v-icon>
                <span class="caption grey--text font-weight-light">last registration 26 minutes ago</span>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
export default {
  data: () => ({
      labels: [
        '12am',
        '3am',
        '6am',
        '9am',
        '12pm',
        '3pm',
        '6pm',
        '9pm',
      ],
      value: [
        200,
        675,
        410,
        390,
        310,
        460,
        250,
        240,
      ],
    }),
}
</script>

<style>
 .v-sheet--offset {
    top: -24px;
    position: relative;
  }
</style>