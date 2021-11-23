<template>
    <div>
        <drop-down :params="params" @load="loadVideos"></drop-down>
        <div class="content px-2 py-5"  v-for="v in videos" :key="v.video_id">
            <div class="row">
                <h1 class="col-lg-1 d-none d-lg-block text-center pl-0 pl-0"><span class="badge badge-secondary">1</span></h1>
                <div class="col-lg-6 p-0">
                    <h1 class="d-lg-none text-center rank"><span class="badge badge-secondary">1</span></h1>
                    <img :src="'http://i.ytimg.com/vi/' + v.video_id + '/maxresdefault.jpg'" class="w-100 youtube-thumbnail">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-1 col-0"></div>
                <h2 class="col-lg-6 bg-light py-2 border-left border-primary content-title">{{v.title}}</h2>
            </div>
            <div class="row">

                <div class="col-lg-1 col-0"></div>
                <div class="col-lg-3 col-6 text-left">再生回数<div class="font-weight-bold">{{v.view_count}}</div></div>
                <div class="col-lg-3 col-6 text-right my-2">{{v.published_at}}</div>
            </div>
        </div>
        <pagination></pagination>
    </div>
</template>
<script>
import axios from 'axios';
import Pagination from './Pagination.vue';
import DropDown from './DropDown.vue';
export default {
    props: ['tableName','queries'],
        components: {
        'pagination': Pagination,
        'drop-down': DropDown
    },
    data(){
        return {
            videos: [],
            params: {
                'table_name':this.tableName,
                ...this.queries
                }
        }
    },
    created(){
        this.loadVideos(this.params);
    },
    methods:{
        loadVideos(queries){
            let that = this;
            this.params = {...this.params,...queries};
            axios.get('http://localhost:8000/api/video',{
                params: that.params
            })
            .then((response)=>{
                that.videos = response.data.data;
            });
        }
    }
}
</script>