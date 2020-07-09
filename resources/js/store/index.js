import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    category:[],
    item:[],
    slider:[],
    reservation:[],
    contact:[]
  },
  getters:{
            getCategory(state){
                      return state.category;
            },
            getItem(state){
                return state.item;
            },
            getSlider(state) {
                return state.slider;
            },
            getReservation(state) {
                return state.reservation;
            },
             getContact(state) {
                 return state.contact;
             },
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
            },
            sliderList(context) {
                axios.get('/admin/slider').then((response) => {
                    context.commit('sliders', response.data.sliders)
                }).catch((err) => {

                });
            },
            reservationList(context) {
                axios.get('/admin/reservation/list').then((response) => {
                    context.commit('reservations', response.data.reservations)
                }).catch((err) => {

                });
            },
            contactList(context) {
                axios.get('/admin/contact/list').then((response) => {
                    context.commit('contacts', response.data.contacts)
                }).catch((err) => {

                });
            }
  },
  mutations: {
    categories (state,data) {
      return state.category = data;
    },
    items(state,data){
        return state.item = data;
    },
     sliders(state,data){
        return state.slider = data;
    },
    reservations(state,data){
        return state.reservation =data;
    },
    contacts(state,data){
        return state.contact =data;
    }
  }
})

export default store;
