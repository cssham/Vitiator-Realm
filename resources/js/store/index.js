import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    category:[],
    item:[]
  },
  getters:{
            getCategory(state){
                      return state.category;
            },
            getItem(state){
                return state.item;
            }
  },
  actions:{
            categoryList(context){
                      axios.get('/admin/category').then((response) => {
                                context.commit('categories',response.data.categories)
                      }).catch((err) => {

                      });
            },
            itemList(context){
                axios.get('/admin/item').then((response)=>{
                    context.commit('items',response.data.items)
                }).catch((err)=>{

                });
            }
  },
  mutations: {
    categories (state,data) {
      return state.category = data;
    },
    items(state,data){
        return state.item = data;
    }
  }
})

export default store;
