<template>
    <div class="row">
        <div class=" col-lg-7">
            <div class="card shadow">
                <div class="card-body">
                    <div class="h5 mb-3">キャラクターで探す</div>
                    <ul style="display:flex;flex-wrap:wrap;">
                        <li class="mx-1 mb-2 btn btn-secondary" style="width:90px;"  v-for="vocaloid in vocaloids" :key="vocaloid">
                            <a class="text-light text-decoration-none" href="#" @click="search(vocaloid)">{{vocaloid}}</a>
                        </li>
                    </ul>
                    <div class="mx-1 mb-2 btn btn-secondary float-right"><a class="text-light text-decoration-none" href="#" @click="search(null)">指定なし</a></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props:{
        'params': Object
    },
    data(){
        return {
            vocaloids: ['初音ミク','鏡音リン','鏡音レン','GUMI','flower','音街ウナ','可不','歌愛ユキ','巡音ルカ']
        }
    },
    methods:{
        search(vocaloid){
            let queries = {
                ...this.params,
                'vocaloid': vocaloid
                };
            queries.page = '1';
            this.$emit('load',queries);
        }
    }
}
</script>
