<template>
    <div>
        <drop-down :params="params" :type="dropDownType" @load="loadVideos"></drop-down>
        <div class="row" v-show="isLoading == true">
            <div class="h5 col-lg-6  ml-lg-4">読み込み中. . .</div>
        </div>
        <div class="content px-2 py-5"  v-for="(v, i) in videos" :key="v.video_id">
            <div class="row">
                <h1 class="col-lg-1 d-none d-lg-block text-center pl-0 pl-0"><span class="badge badge-secondary">{{10*(params.page-1)+i+1}}</span></h1>
                <div class="col-lg-6 p-0" :id="v.video_id">
                    <h1 class="d-lg-none text-center rank"><span class="badge badge-secondary">{{10*(params.page-1)+i+1}}</span></h1>
                    <img :src="'http://i.ytimg.com/vi/' + v.video_id + '/maxresdefault.jpg'" class="w-100 youtube-thumbnail" @click="clicked(v.video_id)">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-1 col-0"></div>
                <h2 class="col-lg-6 bg-light py-2 border-left border-primary content-title">{{htmlspecialchars_decode(v.title)}}</h2>
            </div>
            <div class="row">

                <div class="col-lg-1 col-0"></div>
                <div class="col-lg-3 col-6 text-left">再生回数<div class="font-weight-bold">{{v.view_count}}</div></div>
                <div class="col-lg-3 col-6 text-right my-2">{{v.published_at}}</div>
            </div>
        </div>
        <pagination :params="params" :current-page="currentPage" :last-page="lastPage" :use-edge-link="useEdgeLink" :smartphone-page-limit="smartphonePageLimit" @load="loadVideos"></pagination>
        <br>
        <condition-card :params="params" @load="loadVideos" v-if="useConditionCard"></condition-card>
    </div>
</template>
<script>
import axios from 'axios';
import Pagination from './Pagination.vue';
import DropDown from './DropDown.vue';
import ConditionCard from './ConditionCard.vue';
export default {
    props: {
        'queries': Object,
        'tableName': String,
        'dropDownType': {
            type: String,
            default: 'notUse'
        },
        'useEdgeLink': {
            type: Boolean,
            default: false
        } ,
        'useConditionCard':{
            type: Boolean,
            default: false
        } 
    },
        components: {
        'pagination': Pagination,
        'drop-down': DropDown,
        'condition-card': ConditionCard
    },
    data(){
        return {
            videos: [],
            params: {
                'table_name':this.tableName,
                ...this.queries
                },
            currentPage: 1,
            lastPage: 10,
            isLoading: false
        }
    },
    created(){
        this.params.sort = this.dropDownType == 'year' ? '1' : '0';
        this.loadVideos(this.params);
    },
    methods:{
        loadVideos(queries){
            let that = this;
            this.isLoading = true;
            this.params = {...this.params,...queries};
            axios.get('http://www.vocalolist.com/api/video',{
                params: that.params
            })
            .then((response)=>{
                that.isLoading = false;
                that.videos = response.data.data;
                that.currentPage = response.data.current_page;
                that.lastPage = response.data.last_page;
                setTimeout(that.checkImg,500);
            });
        },
        clicked(videoId){
            let videoImgParent = document.getElementById(videoId);
            videoImgParent.innerHTML = `
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="https://www.youtube.com/embed/${videoId}"></iframe>
                </div>
            `;
        },
        checkImg() {
            let replaceThumbnails = [];
            let thumbnails = document.querySelectorAll('.youtube-thumbnail');
            thumbnails.forEach(function (thumbnail) {
                //横幅が120pxだったらエラー用の画像返されていると判断。0の場合もある
                if (thumbnail.naturalWidth == 120 || thumbnail.naturalWidth == 0) {
                    replaceThumbnails.push(thumbnail);
                }
            });
            if (replaceThumbnails.length != 0) {
                for (const thumbnail of replaceThumbnails) {
                    thumbnail.src = thumbnail.src.replace('maxresdefault','mqdefault');
                }
            }
        },
        htmlspecialchars_decode(str){
              return String(str).replaceAll("&amp;",'&')
                .replaceAll("&quot;",'"')
                .replaceAll("&lt;",'<')
                .replaceAll("&gt;",'>');
        }
    },
    computed:{
        smartphonePageLimit(){
            return this.params.table_name == 'famous_vocalovideos' ? 7 : 10;
        }
    }
}
</script>