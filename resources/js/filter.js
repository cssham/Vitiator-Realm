import Vue from 'vue'
import moment from 'moment'
//timeFormat
Vue.filter('timeFormat',(arg)=>{
    return moment(arg).format("do MMM YYYY");
})
Vue.filter('shortLength',(text,length,suffix)=>{
    return text.substring(0,length)+suffix;
})
