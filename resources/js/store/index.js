import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store ({

    state: {
        //状態を管理する
        //component側でstateからデータを取るのはcomputed

        
    },
    getters: {
        //stateの値を加工して、componentで使いたい時。
        //componentsではcomputedで展開

    },
    mutations: {
        //actionsが終わった後の同期処理をする
        //change and edite data in state
        //componentsではmethodsで展開

    },
    actions: {
        //非同期処理をする
        //componentsではmethodsで展開

    },
    modules: {

    }

})